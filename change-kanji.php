<?php
include 'config.php';

$changingKanji = htmlspecialchars($_GET['changingKanji']);
$selectInfo = $mysqli->query("SELECT * FROM kanji WHERE kanji_view = '$changingKanji'")->fetch_array();
$kanjiRadical = $selectInfo['key_num'];
$kanjiOns = explode('; ', $selectInfo['kanji_ons_kana']);
$kanjiKuns = explode('; ', $selectInfo['kanji_kuns_kana']);

$kanjiCombinations = [];
$kanjiID = $mysqli->query("SELECT ID FROM kanji WHERE kanji_view = '$changingKanji'")->fetch_array()['ID'];
$kanjiCombsSelect = $mysqli->query("SELECT `combinations`.* FROM `kanji_combinations` LEFT JOIN `combinations` ON `kanji_combinations`.`combination` = `combinations`.`ID` WHERE (`kanji_combinations`.`kanji` = '$kanjiID')");
while($item = $kanjiCombsSelect->fetch_array()) {
  array_push($kanjiCombinations, $item);
}

$selectRadicals = $mysqli->query("SELECT * FROM kanji_keys");
$arrRadicals = [];

while($item = $selectRadicals->fetch_array()) {
  array_push($arrRadicals, $item);
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
	<script src="js/readings-table.js" defer></script>
	<title>Изменение иероглифа <?=$changingKanji?></title>
</head>
<body>
	<?include("includes/header.php")?>
	<section class="add-kanji__section section">
		<div class="container">
			<div class="section__wp add-kanji__section single-kanji__section-wp">
				<div class="section__top">
					<div class="section__title-wp">
						<h2 class="section__title">Изменение иероглифа <?=$changingKanji?></h2>
					</div>
				</div>
				<div class="single-kanji__content">
					<form method="GET" action="controller/manipulate.php">
            <input type="hidden" value="change" name="manipulate">
						<div class="add-kanji__kanji">
							<h3 class="add-kanji__subtitle">Иероглиф</h3>
							<input required type="text" name="newKanjiView" class="add-kanji__kanji-input" value="<?=$changingKanji?>" placeholder="漢字">
              <input type="hidden" name="prevKanji" value="<?=$changingKanji?>">
							<div class="section__sep section__sep_big">&#9670;</div>
						</div>
						<div class="add-kanji__readings">
							<div class="add-kanji__reading">
								<div class="add-kanji__reading-title">
									<h3 class="add-kanji__subtitle">Онные чтения</h3>
									<div class="section__sep">&#9670;</div>
									<span class="add-kanji__reading-add">&plus;</span>
								</div>
								<div class="add-kanji__reading-content">
									<div class="add-kanji__reading-row add-kanji__reading-headrow">
										<div class="add-kanji__reading-cell">Чтение</div>
										<div class="add-kanji__reading-cell">Значение</div>
									</div>
                  <?php
									foreach($kanjiOns as &$item) {
										$item = explode(' - ', $item);
                  ?>
                    <div class="add-kanji__reading-row">
                      <textarea name="newKanjiOnsReading[]" class="add-kanji__reading-cell add-kanji__reading-cell_kanji" placeholder="Чтение"><?=$item[0]?></textarea>
                      <textarea name="newKanjiOnsMeaning[]" class="add-kanji__reading-cell" placeholder="Значение"><?=$item[1]?></textarea>
                      <span class="add-kanji__reading-delete">&times;</span>
                    </div>
									<?php } ?>
								</div>
							</div>
							<div class="add-kanji__reading">
								<div class="add-kanji__reading-title">
									<h3 class="add-kanji__subtitle">Кунные чтения</h3>
									<div class="section__sep">&#9670;</div>
									<span class="add-kanji__reading-add">&plus;</span>
								</div>
								<div class="add-kanji__reading-content">
									<div class="add-kanji__reading-row add-kanji__reading-headrow">
										<div class="add-kanji__reading-cell">Чтение</div>
										<div class="add-kanji__reading-cell">Значение</div>
									</div>
									<?php
									foreach($kanjiKuns as &$item) {
										$item = explode(' - ', $item);
                  ?>
                    <div class="add-kanji__reading-row">
                      <textarea name="newKanjiKunsReading[]" class="add-kanji__reading-cell add-kanji__reading-cell_kanji" placeholder="Чтение"><?=$item[0]?></textarea>
                      <textarea name="newKanjiKunsMeaning[]" class="add-kanji__reading-cell" placeholder="Значение"><?=$item[1]?></textarea>
                      <span class="add-kanji__reading-delete">&times;</span>
                    </div>
									<?php } ?>
								</div>
							</div>
						</div>
						<div class="add-kanji__radical">
							<h3 class="add-kanji__subtitle">Ключ</h3>
							<select class="add-kanji__radical-select" name="newKanjiRadical">
                <?php for($i = 0; $i < count($arrRadicals); $i++) {
                  $radicalId = $arrRadicals[$i]['ID'];
									$radicalNum = $arrRadicals[$i]['key_number'];
									$radicalView = $arrRadicals[$i]['key_view'];
									$radicalName = $arrRadicals[$i]['key_name'];
									if ($radicalNum == $kanjiRadical) { ?>
										<option value="<?=$radicalId?>" selected><?=$radicalName?> <?=$radicalNum?> - <?=$radicalView?></option>
									<?php } else { ?>
										<option value="<?=$radicalId?>"><?=$radicalName?> <?=$radicalNum?> - <?=$radicalView?></option>
                  <?php } } ?>
							</select>
						</div>
						<div class="single-kanji__table js-table section__table">
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
								<span class="section__table-row-icon section__table-row-add">&plus;</span>
							</div>
              <?php
									if ($kanjiCombinations[0]) {
										foreach($kanjiCombinations as &$item) {
											$combination = $item['combination'];
											$kana = $item['kana'];
											$translation = $item['translation']; ?>
											<div class="section__table-row js-row">
                        <input name="combinationsKanji[]" type="text" value="<?=$combination?>" class="section__table-item section__table-item_kanji" placeholder="漢字">
                        <input type="hidden" name="prevComb[]" value="<?=$combination?>">
                        <input name="combinationsKana[]" type="text" value="<?=$kana?>" class="section__table-item section__table-item_kanji" placeholder="かな">
                        <input name="combinationsTranslation[]" type="text" value="<?=$translation?>" class="section__table-item" placeholder="Перевод">
                        <span class="section__table-row-icon section__table-row-delete">&times;</span>
                      </div>
									<?php }
									} else { ?>
                    <div class="section__table-row js-row">
                      <input name="combinationsKanji[]" type="text" class="section__table-item section__table-item_kanji" placeholder="漢字">
                      <input name="combinationsKana[]" type="text" class="section__table-item section__table-item_kanji" placeholder="かな">
                      <input name="combinationsTranslation[]" type="text" class="section__table-item" placeholder="Перевод">
                      <span class="section__table-row-icon section__table-row-delete">&times;</span>
                    </div>
								<?php	} ?>
						</div>
            <button class="button button_centered">Изменить иероглиф</button>
					</form>
				</div>
			</div>
		</div>
	</section>
	<?include('includes/footer.php')?>
</body>
</html>