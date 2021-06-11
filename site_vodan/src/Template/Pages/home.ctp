<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->layout = false;

if (!Configure::read('debug')) :
    throw new NotFoundException(
        'Please replace src/Template/Pages/home.ctp with your own version or re-enable debug mode.'
    );
endif;

$cakeDescription = 'CakePHP: the rapid development PHP framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>
    </title>

    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->css('base.css') ?>
    <?= $this->Html->css('style.css') ?>
    <?= $this->Html->css('home.css') ?>
    <link href="https://fonts.googleapis.com/css?family=Raleway:500i|Roboto:300,400,700|Roboto+Mono" rel="stylesheet">
</head>
<body class="home">

<header class="row">
    <div class="header-image"><?= $this->Html->image('cake.logo.svg') ?></div>
    <div class="header-title">
        <h1>Welcome to CakePHP <?= Configure::version() ?> Red Velvet. Build fast. Grow solid.</h1>
    </div>
</header>

<div class="row">
    <div class="column">
        <h4>Formulários</h4>
        <ul>
            <li class = "consultar_questionarios" ><a href = "../Questionnaires">Consultar/Manipular questionario existente</a></li>
            <li><?= $this->Html->link(__('Adicionar questionário'), ['controller' => 'Questionnaires', 'action' => 'add']) ?></li>
        </ul>
    </div>
</div>
<hr>
<div class="row">
    <div class="column">
        <h4>Tipo de Questões</h4>
        <ul>
            <li class = "consulta_questoes"><a href = "../QuestionTypes">Consultar/Manipular tipos de questões</a></li>
            <li><?= $this->Html->link(__('Criar novo tipo de questão'), ['controller' => 'QuestionTypes', 'action' => 'add']) ?></li>
        </ul>
    </div>
</div>
<hr>
<div class="row">
    <div class="column">
        <h4>Respostas Padronizadas</h4>
        <ul>
            <li class = "consulta_lista_resp" ><a href = "../ListTypes">Consultar/Manipular lista de respostas</a></li>
            <li><?= $this->Html->link(__('Criar lista de respostas'), ['controller' => 'ListTypes', 'action' => 'add']) ?></li>
        </ul>
    </div>
</div>
<hr>
<div class="row">
    <div class="column">
        <h4>Questões</h4>
        <ul>
            <li class = "nova_questoes" ><a href = "../Questions">Ver questões</a></li>
            <li><?= $this->Html->link(__('Criar nova questão'), ['controller' => 'Questions', 'action' => 'add']) ?></li>
        </ul>
    </div>
</div>
<hr>
<div class="row">
    <div class="columns large-6">
        <h4>Database</h4>
        <?php
        try {
            $connection = ConnectionManager::get('default');
            $connected = $connection->connect();
        } catch (Exception $connectionError) {
            $connected = false;
            $errorMsg = $connectionError->getMessage();
            if (method_exists($connectionError, 'getAttributes')) :
                $attributes = $connectionError->getAttributes();
                if (isset($errorMsg['message'])) :
                    $errorMsg .= '<br />' . $attributes['message'];
                endif;
            endif;
        }
        ?>
        <ul>
        <?php if ($connected) : ?>
            <li class="bullet success">CakePHP is able to connect to the database.</li>
        <?php else : ?>
            <li class="bullet problem">CakePHP is NOT able to connect to the database.<br /><?= $errorMsg ?></li>
        <?php endif; ?>
        </ul>
    </div>
</div>
</body>
</html>
