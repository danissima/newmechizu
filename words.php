<?php
include 'config.php';


if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}

$kol = 10;
$art = ($page * $kol) - $kol;

$total = $mysqli->query("SELECT * FROM words")->{'num_rows'} + $mysqli->query("SELECT * FROM combinations")->{'num_rows'};
$str_pag = ceil($total / $kol);


$selectWords = $mysqli->query("SELECT * FROM words ORDER BY kana");
$words = [];
while($item = $selectWords->fetch_array()) {
	$item['from'] = 'words';
	array_push($words, $item);
}
$selectCombs = $mysqli->query("SELECT * FROM combinations ORDER BY kana");
while($item = $selectCombs->fetch_array()) {
	$item['from'] = 'combs';
	array_push($words, $item);
}

$wordsKana=array_map(function($el) {
	return $el['kana'];
}, $words);
sort($wordsKana);

$result = [];
foreach ($wordsKana as $item) {
	foreach ($words as $word) {
		if ($item == $word['kana']) {
			array_push($result, $word);
		}
	}
}
$resultOnPage = array_slice($result, $art, $kol);

$sortedByKana = [];
$memory = null;
foreach($resultOnPage as &$word) {
	preg_match_all('/./u', $word['kana'], $letter);
	if ($letter[0][0] != $memory) {
		$memory = $letter[0][0];
		$sortedByKana[$memory] = array();
	}
	$sortedByKana[$memory][] = $word;
}
	


?>

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
				<div class="section__page-nav">
					<?php
						if ($page != 1) $pervpage = "<a class='pages__item pages__item_move' href=words.php?page=1><<</a>
						<a class='pages__item pages__item_move' href=words.php?page=". ($page - 1) ."><</a> ";
						if ($page != $str_pag) $nextpage = " <a class='pages__item pages__item_move' href=words.php?page=". ($page + 1) .">></a>
																			<a class='pages__item pages__item_move' href=words.php?page=" .$str_pag. ">>></a>";
						if($page - 2 > 0) $page2left = " <a class='pages__item pages__item_move' href=words.php?page=". ($page - 2) .'>'. ($page - 2) .'</a>';
						if($page - 1 > 0) $page1left = "<a class='pages__item pages__item_move' href=words.php?page=". ($page - 1) .'>'. ($page - 1) .'</a>';
						if($page + 2 <= $str_pag) $page2right = "<a class='pages__item pages__item_move' href=words.php?page=". ($page + 2) .'>'. ($page + 2) .'</a>';
						if($page + 1 <= $str_pag) $page1right = "<a class='pages__item pages__item_move' href=words.php?page=". ($page + 1) .'>'. ($page + 1) .'</a>';

						echo $pervpage.$page2left.$page1left."<b class='pages__selected pages__item'>".$page."</b>".$page1right.$page2right.$nextpage;
					
					?>
				</div>
				<div class="words__content">
					<form method="POST" action="">
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
						<a class="button button_centered" href="#">Добавить слова</a>
					</form>
					<?php
					foreach($sortedByKana as &$letter) {
						$current = key($sortedByKana); ?>
						<div class="words__table words-letter__table section__table section__table_small">
							<div class="section__table-row-head section__table-row">
								<div class="section__table-title-wp section__table-title-wp_left section__table-title-wp_small">
									<h3 class="section__table-title"><?=$current?></h3>
								</div>
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
						<?php foreach($letter as &$word) {
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
						</div>
						<?php next($sortedByKana);
					}
					?>
				</div>
			</div>
		</div>
	</section>
	<?include('includes/footer.php')?>
</body>
</html>