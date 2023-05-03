<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Test $test
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('List Tests'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="tests form large-9 medium-8 columns content">
    <?= $this->Form->create($test) ?>
    <fieldset>
        <legend><?= __('Add Test') ?></legend>
        <?php
            echo $this->Form->control('name');
            echo $this->Form->control('description');
            echo $this->Form->control('active');
            echo $this->Form->control('date', ['empty' => true]);
            echo $this->Form->control('tipo');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
