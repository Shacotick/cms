<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Видалити користувача "<?= $user["lastname"] ?> <?= $user["firstname"] ?>"?</h4>
  <p>Після видалення користувача не можна буде відновити.</p>
  <hr>
  <p class="mb-0">
    <a href="/user/delete/<?= $user['id'] ?>/true" class="btn btn-danger">Видалити</a>
    <a href="/user" class="btn btn-light">Відмінити</a>
  </p>
</div>