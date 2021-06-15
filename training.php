<?php
include 'config.php';

$kanjiSelect = $mysqli->query("SELECT kanji_view FROM kanji");
$kanjiAmount = $kanjiSelect->{'num_rows'};
$kanjiArr = [];
while ($kanjiItem = $kanjiSelect->fetch_array()) {
  array_push($kanjiArr, $kanjiItem[0]);
}
$taskKanji = $kanjiArr[rand(0, $kanjiAmount - 1)];
$quizResults = $mysqli->query("SELECT kanji_search FROM kanji WHERE kanji_view = '$taskKanji'")->fetch_array()[0];

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="images/logo/logo2.png">
	<script src="js/jquery.js" defer></script>
  <script src="js/training.js" defer></script>
	<title>Слова</title>
</head>
<body>
	<?include("includes/header.php")?>
	<section class="section train__section">
		<div class="container">
			<div class="section__wp single-kanji__section-wp">
				<div class="section__top">
					<div class="section__title-wp">
						<h2 class="section__title">Проверка знаний</h2>
					</div>
				</div>
        <p class="section__subtitle">Назови чтения и значения данного иероглифа</p>
				<div class="words__content">
          <div class="words__table words-letter__table section__table section__table_small">
            <div class="section__table-row-head section__table-row">
              <div class="section__table-title-wp section__table-title-wp_left section__table-title-wp_small">
                <h3 class="section__table-title"><?=$taskKanji?></h3>
              </div>
              <div class="section__table-item section__table-item-head">
                <h4>Оны</h4>
                <div class="section__sep section__sep_white">&#9670;</div>
              </div>
              <div class="section__table-item section__table-item-head">
                <h4>Куны</h4>
                <div class="section__sep section__sep_white">&#9670;</div>
              </div>
              <div class="section__table-item section__table-item-head">
                <h4>Значения</h4>
                <div class="section__sep section__sep_white">&#9670;</div>
              </div>
              <span class="section__table-row-icon buttons__show-results">?</span>
            </div>
            <div class="section__table-row">
              <textarea class="section__table-item section__table-item_kanji answer-field__item-ons" placeholder="Онные чтения"></textarea>
              <textarea class="section__table-item section__table-item_kanji answer-field__item-kuns" placeholder="Кунные чтения"></textarea>
              <textarea class="section__table-item answer-field__item-meanings" placeholder="Значения"></textarea>
            </div>
          </div>
          <button class="button button_centered buttons__check-answers">Проверить</button>
				</div>
        <div class="quiz__results quiz__item">
          <div class="result__item-block results__title-block">
            <h2 class="results__title">Ответ:</h2>
          </div>
          <div class="results__item-block">
            <p class="results__item results__ons"></p>
          </div>
          <div class="results__item-block">
            <p class="results__item results__kuns"></p>
          </div>
          <div class="results__item-block">
            <p class="results__item results__meanings"></p>
          </div>
        </div>
			</div>
		</div>
	</section>
  <script>
    let quizResults = '<?=$quizResults?>';
  </script>
</body>
</html>