<?php
	namespace App\Model;

	use Library\Core\AbstractModel;

	class ProductModel extends AbstractModel
	{


		/**
		 * Create a product in database
		 * @param array $data Product data to insert
		 * @return int|null Product id or null
		 */
		public function create (array $data): ?int
		{
            // 1. Create a product on Stripe ?
            // 2. Retrieve a "stripe_product_id".
            // 3. Insert new product into SQL DB (with stripe_product_id)

			$productId = $this->db->execute('INSERT INTO products (img, name, description, price) VALUES (:img, :name, :description, :price)', [
				'img' => $data['img'],
				'name' => $data['name'],
				'description' => $data['description'],
				'price' => $data['price']
			]);

			//if no product is created, return null
			if (empty($productId)) {
				return null;
			}
			return $productId;

		}

		/**
		 * Get all products from database
		 * @return array Array of products
		 */

		public function getAll(): array
		{
			return $this->db->getResults('SELECT id, img, name, description, price FROM products order by id desc');
		}

		/**
		 * Get a product by his id
		 * @param int $id Product id
		 * @return array|null Array of product or null
		 */

		public function find(int $id): ?array
		{
			$results = $this->db->getResults('SELECT id, img, name, description, price FROM products WHERE id = :id', [
				'id' => $id
			]);

			if (empty($results)) {
				return null;
			}
			return $results[0];

		}

		/**
		 * @param int $id Product id
		 * @return int|null Product id or null
		 */

		public function findById(int $id): ?array
		{
			$results = $this->db->getResults('SELECT id, img, name, description, price FROM products WHERE id = :id', [
				'id' => $id
			]);

			if (empty($results)) {
				return null;
			}
			return $results;

		}

		/**
		 * Update a product in database
		 * @param int $id Product id
		 * @param array $data Product data to update
		 * @return int|null Product id or null
		 */
		public function update (int $id, array $data): ?int
		{
			$productId = $this->db->execute('UPDATE products SET img = :img, name = :name, description = :description, price = :price WHERE id = :id', [
				'id' => $id,
				'img' => $data['img'],
				'name' => $data['name'],
				'description' => $data['description'],
				'price' => $data['price']
			]);

			//if no product is created, return null
			if (empty($productId)) {
				return null;
			}
			return $productId;
		}

		/**
		 * Delete a product from database
		 * @param int $id Product id
		 * @return int|null Product id or null
		 */

		public function delete (int $id): ?int
		{
			$productId = $this->db->execute('DELETE FROM products WHERE id = :id', [
				'id' => $id
			]);

			//if no product is created, return null
			if (empty($productId)) {
				return null;
			}
			return $productId;
		}



	}