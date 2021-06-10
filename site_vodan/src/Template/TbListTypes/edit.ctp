<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbListType $tbListType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tbListType->list_type_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tbListType->list_type_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Tb List Types'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tbListTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($tbListType) ?>
    <fieldset>
        <legend><?= __('Edit Tb List Type') ?></legend>
        <?php
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
