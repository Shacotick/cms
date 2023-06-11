<?php
  use core\Core;
?>

<h1 class = "mb-2">Додати новину</h1>
  
  <form action="" method="POST">
    <label for="title" class="form-label">Заголовок новини:</label>
    <input type="text" id="title" name="title" class="form-control" required><br><br>
    
    <label for="content" class="form-label">Контент новини:</label><br>
    <textarea id="content" name="content" class="form-control" rows="4" cols="50"></textarea>
    <?php if (Core::getInstance()->requestMethod === "POST"): ?>
      <label for="success" class="form-label">Новина успішно додана!</label>
    <?php endif; ?>
    <br><br>

    <button class="btn btn-primary">Додати новину</button>
  </form>

<a href = "/projects/edit/<?= $projectId ?>" class="btn btn-primary mt-3">Повернутись до сторінки</a>