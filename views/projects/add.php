<h1>Додавання проєкту</h1>
<form action="" method="post">
    <div class="col-sm-9 pb-3 pt-3">
        <label for="name" class="form-label">Назва проєкту</label>
        <input type="text" class="form-control" id="name" name="name">
        <?php if(!empty($errors["name"])): ?>
            <div class="form-text text-danger"><?= $errors["name"] ?></div>
        <?php endif; ?>
    </div>
    <div>
        <button class="btn btn-primary">Додати</button>
    </div>
    
</form>