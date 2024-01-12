<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Ranking
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
        <!-- Left col -->
        <section class="col-lg-6 col-md-6 connectedSortable">

            <!-- Ranking Diario -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Ranking Diário</h3>
                    <?php echo $this->Form->create($date, ['role' => 'form', 'id' => 'formDate']); ?>

                    <div class="form-group">
                        <label>Date:</label>

                        <div class="input-group date">
                            <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </div>
                            <input type="text" class="form-control pull-right" id="datepicker" name="datenow">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <?php echo $this->Form->end(); ?>

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Jogador</th>
                                    <th scope="col" class="text-center padding-5">Jog</th>
                                    <th scope="col" class="text-center padding-5">Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($resultsDiario as $result): ?>
                                    <tr>
                                        <td class="padding-5">
                                            <?= h($i) ?>
                                        </td>
                                        <td class="padding-5">
                                            <?= h($result['name']) ?>
                                        </td>
                                        <td class="text-center padding-5">
                                            <?= $this->Number->format($result['qtd_games']) ?>
                                        </td>
                                        <td class="text-center padding-5">
                                            <?= $this->Number->format($result['value'], ['places' => 2]) ?>
                                        </td>
                                    </tr>
                                    <?php $i++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </section>
        <section class="col-lg-6 col-md-6 connectedSortable">

            <!-- Ranking Semanal -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Ranking Semanal</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Jogador</th>
                                    <th scope="col" class="text-center padding-5">Dias Jog.</th>
                                    <th scope="col" class="text-center padding-5">Jog.</th>
                                    <th scope="col" class="text-center padding-5">Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($resultsSemanal as $result): ?>
                                    <tr>
                                        <td class="padding-5">
                                            <?= h($i) ?>
                                        </td>
                                        <td class="padding-5">
                                            <?= h($result['name']) ?>
                                        </td>
                                        <td class="text-center padding-5">
                                            <?= $this->Number->format($result['qtd_diasjogados']) ?>
                                        </td>
                                        <td class="text-center padding-5">
                                            <?= $this->Number->format($result['qtd_games']) ?>
                                        </td>
                                        <td class="text-center padding-5">
                                            <?= $this->Number->format($result['value'], ['places' => 2]) ?>
                                        </td>
                                    </tr>
                                    <?php $i++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </section>
        <section class="col-lg-6 col-md-6 connectedSortable">

            <!-- Ranking Mensal -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Ranking Mensal</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Jogador</th>
                                    <th scope="col" class="text-center padding-5">Dias Jog.</th>
                                    <th scope="col" class="text-center padding-5">Jog.</th>
                                    <th scope="col" class="text-center padding-5">Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($resultsMensal as $result): ?>
                                    <tr>
                                        <td class="padding-5">
                                            <?= h($i) ?>
                                        </td>
                                        <td class="padding-5">
                                            <?= h($result['name']) ?>
                                        </td>
                                        <td class="text-center padding-5">
                                            <?= $this->Number->format($result['qtd_diasjogados']) ?>
                                        </td>
                                        <td class="text-center padding-5">
                                            <?= $this->Number->format($result['qtd_games']) ?>
                                        </td>
                                        <td class="text-center padding-5">
                                            <?= $this->Number->format($result['value'], ['places' => 2]) ?>
                                        </td>
                                    </tr>
                                    <?php $i++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </section>
        <section class="col-lg-6 col-md-6 connectedSortable">

            <!-- Ranking Anual -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Ranking Anual</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Jogador</th>
                                    <th scope="col" class="text-center padding-5">Dias Jog.</th>
                                    <th scope="col" class="text-center padding-5">Jog.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($resultsAnual as $result): ?>
                                    <tr>
                                        <td class="padding-5">
                                            <?= h($i) ?>
                                        </td>
                                        <td class="padding-5">
                                            <?= h($result['name']) ?>
                                        </td>
                                        <td class="text-center padding-5">
                                            <?= $this->Number->format($result['qtd_diasjogados']) ?>
                                        </td>
                                        <td class="text-center padding-5">
                                            <?= $this->Number->format($result['qtd_games']) ?>
                                        </td>
                                        <td class="text-center padding-5">
                                            <?= $this->Number->format($result['value'], ['places' => 2]) ?>
                                        </td>
                                    </tr>
                                    <?php $i++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </section>
        <section class="col-lg-6 col-md-6 connectedSortable">

            <!-- Ranking Acumulado -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Ranking Acumulado</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Jogador</th>
                                    <th scope="col" class="text-center padding-5">Dias Jog.</th>
                                    <th scope="col" class="text-center padding-5">Jog.</th>
                                    <th scope="col" class="text-center padding-5">Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($resultsAcumulado as $result): ?>
                                    <tr>
                                        <td class="padding-5">
                                            <?= h($i) ?>
                                        </td>
                                        <td class="padding-5">
                                            <?= h($result['name']) ?>
                                        </td>
                                        <td class="text-center padding-5">
                                            <?= $this->Number->format($result['qtd_diasjogados']) ?>
                                        </td>
                                        <td class="text-center padding-5">
                                            <?= $this->Number->format($result['qtd_games']) ?>
                                        </td>
                                        <td class="text-center padding-5">
                                            <?= $this->Number->format($result['value'], ['places' => 2]) ?>
                                        </td>
                                    </tr>
                                    <?php $i++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </section>
        <!-- /.Left col -->
    </div>
    <!-- /.row (main row) -->

