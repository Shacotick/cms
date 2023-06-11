<style>
    form {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin-top: 50px;
    }
    
    div {
    margin-bottom: 10px;
    }
    
    label {
    display: block;
    font-weight: bold;
    }
    
    input[type="text"], input[type="password"] {
    width: 100%;
    padding: 5px;
    border-radius: 3px;
    border: 1px solid #ccc;
    }
    
    button {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 3px;
    font-size: 16px;
    cursor: pointer;
    }
    
    button:hover {
    background-color: #0069d9;
    }

    h1 {
        text-align: center;
    }

    .error{
        color: red;
    }
</style>

<?php
core\Core::getInstance()->pageParams['title'] = 'Реєстрація на сайті';
?>

<h1>Реєстрація користувача</h1>

<form method="post" action="">
    <div>
        <label for="login">Логин: </label>
    </div>
    <div style="max-width: 200px;">
        <input type="text" name="login" id="login" value="<?= $model['login'] ?>" \>
        <?php if(!empty($errors['login'])): ?>
            <span class="error">
                <?= $errors['login']; ?>
            </span>
        <?php endif; ?>
    </div>
    
    <div>
        <label for="password">Пароль: </label>
    </div>
    <div style="max-width: 200px;">
        <input type="password" name="password" id="password" value="<?= $model['password'] ?>"\>
        <?php if(!empty($errors['password'])): ?>
            <span class="error">
                <?= $errors['password']; ?>
            </span>
        <?php endif; ?>
    </div>
    
    <div>
        <label for="password2">Пароль (ще раз): </label>
    </div>
    <div>
        <input type="password" name="password2" id="password2" value="<?= $model['password2'] ?>"\>
        <?php if(!empty($errors['password2'])): ?>
            <span class="error">
                <?= $errors['password2']; ?>
            </span>
        <?php endif; ?>
    </div>

    <div>
        <label for="secondname">Прізвище: </label>
    </div>
    <div>
        <input type="text" name="secondname" id="secondname" value="<?= $model['secondname'] ?>"\>
    </div>

    <div>
        <label for="firstname">Ім'я: </label>
    </div>
    <div>
        <input type="text" name="firstname" id="firstname" value="<?= $model['firstname'] ?>"\>
    </div>
    <button>Зареєструватися</button>
    
</form>