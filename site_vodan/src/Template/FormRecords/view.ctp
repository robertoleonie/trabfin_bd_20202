<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\FormRecord $formRecord
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Form Record'), ['action' => 'edit', $formRecord->form_record_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Form Record'), ['action' => 'delete', $formRecord->form_record_id], ['confirm' => __('Are you sure you want to delete # {0}?', $formRecord->form_record_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Form Records'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Form Record'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Participants'), ['controller' => 'Participants', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Participant'), ['controller' => 'Participants', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Hospital Units'), ['controller' => 'HospitalUnits', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hospital Unit'), ['controller' => 'HospitalUnits', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Questionnaires'), ['controller' => 'Questionnaires', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Questionnaire'), ['controller' => 'Questionnaires', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Crfforms'), ['controller' => 'Crfforms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Crfform'), ['controller' => 'Crfforms', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="formRecords view large-9 medium-8 columns content">
    <h3><?= h($formRecord->form_record_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Participant') ?></th>
            <td><?= $formRecord->has('participant') ? $this->Html->link($formRecord->participant->participant_id, ['controller' => 'Participants', 'action' => 'view', $formRecord->participant->participant_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hospital Unit') ?></th>
            <td><?= $formRecord->has('hospital_unit') ? $this->Html->link($formRecord->hospital_unit->hospital_unit_id, ['controller' => 'HospitalUnits', 'action' => 'view', $formRecord->hospital_unit->hospital_unit_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Questionnaire') ?></th>
            <td><?= $formRecord->has('questionnaire') ? $this->Html->link($formRecord->questionnaire->questionnaire_id, ['controller' => 'Questionnaires', 'action' => 'view', $formRecord->questionnaire->questionnaire_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Crfform') ?></th>
            <td><?= $formRecord->has('crfform') ? $this->Html->link($formRecord->crfform->crfform_id, ['controller' => 'Crfforms', 'action' => 'view', $formRecord->crfform->crfform_id]) : '' ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Form Record Id') ?></th>
            <td><?= $this->Number->format($formRecord->form_record_id) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('DtRegistroForm') ?></th>
            <td><?= h($formRecord->dtRegistroForm) ?></td>
        </tr>
    </table>
</div>
