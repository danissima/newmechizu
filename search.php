<?php
include 'config.php';

$find = $_GET['search'];
$selectSearchedKanji = $mysqli->query("SELECT * FROM kanji WHERE kanji_search LIKE '%$find%'");
$selectKanjiIfRadical = $mysqli->query("SELECT `kanji`.* FROM `kanji_keys` LEFT JOIN `kanji` ON `kanji`.`key_num` = `kanji_keys`.`key_number` WHERE (`kanji_keys`.`key_view` = '$find' OR `kanji_keys`.`key_number` = '$find' OR `kanji_keys`.`key_name` = '$find')");
$selectSearchedRadicals = $mysqli->query("SELECT * FROM kanji_keys WHERE key_view LIKE '%$find%' OR key_number LIKE '%$find%' OR key_name LIKE '%$find%'");
$selectSearchedWords = $mysqli->query("SELECT * FROM words WHERE word_kanji LIKE '%$find%' OR kana LIKE '%$find%' OR translation LIKE '%$find%'");
$selectSearchedCombs = $mysqli->query("SELECT * FROM combinations WHERE combination LIKE '%$find%' OR kana LIKE '%$find%' OR translation LIKE '%$find%'");

$searchedKanji = queryResultToArr($selectSearchedKanji);
$searchedKanjiIfRadical = queryResultToArr($selectKanjiIfRadical);
if ($searchedKanjiIfRadical) {
	$searchedKanji = $searchedKanjiIfRadical;
}
$searchedRadicals = queryResultToArr($selectSearchedRadicals); 
$searchedWords = queryResultToArr($selectSearchedWords);
$searchedCombs = queryResultToArr($selectSearchedCombs);


function queryResultToArr($queryResult) {
	$result = [];
	while ($item = $queryResult->fetch_array()) {
		array_push($result, $item);
	}
	return $result;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="images/logo/logo2.png">
	<title>Результаты поиска</title>
</head>
<body>
	<?include("includes/header.php")?>
	<section class="section search">
		<div class="container">
			<div class="section__wp single-kanji__section-wp">
				<div class="section__top">
					<div class="section__title-wp">
						<h2 class="section__title">Результаты поиска</h2>
					</div>
				</div>
        <?php
        if ($searchedKanji) { ?>
          <div class="kanji__content">
            <div class="kanji__col">
              <div class="kanji__col-item">
                <div class="kanji__col-items">
                  <?php foreach ($searchedKanji as $item) {
                    $kanjiView = $item['kanji_view'];  
                  ?>
                    <div class="kanji__item-wp"><a href="/kanji-item.php?kanji=<?=$kanjiView?>" class="kanji__item"><?=$kanjiView?></a></div>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
        <?php
        if ($searchedWords || $searchedCombs) { ?>
          <div class="words__content">
            <div class="words__table words-letter__table section__table section__table_small">
              <div class="section__table-row-head section__table-row">
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
              <?php foreach($searchedWords as &$word) {
                $id = $word['ID'];
                $from = $word['from'];
                $wordKanji = $word[1];
                $kana = $word['kana'];
                $translation = $word['translation']; ?>
                <div class="section__table-row">
                  <div class="section__table-item section__table-item_kanji"><?=$wordKanji?></div>
                  <div class="section__table-item section__table-item_kanji"><?=$kana?></div>
                  <div class="section__table-item"><?=$translation?></div>
                  <span class="section__table-row-icon section__table-row-change">&#9999;</span>
                </div>
              <?php } ?>
              <?php foreach($searchedCombs as &$item) {
								$combination = $item['combination'];
								$kana = $item['kana'];
								$translation = $item['translation'];
							?>
							<div class="section__table-row">
								<div class="section__table-item section__table-item_kanji"><?=$combination?></div>
								<div class="section__table-item section__table-item_kanji"><?=$kana?></div>
								<div class="section__table-item"><?=$translation?></div>
                <span class="section__table-row-icon section__table-row-change">&#9999;</span>
							</div>
						<?php } ?>
              </div>
          </div>
        <?php } ?>
        <?php if ($searchedRadicals) { ?>
          <div class="words__content">
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
                foreach ($searchedRadicals as $item) {
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
        <?php } ?>
			</div>
		</div>
	</section>
	<?include('includes/footer.php')?>
</body>
</html>