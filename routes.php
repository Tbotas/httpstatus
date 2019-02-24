<?php
    $routes = array(
			'Httpstatus' => [
				'home' => '/',
				'ajoutersite' => '/ajoutersite',
				'connexion' => '/connexion',
				'historique' => '/historique/{id}',
				'login' => '/login',
				'deconnexion' => '/deconnexion',
				'supprimer' => '/supprimer/{id}',
				'add_website' => '/add_website'
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
