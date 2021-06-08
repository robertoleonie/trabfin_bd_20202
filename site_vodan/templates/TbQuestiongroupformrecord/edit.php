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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $tbQuestiongroupformrecord->questionGroupFormRecordID],
                ['confirm' => __('Are you sure you want to delete # {0}?', $tbQuestiongroupformrecord->questionGroupFormRecordID), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Tb Questiongroupformrecord'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tbQuestiongroupformrecord form content">
            <?= $this->Form->create($tbQuestiongroupformrecord) ?>
            <fieldset>
                <legend><?= __('Edit Tb Questiongroupformrecord') ?></legend>
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
