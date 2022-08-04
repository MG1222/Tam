<?php
	namespace App\Controller;

	use Library\Core\AbstractController;
	use Stripe\Stripe;
	use App\Model\BasketModel;
	use Stripe\Checkout\Session;




	class StripeController extends AbstractController
	{

		/**

		 * @return void
		 */
		public function index(): void
		{
			require_once 'vendor/autoload.php';
			require_once 'config/stripe.php';

			\Stripe\Stripe::setApiKey('sk_test_51LT6lAB3dtYEA9zhYsDjfdnEDzPgRuAJ6IDvItqY8cAlsK9Sds27bBazg8WF2z1dkxKTbkSbfOrrVjRjNOwigFR200mbz2UIJL');

		}
	}