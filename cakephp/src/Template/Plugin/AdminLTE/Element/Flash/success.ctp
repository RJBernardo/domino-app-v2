<!-- <section class="content-header">
    <div class="alert alert-success alert-dismissible">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <h4><i class="icon fa fa-check"></i> <?= __('Alert') ?>!</h4>
        <?= h($message) ?>
    </div>
</section> -->
<script>
    alert('<?= h($message) ?>');
</script>