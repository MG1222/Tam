<?php
	namespace App\Controller;

	use Library\Auth\Authenticate;
	use Library\Core\AbstractController;
	use App\Model\ProductModel;
	use Library\Http\NotFoundException;
	use App\Model\BasketModel;

	class ProductController extends AbstractController
	{
		/**
		 * @var ProductModel
		 * @var Authenticate
		 * method for creating a new product only admin can do it
		 */
		public function store(): void
		{
			if (!auth()->isAdmin()) {
				$this->redirect('/');
			}
			$extensions = ['jpeg', 'gif'];

			$model = new ProductModel();
			//check if input is valid
			if (empty($_FILES['img']) ||  empty($_POST['name']) || empty($_POST['description']) || empty($_POST['price'])) {
				$_SESSION['error'] = "Vous devez remplir tous les champs";
				$this->redirect('/admin');
			}
			if (isset($_FILES['img'])) {
					// if the file is empty
				if ($_FILES['img']['error'] !== 0) {
						$_SESSION['error'] = "pas de img";
						$this->redirect('/admin');
					}

					// if !(.jpg or .gif)
				$extension = explode('/', $_FILES['img']['type'])[1];
				if (!in_array($extension, $extensions)) {
						$_SESSION['error'] = "extension non autorisée";
						$this->redirect('/admin');
					}
				// change the name of the file (unique)
				$fileName = uniqid();

				// move the file to the directory
				move_uploaded_file($_FILES['img']['tmp_name'], "asset/img/products/$fileName.$extension");


				// if evrything is ok, we create the product
				$model->create([
						'name' => $_POST['name'],
						'description' => $_POST['description'],
						'price' => $_POST['price'],
						'img' => $fileName . '.' . $extension
						]);
				$this->redirect('/');
			}

		}

		/**
		 *
		 * @var ProductModel
		 * method for show all products in home page
		 */

		public function showAll(): void
		{
			$model = new ProductModel();
			$products = $model->getAll();

			$this->display('Product/productsAll', [
				'products' => $products
			]);
		}

		/**
		 * @var ProductModel
		 * method for edit a product only admin can do it
		 * @return void
		 */

		public function edit(): void
		{
			if (!auth()->isAdmin()) {
				$this->redirect('/');
			}
			$model = new ProductModel();
			$product = $model->find($_GET['id']);





		}

		/**
		 * @var ProductModel
		 * @var Authenticate
		 * method for delete a product only admin can do it
		 */
		public function delete(): void
		{
			if (!auth()->isAdmin()) {
				$this->redirect('/');
			}

			$basket = new BasketModel();
			$idProduct = $_GET['id'];
			$inBasket = $basket->getBasketAdmin($idProduct);

			if ($inBasket) {
				$errors['error'] = "Ce produit est dans un panier, vous ne pouvez pas le supprimer ! Contactez le utilisateur qui a commandé ce produit";
				if (count($errors) > 0) {
					$_SESSION['error'] = $errors;
					$this->redirect('/');

				}
			}

			$model = new ProductModel();
			 $model->delete($idProduct);
			$this->redirect('/');


		}

















	}