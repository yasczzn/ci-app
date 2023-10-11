<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>   
    <h2 class="mt-2">User Form</h2>
    <form action="" method="POST" role="form">
        <div class="form-group row">
            <label for="inputName">Name</label>
            <input type="text" class="form-control" name="name" placeholder="Enter name">
        </div>
        <div class="form-group row">
            <label for="inputEmail">Email Address</label>
            <input type="email" class="form-control" name="email" placeholder="Enter email">
        </div>
        <input type="submit" value="Submit" name="submit" class="btn btn-success btn-user ms-3"/>
        <a href='/'>
            <input type='button' value='Cancel' class='btn btn-danger btn-user'>
        </a>
        <hr>
    </form>
<?= $this->endSection(); ?>
