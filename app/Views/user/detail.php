<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>
    <h2 class="mt-2">User Details</h2>
    <div class="card" style="width: 18rem;">
        <img src="/img/<?= $user['image']; ?>" class="card-img-top" alt="user image">
        <div class="card-body">
            <h5 class="card-title"><?= $user['name']; ?></h5>
            <p class="card-text"><?= $user['email']; ?></p>

            <a href="/user/edit/<?= $user['id']; ?>" type="button" value='edit' class='btn btn-warning'>Edit</a>
            <form action="/user/<?= $user['id']; ?>" method="post" class="d-inline">
                <?= csrf_field(); ?>
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class='btn btn-danger' onclick="return confirm('Are you sure?')">Delete</button>
            </form>
            <a href="" type="button" value='print' class='btn btn-success'>Print Data</a>

            <br><br>
            <a href="/user">Back to User data</a>
        </div>
    </div>
<?= $this->endSection(); ?>