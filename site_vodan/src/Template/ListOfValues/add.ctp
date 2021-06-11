<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ListOfValue $listOfValue
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List List Of Values'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List List Types'), ['controller' => 'ListTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New List Type'), ['controller' => 'ListTypes', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="listOfValues form large-9 medium-8 columns content">
    <?= $this->Form->create($listOfValue) ?>
    <fieldset>
        <legend><?= __('Add List Of Value') ?></legend>
        <?php
            echo $this->Form->control('list_type_id', ['options' => $listTypes]);
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
