<h1 class = "mb-2">Редагувати новину</h1>
  
  <form action="" method="POST">
    <label for="title" class="form-label">Заголовок новини:</label>
    <input type="text" id="title" name="title" class="form-control" value = "<?= $news['title'] ?>" required><br><br>
    
    <label for="content" class="form-label">Контент новини:</label><br>
    <textarea id="content" name="content" class="form-control" rows="4" cols="50"><?= $news['content'] ?></textarea>
    
    <button class="btn btn-primary mt-5">Зберегти новину</button>
  </form>

<a href = "/projects/edit/<?= $projectId ?>" class="btn btn-primary mt-3">Повернутись до сторінки</a>