<?php
    $routes = array(
			'Httpstatus' => [
				'home' => '/',
				'ajouterside' => '/ajoutersite',
				'connexion' => '/connexion',
				'historique' => '/historique/{id}',
				'login' => '/login',
			],
			'Api' => [
				'endpoint' => '/api',
				'list' => '/api/list',
				'add' => '/api/add',
				'status' => '/api/status/{id}',
				'history' => '/api/history/{id}',
				'delete' => '/api/delete/{id}',
			],
    );

    define('ROUTES', $routes);
