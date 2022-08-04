<?php
	namespace App\Controller;

	use Library\Auth\Authenticate;
	use Library\Core\AbstractController;
	use App\Model\UserModel;

	class AdminController extends AbstractController
	{
		public function index(): void
		{
			if (!auth()->isAdmin()) {
				$this->redirect('/product/');
			}
			$this->display('Admin/index');
		}


	}