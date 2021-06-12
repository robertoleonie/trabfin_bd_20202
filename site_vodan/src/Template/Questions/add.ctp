<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Question $question
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Questions'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Question Types'), ['controller' => 'QuestionTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Question Type'), ['controller' => 'QuestionTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List List Types'), ['controller' => 'ListTypes', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New List Type'), ['controller' => 'ListTypes', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Question Groups'), ['controller' => 'QuestionGroups', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Question Group'), ['controller' => 'QuestionGroups', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="questions form large-9 medium-8 columns content">
    <?= $this->Form->create($question) ?>
    <fieldset>
        <legend><?= __('Add Question') ?></legend>
        <?php
            if(isset($_GET['description'])){
                echo $this->Form->control('description', ['value' => $_GET['description']]);
            }else{
                echo $this->Form->control('description');
            }
            if(isset($_GET['question_type_id'])){
                echo $this->Form->control('question_type_id', ['options' => $questionTypes, 'value' => $_GET['question_type_id']]);
            }else{
                echo $this->Form->control('question_type_id',['options' => $questionTypes]);
            }
            if(isset($_GET['list_type_id'])){
                echo $this->Form->control('list_type_id', ['options' => $listTypes, 'value' => $_GET['list_type_id']]);
            }else{
                echo $this->Form->control('list_type_id', ['options' => $listTypes, 'empty' => true]);
            }
            if(isset($_GET['question_group_id'])){
                echo $this->Form->control('question_group_id', ['options' => $listTypes, 'value' => $_GET['question_group_id']]);
            }else{
                echo $this->Form->control('question_group_id', ['options' => $questionGroups, 'empty' => true]);
            }
            if(isset($_GET['subordinateTo'])){
                echo $this->Form->control('subordinateTo', ['options' => $listTypes, 'value' => $_GET['subordinateTo']]);
            }else{
                echo $this->Form->control('isAbout',['options' => $questions, 'empty' => true]);
            }
            if(isset($_GET['isAbout'])){
                echo $this->Form->control('isAbout', ['options' => $listTypes, 'value' => $_GET['isAbout']]);
            }else{
                echo $this->Form->control('subordinateTo',['options' => $questions, 'empty' => true]);
            }
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
