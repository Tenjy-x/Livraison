<?php

use app\controllers\ApiExampleController;
use app\controllers\ApiProductsController;
use app\middlewares\SecurityHeadersMiddleware;
use flight\Engine;
use flight\net\Router;
use app\controllers\LivraisonController;
/** 
 * @var Router $router 
 * @var Engine $app
 */

// This wraps all routes in the group with the SecurityHeadersMiddleware
$router->group('', function(Router $router) use ($app) {
	$router->get('/', [LivraisonController::class , 'getAllLivraisonIndex']);

	$router->get('/liste', [LivraisonController::class , 'getAllLivraison']);
	$router->post('/insert', [LivraisonController::class , 'insertLivraison']);

	// $router->get('/produit/@id', function($id) use ($app) {
	// 	$app->render('produit', ['id' => $id]);
	// });

	$router->get('/hello-world/@name', function($name) {
		echo '<h1>Hello world! Oh hey '.$name.'!</h1>';
	});

	// $router->get('/route-i/@name', function($name) {
	// 	echo '<h1>OKAY '.$name.'!</h1>';
	// });

	$router->group('/api', function() use ($router) {
		// $router->get('/users', [ ApiExampleController::class, 'getUsers' ]);
		// $router->get('/users/@id:[0-9]', [ ApiExampleController::class, 'getUser' ]);
		// $router->post('/users/@id:[0-9]', [ ApiExampleController::class, 'updateUser' ]);
		
		$router->get('/products', [ApiProductsController::class, 'getProducts' ]);
	});
	
	
}, [ SecurityHeadersMiddleware::class ]);