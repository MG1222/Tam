<?php
	namespace App\Controller;

	use Library\Auth\Authenticate;
	use Library\Core\AbstractController;
	use App\Model\ProductModel;
	use App\Model\BasketModel;
	use Stripe\Stripe;
	use Stripe\Checkout\Session;


	class BasketController extends AbstractController
	{
		/**
		 * @return void
		 */
		public function index(): ?int
		{
			// if user not log in he is redirected to log in page
			if (!(auth()->isAuthenticated())) {
				$errors['basketError'] = "Oups... On doit être connecté pour voir votre panier.";
				if  (count($errors) > 0) {
					$_SESSION['error'] = $errors;
					$this->redirect('/logIn');
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
		 * method where we show the product
		 * and user can add it to his basket
		 */

		public function addToBasket(): void
		{
			$model = new ProductModel();
			$id = $_GET['id'];
			$product = $model->find($id);

			//check if product don't exist bc admin delete it in the same time
			if (empty($product)) {
				$errors['basketError'] = "OMG... Ce produit n'existe plus ";
				if (count($errors) > 0) {
					$_SESSION['error'] = $errors;
					$this->redirect('/');
				}
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


			$this->display('Product/productOne', [
				'product' => $product
			]);


		}

		/**
		 * @throws \Stripe\Exception\ApiErrorException
		 * @return void
		 * method where we checkout the basket
		 * and we send the user to the payment page
		 * and we send the user to the bravo page
		 *
		 */
		public function checkout(): void
		{
			$key = require_once 'config/stripe.php';
			require_once 'vendor/autoload.php';

			\Stripe\Stripe::setApiKey($key['STRIPE_SECRET_KEY']);

			$userId = auth()->getId();
			$model = new BasketModel();
			$baskets = $model->getBasket($userId);


			$session = Session::create([

				'line_items' => [
					array_map(fn(array $baskets) => [
						'quantity'   => 1,
						'price_data' => [
							'currency'     => 'EUR',
							'product_data' => [
								'name' => $baskets['name']
							],
							'unit_amount'  => $baskets['price'] * 100,
						]
					], $baskets)
				],
				'mode'                        => 'payment',
				'success_url'                 => 'http://localhost/project/index.php/basket/bravo',
				'cancel_url'                  => 'http://localhost/project/index.php/basket',
				'billing_address_collection'  => 'required',
				'shipping_address_collection' => [
					'allowed_countries' => ['FR']
				],
				'metadata'                    => [
					'cart_id' => $baskets[0]['id']
				]

			]);

			header("HTTP/1.1 303 See Other");
			header("Location: " . $session->url);
			exit;

		}

		/**
		 * @return void
		 */
		public function bravo(): void
		{
			if (auth()->isAuthenticated()) {
				$userId = auth()->getId();
				$model = new BasketModel();
				$baskets = $model->getBasket($userId);
					if ($baskets) {
						$model->deleteAll($userId);
						$this->display('Basket/bravo');
					}
			} else {
				$this->redirect('/');
			}

		}


		/**
		 * @return void
		 * method user can delete product from his basket
		 */

		public function deleteFromBasket(): void
		{
			$model = new BasketModel();
			$id = $_GET['id'];
			$model->delete($id);
			$this->redirect('/basket');
		}




	}