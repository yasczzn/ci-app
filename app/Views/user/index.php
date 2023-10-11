<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>
    <div class="table-wrapper">
        <h2 class="mt-2">User Data</h2>
        <?php if(session()->getFlashdata('notification')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('notification'); ?>
            </div>
        <?php endif; ?>    
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Image</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach($user as $u) : ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><?= $u['name']; ?></td>
                        <td><?= $u['email']; ?></td>
                        <td><img src="/img/<?= $u['image']; ?>" alt="user image" class="image"></td>
                        <td>
                            <a href="/user/<?= $u['id']; ?>" class='btn btn-success'>Details</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="col-sm-4">
            <a href="/user/create" class="btn btn-primary">Add New</a>
        </div>
    </div>
<?= $this->endSection(); ?>