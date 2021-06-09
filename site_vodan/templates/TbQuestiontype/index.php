<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbQuestiontype[]|\Cake\Collection\CollectionInterface $tbQuestiontype
 */
?>
<div class="tbQuestiontype index content">
    <?= $this->Html->link(__('New Questiontype'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Questiontype') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('questionTypeID') ?></th>
                    <th><?= $this->Paginator->sort('description') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($tbQuestiontype as $tbQuestiontype): ?>
                <tr>
                    <td><?= $this->Number->format($tbQuestiontype->questionTypeID) ?></td>
                    <td><?= h($tbQuestiontype->description) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('Clone'), ['action' => 'add', '?' => array('description' => $tbQuestiontype->description)]) ?>
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
