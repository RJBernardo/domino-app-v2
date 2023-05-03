<section class="content-header">
  <h1>
    Group
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
            <dt scope="row"><?= __('Name') ?></dt>
            <dd><?= h($group->name) ?></dd>
            <dt scope="row"><?= __('Removed') ?></dt>
            <dd><?= h($group->removed) ?></dd>
            <dt scope="row"><?= __('Id') ?></dt>
            <dd><?= $this->Number->format($group->id) ?></dd>
            <dt scope="row"><?= __('Created') ?></dt>
            <dd><?= h($group->created) ?></dd>
            <dt scope="row"><?= __('Modified') ?></dt>
            <dd><?= h($group->modified) ?></dd>
          </dl>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-share-alt"></i>
          <h3 class="box-title"><?= __('Roles') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php if (!empty($group->roles)): ?>
          <table class="table table-hover">
              <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Group Id') ?></th>
                    <th scope="col"><?= __('Name') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col" class="actions text-center"><?= __('Ações') ?></th>
              </tr>
              <?php foreach ($group->roles as $roles): ?>
              <tr>
                    <td><?= h($roles->id) ?></td>
                    <td><?= h($roles->group_id) ?></td>
                    <td><?= h($roles->name) ?></td>
                    <td><?= h($roles->created) ?></td>
                    <td><?= h($roles->modified) ?></td>
                      <td class="actions text-right">
                      <?= $this->Html->link(__('Visualizar'), ['controller' => 'Roles', 'action' => 'view', $roles->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Editar'), ['controller' => 'Roles', 'action' => 'edit', $roles->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Apagar'), ['controller' => 'Roles', 'action' => 'delete', $roles->id], ['confirm' => __('Tem certeza que deseja apagar # {0}?', $roles->id), 'class'=>'btn btn-danger btn-xs']) ?>
                  </td>
              </tr>
              <?php endforeach; ?>
          </table>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="box box-solid">
        <div class="box-header with-border">
          <i class="fa fa-share-alt"></i>
          <h3 class="box-title"><?= __('Users') ?></h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <?php if (!empty($group->users)): ?>
          <table class="table table-hover">
              <tr>
                    <th scope="col"><?= __('Id') ?></th>
                    <th scope="col"><?= __('Group Id') ?></th>
                    <th scope="col"><?= __('Role Id') ?></th>
                    <th scope="col"><?= __('Username') ?></th>
                    <th scope="col"><?= __('Password') ?></th>
                    <th scope="col"><?= __('Email') ?></th>
                    <th scope="col"><?= __('Created') ?></th>
                    <th scope="col"><?= __('Modified') ?></th>
                    <th scope="col"><?= __('Removed') ?></th>
                    <th scope="col" class="actions text-center"><?= __('Ações') ?></th>
              </tr>
              <?php foreach ($group->users as $users): ?>
              <tr>
                    <td><?= h($users->id) ?></td>
                    <td><?= h($users->group_id) ?></td>
                    <td><?= h($users->role_id) ?></td>
                    <td><?= h($users->username) ?></td>
                    <td><?= h($users->password) ?></td>
                    <td><?= h($users->email) ?></td>
                    <td><?= h($users->created) ?></td>
                    <td><?= h($users->modified) ?></td>
                    <td><?= h($users->removed) ?></td>
                      <td class="actions text-right">
                      <?= $this->Html->link(__('Visualizar'), ['controller' => 'Users', 'action' => 'view', $users->id], ['class'=>'btn btn-info btn-xs']) ?>
                      <?= $this->Html->link(__('Editar'), ['controller' => 'Users', 'action' => 'edit', $users->id], ['class'=>'btn btn-warning btn-xs']) ?>
                      <?= $this->Form->postLink(__('Apagar'), ['controller' => 'Users', 'action' => 'delete', $users->id], ['confirm' => __('Tem certeza que deseja apagar # {0}?', $users->id), 'class'=>'btn btn-danger btn-xs']) ?>
                  </td>
              </tr>
              <?php endforeach; ?>
          </table>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</section>
