<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\HospitalUnit $hospitalUnit
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $hospitalUnit->hospital_unit_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $hospitalUnit->hospital_unit_id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Hospital Units'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="hospitalUnits form large-9 medium-8 columns content">
    <?= $this->Form->create($hospitalUnit) ?>
    <fieldset>
        <legend><?= __('Edit Hospital Unit') ?></legend>
        <?php
            echo $this->Form->control('hospitalUnitName');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
