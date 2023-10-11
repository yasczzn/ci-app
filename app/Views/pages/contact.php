<?= $this->extend('layout/template'); ?>


<?= $this->section('content'); ?>
    <h2 class="mt-2">Contact Us</h2>
    <?php foreach ($address as $a) : ?>
        <ul>
            <li><?= $a['tipe']; ?></li>
            <li><?= $a['alamat']; ?></li>
            <li><?= $a['kota']; ?></li>
        </ul>
    <?php endforeach; ?>
    <a href="/" type="button" class="btn btn-primary">Home</a>
<?= $this->endSection(); ?>