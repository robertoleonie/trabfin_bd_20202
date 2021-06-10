<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbHospitalUnit[]|\Cake\Collection\CollectionInterface $tbHospitalUnits
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Tb Hospital Unit'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="tbHospitalUnits index large-9 medium-8 columns content">
    <h3><?= __('Tb Hospital Units') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th scope="col"><?= $this->Paginator->sort('hospital_unit_id') ?></th>
                <th scope="col"><?= $this->Paginator->sort('hospitalUnitName') ?></th>
                <th scope="col" class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tbHospitalUnits as $tbHospitalUnit): ?>
            <tr>
                <td><?= $this->Number->format($tbHospitalUnit->hospital_unit_id) ?></td>
                <td><?= h($tbHospitalUnit->hospitalUnitName) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $tbHospitalUnit->hospital_unit_id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tbHospitalUnit->hospital_unit_id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tbHospitalUnit->hospital_unit_id], ['confirm' => __('Are you sure you want to delete # {0}?', $tbHospitalUnit->hospital_unit_id)]) ?>
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
</div>
