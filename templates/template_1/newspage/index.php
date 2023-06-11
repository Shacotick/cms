<head>
   <link rel = "stylesheet" href = "/views/projects/sites/<?=$projectId?>/<?=$pageId?>/style.css">
   <title>ПИСАНИНА.media</title>
</head>
<body>
   <div class="header mb-5">
      <div class="header_content">
         <div class="header_content_logo">
            <div class="header_content_logo_hello">
               <span style="font-size: 24px; letter-spacing: 4px; font-weight: lighter;">ПИСАНИНА.</span>
               <span style="font-size: 24px; letter-spacing: 3px; font-weight: bold;">media</span>
            </div>
            <div class="header_content_logo_description"><span style="font-style: italic;">Далі - більше!</span></div>
         </div>
      </div>
   </div>

   <main class="main">
      <div class="main_news">
         <div class="main_news_intro">
            <div class="main_news_intro-text">
               <h1><?= $news['title'] ?></h1>
            </div>
            <div class="main_news_intro-time mb-3"><?= $news['date'] ?></div>
         </div>
         <div class="main_news_text">
            <p><?= $news['content'] ?></p>
         </div>
         <div class="main_news_border"></div>
         <div class="main_news_author mt-4"><b>Автор: <?= $user['lastname'] ?> <?= $user['firstname'] ?></b></div>
      </div>
   </main>

   
</body>