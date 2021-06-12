<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FormRecord $formRecord
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Form Records'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Participants'), ['controller' => 'Participants', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Participant'), ['controller' => 'Participants', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Hospital Units'), ['controller' => 'HospitalUnits', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Hospital Unit'), ['controller' => 'HospitalUnits', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Questionnaires'), ['controller' => 'Questionnaires', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Questionnaire'), ['controller' => 'Questionnaires', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Crfforms'), ['controller' => 'Crfforms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Crfform'), ['controller' => 'Crfforms', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="formRecords form large-9 medium-8 columns content">
    <?= $this->Form->create($formRecord) ?>
    <fieldset>
        <legend><?= __('Add Form Record') ?></legend>
        <?php
            echo $this->Form->control('participant_id', ['options' => $participants]);
            echo $this->Form->control('hospital_unit_id', ['options' => $hospitalUnits]);
            echo $this->Form->control('questionnaire_id', ['options' => $questionnaires]);
            echo $this->Form->control('crfform_id', ['options' => $crfforms]);
            echo $this->Form->control('dtRegistroForm');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
