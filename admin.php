<?php
session_start();
if ($_SESSION['admin']) {
  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $extra = '';
  header("Location: http://$host$uri/$extra");
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="images/logo/logo2.png">
	<title>Администратор</title>
</head>
<body>
	<?include("includes/header.php")?>
  <div class="admin__section section">
    <div class="container">
      <div class="admin__content">
        <div class="section__top">
					<div class="section__title-wp">
						<h2 class="section__title">Авторизуйтесь</h2>
					</div>
				</div>
        <form method="POST" action="auth.php">
          <input type="hidden" name="action" value="add">
          <div class="words__table section__table js-table section__table_small">
            <div class="section__table-row-head section__table-row">
              <div class="section__table-item section__table-item-head">
                <h4>Логин</h4>
                <div class="section__sep section__sep_white">&#9670;</div>
              </div>
              <div class="section__table-item section__table-item-head">
                <h4>Пароль</h4>
                <div class="section__sep section__sep_white">&#9670;</div>
              </div>
            </div>
            <div class="section__table-row js-row">
              <input required name="adminLogin" type="text" class="section__table-item" placeholder="Логин">
              <input required name="adminPassword" type="password" class="section__table-item" placeholder="Пароль">
            </div>
          </div>
          <button class="button button_centered">Войти</button>
        </form>
      </div>
    </div>
  </div>
  <?include("includes/footer.php")?>
</body>
</html>