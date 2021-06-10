<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbListOfValue $tbListOfValue
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tb List Of Value'), ['action' => 'edit', $tbListOfValue->list_of_value_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tb List Of Value'), ['action' => 'delete', $tbListOfValue->list_of_value_id], ['confirm' => __('Are you sure you want to delete # {0}?', $tbListOfValue->list_of_value_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tb List Of Values'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tb List Of Value'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Tb List Types'), ['controller' => 'TbListTypes', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tb List Type'), ['controller' => 'TbListTypes', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tbListOfValues view large-9 medium-8 columns content">
    <h3><?= h($tbListOfValue->list_of_value_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Tb List Type') ?></th>
            <td><?= $tbListOfValue->has('tb_list_type') ? $this->Html->link($tbListOfValue->tb_list_type->list_type_id, ['controller' => 'TbListTypes', 'action' => 'view', $tbListOfValue->tb_list_type->list_type_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($tbListOfValue->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('List Of Value Id') ?></th>
            <td><?= $this->Number->format($tbListOfValue->list_of_value_id) ?></td>
        </tr>
    </table>
</div>
