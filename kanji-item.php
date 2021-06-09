<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="images/logo/logo2.png">
	<title>Карточка иероглифа 一</title>
</head>
<body>
	<?include("includes/header.php")?>
	<section class="section">
		<div class="container">
			<div class="section__wp single-kanji__section-wp">
				<div class="section__top">
					<div class="button-wp"><a href="#" class="button">Изменить</a></div>
					<div class="section__title-wp">
						<h2 class="section__title">Карточка иероглифа</h2>
					</div>
					<div class="button-wp"><a href="#" class="button">Удалить</a></div>
				</div>
				<div class="single-kanji__content">
					<div class="single-kanji__main-info">
						<div class="single-kanji__readings">
							<div class="single-kanji__readings-title-wp">
								<h3 class="single-kanji__readings-title">Онные чтения</h3>
							</div>
							<div class="section__sep">&#9670;</div>
							<div class="single-kanji__readings-list-wp">
								<ul class="single-kanji__readings-list">
									<li class="single-kanji__readings-item">イチ, イツ</li>
								</ul>
							</div>
						</div>
						<div class="single-kanji__preview-wp">
							<div class="single-kanji__preview">一</div>
							<div class="section__sep section__speaker">&#128265;</div>
							<div class="single-kanji__radical">Ключ 1 (один)<br><span>一</span></div>
						</div>
						<div class="single-kanji__readings">
							<div class="single-kanji__readings-title-wp">
								<h3 class="single-kanji__readings-title">Кунные чтения</h3>
							</div>
							<div class="section__sep">&#9670;</div>
							<div class="single-kanji__readings-list-wp">
								<ul class="single-kanji__readings-list">
									<li class="single-kanji__readings-item">ひとつ - <span>один</span></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="single-kanji__stroke-order">
						<div class="single-kanji__stroke-order-title-wp">
							<h3 class="single-kanji__stroke-order-title">Порядок черт</h3>
						</div>
						<div class="single-kanji__stroke-order-image-wp">
							<img src="images/stroke-order.png" alt="stroke order" class="single-kanji__stroke-order-image">
						</div>
					</div>
					<div class="single-kanji__table section__table">
						<div class="section__table-row-head section__table-row section__combs-table-row-head">
							<div class="section__table-title-wp"><h3 class="section__table-title">Сочетания</h3></div>
							<div class="section__table-item section__table-item-head">
								<h4>Иероглифы</h4>
								<div class="section__sep section__sep_white">&#9670;</div>
							</div>
							<div class="section__table-item section__table-item-head">
								<h4>Азбука</h4>
								<div class="section__sep section__sep_white">&#9670;</div>
							</div>
							<div class="section__table-item section__table-item-head">
								<h4>Перевод</h4>
								<div class="section__sep section__sep_white">&#9670;</div>
							</div>
						</div>
						<div class="section__table-row">
							<div class="section__table-item section__table-item_kanji">一年生</div>
							<div class="section__table-item section__table-item_kanji">いちねんせい</div>
							<div class="section__table-item">Первогодка</div>
						</div>
						<div class="section__table-row">
							<div class="section__table-item section__table-item_kanji">一日</div>
							<div class="section__table-item section__table-item_kanji">ついたち</div>
							<div class="section__table-item">Первый день месяца</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?include('includes/footer.php')?>
</body>
</html>