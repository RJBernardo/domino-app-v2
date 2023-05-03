<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Usuário
        <small><?php echo __('Edit'); ?></small>
    </h1>
    <ol class="breadcrumb">
        <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class'=>'btn btn-danger btn-xs']) ?>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <?php echo $this->Form->create($user, ['role' => 'form', 'type' => 'file']); ?>
    <div class="row">
        <div class="col-md-8">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo __('Formulário'); ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <?php echo $this->Form->create($user, ['role' => 'form']); ?>
                <div class="box-body">
                    <?php
                   echo $this->Form->control('name');
                   echo $this->Form->control('email');
                   echo $this->Form->control('password');
                   echo $this->Form->control('active', ['options' => ['S' => 'Sim', 'N' => 'Não']]);
                   echo $this->Form->control('id_jogador');
                //    echo $this->Form->control('role');
                   echo $this->Form->control('group_id', ['options' => $groups, 'default' => 2]);
              ?>
                </div>
                <!-- /.box-body -->

                <div class="box-footer ">
                    <button class="btn btn btn-success" title='<?= __('Submit') ?>'
                        data-original-title='<?= __('Submit') ?>' data-toggle="tooltip" type="submit"><i
                            class="fa fa-check fa-fw"></i> Confirmar
                    </button>
                    <a href="<?php echo $this->Url->build('/Users'); ?>" title='Cancelar' data-original-title='Cancelar'
                        class="btn btn-danger">
                        <i class="fa fa-close fa-fw"></i>Cancelar
                    </a>
                </div>

            </div>
            <!-- /.box -->
        </div>

        <div class="col-md-4">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-body">
                    <div class="row">
                        <?php if (!empty($user->photo)) { ?>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <img src="/files/Users/photo/<?= $user->photo; ?>"
                                class="profile-user-img img-responsive img-circle" alt="User profile picture">
                        </div>
                        <?php } ?>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                            <?php echo $this->Form->control('photo', ['type' => 'file']);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
    </div>
    <?php echo $this->Form->end(); ?>

    <!-- /.row -->
</section>