<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="images/logo/logo2.png">
	<title>Слова</title>
</head>
<body>
	<?include("includes/header.php")?>
	<section class="section">
		<div class="container">
			<div class="section__wp single-kanji__section-wp">
				<div class="section__top">
					<div class="section__title-wp">
						<h2 class="section__title">Изученные слова</h2>
					</div>
				</div>
				<div class="section__tools">
					<?include('includes/search-block.php')?>
				</div>
				<div class="words__content">
					<div class="words__table section__table section__table_small">
						<div class="section__table-row-head section__table-row">
							<div class="section__table-title-wp section__table-title-wp_left section__table-title-wp_small"><h3 class="section__table-title">Новые слова</h3></div>
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
							<span class="section__table-row-icon section__table-row-add">&plus;</span>
						</div>
						<div class="section__table-row">
							<input type="text" class="section__table-item section__table-item_kanji" placeholder="漢字">
							<input type="text" class="section__table-item section__table-item_kanji" placeholder="かな">
							<input type="text" class="section__table-item" placeholder="Перевод">
							<span class="section__table-row-icon section__table-row-delete">&times;</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?include('includes/footer.php')?>
</body>
</html>