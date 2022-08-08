<?php
	namespace App\Controller;

	use Library\Auth\Authenticate;
	use Library\Core\AbstractController;
	use App\Model\ProductModel;

	class AdminController extends AbstractController
	{
		public function index(): void
		{
			if (!auth()->isAdmin()) {
				$this->redirect('/');
			}
			$this->display('Admin/index');
		}


		public function edit(): void
		{
			if (!auth()->isAdmin()) {
				$this->redirect('/');
				}

			$model = new ProductModel();
			$id = $_GET['id'];
			$product = $model->find($id);

			if (isset($_FILES['name']) && isset($_POST['description']) && isset($_POST['price'] )) {
				$model->update($id, [
					'name' => $_POST['name'],
					'description' => $_POST['description'],
					'price' => $_POST['price']
				]);
				$this->redirect('/');
			}


			$this->display('Admin/edit', [
				'product' => $product
			]);
		}



	}