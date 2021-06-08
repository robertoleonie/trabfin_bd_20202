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
            <?= $this->Html->link(__('Edit Tb Questiongroupformrecord'), ['action' => 'edit', $tbQuestiongroupformrecord->questionGroupFormRecordID], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Tb Questiongroupformrecord'), ['action' => 'delete', $tbQuestiongroupformrecord->questionGroupFormRecordID], ['confirm' => __('Are you sure you want to delete # {0}?', $tbQuestiongroupformrecord->questionGroupFormRecordID), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Tb Questiongroupformrecord'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Tb Questiongroupformrecord'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tbQuestiongroupformrecord view content">
            <h3><?= h($tbQuestiongroupformrecord->questionGroupFormRecordID) ?></h3>
            <table>
                <tr>
                    <th><?= __('Answer') ?></th>
                    <td><?= h($tbQuestiongroupformrecord->answer) ?></td>
                </tr>
                <tr>
                    <th><?= __('QuestionGroupFormRecordID') ?></th>
                    <td><?= $this->Number->format($tbQuestiongroupformrecord->questionGroupFormRecordID) ?></td>
                </tr>
                <tr>
                    <th><?= __('FormRecordID') ?></th>
                    <td><?= $this->Number->format($tbQuestiongroupformrecord->formRecordID) ?></td>
                </tr>
                <tr>
                    <th><?= __('CrfFormsID') ?></th>
                    <td><?= $this->Number->format($tbQuestiongroupformrecord->crfFormsID) ?></td>
                </tr>
                <tr>
                    <th><?= __('QuestionID') ?></th>
                    <td><?= $this->Number->format($tbQuestiongroupformrecord->questionID) ?></td>
                </tr>
                <tr>
                    <th><?= __('ListOfValuesID') ?></th>
                    <td><?= $this->Number->format($tbQuestiongroupformrecord->listOfValuesID) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
