<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ListType $listType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $listType->list_type_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $listType->list_type_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List List Types'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="listTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($listType) ?>
    <fieldset>
        <legend><?= __('Edit List Type') ?></legend>
        <?php
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
