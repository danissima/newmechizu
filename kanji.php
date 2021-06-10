<?php
include 'config.php';

if (isset($_GET['page'])) {
	$page = $_GET['page'];
} else {
	$page = 1;
}

$kol = 3;
$art = ($page * $kol) - $kol;

$total = $mysqli->query("SELECT * FROM kanji_keys")->{"num_rows"};
$str_pag = ceil($total / $kol);

$radicalsSelect = $mysqli->query("SELECT * from kanji_keys LIMIT $art, $kol");

$radicalsList = [];
while ($item = $radicalsSelect->fetch_array()) {
	array_push($radicalsList, $item);
}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="images/logo/logo2.png">
	<title>Иероглифы</title>
</head>
<body>
	<?include("includes/header.php")?>
	<section class="section">
		<div class="container">
			<div class="section__wp">
				<div class="section__top">
					<div class="section__title-wp">
						<h2 class="section__title">Изученные иероглифы</h2>
					</div>
				</div>
				<div class="section__tools">
					<a class="button" href="/add-kanji.php">Добавить иероглиф</a>
					<a class="button" href="/radicals.php">Ключи</a>
					<?include('includes/search-block.php')?>
				</div>
				<div class="section__page-nav">
					<?php
					if ($page != 1) $pervpage = "<a class='pages__item pages__item_move' href=kanji.php?page=1><<</a>
					<a class='pages__item pages__item_move' href=kanji.php?page=". ($page - 1) ."><</a> ";
					if ($page != $str_pag) $nextpage = " <a class='pages__item pages__item_move' href=kanji.php?page=". ($page + 1) .">></a>
																		<a class='pages__item pages__item_move' href=kanji.php?page=" .$str_pag. ">>></a>";

					if($page - 2 > 0) $page2left = " <a class='pages__item pages__item_move' href=kanji.php?page=". ($page - 2) .'>'. ($page - 2) .'</a>';
					if($page - 1 > 0) $page1left = "<a class='pages__item pages__item_move' href=kanji.php?page=". ($page - 1) .'>'. ($page - 1) .'</a>';
					if($page + 2 <= $str_pag) $page2right = "<a class='pages__item pages__item_move' href=kanji.php?page=". ($page + 2) .'>'. ($page + 2) .'</a>';
					if($page + 1 <= $str_pag) $page1right = "<a class='pages__item pages__item_move' href=kanji.php?page=". ($page + 1) .'>'. ($page + 1) .'</a>';

					echo $pervpage.$page2left.$page1left."<b class='pages__selected pages__item'>".$page."</b>".$page1right.$page2right.$nextpage;
					
					?>
				</div>
				<div class="kanji__content">
					<?php
					foreach ($radicalsList as &$radical) {
						$radicalNumber = $radical['key_number'];
						$radicalView = $radical['key_view'];
						$radicalName = $radical['key_name'];
					
						$selectKanjiOfRadical = $mysqli->query("SELECT kanji_view FROM kanji WHERE key_num = '$radicalNumber'");
						$kanjiOfRadicalList = [];
						while ($item = $selectKanjiOfRadical->fetch_array()) {
							array_push($kanjiOfRadicalList, $item);
						}
						if (count($kanjiOfRadicalList)) { ?>
							<div class="kanji__col">
								<div class="kanji__col-item">
									<div class="kanji__col-radical-wp">
										<h3 class="kanji__col-radical">Ключ <?=$radicalNumber?>: <?=$radicalView?> (<?=$radicalName?>)</h3>
									</div>
									<div class="section__sep">&#9670;</div>
									<div class="kanji__col-items">
										<?php for ($j = 0; $j < count($kanjiOfRadicalList); $j++) { 
											$item = $kanjiOfRadicalList[$j]['kanji_view']; ?>
											<div class="kanji__item-wp"><a href="/kanji-item.php?kanji=<?=$item?>" class="kanji__item"><?=$item?></a></div>
										<?php } ?>
									</div>
								</div>
							</div>
						<?php } } ?>
				</div>
			</div>
		</div>
	</section>
	<?include('includes/footer.php')?>
</body>
</html>