<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Questionnaire[]|\Cake\Collection\CollectionInterface $questionnaires
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Questionnaire'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="questionnaires index large-9 medium-8 columns content">
    <h3><?= __('Questionnaires') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('questionnaire_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('version') ?></th>
                <th scope="col"><?= $this->Paginator->sort('description') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($questionnaires as $questionnaire): ?>
            <tr>
                <td><?= $this->Number->format($questionnaire->questionnaire_id) ?></td>
                <td><?= $this->Number->format($questionnaire->version) ?></td>
                <td><?= h($questionnaire->description) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('Clone - '), ['action' => 'clone', $questionnaire->questionnaire_id]) ?>
                    <?= $this->Html->link(__('Consult - '), ['action' => 'view', $questionnaire->questionnaire_id]) ?>
                    <?= $this->Html->link(__('Delete'), ['action' => 'deletar', $questionnaire->questionnaire_id]) ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
    <?php 
    if(isset($_GET['row'])){
        if($_GET['row'] == '0'){
            echo 'The questionnaire was deleted';
        }else if($_GET['row'] == '1'){
            echo 'The questionnaire could not be deleted, it already has associated records. Try cloning it or adding a new one';
        }
    }   
    ?>
</div>
