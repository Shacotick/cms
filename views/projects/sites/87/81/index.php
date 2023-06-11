<!DOCTYPE html>
<html lang="en">


<?php
use models\Pages;
use models\News;

$pages = Pages::getPagesByProjectId($projectId);
$news = News::getByProjectId($projectId);

$maxCharsContent = 540;
$maxCharsTitle = 110;
foreach($news as &$tempNews)
{
   if (mb_strlen($tempNews['content']) > $maxCharsContent) {
      $tempNews['content'] = mb_substr($tempNews['content'], 0, $maxCharsContent) . '...';
   }
}

$lastNews = array_reverse($news);

?>

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel = "stylesheet" href = "/views/projects/sites/<?=$projectId?>/<?=$pageId?>/style.css">
   <title>ПИСАНИНА.media</title>
</head>

<body>
<!--
   <form id="myForm" class="hidden-form">
  <div>
    <label class="col-form-label">Виберіть сторінку:</label>
  </div>

  <div>
    <select id="pageId" class="form-control" name="pageId">

         <?php foreach ($pages as $page): ?>
          <option value="<?=$page['id']?>"><?=$page['title']?></option>
        <?php endforeach;?>

      </select>
  </div>

  <div>
  <label class="col-form-label">Текст:</label>
          <input type="text" id="inputPassword6" class="form-control" name="textInput" aria-labelledby="passwordHelpInline">
          <span id="passwordHelpInline" class="form-text">8-20 символів</span>
  </div>

    <input type="submit" class = "btn btn-primary" value="Зберегти">
  <div>
    <input type="button" class = "btn btn-primary" value="Скасувати" onclick="hideForm('myForm')">
  </div>

</form>
-->

   <div class="header">
      <div class="header_content">
         <div class="header_content_logo">
            <div class="header_content_logo_hello">
               <span style="font-size: 24px; letter-spacing: 4px; font-weight: lighter;">ПИСАНИНА.</span>
               <span style="font-size: 24px; letter-spacing: 3px; font-weight: bold;">media</span>
            </div>
            <div class="header_content_logo_description"><span style="font-style: italic;">Далі - більше!</span></div>
         </div>


<!--
         <div class="header_content_nav">
            <ul>
               <li><button class = "btn btn-primary mx-2" id = "addHeaderButton" onclick="showBlocks()">Додати елемент</button></li>
               <li><a href="#">ГОЛОВНА</a></li>
               <li><a class = "hidden-header-block" id = "headContainer1" onclick="showForm(event, 'myForm')">Нова сторінка</a></li>
               <li><a class = "hidden-header-block" id = "headContainer2" onclick="showForm(event, 'myForm')">Нова сторінка</a></li>
               <li><a class = "hidden-header-block" id = "headContainer3" onclick="showForm(event, 'myForm')">Нова сторінка</a></li>
               <li><a class = "hidden-header-block" id = "headContainer4" onclick="showForm(event, 'myForm')">Нова сторінка</a></li>
               <li><a class = "hidden-header-block" id = "headContainer5" onclick="showForm(event, 'myForm')">Нова сторінка</a></li>
               <li><a class = "hidden-header-block" id = "headContainer6" onclick="showForm(event, 'myForm')">Нова сторінка</a></li>
               <li><a class = "hidden-header-block" id = "headContainer7" onclick="showForm(event, 'myForm')">Нова сторінка</a></li>
            </ul>
         </div>
