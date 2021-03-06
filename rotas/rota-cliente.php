<?php

require 'DAO/ClientesDAO.php';
require 'Model/Clientes.php';

$app->get('/clientes', function ($request, $response, $args) {

    if ($_SESSION['logado']) {
        $clienteDAO = new ClientesDAO();
        $res = $clienteDAO->listar();
        
        return $this->view->render($response, 'clientes.html', [
            'clientes' => $res
        ]);
    } else {
        return $response->withRedirect($this->router->pathFor('login'));
    }

})->setName('clientes');

$app->get('/cadastrarClientes', function ($request, $response, $args) {
    
    if ($_SESSION['logado']) {
        $pontos = new PontosFisicosDAO();
        $res = $pontos->listar();

        return $this->view->render($response, 'cadastrarcliente.html', [
            'pontos' => $res
        ]);
    } else {
        return $response->withRedirect($this->router->pathFor('login'));
    }

})->setName('cadastrarClientes');

$app->get('/AlterarClientes/{id}', function ($request, $response, $args) {

    if ($_SESSION['logado']) {
        $clienteDAO = new ClientesDAO();
        $pontos = new PontosFisicosDAO();
        $res = $clienteDAO->listarUnico($args['id']);
        $res2 = $pontos->listar();

        return $this->view->render($response, 'alterarcliente.html', [
            'cliente' => $res,
            'pontos' => $res2
        ]);
    } else {
        return $response->withRedirect($this->router->pathFor('login'));
    }

})->setName('AlterarClientes');

$app->post('/cadastrarClientes', function ($request, $response, $args) {
    
    if ($_SESSION['logado']) {
        $nome = filter_input(INPUT_POST, 'nome');
        $cpf = filter_input(INPUT_POST, 'cpf');
        $ponto = filter_input(INPUT_POST, 'ponto');
        $vip = filter_input(INPUT_POST, 'vip');

        $clienteModel = new Clientes();
        $clienteDAO = new ClientesDAO();
        $clienteModel->setNome($nome);
        $clienteModel->setCpf($cpf);
        $clienteModel->setPonto_registrado($ponto);
        $clienteModel->setVip($vip);
        $clienteDAO->salvar($clienteModel);
        
        return $response->withRedirect($this->router->pathFor('clientes'));
    } else {
        return $response->withRedirect($this->router->pathFor('login'));
    }

})->setName('cadastrarClientes');

$app->post('/AlterarClientes/{id}', function ($request, $response, $args) {
    
    if ($_SESSION['logado']) {
        $nome = filter_input(INPUT_POST, 'nome');
        $cpf = filter_input(INPUT_POST, 'cpf');
        $ponto = filter_input(INPUT_POST, 'ponto');
        $vip = filter_input(INPUT_POST, 'vip');

        $clienteModel = new Clientes();
        $clienteDAO = new ClientesDAO();
        $clienteModel->setNome($nome);
        $clienteModel->setCpf($cpf);
        $clienteModel->setPonto_registrado($ponto);
        $clienteModel->setVip($vip);
        $clienteDAO->alterar($clienteModel, $args['id']);
        
        return $response->withRedirect($this->router->pathFor('clientes'));
    } else {
        return $response->withRedirect($this->router->pathFor('login'));
    }

})->setName('AlterarClientes');

$app->get('/DeletarCliente/{id}', function ($request, $response, $args) {

    if ($_SESSION['logado']) {
        try {
            $clienteDAO = new ClientesDAO();
            $clienteDAO->deletar($args['id']);
            
            return $response->withRedirect($this->router->pathFor('clientes'));
        } catch (PDOException $e) {
            return $response->withRedirect($this->router->pathFor('erroChave'));
        }
    } else {
        return $response->withRedirect($this->router->pathFor('login'));
    }

})->setName('DeletarCliente');