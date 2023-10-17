<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>
    <div class="row">
        <div class="col-6">
            <h2 class="mt-2">Data Orang</h2>
            <form action="" method="post">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Enter Keyword..." name="keyword">
                    <button class="btn btn-outline-secondary" type="submit" name="submit">Search</button>
                </div>
            </form>
            <div class="col-sm-4">
                <a href="orang/printpdf" target="_blank" class="btn btn-outline-primary" name="orang">Print All Data</a>
            </div>
            <br>
        </div>
    </div>
    <div class="table-wrapper">  
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 + (4 * ($currentPage - 1)); ?>
                <?php foreach($orang as $o) : ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><?= $o['name']; ?></td>
                        <td><?= $o['email']; ?></td>
                        <td>
                            <a href="" class='btn btn-success'>Details</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?= $pager->links('orang', 'orang_pagination'); ?>
    </div>
<?= $this->endSection(); ?>