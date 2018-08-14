<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\CarroControlador#index',
    ],
    // REST
    '/carros' => [
        'GET' => '\Controlador\CarroControlador#index',
        'POST' => '\Controlador\CarroControlador#armazenar',
    ],
    // REST
    '/carros/?' => [
        'GET' => '\Controlador\CarroControlador#mostrar',
        'PATCH' => '\Controlador\CarroControlador#atualizar',
        'DELETE' => '\Controlador\CarroControlador#destruir',
    ],
    // NÃO INCLUSO NO REST
    '/carros/criar' => [
        'GET' => '\Controlador\CarroControlador#criar',
    ],
    // NÃO INCLUSO NO REST
    '/carros/?/editar' => [
        'GET' => '\Controlador\CarroControlador#editar',
    ],
    // NÃO INCLUSO NO REST
    '/carros/?/vender' => [
        'PATCH' => '\Controlador\CarroControlador#vender',
    ],
    // NÃO INCLUSO NO REST
    '/carros/relatorio' => [
        'GET' => '\Controlador\CarroControlador#relatorio',
    ],
];
