<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>
    <h2 class="mt-2">Hello World!</h2>

    <div class="col-sm-4">
        <a href="/user" type="button" class="btn btn-primary">See User Info</a>
    </div>      
    <br>
    <form action="" method="post">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Masukkan data karyawan..." name="keyword">
            <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
        </div>
    </form>
    <div class="row">
        <?php $i = 1 + (6 * ($currentPage - 1)); ?>
        <?php foreach($user as $u) : ?>
            <div class="col-sm-4">
                <div class="card mt-3" style="margin: 10px;">
                    <div class="row no-gutters">
                        <div class="col-md-4">
                            <a href="<?= base_url('img/' . $u['image']); ?>" target="_blank"><img src="/img/<?= $u['image']; ?>" class="card-img" alt="u image" style="flex-shrink: 0; min-width: 100%; min-height: 100%; object-fit:cover; object-position:center"></a>
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h4 class="card-title" style="margin-bottom:0;"><?= $u['first_name']; ?> <?= $u['last_name']; ?></h4>
                                <p class="card-text"><small><?= $u['email']; ?></small></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?= $pager->links('user_data', 'orang_pagination'); ?>
    </div>
<?= $this->endSection(); ?>