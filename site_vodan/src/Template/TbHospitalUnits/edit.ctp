<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbHospitalUnit $tbHospitalUnit
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tbHospitalUnit->hospital_unit_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tbHospitalUnit->hospital_unit_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Tb Hospital Units'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tbHospitalUnits form large-9 medium-8 columns content">
    <?= $this->Form->create($tbHospitalUnit) ?>
    <fieldset>
        <legend><?= __('Edit Tb Hospital Unit') ?></legend>
        <?php
            echo $this->Form->control('hospitalUnitName');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
