<?php
	namespace App\Model;

	use Library\Core\AbstractModel;

	class BasketModel extends AbstractModel
	{
		public function add(int $id, array $data): ?string
		{
			$basketId = $this->db->execute('INSERT INTO basket (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)', [
				'user_id' => $data['user_id'],
				'product_id' => $data['product_id'],
				'quantity' => $data['quantity']
			]);

			//if no basket is created, return null
			if (empty($basketId)) {
				return null;
			}
			return $basketId;
		}

		public function getBasket(int $user_id): ?array
		{
			$basket = $this->db->getResults(
				sql: 'SELECT * FROM products LEFT JOIN basket ON products.id=basket.product_id WHERE basket.user_id = :user_id', parameters: [
					'user_id' => $user_id

				]);

			 //var_dump($basket);
			if (empty($basket)) {
				return null;
			}

			return $basket;
		}

		public function delete(int $id): ?string
		{
			$basketId = $this->db->execute('DELETE FROM basket WHERE id = :id', [
				'id' => $id
			]);

			//if no basket is created, return null
			if (empty($basketId)) {
				return null;
			}
			return $basketId;
		}









		//TODO how to make basket in php
		//todo step 1 create  table basket ? witd id user_id and product_id ?
		//todo step 2 if user not log he can't use basket
		//todo each user have 1 basket
		// todo user can modifie basket
		//todo step 3 if address is ok he can pay via stripe ?


	}