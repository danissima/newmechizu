<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="images/logo/logo2.png">
	<title>Новый иероглиф</title>
</head>
<body>
	<?include("includes/header.php")?>
	<section class="section">
		<div class="container">
			<div class="section__wp single-kanji__section-wp">
				<div class="section__top">
					<div class="section__title-wp">
						<h2 class="section__title">Новый иероглиф</h2>
					</div>
				</div>
				<div class="single-kanji__content">
					<div class="add-kanji__kanji">
						<h3 class="add-kanji__kanji-title">Иероглиф</h3>
						<input type="text" class="add-kanji__kanji-input">
						<span class="add-kanji__kanji-sep">ff</span>
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