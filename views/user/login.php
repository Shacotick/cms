<style>
    form, .message-error{
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    margin-top: 50px;
    }

    .message-error{
        color: red;
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
core\Core::getInstance()->pageParams['title'] = 'Вхід на сайт';
?>
<h1>Вхід на сайт</h1>
<?php if(!empty($error)): ?>
<div class="message-error">
    <?= $error; ?>
</div>
<?php endif; ?>
<form method="post" action="">
    <div>
        <label for="login">Логин: </label>
    </div>
    <div>
        <input type="text" name="login" id="login" value="<?= $model['login'] ?>" \>
    </div>
    
    <div>
        <label for="password">Пароль: </label>
    </div>
    <div>
        <input type="password" name="password" id="password" value="<?= $model['password'] ?>"\>
    </div>
    <button>Увійти</button>
    
</form>