<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\RaizControlador#index',
    ],
    '/login' => [
        'GET' => '\Controlador\LoginControlador#criar',
        'POST' => '\Controlador\LoginControlador#armazenar',
        'DELETE' => '\Controlador\LoginControlador#destruir',
    ],
    '/usuarios' => [
        'POST' => '\Controlador\UsuarioControlador#armazenar',
    ],
    '/usuarios/criar' => [
        'GET' => '\Controlador\UsuarioControlador#criar',
    ],
    '/usuarios/sucesso' => [
        'GET' => '\Controlador\UsuarioControlador#sucesso',
    ],
    '/fotos' => [
        'GET' => '\Controlador\FotoControlador#index',
        'POST' => '\Controlador\FotoControlador#armazenar',
    ], 
    '/fotos/?' => [
        'POST' => '\Controlador\VotoControlador#avaliar',
    ],
    '/fotos/ranking' => [
        'GET' => '\Controlador\FotoControlador#ranking',        
    ],    
];
