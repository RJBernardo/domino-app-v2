<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Game $game
 */
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= __('Game'); ?>
        <small><?php echo __('Add'); ?></small>
    </h1>
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
                <?php echo $this->Form->create($game, ['role' => 'form']); ?>
                <div class="box-body">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-2">
                            <?php                                echo $this->Form->control('data');
                            ?>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-2">
                            <?php                                echo $this->Form->control('user_id', ['options' => $users]);
                            ?>
                        </div>
                        <div class="hidden">
                            <?php                                echo $this->Form->control('win', ['checked', 'class'=> 'hidden']);
                            ?>
                        </div>
                        <?php                                echo $this->Form->control('type_game', ['type' =>'hidden', 'value' => 'M']);
                            ?>
                        <?php                                echo $this->Form->control('game', ['type' =>'hidden', 'value' => '0']);
                            ?>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-2">
                            <?php                                echo $this->Form->control('qtd_games');
                            ?>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-2">
                            <?php                                echo $this->Form->control('qtd_win');
                            ?>
                        </div>
                        <div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-2">
                            <?php                                echo $this->Form->control('cheat');
                            ?>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer ">
                    <button class="btn btn btn-success" title='<?= __('Submit') ?>'
                        data-original-title='<?= __('Submit') ?>' data-toggle="tooltip" type="submit"><i
                            class="fa fa-check fa-fw"></i> Confirmar
                    </button>
                    <a href="<?php echo $this->Url->build('/Games'); ?>" title='Cancelar' data-original-title='Cancelar'
                        class="btn btn-danger">
                        <i class="fa fa-close fa-fw"></i>Cancelar
                    </a>
                </div>

                <?php echo $this->Form->end(); ?>
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.row -->
</section>