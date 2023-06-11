<div class="my-3 p-3 bg-body rounded shadow-sm">
    <h6 class="border-bottom pb-2 mb-0">Список журналістів</h6>
    <a href="/user/add" class="btn btn-primary mt-3 mb-3">Додати журналіста</a>
    <?php foreach($users as $user): ?>
    <div class="d-flex text-body-secondary pt-3">
      <svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#007bff"></rect><text x="50%" y="50%" fill="#007bff" dy=".3em">32x32</text></svg>
      <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
        <div class="d-flex justify-content-between">
          <strong class="text-gray-dark"><?= $user['lastname'] ?> <?= $user['firstname'] ?></strong>
          <div>
            <a href="/user/edit/<?= $user['id'] ?>" class = "btn btn-primary mx-2">Змінити</a>
            <a href="/user/delete/<?= $user['id'] ?>" class = "btn btn-primary mx-2">Видалити</a>
          </div>
        </div>
        <div>
          <span class = "mr-4">Проєкти: </span>
          <?php foreach($user['projects'] as $projects): ?>
            <span class = "mx-1"><?= $projects ?></span>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
    <?php endforeach; ?>

</div>