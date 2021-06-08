<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbQuestiongroupformrecord[]|\Cake\Collection\CollectionInterface $tbQuestiongroupformrecord
 */
?>
<div class="tbQuestiongroupformrecord index content">
    <?= $this->Html->link(__('New Tb Questiongroupformrecord'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Tb Questiongroupformrecord') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('questionGroupFormRecordID') ?></th>
                    <th><?= $this->Paginator->sort('formRecordID') ?></th>
                    <th><?= $this->Paginator->sort('crfFormsID') ?></th>
                    <th><?= $this->Paginator->sort('questionID') ?></th>
                    <th><?= $this->Paginator->sort('listOfValuesID') ?></th>
                    <th><?= $this->Paginator->sort('answer') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tbQuestiongroupformrecord as $tbQuestiongroupformrecord): ?>
                <tr>
                    <td><?= $this->Number->format($tbQuestiongroupformrecord->questionGroupFormRecordID) ?></td>
                    <td><?= $this->Number->format($tbQuestiongroupformrecord->formRecordID) ?></td>
                    <td><?= $this->Number->format($tbQuestiongroupformrecord->crfFormsID) ?></td>
                    <td><?= $this->Number->format($tbQuestiongroupformrecord->questionID) ?></td>
                    <td><?= $this->Number->format($tbQuestiongroupformrecord->listOfValuesID) ?></td>
                    <td><?= h($tbQuestiongroupformrecord->answer) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $tbQuestiongroupformrecord->questionGroupFormRecordID]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $tbQuestiongroupformrecord->questionGroupFormRecordID]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $tbQuestiongroupformrecord->questionGroupFormRecordID], ['confirm' => __('Are you sure you want to delete # {0}?', $tbQuestiongroupformrecord->questionGroupFormRecordID)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
