<div class="alert alert-danger" role="alert">
  <h4 class="alert-heading">Видалити новину "<?= $news["title"] ?>"?</h4>
  <p>Після видалення новину не можна буде відновити.</p>
  <hr>
  <p class="mb-0">
    <a href="/news/delete/<?= $project_id ?>/<?= $news["id"] ?>/true" class="btn btn-danger">Видалити</a>
    <a href="/projects/edit/<?= $project_id ?>" class="btn btn-light">Відмінити</a>
  </p>
</div>