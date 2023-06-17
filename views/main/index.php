<?php
  use models\User;
?>

<!-- Основний контейнер сторінки -->
<div class="container">
  <!-- Логотип або назва програми -->
  <h1>Ласкаво просимо до нашої системи!</h1>

  <!-- Опис функцій -->
  <p>У нашій програмі ви зможете насолоджуватись безліччю функцій і можливостей, щоб зробити ваш досвід незабутнім.<br>Ось деякі з них:</p>

  <!-- Картинка справа від тексту -->
  <div style="display: flex; align-items: center;">
    <div style="margin-right: 20px;">
      <!-- Статистика або огляд -->
      <div class="stats">
        <p>Керування вмістом</p>
        <p>Інтеграція зі соціальними мережами</p>
        <img src="/themes/light/logoMain.png" alt="Лого" height="200">
      </div>

      <!-- Кнопки дій -->
      <div class="actions">
        <a href="#" class = "btn btn-primary">Публікація новин</a>
        <a href="#" class = "btn btn-primary">Власний дизайн сайту</a>
      </div>

      <!-- Посилання на додаткові функції -->
      <div class="additional-features">
        <a href="#" class = "btn btn-primary">Керування журналістами</a>
        <a href="#" class = "btn btn-primary">Керування власними проєктами</a>
      </div>
    </div>

  </div>
</div>


<style>
    h1 {
      font-size: 24px;
    }
    
    p {
      font-size: 18px;
      line-height: 1.5;
    }
    
    .actions {
      margin-top: 20px;
    }
    
    .actions a {
      display: inline-block;
      margin: 10px;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 4px;
    }
    
    .stats {
      margin-top: 20px;
    }
    
    .stats p {
      font-size: 16px;
      color: #666;
    }
    
    .additional-features {
      margin-top: 20px;
    }
    
    .additional-features a {
      display: inline-block;
      margin: 10px;
      padding: 10px 20px;
      text-decoration: none;
      border-radius: 4px;
    }
  </style>