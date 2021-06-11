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
</div>
