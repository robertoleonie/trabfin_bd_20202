<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbHospitalUnit $tbHospitalUnit
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Tb Hospital Unit'), ['action' => 'edit', $tbHospitalUnit->hospital_unit_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Tb Hospital Unit'), ['action' => 'delete', $tbHospitalUnit->hospital_unit_id], ['confirm' => __('Are you sure you want to delete # {0}?', $tbHospitalUnit->hospital_unit_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Tb Hospital Units'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Tb Hospital Unit'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="tbHospitalUnits view large-9 medium-8 columns content">
    <h3><?= h($tbHospitalUnit->hospital_unit_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('HospitalUnitName') ?></th>
            <td><?= h($tbHospitalUnit->hospitalUnitName) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hospital Unit Id') ?></th>
            <td><?= $this->Number->format($tbHospitalUnit->hospital_unit_id) ?></td>
        </tr>
    </table>
</div>
