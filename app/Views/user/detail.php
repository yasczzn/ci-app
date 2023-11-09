<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>
    <h2 class="mt-2">Detail Karyawan</h2>
    <div class="card mb-3" style="margin: 60px;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <a href="<?= base_url('img/' . $user['image']); ?>" target="_blank"><img src="/img/<?= $user['image']; ?>" class="card-img" alt="user image" style="flex-shrink: 0; min-width: 100%; min-height: 100%; object-fit:cover; object-position:center"></a>
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h4 class="card-title" style="margin-bottom:0;"><?= $user['first_name']; ?> <?= $user['last_name']; ?></h4>
                    <p class="card-text"><small><?= $user['email']; ?></small></p>
                    <!-- <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p> -->
                    <p class="card-text" style="margin-bottom:0;"><b>Dokumen karyawan</b></p>
                    <p class="card-text"><small><?= $user['file']; ?> <a href="<?= base_url('file/' . $user['file']); ?>" target="_blank">download file</a></p>
                    <a href="/user/edit/<?= $user['id']; ?>" type="button" value='edit' class='btn btn-warning'>Ubah</a>
                    <form action="/user/<?= $user['id']; ?>" method="post" class="d-inline">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class='btn btn-danger' onclick="return confirm('Are you sure?')">Hapus</button>
                    </form>
                    <a href="/user/print/<?= $user['id']; ?>" target="_blank" class="btn btn-success" name="print">Print Data</a>
                    <br><br>
                    <a href="/user">Kembali ke tabel</a>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>