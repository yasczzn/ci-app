<h2 class="mt-2">User Details</h2>
<br><br>
<div class="card" style="width: 18rem;">
    <img src="./img/<?= $user['image']; ?>" name="user" class="card-img-top" alt="user image">
    <div class="card-body">
        <h1 class="card-title"><?= $user['first_name']; ?> <?= $user['last_name']; ?></h1>
        <p class="card-text"><?= $user['email']; ?></p>
        <p class="card-text"><b>Start Working since:</b> <?= $user['hired_since']; ?></p>
        <br>
        <p class="card-text">User's profile</p>
        <br>
    </div>
</div>