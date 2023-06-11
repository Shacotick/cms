<?php

use Models\User; 
use Models\Pages;

?>

<h2 class = "mb-5">Список проєктів</h2>
<?php if(User::isAdmin()): ?>
<a href="/projects/add" class="btn btn-primary mt-3 mb-3">Додати новий проєкт</a>
<?php endif; ?>
<div class="row row-cols-1 row-cols-md-4 g-4">
    <?php foreach ($rows as $row) : ?>
        <div class="col">
            <div class="card" style="width: 18rem;">
            <div class="card-body">
                    <h5 class="card-title"><?= $row["name"] ?></h5>
                </div>
                  <div class="card-body">
                  <?php if(User::isAdmin()): ?>
                    <div>
                      <a href="/projects/view/<?= $row["id"] ?>/<?= Pages::getMainPageByProjectId($row["id"])["id"] ?>" class="btn btn-primary mt-1 mb-1">Перейти</a>
                    </div>
                    <div>
                      <a href="/projects/edit/<?= $row["id"] ?>" class="btn btn-primary mt-1 mb-1">Редагувати проєкт</a>
                    </div>
                    <div> 
                        <a href="/projects/delete/<?= $row["id"] ?>" class="btn btn-primary mt-1 mb-1">Видалити проєкт</a>
                    </div>
                  <?php else: ?>
                    <div> 
                      <a href="/projects/edit/<?= $row["id"] ?>" class="btn btn-primary mt-1 mb-1">Перейти до списку новин</a>
                    </div>
                  <?php endif; ?>
                  </div>
            </div>
        </div>
    <? endforeach; ?>
</div>