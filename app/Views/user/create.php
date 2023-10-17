<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>   
    <h2 class="my-2">Add User Form</h2>
    <?php if(session()->has('errors')) : ?>
        <ul class="alert alert-danger">
            <?php foreach(session('errors') as $error) : ?>
                <li><?= $error; ?></li>
            <?php endforeach ?>    
        </ul>
    <?php endif ?>    
    <form action="/user/save" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <div class="form-group row">
            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" id="name" name="name" class="form-control" 
                placeholder="Enter name" value="<?= old('name'); ?>" autofocus>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email Address</label>
            <div class="col-sm-10">
                <input type="email" id="email" name="email" class="form-control" 
                placeholder="Enter email" value="<?= old('email'); ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="formFile" class="col-sm-2 col-form-label">User Image</label>
            <div class="col-sm-2">
                <img src="/img/default.jpg" alt="" class="img-thumbnail img-preview">
            </div>
            <div class="col-sm-8">
                <input type="file" id="image" name="image" onchange="previewImg()" value="<?= old('image'); ?>" 
                class="form-control" placeholder="Enter image">
            </div>
        </div>
        <div class="form-group row">
            <label for="formFile" class="col-sm-2 col-form-label">User Document</label>
            <div class="col-sm-10">
                <input type="file" id="file" name="file" class="form-control" 
                placeholder="Enter file" value="<?= old('file'); ?>">
            </div>
        </div>
        <button type="submit" class="btn btn-success btn-user ms-3">Submit</button>
        <a href="/user" type="button" class="btn btn-danger">Cancel</a>
        <hr>
    </form>
<?= $this->endSection(); ?>
