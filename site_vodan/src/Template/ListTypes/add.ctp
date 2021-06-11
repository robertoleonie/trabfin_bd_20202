<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ListType $listType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List List Types'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="listTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($listType) ?>
    <fieldset>
        <legend><?= __('Add List Type') ?></legend>
        <?php
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
