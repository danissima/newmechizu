<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="images/logo/logo2.png">
	<title>Иероглифы</title>
</head>
<body>
	<?include("includes/header.php")?>
	<section class="section">
		<div class="container">
			<div class="section__wp">
				<div class="section__top">
					<div class="section__title-wp">
						<h2 class="section__title">Изученные иероглифы</h2>
					</div>
				</div>
				<div class="section__tools">
					<div class="button-wp"><a class="button" href="#">Добавить иероглиф</a></div>
					<div class="button-wp"><a class="button" href="#">Ключи</a></div>
					<?include('includes/search-block.php')?>
				</div>
				<div class="kanji__content">
					<div class="kanji__col">
						<div class="kanji__col-item">
							<div class="kanji__col-radical-wp">
								<h3 class="kanji__col-radical">Ключ 1: 一 (один)</h3>
							</div>
							<div class="section__sep">&#9670;</div>
							<div class="kanji__col-items">
								<div class="kanji__item-wp"><a href="/kanji-item.php" class="kanji__item">一</a></div>
								<div class="kanji__item-wp"><a href="#" class="kanji__item">三</a></div>
								<div class="kanji__item-wp"><a href="#" class="kanji__item">七</a></div>
							</div>
						</div>
					</div>
					<div class="kanji__col">
						<div class="kanji__col-item">
							<div class="kanji__col-radical-wp">
								<h3 class="kanji__col-radical">Ключ 1: 一 (один)</h3>
							</div>
							<div class="section__sep">&#9670;</div>
							<div class="kanji__col-items">
								<div class="kanji__item-wp"><a href="#" class="kanji__item">一</a></div>
								<div class="kanji__item-wp"><a href="#" class="kanji__item">三</a></div>
								<div class="kanji__item-wp"><a href="#" class="kanji__item">七</a></div>
							</div>
						</div>
					</div>
					<div class="kanji__col">
						<div class="kanji__col-item">
							<div class="kanji__col-radical-wp">
								<h3 class="kanji__col-radical">Ключ 1: 一 (один)</h3>
							</div>
							<div class="section__sep">&#9670;</div>
							<div class="kanji__col-items">
								<div class="kanji__item-wp"><a href="#" class="kanji__item">一</a></div>
								<div class="kanji__item-wp"><a href="#" class="kanji__item">三</a></div>
								<div class="kanji__item-wp"><a href="#" class="kanji__item">七</a></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?include('includes/footer.php')?>
</body>
</html>