<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\MensagemControlador#index',
        'POST' => '\Controlador\MensagemControlador#armazenar',
    ],

    '/pedido' => [
        'GET' => '\Controlador\MensagemControlador#pedido',
    ]
];
