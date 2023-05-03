<section class="content-header">
  <h1>
    Game
    <small><?php echo __('View'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo $this->Url->build(['action' => 'index']); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Home'); ?></a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-info"></i>
          <h3 class="box-title"><?php echo __('Dados'); ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <dl class="dl-horizontal">
            <dt scope="row"><?= __('User') ?></dt>
            <dd><?= $game->has('user') ? $this->Html->link($game->user->name, ['controller' => 'Users', 'action' => 'view', $game->user->id]) : '' ?></dd>
            <dt scope="row"><?= __('Type Game') ?></dt>
            <dd><?= h($game->type_game) ?></dd>
            <dt scope="row"><?= __('Type Win First') ?></dt>
            <dd><?= h($game->type_win_first) ?></dd>
            <dt scope="row"><?= __('Type Win Second') ?></dt>
            <dd><?= h($game->type_win_second) ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($game->id) ?></dd>
            <dt scope="row"><?= __('Game') ?></dt>
            <dd><?= $this->Number->format($game->game) ?></dd>
            <dt scope="row"><?= __('Qtd Games') ?></dt>
            <dd><?= $this->Number->format($game->qtd_games) ?></dd>
            <dt scope="row"><?= __('Created By') ?></dt>
            <dd><?= $this->Number->format($game->created_by) ?></dd>
            <dt scope="row"><?= __('Data') ?></dt>
            <dd><?= h($game->data) ?></dd>
            <dt scope="row"><?= __('Created') ?></dt>
            <dd><?= h($game->created) ?></dd>
            <dt scope="row"><?= __('Modified') ?></dt>
            <dd><?= h($game->modified) ?></dd>
            <dt scope="row"><?= __('Win') ?></dt>
            <dd><?= $game->win ? __('Yes') : __('No'); ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

</section>
