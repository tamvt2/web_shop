<?php

$router->get('/login', 'user@index');
$router->get('/register', 'user@show');
$router->get('/logout', 'user@logout');
$router->post('/register', 'user@register');
$router->post('/login', 'user@login');
$router->post('/update', 'user@update');

$router->get('/add-category', 'category@create');
$router->get('/update-category/:id', 'category@show');
$router->get('/list-category', 'category@index');
$router->post('/add-category', 'category@insert');
$router->post('/update-category/:id', 'category@update');
$router->delete('/destroy-category/:id', 'category@delete');

$router->get('/add-product', 'product@create');
$router->get('/update-product/:id', 'product@show');
$router->get('/list-product', 'product@index');
$router->post('/add-product', 'product@insert');
$router->post('/update-product/:id', 'product@update');
$router->delete('/destroy-product/:id', 'product@delete');

$router->get('/list-cart-item', 'cart@index');
$router->get('/list-order', 'order@index');
$router->get('/list-order-item', 'orderitem@index');

// $router->get('/add', 'product@create');
// $router->post('/add', 'product@store');
// $router->get('/update/:id', 'product@show');
// $router->post('/update/:id', 'product@edit');
// $router->delete('/destroy/:id', 'product@delete');

$router->get('/api/v1/product/list', 'product@list');
$router->post('/api/v1/product/update/:id', 'product@update');
$router->delete('/api/v1/product/delete/:id', 'product@delete');

$router->post('/uploadImage', 'home@upload');
$router->get('/search', 'home@search');
$router->post('/add-cart', 'home@addCart');
$router->post('/buy-cart', 'home@buyCart');
$router->post('/update-cart/:id', 'home@updateCart');
$router->post('/destroy-cart/:id', 'home@delete');

$router->get('/', function() {
	include './Application/Views/home.php';
});

$router->get('/user', 'home@index');