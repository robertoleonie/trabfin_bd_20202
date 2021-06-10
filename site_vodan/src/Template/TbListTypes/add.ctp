<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbListType $tbListType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Tb List Types'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tbListTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($tbListType) ?>
    <fieldset>
        <legend><?= __('Add Tb List Type') ?></legend>
        <?php
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
