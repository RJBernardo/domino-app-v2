<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Users

        <div class="pull-right">
            <?php echo $this->Html->link(__('Novo'), ['action' => 'add'], ['class'=>'btn btn-success btn-xs']) ?></div>
    </h1>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php echo __('Lista'); ?></h3>

                    <div class="box-tools">
                        <form action="<?php echo $this->Url->build(); ?>" method="POST">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control pull-right"
                                    placeholder="<?php echo __('Pesquisar'); ?>">

                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col"><?= $this->Paginator->sort('id') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('name') ?></th>
                                <th scope="col"><?= $this->Paginator->sort('email') ?></th>
                                <th scope="col" class="actions text-center"><?= __('Ações') ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?= $this->Number->format($user->id) ?></td>
                                <td><?= h($user->name) ?></td>
                                <td><?= h($user->email) ?></td>
                                <td class="actions text-right">
                                    <?= $this->Html->link(__('Visualizar'), ['action' => 'view', $user->id], ['class'=>'btn btn-info btn-xs']) ?>
                                    <?= $this->Html->link(__('Editar'), ['action' => 'edit', $user->id], ['class'=>'btn btn-warning btn-xs']) ?>
                                    <?= $this->Form->postLink(__('Apagar'), ['action' => 'delete', $user->id], ['confirm' => __('Tem certeza que deseja apagar # {0}?', $user->id), 'class'=>'btn btn-danger btn-xs']) ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.box-body -->
                <div class="box-footer clearfix">
                    <?php echo $this->Paginator->counter(
                    __('Showing {{start}} to {{end}} of {{count}} entries')
                    );
                    ?>
                    <ul class="pagination pagination-sm no-margin pull-right">
                        <?php echo $this->Paginator->first(__('first')); ?>
                        <?php echo $this->Paginator->prev(__('previous')); ?>
                        <?php echo $this->Paginator->numbers(['first' => 3, 'last' => 3]);?>
                        <?php echo $this->Paginator->next(__('next')); ?>
                        <?php echo $this->Paginator->last(__('last')); ?>
                    </ul>
                </div>
            </div>
            <!-- /.box -->
        </div>
    </div>
</section>