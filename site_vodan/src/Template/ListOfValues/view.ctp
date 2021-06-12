<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ListOfValue $listOfValue
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit List Of Value'), ['action' => 'edit', $listOfValue->list_of_value_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete List Of Value'), ['action' => 'delete', $listOfValue->list_of_value_id], ['confirm' => __('Are you sure you want to delete # {0}?', $listOfValue->list_of_value_id)]) ?> </li>
        <li><?= $this->Html->link(__('List List Of Values'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New List Of Value'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List List Types'), ['controller' => 'ListTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New List Type'), ['controller' => 'ListTypes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="listOfValues view large-9 medium-8 columns content">
    <h3><?= h($listOfValue->list_of_value_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('List Type') ?></th>
            <td><?= $listOfValue->has('list_type') ? $this->Html->link($listOfValue->list_type->description, ['controller' => 'ListTypes', 'action' => 'view', $listOfValue->list_type->description]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($listOfValue->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('List Of Value Id') ?></th>
            <td><?= $this->Number->format($listOfValue->list_of_value_id) ?></td>
        </tr>
    </table>
</div>