</section>
<!-- /.content -->


<!-- Morris chart -->
<?php echo $this->Html->css('AdminLTE./bower_components/morris.js/morris', ['block' => 'css']); ?>
<!-- jvectormap -->
<?php echo $this->Html->css('AdminLTE./bower_components/jvectormap/jquery-jvectormap', ['block' => 'css']); ?>
<!-- Date Picker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min', ['block' => 'css']); ?>
<!-- Daterange picker -->
<?php echo $this->Html->css('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'css']); ?>
<!-- bootstrap wysihtml5 - text editor -->
<?php echo $this->Html->css('AdminLTE./plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min', ['block' => 'css']); ?>

<!-- jQuery UI 1.11.4 -->
<?php echo $this->Html->script('AdminLTE./bower_components/jquery-ui/jquery-ui.min', ['block' => 'script']); ?>
<!-- Morris.js charts -->
<?php echo $this->Html->script('AdminLTE./bower_components/raphael/raphael.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/morris.js/morris.min', ['block' => 'script']); ?>
<!-- Sparkline -->
<?php echo $this->Html->script('AdminLTE./bower_components/jquery-sparkline/dist/jquery.sparkline.min', ['block' => 'script']); ?>
<!-- jvectormap -->
<?php echo $this->Html->script('AdminLTE./plugins/jvectormap/jquery-jvectormap-1.2.2.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./plugins/jvectormap/jquery-jvectormap-world-mill-en', ['block' => 'script']); ?>
<!-- jQuery Knob Chart -->
<?php echo $this->Html->script('AdminLTE./bower_components/jquery-knob/dist/jquery.knob.min', ['block' => 'script']); ?>
<!-- daterangepicker -->
<?php echo $this->Html->script('AdminLTE./bower_components/moment/min/moment.min', ['block' => 'script']); ?>
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-daterangepicker/daterangepicker', ['block' => 'script']); ?>
<!-- datepicker -->
<?php echo $this->Html->script('AdminLTE./bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min', ['block' => 'script']); ?>
<!-- Bootstrap WYSIHTML5 -->
<?php echo $this->Html->script('AdminLTE./plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min', ['block' => 'script']); ?>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<?php echo $this->Html->script('AdminLTE.pages/dashboard', ['block' => 'script']); ?>
<!-- AdminLTE for demo purposes -->
<?php echo $this->Html->script('AdminLTE.demo', ['block' => 'script']); ?>

<?php $this->start('scriptBottom'); ?>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);


    //Date picker
    $('#datepicker').datepicker({
        autoclose: true,
        format: 'dd/mm/yyyy'
    }).on('changeDate', function (ev) {
        $(this).closest('form').submit();
    });

    $('#datepicker').val('<?= $datenow ?>');
</script>
<?php $this->end(); ?>