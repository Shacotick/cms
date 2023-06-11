<h2>Список новин</h2>
<a href="/news/add/" class="btn btn-primary mt-3 mb-3">Додати новину</a>
<div class="row row-cols-1 row-cols-md-4 g-4">
    <?php foreach ($rows as $row) : ?>
        <div class="col">
            <div class="card" style="width: 18rem;">
            <div class="card-body">
                    <h5 class="card-title"><?= $row["title"] ?></h5>
                </div>
                <div class="card-body">
                  <div>
                    <a href="/news/edit/<?= $row["id"] ?>" class="btn btn-primary mt-1 mb-1">Редагувати проєкт</a>
                  </div>
                  <div> 
                      <a href="/news/delete/<?= $row["id"] ?>" class="btn btn-primary mt-1 mb-1">Видалити проєкт</a>
                  </div>
                </div>
            </div>
        </div>
    <? endforeach; ?>
</div>