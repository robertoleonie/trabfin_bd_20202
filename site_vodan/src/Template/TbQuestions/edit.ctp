<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbQuestion $tbQuestion
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tbQuestion->question_idb],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tbQuestion->question_idb)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Tb Questions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Tb Question Types'), ['controller' => 'TbQuestionTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tb Question Type'), ['controller' => 'TbQuestionTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tb List Of Values'), ['controller' => 'TbListOfValues', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tb List Of Value'), ['controller' => 'TbListOfValues', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Tb Question Groups'), ['controller' => 'TbQuestionGroups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Tb Question Group'), ['controller' => 'TbQuestionGroups', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tbQuestions form large-9 medium-8 columns content">
    <?= $this->Form->create($tbQuestion) ?>
    <fieldset>
        <legend><?= __('Edit Tb Question') ?></legend>
        <?php
            echo $this->Form->control('description');
            echo $this->Form->control('question_type_id', ['options' => $tbQuestionTypes]);
            echo $this->Form->control('list_type_id', ['options' => $tbListOfValues, 'empty' => true]);
            echo $this->Form->control('question_group_id', ['options' => $tbQuestionGroups, 'empty' => true]);
            echo $this->Form->control('subordinateTo');
            echo $this->Form->control('isAbout');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
