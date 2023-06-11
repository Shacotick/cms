<?php
    use models\User;
?>

<?php if(User::isAdmin()): ?>
    <h1>Редагування проєкту</h1>
    <form action="" method="post">
        <div class="col-sm-6 pb-3 pt-3">
            <label for="name" class="form-label">Назва проєкту</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $project["name"] ?>">
            <?php if(!empty($errors["name"])): ?>
                <div class="form-text text-danger"><?= $errors["name"] ?></div>
            <?php endif; ?>
        </div>
        <div>
            <button class="btn btn-primary">Зберегти</button>
        </div>
    </form>
<?php endif; ?>

<?php if(!User::isAdmin()): ?>
<h2 class = "mt-5" >Список новин</h2>
<a href="/news/add/<?= $project['id'] ?>" class="btn btn-primary mt-3 mb-3">Додати новину</a>
<div class="row row-cols-1 row-cols-md-4 g-4">
    <?php foreach ($news as $row) : ?>
        <div class="col">
            <div class="card" style="width: 18rem;">
            <div class="card-body">
                    <h5 class="card-title"><?= $row["title"] ?></h5>
                </div>
                <div class="card-body">
                  <div>
                    <a href="/news/edit/<?= $project['id'] ?>/<?= $row["id"] ?>" class="btn btn-primary mt-1 mb-1">Редагувати</a>
                  </div>
                  <div> 
                      <a href="/news/delete/<?= $project['id'] ?>/<?= $row["id"] ?>" class="btn btn-primary mt-1 mb-1">Видалити</a>
                  </div>
                </div>
            </div>
        </div>
    <? endforeach; ?>
</div>
<?php endif; ?>