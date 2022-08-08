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


			if (empty($basket)) {
				return null;
			}

			return $basket;
		}

		public function getBasketAdmin(int $id): ?array
		{
			$basket = $this->db->getResults(
				sql: 'SELECT * FROM products LEFT JOIN basket ON products.id=basket.product_id WHERE basket.product_id = :id', parameters: [
				'id' => $id

			]);


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

public function deleteAll(int $user_id): ?string
		{
			$basketId = $this->db->execute('DELETE FROM basket WHERE user_id = :user_id', [
				'user_id' => $user_id
			]);

			//if no basket is created, return null
			if (empty($basketId)) {
				return null;
			}
			return $basketId;
		}


	}