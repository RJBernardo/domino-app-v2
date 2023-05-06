<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= __('Games'); ?>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">
                        <?php echo __('Lista'); ?>
                    </h3>

                    <div class="box-tools">
                        <div class="pull-right">
                            <?php echo $this->Html->link(
                                __('Lançamento Manual'),
                                ['action' => 'add'],
                                ['class' => 'btn btn-success']
                            ) ?>
                        </div>
                        <div class="pull-right">
                            <?php echo $this->Html->link(
                                __('Lançamento Online'),
                                ['action' => 'addMany'],
                                ['class' => 'btn btn-info']
                            ) ?>
                        </div>
                        <div class="pull-right">
                            <?php echo $this->Html->link(
                                __('Exportar'),
                                ['action' => 'xlsxSpout'],
                                ['class' => 'btn btn-primary']
                            ) ?>
                        </div>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">
                                    <?= $this->Paginator->sort('id') ?>
                                </th>
                                <th scope="col">
                                    <?= $this->Paginator->sort('data') ?>
                                </th>
                                <th scope="col">
                                    <?= $this->Paginator->sort('game') ?>
                                </th>
                                <th scope="col">
                                    <?= $this->Paginator->sort('user_id') ?>
                                </th>
                                <th scope="col">
                                    <?= $this->Paginator->sort('win') ?>
                                </th>
                                <th scope="col">
                                    <?= $this->Paginator->sort('type_game') ?>
                                </th>
                                <th scope="col">
                                    <?= $this->Paginator->sort('qtd_games') ?>
                                </th>
                                <th scope="col">
                                    <?= $this->Paginator->sort('type_win_first') ?>
                                </th>
                                <th scope="col">
                                    <?= $this->Paginator->sort('type_win_second') ?>
                                </th>
                                <th scope="col">
                                    <?= $this->Paginator->sort('created_by') ?>
                                </th>
                                <th scope="col" class="actions text-center">
                                    <?= __('Ações') ?>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($games as $game): ?>
                                <tr>
                                    <td>
                                        <?= $this->Number->format($game->id) ?>
                                    </td>
                                    <td>
                                        <?= h($game->data) ?>
                                    </td>
                                    <td>
                                        <?= $this->Number->format($game->game) ?>
                                    </td>
                                    <td>
                                        <?= $game->has('user') ?
                                            $this->Html->link($game->user
                                                ->name, [
                                                    'controller' => 'Users
                                                ',
                                                    'action' => 'view', $game->user
                                                        ->id
                                                ]) : '' ?>
                                    </td>
                                    <td>
                                        <?= h($game->win) ?>
                                    </td>
                                    <td>
                                        <?= h($game->type_game) ?>
                                    </td>
                                    <td>
                                        <?= $this->Number->format($game->qtd_games) ?>
                                    </td>
                                    <td>
                                        <?= h($game->type_win_first) ?>
                                    </td>
                                    <td>
                                        <?= h($game->type_win_second) ?>
                                    </td>
                                    <td>
                                        <?= $this->Number->format($game->created_by) ?>
                                    </td>
                                    <td class="actions text-right">
                                        <?= $this->Html->link(
                                            __('Visualizar'),
                                            ['action' => 'view', $game->id],
                                            ['class' => 'btn btn-info btn-xs']
                                        ) ?>
                                        <?= $this->Html->link(__('Editar'), ['action' => 'edit', $game->id], [
                                            'class' => 'btn
                                btn-warning btn-xs'
                                        ]) ?>
                                        <?= $this->Form->postLink(__('Apagar'), ['action' => 'delete', $game->id], [
                                            'confirm'
                                            => __('Tem certeza que deseja apagar # {0}?', $game->id),
                                            'class' => 'btn btn-danger
                                btn-xs'
                                        ]) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot>

                        </tfoot>
                    </table>
                    <?php if ($games->count() == 0) { ?>
                        <div class="text-center">Nenhum Registro Encontrado</div>
                    <?php } ?>
                </div>
                <!-- /.box-body -->
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->Paginator->counter(
                        __('Showing {{start}} to {{end}} of {{count}} entries')
                    );
                    ?>
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <?php echo $this->Paginator->first(__('first')); ?>
                        <?php echo $this->Paginator->prev(__('previous')); ?>
                        <?php echo $this->Paginator->numbers(['first' => 3, 'last' => 3]); ?>
                        <?php echo $this->Paginator->next(__('next')); ?>
                        <?php echo $this->Paginator->last(__('last')); ?>
                    </ul>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>