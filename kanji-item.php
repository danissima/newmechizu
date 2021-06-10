<?php
include 'config.php';
	$kanjiView = htmlspecialchars($_GET['kanji']);
	
	$selectRadical = $mysqli->query("SELECT kanji_keys.* FROM kanji_keys LEFT JOIN kanji ON kanji.key_num = kanji_keys.key_number WHERE kanji.kanji_view = '$kanjiView'")->fetch_array();
	
	$radicalNumber = $selectRadical['key_number'];
	$radicalView = $selectRadical['key_view'];
	$radicalName = $selectRadical['key_name'];
	
	$selectKanjiItem = $mysqli->query("SELECT * FROM kanji WHERE kanji_view = '$kanjiView'")->fetch_array();
	
	$kanjiOns = preg_split("/;\s/", $selectKanjiItem['kanji_ons_kana']);
	$kanjiKuns = preg_split("/;\s/", $selectKanjiItem['kanji_kuns_kana']);

	$kanjiID = $mysqli->query("SELECT ID FROM kanji WHERE kanji_view = '$kanjiView'")->fetch_array()['ID'];
	$kanjiCombsSelect = $mysqli->query("SELECT `combinations`.* FROM `kanji_combinations` LEFT JOIN `combinations` ON `kanji_combinations`.`combination` = `combinations`.`ID` WHERE (`kanji_combinations`.`kanji` ='$kanjiID')");
	$kanjiCombinations = [];
	while($item = $kanjiCombsSelect->fetch_array()) {
		array_push($kanjiCombinations, $item);
	}



?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="images/logo/logo2.png">
	<title>Карточка иероглифа <?=$kanjiView?></title>
</head>
<body>
	<?include("includes/header.php")?>
	<section class="section">
		<div class="container">
			<div class="section__wp single-kanji__section-wp">
				<div class="section__top">
					<a href="/change-kanji.php?changingKanji=<?=$kanjiView?>" class="button">Изменить</a>
					<div class="section__title-wp">
						<h2 class="section__title">Карточка иероглифа</h2>
					</div>
					<a href="#" class="button">Удалить</a>
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
									<?php 
										if ($kanjiOns[0]) {
											for($i = 0; $i < count($kanjiOns); $i++) { ?>
													<li class="single-kanji__readings-item"><?=explode(' - ', $kanjiOns[$i])[0]?><span><?php if (explode(' - ', $kanjiOns[$i])[1]) echo ' - ' . explode(' - ', $kanjiOns[$i])[1] ?></span></li>
									<?php	}	}	?>
								</ul>
							</div>
						</div>
						<div class="single-kanji__preview-wp">
							<div class="single-kanji__preview"><?=$kanjiView?></div>
							<div class="section__sep section__speaker">&#128265;</div>
							<div class="single-kanji__radical">Ключ <?=$radicalNumber?> (<?=$radicalName?>)<br><span><?=$radicalView?></span></div>
						</div>
						<div class="single-kanji__readings">
							<div class="single-kanji__readings-title-wp">
								<h3 class="single-kanji__readings-title">Кунные чтения</h3>
							</div>
							<div class="section__sep">&#9670;</div>
							<div class="single-kanji__readings-list-wp">
								<ul class="single-kanji__readings-list">
									<?php 
										if ($kanjiKuns[0]) {
											for($i = 0; $i < count($kanjiKuns); $i++) { ?>
												<li class="single-kanji__readings-item"><?=explode(' - ', $kanjiKuns[$i])[0]?><span><?php if (explode(' - ', $kanjiKuns[$i])[1]) echo ' - ' . explode(' - ', $kanjiKuns[$i])[1] ?></span></li>
										<?php	} } ?>
								</ul>
							</div>
						</div>
					</div>
					<?php 
					if (!$kanjiCombinations[0]) {
						print("no");
					} else {	
					?>
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
						<?php }
							foreach($kanjiCombinations as &$item) {
								$combination = $item['combination'];
								$kana = $item['kana'];
								$translation = $item['translation'];
							?>
							<div class="section__table-row">
								<div class="section__table-item section__table-item_kanji"><?=$combination?></div>
								<div class="section__table-item section__table-item_kanji"><?=$kana?></div>
								<div class="section__table-item"><?=$translation?></div>
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