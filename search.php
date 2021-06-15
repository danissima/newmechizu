<?php
session_start();
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
  <script src="js/jquery.js" defer></script>
  <script src="js/words-modal.js" defer></script>
  <script src="js/radicals-modal.js" defer></script>
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
				<div class="section__tools">
					<?include('includes/search-block.php')?>
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
                $wordKanji = $word[1];
                $kana = $word['kana'];
                $translation = $word['translation']; ?>
                <div class="section__table-row">
                  <input type="hidden" value="<?=$id?>" class="word-id">
                  <input type="hidden" value="words" class="word-from">
                  <div class="section__table-item section__table-item_kanji"><?=$wordKanji?></div>
                  <div class="section__table-item section__table-item_kanji"><?=$kana?></div>
                  <div class="section__table-item"><?=$translation?></div>
									<?php if($_SESSION['admin']) {?>
                  	<span class="section__table-row-icon section__table-row-change word-change">&#9999;</span>
									<?php }?>
                </div>
              <?php } ?>
              <?php foreach($searchedCombs as &$item) {
                $id = $item['ID'];
								$combination = $item['combination'];
								$kana = $item['kana'];
								$translation = $item['translation'];
							?>
							<div class="section__table-row">
                <input type="hidden" value="<?=$id?>" class="word-id">
								<input type="hidden" value="combs" class="word-from">
								<div class="section__table-item section__table-item_kanji"><?=$combination?></div>
								<div class="section__table-item section__table-item_kanji"><?=$kana?></div>
								<div class="section__table-item"><?=$translation?></div>
								<?php if($_SESSION['admin']) {?>
                	<span class="section__table-row-icon section__table-row-change word-change">&#9999;</span>
									<?php }?>
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
                  <input type="hidden" value="<?=$radicalID?>">
                  <div class="section__table-item section__table-item_kanji"><?=$radicalView?></div>
                  <div class="section__table-item"><?=$radicalNumber?></div>
                  <div class="section__table-item"><?=$radicalName?></div>
									<?php if($_SESSION['admin']) {?>
                  	<span class="section__table-row-icon section__table-row-change radical-change">&#9999;</span>
										<?php }?>
                </div>
              <?php } ?>
            </div>
          </div>
        <?php } ?>
			</div>
		</div>
	</section>
	<?include('includes/footer.php')?>
  <div class="modal words__modal">
		<div class="modal__overlay"></div>
		<div class="modal__content">
			<form method="GET" action="controller/words.php">
				<input type="hidden" value="change" name="action">
				<input type="hidden" value="" name="changing" class="wordId">
				<input type="hidden" value="" name="from" class="from">
				<div class="words__table section__table section__table_small">
					<div class="section__table-row-head section__table-row">
						<span class="section__table-row-icon modal__close">&times;</span>
						<div class="section__table-title-wp section__table-title-wp_left section__table-title-wp_small"><h3 class="section__table-title">Изменение слова</h3></div>
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
						<input name="wordKanji" type="text" class="section__table-item section__table-item_kanji wordKanji" placeholder="漢字">
						<input required name="wordKana" type="text" class="section__table-item section__table-item_kanji wordKana" placeholder="かな">
						<input required name="wordTranslation" type="text" class="section__table-item wordTranslate" placeholder="Перевод">
					</div>
				</div>
				<button class="button">Изменить</button>
			</form>
			<form method="GET" action="controller/words.php">
					<button class="button button__delete">Удалить</button>
					<input type="hidden" value="delete" name="action">
					<input type="hidden" value="" name="deleting" class="wordId">
					<input type="hidden" value="" name="from" class="from">
			</form>
		</div>
	</div>
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
						<input required name="radicalNumber" type="number" class="section__table-item radicalNum" placeholder="Номер">
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