<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbListType $tbListType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tb List Type'), ['action' => 'edit', $tbListType->list_type_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tb List Type'), ['action' => 'delete', $tbListType->list_type_id], ['confirm' => __('Are you sure you want to delete # {0}?', $tbListType->list_type_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tb List Types'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tb List Type'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tbListTypes view large-9 medium-8 columns content">
    <h3><?= h($tbListType->list_type_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($tbListType->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('List Type Id') ?></th>
            <td><?= $this->Number->format($tbListType->list_type_id) ?></td>
        </tr>
    </table>
</div>
