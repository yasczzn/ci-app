<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>
    <div class="row">
        <div class="col-6">
            <h2 class="mt-2">User Data</h2>
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Enter Keyword..." name="keyword">
                    <button class="btn btn-outline-secondary" type="submit" name="submit">Search</button>
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
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Image</th>
                    <th scope="col">File</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 + (4 * ($currentPage - 1)); ?>
                <?php foreach($user as $u) : ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><?= $u['name']; ?></td>
                        <td><?= $u['email']; ?></td>
                        <td><img src="/img/<?= $u['image']; ?>" alt="user image" class="image"></td>
                        <td><?= $u['file']; ?></td>
                        <td>
                            <a href="/user/<?= $u['id']; ?>" class='btn btn-success'>Details</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $pager->links('user_data', 'orang_pagination'); ?>
        <div class="col-sm-4">
            <a href="/user/create" class="btn btn-primary">Add New</a>
        </div>
    </div>
<?= $this->endSection(); ?>