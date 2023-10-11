<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>
    <h2 class="mt-2">Hello World!</h2>

    <div class="col-sm-4">
        <a href="/user" type="button" class="btn btn-primary">See User Info</a>
    </div>                
<?= $this->endSection(); ?>