<h1 class = "mb-2">Редагувати користувача</h1>
  
  <form action="" method="POST">
    <label for="title" class="form-label">Прізвище:</label>
    <input type="text" id="lastname" name="lastname" class="form-control" value = "<?= $user['lastname'] ?>">
    
    <label for="title" class="form-label">Прізвище:</label>
    <input type="text" id="firstname" name="firstname" class="form-control" value = "<?= $user['firstname'] ?>">
    
    <button class="btn btn-primary mt-5">Зберегти користувача</button>
  </form>

<a href = "/user" class="btn btn-primary mt-3">Повернутись до сторінки</a>