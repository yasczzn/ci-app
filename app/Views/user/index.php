<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>
    <div class="row">
        <div class="col-6">
            <h2 class="mt-2">Data Karyawan</h2>
            <br>
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Masukkan kata pencarian..." name="keyword">
                    <button class="btn btn-outline-secondary" type="submit" name="submit">Cari</button>
                </div>
            </div>
        </form>
    </div>
    <div class="table-wrapper">
        <?php if(session()->getFlashdata('notification')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('notification'); ?>
            </div>
        <?php endif; ?>    
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Age</th>
                    <th scope="col">Start Working</th>
                    <th scope="col">Image</th>
                    <th scope="col">File</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 + (5 * ($currentPage - 1)); ?>
                <?php foreach($user as $u) : ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><?= $u['first_name']; ?></td>
                        <td><?= $u['last_name']; ?></td>
                        <td><?= $u['email']; ?></td>
                        <td><?= $u['age']; ?></td>
                        <td><?= $u['hired_since']; ?></td>
                        <td><a href="<?= base_url('img/' . $u['image']); ?>" target="_blank"><img src="/img/<?= $u['image']; ?>" alt="user image" class="image"></a></td>
                        <td><a href="<?= base_url('file/' . $u['file']); ?>" target="_blank"><span class="text"><?= $u['file']; ?></span></a></td>
                        <td>
                            <a href="/user/details/<?= $u['id']; ?>" class='btn btn-success'>Detail</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $pager->links('user_data', 'orang_pagination'); ?>
        <div class="col-sm-4">
            <a href="/user/create" class="btn btn-primary">Tambah Karyawan</a>
        </div>
    </div>
<?= $this->endSection(); ?>