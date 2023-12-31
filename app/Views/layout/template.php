<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- My CSS -->
    <link rel="stylesheet" href="/css/style.css">

    <title><?= $title; ?></title>
  </head>
<body>

<?= $this->include('layout/navbar'); ?>

<div class="container">
    <div class="row">
        <div class="col">
            <?= $this->renderSection('content'); ?>
        </div>
    </div>
</div>

<em>&copy; 2023</em>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script>
      function previewImg() {
        const image = document.querySelector('#image');
        const imgLabel = document.querySelector('.img-label');
        const imgPreview = document.querySelector('.img-preview');

        imgLabel.textContent = image.files[0].name;

        const imageFile = new FileReader();
        imageFile.readAsDataURL(image.files[0]);

        imageFile.onload = function(e) {
          imgPreview.src = e.target.result;
        }
      }

      function previewFile() {
        const doc = document.querySelector('#file');
        const docLabel = document.querySelector('.file-label');
        const docPreview = document.querySelector('.file-preview');

        docLabel.textContent = file.files[0].name;
      }
    </script>
  </body>
</html>
