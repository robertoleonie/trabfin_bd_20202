<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Questionnaire $questionnaire
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Questionnaire'), ['action' => 'edit', $questionnaire->questionnaire_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Questionnaire'), ['action' => 'delete', $questionnaire->questionnaire_id], ['confirm' => __('Are you sure you want to delete # {0}?', $questionnaire->questionnaire_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Questionnaires'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Questionnaire'), ['action' => 'add']) ?> </li>
        <li> <?= $this->Html->link(__('Clone this questionnaire'), ['action' => 'clone', $questionnaire->questionnaire_id]) ?></li>
    </ul>
</nav>
<div class="questionnaires view large-9 medium-8 columns content">
    <h3><?= h($questionnaire->questionnaire_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('Description') ?></th>
            <td><?= h($questionnaire->description) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Questionnaire Id') ?></th>
            <td><?= $this->Number->format($questionnaire->questionnaire_id) ?></td>
        </tr>
    </table>
    <div class="listOfValues index columns content">
        <div class="row">
            <div class="columns large-8">
                <h5><?= __("List of modules of:\n".$questionnaire->description) ?></h5>
            </div>
            <div class="columns large-3">
                <?= $this->Html->link(__('New Module'), 
                ['controller' => 'Crfforms', 'action' => 'add', '?' => array('questionnaire' => $questionnaire->questionnaire_id) ],
                ['class' => 'button right']) ?>
                
                
            </div>
        </div>
        <table cellpadding="0" cellspacing="0">
            <thead>
                <tr>
                <th scope="col"><?= $this->Paginator->sort('crfform_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($crfforms as $crfform): ?>
                <tr>
                    <td><?= $this->Number->format($crfform->crfform_id) ?></td>
                    <td><?= h($crfform->description) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Consult Module - '),['controller' => 'Crfforms', 'action' => 'view', $crfform->crfform_id]) ?>
                        <?= $this->Html->link(__('Edit Module'), ['controller' => 'Crfforms','action' => 'edit', $crfform->crfform_id]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