-->
      </div>
   </div>


   <main class="main">
      <div class="main_content">
         <div class="main_content_intro" style = "background-image:url(/views/projects/sites/<?=$projectId?>/<?=$pageId?>/photo/BackgroundImg.jpg);">
            <div class="main_content_intro_logo"> <img src="/views/projects/sites/<?=$projectId?>/<?=$pageId?>/photo/LogoImg.webp" alt="logo" srcset=""></div>
            <div class="main_content_intro_text">
               <div class="main_content_intro_text_High">
                  <h1>"ПИСАНИНА. media" вітає тебе!</h1>
               </div>
               <div class="main_content_intro_text_descrip1">
                  Раді бачити в нашому колі!
               </div>
               <div class="main_content_intro_text_descrip2">
                  Познайомимося ближче?
               </div>
            </div>
         </div>
         <div class="main_content_personalInfo">
            <div class="main_content_personalInfo_text">
               <p>Слідкуйте за "ПИСАНИНА.</p><br>
               <p>media" в соціальних мережах:</p>
            </div>
            <div class="main_content_personalInfo_links">
               <ul>
                  <li class="main_content_personalInfo_links_li1"><a href="https://t.me/pysanynamedia">TELEGRAM</a></li>
                  <li class="main_content_personalInfo_links_li2"><a href="https://instagram.com/pysanyna.media?igshid=MmJiY2I4NDBkZg==">INSTAGRAM</a></li>
                  <li class="main_content_personalInfo_links_li3"><a href="https://www.tiktok.com/@pysanyna_media?_t=8cttdKEGGZh&_r=1">TIKTOK</a></li>
               </ul>
            </div>
         </div>
         <div class="main_content_articles">
            <div class="main_content_articles_intro">
               <h2><span style="font-style: italic; font-size: 24px; font-weight: lighter;">НОВИНИ:</span></h2>
            </div>

         <!-- PHP FOR -->
         <?php foreach ($lastNews as $new): ?>

            <div class="main_content_articles-1">
               <div class="main_content_articles-1_deskrip">
                  <div class="main_content_articles-1_deskrip_title">
                     <h2><a href="/projects/newsredirect/<?= $projectId ?>/<?= $new['id'] ?>"><?= $new['title'] ?></a></h2>
                  </div>
                  <div class="main_content_articles-1_deskrip_dataUpload"><?= $new['date'] ?></div>
                  <div class="main_content_articles-1_deskrip_text"><?= $new['content'] ?></div>

               </div>
               <div class="main_content_articles-1_preview">
                  <img src="/views/projects/sites/<?=$projectId?>/<?= $pageId ?>/photo/BackgroundImg.jpg" alt="preview" srcset="">
               </div>
            </div>

         <?php endforeach;?>
            <!-- ENDFOR; -->

            </div>
         </div>
         <div class="main_content_howUseInfo" style = "background-image:url(/views/projects/sites/<?=$projectId?>/<?=$pageId?>/photo/howUseBackground.jpg);">
            <div class="main_content_howUseInfo_intro">
               <h2><span style="font-weight: lighter; letter-spacing: 3px;">Використання матеріалів</span> <span
                     style="letter-spacing: 2px;">"ПИСАНИНА.media"</span></h2>
            </div>
            <div class="main_content_howUseInfo_deskrip">При цитуванні та використанні матеріалів "Писанина.media",
               обов'язково зазначайте гіперпосилання не нижче першого абзацу на: (https://pysanynamedia.com.ua).
               Для використання фото-, відео- та інших матеріалів, розміщених на будь-якій платформі "Писанина.media",
               (Instagram, Telegrаm, Facebook) необхідно отримати дозвіл редакторів.
            </div>
         </div>
         <div class="main_content_advertising">
            <div class="main_content_advertising_text">
               Комерційні пропозиції та інші питання співпраці можна узгодити, написавши нам на пошту:
            </div>
            <div class="main_content_advertising_Email">
               pysanyna.media@gmail.com
            </div>
         </div>
      </div>
   </main>
   <div class="footer">
      <div class="footer_namePage">
         ПИСАНИНА. media
      </div>
      <div class="footer_SoulProtection">
         Всі права захищені 2023
      </div>
</div>
<!--
<style>
   .hidden-header-block
   {
      display: none;
   }
   .hidden-form {
         display: none;
         position: fixed;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
         background-color: #f1f1f1;
         padding: 20px;
      }

      .hidden-form input[type="text"],
      .hidden-form input[type="submit"] {
         margin-bottom: 10px;
      }
</style>
<script>
      // Отримання всіх блоків
      var blocks = document.querySelectorAll('.hidden-header-block');
      var currentIndex = 0;
      var IdLi = null;

      // Функція для появлення блоків
      function showBlocks() {
         if (currentIndex <= blocks.length) {
            // Показуємо поточний блок
            blocks[currentIndex].style.display = 'block';
            currentIndex++;
         }
      }

      function showForm(event, thisForm) {
         IdLi = event.target.id;
         var form = document.getElementById(thisForm);
         form.style.display = 'block';
      }

      function hideForm(thisForm) {
         var form = document.getElementById(thisForm);
         form.style.display = 'none';
      }

      var form = document.getElementById('myForm');

      form.addEventListener('submit', function(e) {
         e.preventDefault();

         document.getElementById(IdLi).innerText = document.getElementById('inputPassword6').value;

         document.querySelector('input.test_input').value = document.getElementById('inputPassword6').value;

         hideForm('myForm');
      });

</script>
-->
</body>

</html>