<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Role $role
 */
?>
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Role
      <small><?php echo __('Edit'); ?></small>
    </h1>
    <ol class="breadcrumb">
      <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class'=>'btn btn-danger btn-xs']) ?>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <!-- general form elements -->
        <div class="box box-primary">
          <div class="box-header with-border">
            <h3 class="box-title"><?php echo __('Formulário'); ?></h3>
          </div>
          <!-- /.box-header -->
          <!-- form start -->
          <?php echo $this->Form->create($role, ['role' => 'form']); ?>
            <div class="box-body">
              <?php
                echo $this->Form->control('group_id', ['options' => $groups, 'empty' => true]);
                echo $this->Form->control('name');
              ?>
            </div>
            <!-- /.box-body -->

          <?php echo $this->Form->submit(__('Confirmar')); ?>

          <?php echo $this->Form->end(); ?>
        </div>
        <!-- /.box -->
      </div>
  </div>
  <!-- /.row -->
</section>
