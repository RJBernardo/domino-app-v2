<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Game $game
 */
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= __('Partida'); ?>
        <small><?php echo __('Add'); ?></small>
    </h1>
</section>

<!-- Main content -->
<section class="content">
<?php echo $this->Form->create($games, ['role' => 'form']); ?>
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo __('Dupla 01'); ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-3 col-xs-4 col-sm-4 col-md-4 col-lg-3 col-xl-2 padding-5">
                            <?php echo $this->Form->control('game.0.user_id', ['label' => 'Jogador', 'options' => $users, 'empty' => 'Selecione', 'required']);?>
                        </div>
                        <div class="col-3 col-xs-3 col-sm-3 col-md-4 col-lg-3 col-xl-2 padding-5">
                            <?php echo $this->Form->control('game.0.type_win_first', ['label' => 'Bateu 1','options' => $type_win, 'class' => 'form-control batida']);?>
                        </div>
                        <div class="col-3 col-xs-3 col-sm-3 col-md-4 col-lg-3 col-xl-2 padding-5">
                            <?php echo $this->Form->control('game.0.type_win_second', ['label' => 'Bateu 2','options' => $type_win, 'class' => 'form-control batida']);?>
                            <?php echo $this->Form->control('game.0.win',['type' => 'hidden']);?>
                        </div>
                        <div class="col-2 col-xs-2 col-sm-2 col-md-3 col-lg-2 col-xl-1 padding-5">
                            <?php echo $this->Form->control('game.0.cheat', ['label' => 'Merda','options' => [0,1,2], 'class' => 'form-control', 'default' => '0']);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 col-xs-4 col-sm-4 col-md-4 col-lg-3 col-xl-2 padding-5">
                            <?php echo $this->Form->control('game.1.user_id', ['label' => false, 'options' => $users, 'empty' => 'Selecione', 'required']);?>
                        </div>
                        <div class="col-3 col-xs-3 col-sm-3 col-md-4 col-lg-3 col-xl-2 padding-5">
                            <?php echo $this->Form->control('game.1.type_win_first', ['label' => false, 'options' => $type_win, 'class' => 'form-control batida']);?>
                        </div>
                        <div class="col-3 col-xs-3 col-sm-3 col-md-4 col-lg-3 col-xl-2 padding-5">
                            <?php echo $this->Form->control('game.1.type_win_second', ['label' => false,'options' => $type_win, 'class' => 'form-control batida']);?>
                            <?php echo $this->Form->control('game.1.win',['type' => 'hidden']);?>
                        </div>
                        <div class="col-2 col-xs-2 col-sm-2 col-md-3 col-lg-2 col-xl-1 padding-5">
                            <?php echo $this->Form->control('game.1.cheat', ['label' => false,'options' => ['0','1','2'], 'class' => 'form-control', 'default' => '0']);?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title"><?php echo __('Dupla 02'); ?></h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-3 col-xs-4 col-sm-4 col-md-4 col-lg-3 col-xl-2 padding-5">
                            <?php echo $this->Form->control('game.2.user_id', ['label' => false,'options' => $users, 'empty' => 'Selecione', 'required']);?>
                        </div>
                        <div class="col-3 col-xs-3 col-sm-3 col-md-4 col-lg-3 col-xl-2 padding-5">
                            <?php echo $this->Form->control('game.2.type_win_first', ['label' => false,'options' => $type_win, 'class' => 'form-control batida']);?>
                        </div>
                        <div class="col-3 col-xs-3 col-sm-3 col-md-4 col-lg-3 col-xl-2 padding-5">
                            <?php echo $this->Form->control('game.2.type_win_second', ['label' => false,'options' => $type_win, 'class' => 'form-control batida']);?>
                            <?php echo $this->Form->control('game.2.win',['type' => 'hidden']);?>
                        </div>
                        <div class="col-2 col-xs-2 col-sm-2 col-md-3 col-lg-2 col-xl-1 padding-5">
                            <?php echo $this->Form->control('game.2.cheat', ['label' => false,'options' => ['0','1','2'], 'class' => 'form-control', 'default' => '0']);?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3 col-xs-4 col-sm-4 col-md-4 col-lg-3 col-xl-2 padding-5">
                            <?php echo $this->Form->control('game.3.user_id', ['label' => false, 'options' => $users, 'empty' => 'Selecione', 'required']);?>
                        </div>
                        <div class="col-3 col-xs-3 col-sm-3 col-md-4 col-lg-3 col-xl-2 padding-5">
                            <?php echo $this->Form->control('game.3.type_win_first',['label' => false,'options' => $type_win, 'class' => 'form-control batida']);?>
                        </div>
                        <div class="col-3 col-xs-3 col-sm-3 col-md-4 col-lg-3 col-xl-2 padding-5">
                            <?php echo $this->Form->control('game.3.type_win_second',['label' => false,'options' => $type_win, 'class' => 'form-control batida']);?>
                            <?php echo $this->Form->control('game.3.win',['type' => 'hidden']);?>
                        </div>
                        <div class="col-2 col-xs-2 col-sm-2 col-md-3 col-lg-2 col-xl-1 padding-5">
                            <?php echo $this->Form->control('game.3.cheat', ['label' => false,'options' => ['0','1','2'], 'class' => 'form-control', 'default' => '0']);?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-footer">
            <div class="row">
                <div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-2">
                    <button class="btn btn btn-warning form-control" title='<?= __('Submit') ?>'
                        data-original-title='<?= __('Submit') ?>' data-toggle="tooltip" type="submit" onclick="return validaPartida(2);"><i
                            class="fa fa-check fa-fw"></i> Continuar Todos
                    </button>
                    <?php echo $this->Form->control('continua_todos',['type' => 'hidden']);?>
                </div>
                <br />
                
                <div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-2">
                    <button class="btn btn btn-primary form-control" title='<?= __('Submit') ?>'
                        data-original-title='<?= __('Submit') ?>' data-toggle="tooltip" type="submit" onclick="return validaPartida(1);"><i
                            class="fa fa-check fa-fw"></i> Continuar Vencedores
                    </button>
                    <?php echo $this->Form->control('continua',['type' => 'hidden']);?>
                </div>
                <br />
                <div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-2">
                    <button class="btn btn btn-success form-control" title='<?= __('Submit') ?>'
                        data-original-title='<?= __('Submit') ?>' data-toggle="tooltip" type="submit" onclick="return validaPartida(0);"><i
                            class="fa fa-check fa-fw"></i> Salvar
                    </button>
                </div>
                <br />
                <div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-2">
                    <a href="<?php echo $this->Url->build('/Games/addMany'); ?>" title='Cancelar'
                        data-original-title='Cancelar' class="btn btn-danger form-control">
                        <i class="fa fa-close fa-fw"></i>Cancelar
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php echo $this->Form->end(); ?>

    <div class="box">
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Jogador</th>
                        <th scope="col" class="text-center padding-5">% Vit</th>
                        <th scope="col" class="text-center padding-5">Jog</th>
                        <th scope="col" class="text-center padding-5">Vit</th>
                        <th scope="col" class="text-center padding-5">Merdas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($results as $result): ?>
                    <tr>
                        <td class="padding-5"><?= h($result['name']) ?></td>
                        <td class="text-center padding-5"><?= $this->Number->precision($result['Perc_Vit'], 2) ?> %</td>
                        <td class="text-center padding-5"><?= $this->Number->format($result['qtd_games']) ?></td>
                        <td class="text-center padding-5"><?= $this->Number->format($result['qtd_win']) ?></td>
                        <td class="text-center padding-5"><?= $this->Number->format($result['qtd_merdas']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>

<?php echo $this->Html->script('addMany', ['block' => 'scriptBottom']); ?>
<script>
    var games = <?= json_encode($games, JSON_PRETTY_PRINT) ?>
</script>
