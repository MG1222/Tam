<?php
	namespace App\Controller;

	use Library\Auth\Authenticate;
	use Library\Core\AbstractController;
	use App\Model\ProductModel;
	use App\Model\BasketModel;


	class BasketController extends AbstractController
	{
		/**
		 * @return void
		 */
		public function index(): ?int
		{
			// if user not log in he is redirected to log in page
			if (!(auth()->isAuthenticated())) {
				$errors['basketError'] = "Vous devez être connecté pour accéder à votre panier";
				if  (count($errors) > 0) {
					$_SESSION['error'] = $errors;
					$this->redirect('/signUp');
				}
			}

			// if user is log in we show his basket
			$userId = auth()->getId();
			$model = new BasketModel();
			$baskets = $model->getBasket($userId);

			$totalPrice = 0;
			if ($baskets) {
				foreach ($baskets as $basket) {
					$totalPrice += $basket['price'];
				}
			}





			$this->display('Basket/basket', ['baskets' => $baskets,
				'totalPrice' => $totalPrice]);
			return $totalPrice;
		}

		/**
		 * @return void
		 */

		public function addToBasket(): void
		{
			$model = new ProductModel();
			$id = $_GET['id'];
			$product = $model->find($id);

			//check if product exist
			if (empty($product)) {
				throw new NotFoundException('Product not found');
			}

			if (isset($_POST['submit'])) {
				$basketModel = new BasketModel();
				$basketModel->add($id, [
					'user_id' => auth()->getId(),
					'product_id' => $id,
					'quantity' => 1

				]);

				$this->redirect('/basket');

			}

			//var_dump($product);

			$this->display('Product/productOne', [
				'product' => $product
			]);


		}

		public function checkout(): void
		{
			$stripe = new \Stripe\StripeClient(
				$this->getConfig()['stripe']['key'],
				$this->getConfig()['stripe']['keySecret']
			);

		}


		/**
		 * @return void
		 */

		public function deleteFromBasket(): void
		{
			$model = new BasketModel();
			$id = $_GET['id'];
			$model->delete($id);
			$this->redirect('/basket');
		}

		private function getConfig()
		{

		}


	}