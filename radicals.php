<?php
session_start();
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
	<script src="js/jquery.js" defer></script>
	<script src="js/section-table.js" defer></script>
	<script src="js/radicals-modal.js" defer></script>
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
				<?php if($_SESSION['admin']) {?>
					<form method="GET" action="controller/radicals.php">
						<input type="hidden" name="action" value="add">
						<div class="words__table section__table js-table section__table_small">
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
							<div class="section__table-row js-row">
								<input required name="radicalView[]" type="text" class="section__table-item section__table-item_kanji" placeholder="Ключ">
								<input required name="radicalNumber[]" type="number" class="section__table-item" placeholder="Номер">
								<input required name="radicalName[]" type="text" class="section__table-item" placeholder="Название">
								<span class="section__table-row-icon section__table-row-delete">&times;</span>
							</div>
						</div>
						<button class="button button_centered">Добавить ключи</button>
					</form>
				<?php } ?>
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
								<input type="hidden" value="<?=$radicalID?>">
								<div class="section__table-item section__table-item_kanji"><?=$radicalView?></div>
								<div class="section__table-item"><?=$radicalNumber?></div>
								<div class="section__table-item"><?=$radicalName?></div>
								<?php if($_SESSION['admin']) {?>
									<span class="section__table-row-icon section__table-row-change radical-change">&#9999;</span>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?include('includes/footer.php')?>
	<div class="modal radicals__modal">
		<div class="modal__overlay"></div>
		<div class="modal__content">
			<form method="GET" action="controller/radicals.php">
				<input type="hidden" value="change" name="action">
				<input type="hidden" value="" name="changing" class="radicalId">
				<div class="words__table section__table section__table_small">
					<div class="section__table-row-head section__table-row">
						<span class="section__table-row-icon modal__close">&times;</span>
						<div class="section__table-title-wp section__table-title-wp_left section__table-title-wp_small"><h3 class="section__table-title">Изменение ключа</h3></div>
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
					<div class="section__table-row">
						<input name="radicalView" type="text" class="section__table-item section__table-item_kanji radicalView" placeholder="Ключ">
						<input required name="radicalNumber" type="number" class="section__table-item section__table-item_kanji radicalNum" placeholder="Номер">
						<input required name="radicalName" type="text" class="section__table-item radicalName" placeholder="Название">
					</div>
				</div>
				<button class="button">Изменить</button>
			</form>
			<form method="GET" action="controller/radicals.php">
					<button class="button button__delete">Удалить</button>
					<input type="hidden" value="delete" name="action">
					<input type="hidden" value="" name="deleting" class="radicalId">
			</form>
		</div>
	</div>
</body>
</html>