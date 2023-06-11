<?php
  use models\User;
?>

<h1>ЛАСКАВО ПРОСИМО!</h1>
<?php if(!User::isUserAunthenticated()): ?>
<p>Для того щоб користуватись нашою системою, будь ласка авторизуйтесь.</p>
<?php else: ?>
<p>Дякую, що користуєтесь нашою веб-платформою з розповсюдження новин.</p>
<?php endif; ?>

<img src="/themes/light/image1.png" alt="Лого" height="350">