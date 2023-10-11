<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>   
    <h2 class="mt-2">Edit User Form</h2>
    <?php if(session()->has('errors')) : ?>
        <ul class="alert alert-danger">
            <?php foreach(session('errors') as $error) : ?>
                <li><?= $error; ?></li>
            <?php endforeach ?>    
        </ul>
    <?php endif ?>  
    <form action="/user/update/<?= $user['id']; ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field(); ?>
        <input type="hidden" name="oldImage" value="<?= $user['image']; ?>">
        <div class="form-group row">
            <label for="inputName" class="col-sm-2 col-form-label">Name</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" 
                placeholder="Enter name" value="<?= (old('name')) ? old('name') : $user['name']; ?>" autofocus>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputEmail" class="col-sm-2 col-form-label">Email Address</label>
            <div class="col-sm-10">
                <input type="email" id="email" name="email" class="form-control" 
                placeholder="Enter email" value="<?= (old('email')) ? old('email') : $user['email']; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="formFile" class="col-sm-2 col-form-label">User Image</label>
            <div class="col-sm-2">
                <img src="/img/<?= $user['image']; ?>" alt="" class="img-thumbnail img-preview" value="<?= (old('image')) ? old('image') : $user['image']; ?>">
            </div>
            <div class="col-sm-8">
                <input type="file" id="image" name="image" onchange="previewImg()" class="form-control" 
                placeholder="<?= $user['image']; ?>" value="<?= (old('image')) ? old('image') : $user['image']; ?>">
            </div>
        </div>
        <button type="submit" class="btn btn-success btn-user ms-3">Update Data</button>
        <a href="/user" type="button" class="btn btn-danger">Back</a>
        <hr>
    </form>
<?= $this->endSection(); ?>