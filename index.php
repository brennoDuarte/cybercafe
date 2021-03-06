<?php

session_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'vendor/autoload.php';
require 'dependences.php';
require 'rotas/rota-admin.php';
require 'rotas/rota-cliente.php';
require 'rotas/rota-noticia.php';
require 'rotas/rota-empresa.php';
require 'rotas/rota-produtos.php';
require 'rotas/rota-usuario.php';
require 'rotas/rota-login.php';
require 'rotas/rota-dash.php';
require 'rotas/rota-vendas.php';
require 'rotas/rota-pag.php';

$app->run();