<?php

	namespace App\Model;

	use Library\Core\AbstractModel;

	class UserModel extends AbstractModel
	{



		/**
		 * Create a user in database
		 * @param array $data User data to insert
		 * @return int|null User id or null
		 */

		public function create(array $data): ?int
		{
			$userId = $this->db->execute('INSERT INTO users (email, password) VALUES (:email, :password)', [
				'email' => $data['email'],
				'password' => $data['password']
			]);

			//if no user is created, return null
			if (empty($userId)) {
				return null;
			}
			return $userId;
		}

		/**
		 * Find a user by his email
		 * @param string $email User email
		 **/
		public function findByEmail(string $email): ?array
		{
			$user = $this->db->getResults(
				sql: 'SELECT id, role, firstName, lastName, email, password, createdAt 
				FROM users
				WHERE email = :email', parameters: [
					'email' => $email
				]
			);
			// var_dump($user);
			if (empty($user)) {
				return null;
			}

			return $user[0];
		}

		public  function findById(int $id): ?array
		{
			$user = $this->db->getResults(
				sql: 'SELECT id, role, firstName, lastName, email, address, city, codePostal, password, createdAt 
				FROM users
				WHERE id = :id', parameters: [
					'id' => $id
				]
			);
			if (empty($user)) {
				return null;
			}


			return $user[0];
		}

		public function update (int $id, array $data): ?string
		{
			$user = $this->db->execute('UPDATE users SET firstName = :firstName, lastName = :lastName, address = :address, city = :city, codePostal = :codePostal WHERE id = :id', [
				'firstName' => $data['firstName'],
				'lastName' => $data['lastName'],
				'address' => $data['address'],
				'city' => $data['city'],
				'codePostal' => $data['codePostal'],
				'id' => $id
			]);
			if (empty($user)) {
				return null;
			}

			return $user;
		}
		public function updatePassword (int $id, string $password): ?string
		{
			$user = $this->db->execute('UPDATE users SET password = :password WHERE id = :id', [
				'password' => $password,
				'id' => $id
			]);
			if (empty($user)) {
				return null;
			}

			return $user;
		}

		public function findAll(int $id): ?array
		{
			$users = $this->db->getResults(
				sql: 'SELECT id, firstName, lastName, email, address, city, codePostal, password, createdAt 
				FROM users
				WHERE id = :id', parameters: [
					'id' => $id
				]
			);
			if (empty($users)) {
				return null;
			}

			return $users;
		}

		public function delete(int $id): ?string
		{
			$user = $this->db->execute('DELETE FROM users WHERE id = :id', [
				'id' => $id
			]);
			if (empty($user)) {
				return null;
			}

			return $user;
		}











	}
