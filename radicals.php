<?php
include 'config.php';
$selectRadicals = $mysqli->query("SELECT * FROM kanji_keys ORDER BY key_number");
	$radicals = [];
	while($item = $selectRadicals->fetch_array()) {
		array_push($radicals, $item);
	}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="images/logo/logo2.png">
	<title>Ключи</title>
</head>
<body>
	<?include("includes/header.php")?>
	<section class="section">
		<div class="container">
			<div class="section__wp single-kanji__section-wp">
				<div class="section__top">
					<div class="section__title-wp">
						<h2 class="section__title">Ключи</h2>
					</div>
				</div>
				<div class="section__tools">
					<?include('includes/search-block.php')?>
				</div>
				<div class="words__content">
					<form method="POST" action="">
						<div class="words__table section__table section__table_small">
							<div class="section__table-row-head section__table-row">
								<div class="section__table-title-wp section__table-title-wp_left section__table-title-wp_small"><h3 class="section__table-title">Новые ключи</h3></div>
								<div class="section__table-item section__table-item-head">
									<h4>Ключ</h4>
									<div class="section__sep section__sep_white">&#9670;</div>
								</div>
								<div class="section__table-item section__table-item-head">
									<h4>Номер</h4>
									<div class="section__sep section__sep_white">&#9670;</div>
								</div>
								<div class="section__table-item section__table-item-head">
									<h4>Название</h4>
									<div class="section__sep section__sep_white">&#9670;</div>
								</div>
								<span class="section__table-row-icon section__table-row-add">&plus;</span>
							</div>
							<div class="section__table-row">
								<input type="text" class="section__table-item section__table-item_kanji" placeholder="Ключ">
								<input type="text" class="section__table-item" placeholder="Номер">
								<input type="text" class="section__table-item" placeholder="Название">
								<span class="section__table-row-icon section__table-row-delete">&times;</span>
							</div>
						</div>
						<a class="button button_centered" href="#">Добавить ключи</a>
					</form>
					<div class="words__table words-letter__table section__table section__table_small">
						<div class="section__table-row-head section__table-row-head_sticky section__table-row">
							<div class="section__table-item section__table-item-head">
								<h4>Ключ</h4>
								<div class="section__sep section__sep_white">&#9670;</div>
							</div>
							<div class="section__table-item section__table-item-head">
								<h4>Номер</h4>
								<div class="section__sep section__sep_white">&#9670;</div>
							</div>
							<div class="section__table-item section__table-item-head">
								<h4>Название</h4>
								<div class="section__sep section__sep_white">&#9670;</div>
							</div>
						</div>
						<?php 
							foreach ($radicals as $item) {
								$radicalID = $item['ID'];
								$radicalView = $item['key_view'];
								$radicalNumber = $item['key_number'];
								$radicalName = $item['key_name']; 
						?>
							<div class="section__table-row">
								<div class="section__table-item section__table-item_kanji"><?=$radicalView?></div>
								<div class="section__table-item"><?=$radicalNumber?></div>
								<div class="section__table-item"><?=$radicalName?></div>
								<span class="section__table-row-icon section__table-row-change">&#9999;</span>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?include('includes/footer.php')?>
</body>
</html>