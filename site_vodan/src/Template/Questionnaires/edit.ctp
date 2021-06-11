<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Questionnaire $questionnaire
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $questionnaire->questionnaire_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $questionnaire->questionnaire_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Questionnaires'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="questionnaires form large-9 medium-8 columns content">
    <?= $this->Form->create($questionnaire) ?>
    <fieldset>
        <legend><?= __('Edit Questionnaire') ?></legend>
        <?php
            echo $this->Form->control('description');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
