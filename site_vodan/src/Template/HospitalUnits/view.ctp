<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HospitalUnit $hospitalUnit
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Hospital Unit'), ['action' => 'edit', $hospitalUnit->hospital_unit_id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Hospital Unit'), ['action' => 'delete', $hospitalUnit->hospital_unit_id], ['confirm' => __('Are you sure you want to delete # {0}?', $hospitalUnit->hospital_unit_id)]) ?> </li>
        <li><?= $this->Html->link(__('List Hospital Units'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Hospital Unit'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="hospitalUnits view large-9 medium-8 columns content">
    <h3><?= h($hospitalUnit->hospital_unit_id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th scope="row"><?= __('HospitalUnitName') ?></th>
            <td><?= h($hospitalUnit->hospitalUnitName) ?></td>
        </tr>
        <tr>
            <th scope="row"><?= __('Hospital Unit Id') ?></th>
            <td><?= $this->Number->format($hospitalUnit->hospital_unit_id) ?></td>
        </tr>
    </table>
</div>
