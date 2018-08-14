<?php

$rotas = [
  '/' => [
      'GET' => '\Controlador\PedidoControlador#index',
  ],
  '/pedidos' => [
      'GET' => '\Controlador\PedidoControlador#index',
      'POST' => '\Controlador\PedidoControlador#armazenar',
  ],
  // REST
  '/pedidos/?' => [
      'PATCH' => '\Controlador\PedidoControlador#atualizar',
      'DELETE' => '\Controlador\PedidoControlador#destruir',
  ],
  // NÃO INCLUSO NO REST
  '/pedidos/criar' => [
      'GET' => '\Controlador\PedidoControlador#criar',
  ],
  // NÃO INCLUSO NO REST
  '/pedidos/?/editar' => [
      'GET' => '\Controlador\PedidoControlador#editar',
  ],
  // REST
  '/lanches' => [
      'GET' => '\Controlador\LancheControlador#lanche',
      'POST' => '\Controlador\LancheControlador#armazenar',
  ],
  // REST
  '/lanches/?' => [
      'DELETE' => '\Controlador\LancheControlador#destruir',
  ],
  // NÃO INCLUSO NO REST
  '/lanches/criar' => [
      'GET' => '\Controlador\LancheControlador#criar',
  ],
];
