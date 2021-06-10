<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbQuestionType $tbQuestionType
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Tb Question Types'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tbQuestionTypes form large-9 medium-8 columns content">
    <?= $this->Form->create($tbQuestionType) ?>
    <fieldset>
        <legend><?= __('Clone Question Type') ?></legend>
        <?php
            echo $this->Form->label('description');
            $actual_link = "$_SERVER[REQUEST_URI]";
            $url_components = parse_url($actual_link);
            if (isset($url_components['query'])){
                parse_str($url_components['query'], $params);
                echo $this->Form->text('description', ['id' => 'description','value'=>$params['description']]);
            }else{
                echo $this->Form->text('description', ['id' => 'description','placeholder'=>'New question type']);
            }
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
