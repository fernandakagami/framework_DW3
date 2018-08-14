<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\RaizControlador#index',
    ],
    // REST
    '/alunos' => [
        'GET' => '\Controlador\AlunoControlador#index',
        'POST' => '\Controlador\AlunoControlador#armazenar',
    ],
    '/relatorios/notas' => [
        'GET' => '\Controlador\RelatorioControlador#index',
    ],
];
