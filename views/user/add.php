<h1>Додавання журналіста</h1>
<form action="" method="post">
    <div class="col-sm-9 pb-3 pt-3">
        <label for="lastname" class="form-label my-2">Прізвище</label>
        <input type="text" class="form-control" id="lastname" name="lastname">

        <label for="firstname" class="form-label my-2">Ім'я</label>
        <input type="text" class="form-control" id="firstname" name="firstname">

        <label for="login" class="form-label my-2">Логін</label>
        <input type="text" class="form-control" id="login" name="login">

        <label for="password" class="form-label my-2">Пароль</label>
        <input type="text" class="form-control" id="password" name="password">

        <label for="project" class="form-label my-2">Закріпити за проєктом</label>
        <div id="projectContainer">
            <select id="projectId1" class="form-control project-select" name="projectId[]">
                <?php foreach ($projects as $project): ?>
                 <option value="<?=$project['id']?>"><?=$project['name']?></option>
                <?php endforeach;?>
            </select>
        </div>

        <div class="input-group-append my-2">
            <button class="btn btn-primary" type="button" id="addProjectButton">+</button>
        </div>

        <?php if (!empty($errors["name"])): ?>
            <div class="form-text text-danger"><?=$errors["name"]?></div>
        <?php endif;?>
    </div>
    <div>
        <button class="btn btn-primary">Додати користувача</button>
    </div>

</form>

<a href = "/user" class="btn btn-primary mt-3">Повернутись до сторінки</a>

<style>
    .project-select {
        margin-bottom: 10px;
    }
</style>

<script>
    var maxSelects = <?= count($projects) ?>; // Максимальна кількість селектів, які можуть бути додані
    var selectCount = 1; // Початкове значення лічильника

    document.getElementById('addProjectButton').addEventListener('click', function() {
        if (selectCount >= maxSelects) {
            return; // Заборонити додавання додаткових селектів, якщо досягнуто максимальну кількість
        }

        var container = document.getElementById('projectContainer'); // Отримуємо контейнер, в якому розташовані селекти
        var select = document.createElement('select'); // Створюємо новий елемент <select>
        select.className = 'form-control project-select'; // Додаємо класи до нового селекта
        select.name = 'projectId[]'; // Встановлюємо атрибут 'name' для селекта, з додаванням '[]', щоб передати значення як масив
        select.id = 'projectId' + (selectCount + 1); // Встановлюємо унікальний ідентифікатор для селекта

        <?php foreach ($projects as $project): ?>
            var option = document.createElement('option'); // Створюємо новий елемент <option>
            option.value = '<?=$project['id']?>'; // Встановлюємо значення для опції
            option.textContent = '<?=$project['name']?>'; // Встановлюємо текстовий вміст для опції
            select.appendChild(option); // Додаємо опцію до селекта
        <?php endforeach;?>

        container.appendChild(select); // Додаємо новий селект до контейнера
        selectCount++; // Збільшуємо значення лічильника

        if (selectCount >= maxSelects) {
            document.getElementById('addProjectButton').disabled = true; // Заборонити додавання, якщо досягнуто максимальну кількість
        }
    });
</script>