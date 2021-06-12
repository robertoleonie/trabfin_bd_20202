<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ListType $listType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit List Type'), ['action' => 'edit', $listType->list_type_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete List Type'), ['action' => 'delete', $listType->list_type_id], ['confirm' => __('Are you sure you want to delete # {0}?', $listType->list_type_id)]) ?> </li>
        <li><?= $this->Html->link(__('List List Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New List Type'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="listTypes view large-9 medium-8 columns content">
    <h3><?= h($listType->list_type_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($listType->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('List Type Id') ?></th>
            <td><?= $this->Number->format($listType->list_type_id) ?></td>
        </tr>
    </table>
    <div class="listOfValues index columns content">
        <div class="row">
            <div class="columns large-5">
                <h5><?= __('List of values of '.$listType->description) ?></h5>
            </div>
            <div class="columns large-5">
                <?= $this->Html->link(__('New List Of Value'), 
                ['controller' => 'ListOfValues', 'action' => 'add', '?' => array('list_type' => $listType->list_type_id) ],
                ['class' => 'button right']) ?>
                
            </div>
        </div>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('list_of_value_id') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                    <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listOfValues as $listOfValue): ?>
                <tr>
                    
                    <td><?= $this->Html->link(__($listOfValue->list_of_value_id),['controller' => 'ListOfValues', 'action' => 'view', $listOfValue->list_of_value_id]) ?></td>
                    <td><?= h($listOfValue->description) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Edit'), ['controller' => 'ListOfValues','action' => 'edit', $listOfValue->list_of_value_id]) ?>
                        <?= $this->Form->postLink(__('Clone'), ['controller' => 'ListOfValues','action' => 'clone', $listOfValue->list_of_value_id, true]) ?>
                       
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
