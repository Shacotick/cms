<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title><?=$siteName?> | <?=$title?></title>
  <link rel = "stylesheet" href = "/themes/light/css/style.css" />
  <link rel= "icon" href="/themes/light/logo.ico">
  <script
  src="https://code.jquery.com/jquery-3.7.0.min.js"
  integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g="
  crossorigin="anonymous"></script>
</head>

<?php
use models\User;

if (User::isUserAunthenticated()) {
    $user = User::getCurrentAunthenticatedUser();
} else {
    $user = null;
}
?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<body>
<?php if (!$isConstructor): ?>

  <div class="container">
  <header class="d-flex flex-wrap align-items-center justify-content-end justify-content-md-between py-3 mb-4 border-bottom">
      <div class="col-md-3 mb-2 mb-md-0">
        <!-- HERE -->
      <!-- <?php if ($isConstructor): ?>
        <ul class="nav col-12 col-md-auto mb-2 mb-md-0 justify-content-start">
          <li><a href = "/" class="btn btn-primary mx-2 my-1">Додати шаблон</a></li>
        </ul>
        <?php endif;?> -->
      </div>


      <ul class="nav col-2 col-md-auto mb-2 justify-content-center mb-md-0">
        <li><a href="/main" class="nav-link px-2 link-secondary">Головна</a></li>
        <?php if (User::isUserAunthenticated()): ?>
          <li><a href="/projects" class="nav-link px-2 link-secondary">Мої проєкти</a></li>

            <?php if (User::isAdmin()): ?>
              <li><a href="/user" class="nav-link px-2 link-secondary">Журналісти</a></li>
            <?php endif;?>

          <?php endif;?>
      </ul>

      <div class="col-md-3 text-end">
        <?php if (User::isUserAunthenticated()): ?>
          <a class="icon-link icon-link-hover mx-3" style="--bs-icon-link-transform: translate3d(0, -.125rem, 0);" href="/user/edit/<?= $user['id'] ?>/account">
            <svg class="bi" aria-hidden="true"><use xlink:href="#clipboard"></use></svg>
            <?=$user['lastname']?> <?=$user['firstname']?>
          </a>
          <a href="\user\logout" class="btn btn-outline-primary me-2">Вийти</a>
        <?php else: ?>
          <a href="\user\login" class="btn btn-outline-primary me-2">Увійти</a>
          <a href="\user\register" class="btn btn-primary">Зареєструватись</a>
        <?php endif;?>
      </div>
  </header>
  </div>
  <?php endif;?>

  <?php if (!$isConstructor): ?>
    <div class="container" style = "height: 100vh;">
  <?php endif;?>
    <?=$content?>
  <?php if (!$isConstructor): ?>
    </div>
  <?php endif;?>

<?php if (!$isConstructor): ?>
  <div class="container">
  <footer class="py-3 my-4">
    <p class="text-center text-body-secondary">© 2023 NULES</p>
  </footer>
  </div>
<?php endif;?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <script src="/js/script.js"></script>
</body>

</html>