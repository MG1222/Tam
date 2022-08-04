<?php
	namespace App\Controller;

	use Library\Auth\Authenticate;
	use Library\Core\AbstractController;
	use App\Model\UserModel;

	class UserController extends AbstractController
	{
		/**** Sign Up / Log In / Log Out ****/

		/**
		 * @return void
		 */
		public function signUp(): void
		{
			if (auth()->isAuthenticated()) {
				$this->redirect('/');
			}
			$this->display('User/signUp');

		}

		/**
		 * method for signUp user
		 *
		 * @return void
		 */

		public function store(): void
		{
			if (auth()->isAuthenticated()) {
				$this->redirect('/');
			}

			$model = new UserModel();

			$user = $model->findByEmail($_POST['email']);
			$errors = $this->validForm($_POST);
			//check if email exist
			if (!empty($user)) {
				$errors['email'] = "Cet email existe déjà, voulez vous vous plutot connecter ?";
			}
			if ($_POST['password'] < 8 ) {
				$errors['password'] = "Votre mot de passe doit contenir au moins 8 caractères";
			}
			//check if there is an error
			if (count($errors) > 0) {
				$_SESSION['error'] = $errors;
				$this->redirect('/signUp');
			}

			$id = $model->create([
				'email' => $_POST['email'],
				'password' => password_hash($_POST['password'], PASSWORD_ARGON2ID)
			]);

			// if the user is created he is logged in
			auth()->logIn($id);

			$this->redirect('/');

		}
 		/**  method for logIn user
		 * @return void
		 */
		public function logIn(): void
		{
			if (auth()->isAuthenticated()) {

				$this->redirect('/');
			}
			$this->display('User/logIn');
		}



		/**
		 * method for logIn user
		 * if user has already acccount, he can log in
		 * we check if the password is correct and authenticate the user
		 * @return void
		 */
		public function auth(): void
		{
			if (auth()->isAuthenticated()) {
				$this->redirect('/');

			}
			$model = new UserModel();
			$user = $model->findByEmail($_POST['email']);

			// if the user is not found
			if ($user === null) {
				$_SESSION['error'] =  [
					'email' => "Cet email n'existe pas, voulez vous vous plutot créer un compte ?"
				];
				//redirect to the login page
				$this->redirect('/logIn');
			}

			if (!password_verify($_POST['password'], $user['password'])) {
				$_SESSION['error'] = [
					'password' => "Le mot de passe est incorrect"
				];
				$this->redirect('/logIn');
			}

			//if user is admin
			if ($user['role'] === 'admin') {
				 $_SESSION['admin'] = $user['role'];
				auth()->logIn($user['id']);
				$this->redirect('/admin');

			}

			// if the user is found
			auth()->logIn($user['id']);


			$this->redirect('/');
		}


		/**
		 * method for logOut user
		 * @return void
		 */

		public function logOut(): void
		{
			auth()->logOut();
			$this->redirect('/');
		}


		/**
		 * method check if the form is valid
		 *
		 * @param array $data
		 * @return array
		 */

		public function validForm(array $data): array
		{
			$errors = [];

			if (empty($data['email'])) {
				$errors['email'] = "L'email ne doit pas être vide";
			}

			if (empty($data['password']) || strlen($data['password']) < 8) {
				$errors['password'] = "Le mot de passe ne doit pas être vide et il doit etre minimin 8 caractères";
			}

			return $errors;
		}

		/**
		 * method for display the user profile
		 * @return void
		 */
		//****** Profile / Edit ******//

		public function userProfile(): ?array
		{
			// if the user is not logged in
			if (!auth()->isAuthenticated()) {
				$this->redirect('/');
			}
			$model = new UserModel();
			$user = $model->findById($_SESSION['user_id']);

			$this->display('User/profile', [
				'user' => $user]);

			var_dump($user);

			return $user;
		}

		/**
		 * method for display the edit profile page
		 * @return void
		 */
		public function edit(): void
		{
			// if the user is not logged in
			if (!auth()->isAuthenticated()) {
				$this->redirect('/');
			}
			$user = new UserModel();
			$user->update($_SESSION['user_id'], [
				'firstName' => $_POST['firstName'],
				'lastName' => $_POST['lastName'],
				'address' => $_POST['address'],
				'city' => $_POST['city'],
				'codePostal' => $_POST['codePostal']
			]);
			//var_dump($user);
			$this->redirect('/profile');


		}
		/**
		 * method for display the edit password
		 * @return void
		 */

		public function editPassword(): void
		{
			// if the user is not logged in
			if (!auth()->isAuthenticated()) {
				$this->redirect('/');
			}

			// Récupération de l'id de l'utilisateur connecté
			$auth = new Authenticate();
			$userId = $auth->getId();

			// Récupération des infos de l'utilisateur en base de données
			$model = new UserModel();
			$user = $model->findById($userId);

			// Vérification de l'ancien mot de passe
			if (!password_verify($_POST['passwordOld'], $user['password'])) {
				$_SESSION['error'] = [
					'password' => "Le mot de passe est incorrect"
				];
				if ($_POST['newPassword'] < 8) {
					$_SESSION['error'] = [
						'password' => "Le mot de passe doit être minimin 8 caractères"
					];
				}

				$this->redirect('/profile');
			}

			// Modification du mot de passe si l'ancien est correct
			$model->updatePassword($userId, $_POST['newPassword']);

			// Redirection
			$this->redirect('/profile');
		}

		/******* Delete User *****/
		/**
		 * method for delete the user
		 * @return void
		 */

		public function delete (): void
		{
			// if the user is not logged in
			if (!auth()->isAuthenticated()) {
				$this->redirect('/');
			}
			$auth = new Authenticate();
			$userId = $auth->getId();

			$model = new UserModel();
			$model->findById($userId);

			if (empty($_POST['DELETE'])) {
				$_SESSION['error'] = [
					'delete' => 'Pour supprime votre compte coche svp'
				];
			}

			$auth->logOut();
			$model->delete($userId);

			$this->redirect('/');

		}































	}