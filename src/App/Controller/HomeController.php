<?php
	namespace App\Controller;

	use Library\Core\AbstractController;


	class HomeController extends AbstractController
	{
		public function index(): void
		{
			$this->display('home');
		}
	}