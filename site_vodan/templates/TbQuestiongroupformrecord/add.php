<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbQuestiongroupformrecord $tbQuestiongroupformrecord
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Tb Questiongroupformrecord'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tbQuestiongroupformrecord form content">
            <?= $this->Form->create($tbQuestiongroupformrecord) ?>
            <fieldset>
                <legend><?= __('Add Tb Questiongroupformrecord') ?></legend>
                <?php
                    echo $this->Form->control('formRecordID');
                    echo $this->Form->control('crfFormsID');
                    echo $this->Form->control('questionID');
                    echo $this->Form->control('listOfValuesID');
                    echo $this->Form->control('answer');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
