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
        <input type="hidden" name="oldFile" value="<?= $user['file']; ?>">
        <div class="form-group row">
            <label for="inputFirstName" class="col-sm-2 col-form-label">First Name</label>
            <div class="col-sm-10">
                <input type="text" id="first_name" name="first_name" class="form-control" 
                placeholder="Enter first name" value="<?= (old('first_name')) ? old('first_name') : $user['first_name']; ?>" autofocus required>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputLastName" class="col-sm-2 col-form-label">Last Name</label>
            <div class="col-sm-10">
                <input type="text" id="last_name" name="last_name" class="form-control" 
                placeholder="Enter last name" value="<?= (old('last_name')) ? old('last_name') : $user['last_name']; ?>" required>
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
            <label for="inputAge" class="col-sm-2 col-form-label">Age</label>
            <div class="col-sm-10">
                <input type="text" id="age" name="age" class="form-control" 
                placeholder="Enter age" value="<?= (old('age')) ? old('age') : $user['age']; ?>" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="inputHiredSince" class="col-sm-2 col-form-label">Start Working from</label>
            <div class="col-sm-10">
                <input type="date" id="hired_since" name="hired_since" class="form-control" 
                placeholder="Enter hired date" value="<?= (old('hired_since')) ? old('hired_since') : $user['hired_since']; ?>" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="formFile" class="col-sm-2 col-form-label">User Image</label>
            <div class="col-sm-2">
                <img src="/img/<?= $user['image']; ?>" alt="" class="img-thumbnail img-preview" value="<?= (old('image')) ? old('image') : $user['image']; ?>">
            </div>
            <div class="col-sm-8">
                <div class="custom-file">
                    <input type="file" id="image" name="image" onchange="previewImg()" class="custom-file-input" 
                     value="<?= (old('image')) ? old('image') : $user['image']; ?>">
                    <label class="img-label custom-file-label" for="formFile"><?= $user['image']; ?></label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="formFile" class="col-sm-2 col-form-label">User Document</label>
            <div class="col-sm-10">
                <div class="custom-file">
                    <input type="file" id="file" name="file" onchange="previewFile()" class="custom-file-input" value="<?= (old('file')) ? old('file') : $user['file']; ?>" required>
                    <label class="file-label custom-file-label" for="formFile"><?= $user['file']; ?></label>
                </div>
            </div>
        </div>    
        <button type="submit" class="btn btn-success btn-user ms-3">Update Data</button>
        <a href="/user" type="button" class="btn btn-danger">Back</a>
        <hr>
    </form>
<?= $this->endSection(); ?>