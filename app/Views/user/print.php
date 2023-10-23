<h2 class="mt-2">User Details</h2>
<br><br>
<div class="card" style="width: 18rem;">
    <img src="/img/<?= $user['image']; ?>" name="user" class="card-img-top" alt="user image">
    <div class="card-body">
        <h5 class="card-title"><?= $user['first_name']; ?></h5>
        <p class="card-text"><?= $user['email']; ?></p>
        <br>
        <p class="card-text"><b>User's document</b></p>
        <span class="text"><?= $user['file']; ?></span>
        <br>

    </div>
</div>