<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\TbQuestiontype $tbQuestiontype
 */
?>

<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Questiontype'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="tbQuestiontype form content">
            <?= $this->Form->create($tbQuestiontype) ?>
            <fieldset>
                <legend><?= __('Clone Questiontype') ?></legend>
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
    </div>
</div>
