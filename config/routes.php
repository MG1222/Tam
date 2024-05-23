<?php
	return [
		// Home show all products
		'/' => [
			'App\Controller\ProductController',
			'showAll'
		],
		// products
		'/product/store' => [
			'App\Controller\ProductController',
			'store'
		],
		// show product possible to add to basket
		'/product/show' => [
			'App\Controller\BasketController',
			'addToBasket'
		],
		//edit product
		'/product/edit' => [
			'App\Controller\ProductController',
			'edit'
		],
		// product delete
		'/product/delete' => [
			'App\Controller\ProductController',
			'delete'
		],
		// basket
		'/basket' => [
			'App\Controller\BasketController',
			'index'
		],
		// basket checkout
		'/basket/checkout' => [
			'App\Controller\BasketController',
			'checkout'
		],
		'/basket/bravo' => [
			'App\Controller\BasketController',
			'bravo'
		],
		// basket delete
		'/basket/deleteFromBasket' => [
			'App\Controller\BasketController',
			'deleteFromBasket'
		],
		//admin
		'/admin' => [
			'App\Controller\AdminController',
			'index'
		],
		'/edit' => [
			'App\Controller\AdminController',
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
