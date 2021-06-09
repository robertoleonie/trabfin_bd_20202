<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.10.0
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Http\Exception\NotFoundException;

$this->disableAutoLayout();

$checkConnection = function (string $name) {
    $error = null;
    $connected = false;
    try {
        $connection = ConnectionManager::get($name);
        $connected = $connection->connect();
    } catch (Exception $connectionError) {
        $error = $connectionError->getMessage();
        if (method_exists($connectionError, 'getAttributes')) {
            $attributes = $connectionError->getAttributes();
            if (isset($attributes['message'])) {
                $error .= '<br />' . $attributes['message'];
            }
        }
    }

    return compact('connected', 'error');
};

if (!Configure::read('debug')) :
    throw new NotFoundException(
        'Please replace templates/Pages/home.php with your own version or re-enable debug mode.'
    );
endif;

$cakeDescription = 'CakePHP: the rapid development PHP framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake', 'home']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <header>
        <div class="container text-center">
            <a href="https://cakephp.org/" target="_blank" rel="noopener">
                <img alt="CakePHP" src="https://cakephp.org/v2/img/logos/CakePHP_Logo.svg" width="350" />
            </a>
        </div>
    </header>
    <main class="main">
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="column">
                       
                        <!-- <div id="url-rewriting-warning" class="alert url-rewriting">
                            <ul>
                                <li class="bullet problem">
                                    URL rewriting is not properly configured on your server.<br />
                                    1) <a target="_blank" rel="noopener" href="https://book.cakephp.org/4/en/installation.html#url-rewriting">Help me configure it</a><br />
                                    2) <a target="_blank" rel="noopener" href="https://book.cakephp.org/4/en/development/configuration.html#general-configuration">I don't / can't use URL rewriting</a>
                                </a></li>
                            </ul>
                        </div> -->
                        <?php Debugger::checkSecurityKeys(); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <h4>Formulários</h4>
                        <ul>
                            <li class = "novo_questionarios" ><a href = "../Novoquestionario"> Adicionar questionario</a></li>
                            <li class = "clonar_questionarios" ><a href = "www.google.com">Adicionar questionario, baseado em existente</a></li>
                            <li class = "excluir_questionarios" ><a href = "www.google.com">Excluir questionario existente</a></li>
                            <li class = "consulta_questionarios" ><a href = "www.google.com">Consultar questionario e versões</a></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="column">
                        <h4>Tipo de Questões</h4>
                        <ul>
                            <li class = "consulta_questoes"><a href = "../TbQuestiontype">Consulta,criar ou clonar tipos de questões</a></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="column">
                        <h4>Respostas Padronizadas</h4>
                        <ul>
                            <li class = "consulta_resp" ><a href = "www.google.com">Consultar lista de resposta</a></li>
                            <li class = "criar_lista_resp" ><a href = "www.google.com">Criar lista de respostas</a></li>
                            <li class = "clonar_lista_resp" ><a href = "www.google.com">Clonar lista de respostas</a></li>
                            <li class = "inserir_lista_resp" ><a href = "www.google.com">Inserir itens em lista existente</a></li>
                            <li class = "alterar_lista_resp" ><a href = "www.google.com">Alterar itens em lista existente</a></li>
                        </ul>
                    </div>
                </div>
                <div class="row">
                    <div class="column">
                        <h4>Respostas Padronizadas</h4>
                        <ul>
                            <li class = "consulta_resp" ><a href = "www.google.com">Consultar lista de resposta</a></li>
                            <li class = "criar_lista_resp" ><a href = "www.google.com">Criar lista de respostas</a></li>
                            <li class = "clonar_lista_resp" ><a href = "www.google.com">Clonar lista de respostas</a></li>
                            <li class = "inserir_lista_resp" ><a href = "www.google.com">Inserir itens em lista existente</a></li>
                            <li class = "alterar_lista_resp" ><a href = "www.google.com">Alterar itens em lista existente</a></li>
                        </ul>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="column">
                        <h4>Questões</h4>
                        <ul>
                            <li class = "nova_questoes" ><a href = "../Novaquestao">Nova questão</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
