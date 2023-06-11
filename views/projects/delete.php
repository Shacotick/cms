<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Видалити проєкт "<?= $project["name"] ?>"?</h4>
  <p>Після видалення проєкт не можна буде відновити.</p>
  <hr>
  <p class="mb-0">
    <a href="/projects/delete/<?= $project["id"] ?>/true" class="btn btn-danger">Видалити</a>
    <a href="/projects" class="btn btn-light">Відмінити</a>
  </p>
</div>