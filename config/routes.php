<?php
	return [
		// Home show all products
		'/' => [
			'App\Controller\ProductController',
			'showAll'
		],
		// products
		'/product/store' => [
			'App\controller\ProductController',
			'store'
		],
		// show product possible to add to basket
		'/product/show' => [
			'App\controller\BasketController',
			'addToBasket'
		],
		//edit product
		'/product/edit' => [
			'App\controller\ProductController',
			'edit'
		],
		// product delete
		'/product/delete' => [
			'App\controller\ProductController',
			'delete'
		],
		// basket
		'/basket' => [
			'App\controller\BasketController',
			'index'
		],
		// basket checkout
		'/basket/checkout' => [
			'App\controller\BasketController',
			'checkout'
		],
		// basket delete
		'/basket/deleteFromBasket' => [
			'App\controller\BasketController',
			'deleteFromBasket'
		],
		//admin
		'/admin' => [
			'App\controller\AdminController',
			'index'
		],
		'/edit' => [
			'App\controller\AdminController',
			'edit'
		],
		// users
		'/signUp' => [
			'App\Controller\UserController',
			'signUp'
		],
		'/user/store' => [
			'App\Controller\UserController',
			'store'
		],
		'/logIn' => [
			'App\Controller\UserController',
			'logIn'
		],
		'/user/auth' => [
			'App\Controller\UserController',
			'auth'
		],
		'/logOut' => [
			'App\Controller\UserController',
			'logOut'
		],
		'/profile' => [
			'App\Controller\UserController',
			'userProfile'
		],
		'/user/edit' => [
			'App\Controller\UserController',
			'edit'
		],
		'/user/editPassword' => [
			'App\Controller\UserController',
			'editPassword'
		],
		'/user/delete' => [
			'App\Controller\UserController',
			'delete'
		]









	];