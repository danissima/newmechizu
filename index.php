<?php
session_start();
include 'config.php';

$kanjiSelect = $mysqli->query("SELECT kanji_view FROM kanji");
$wordsSelect = $mysqli->query("SELECT word_kanji FROM words");
$combsSelect = $mysqli->query("SELECT combination FROM combinations");

$kanjiAmount = $kanjiSelect->{'num_rows'};
$wordsAmount = $wordsSelect->{'num_rows'} + $combsSelect->{'num_rows'};

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/style.css">
	<link rel="icon" href="images/logo/logo2.png">
	<title>Yume Chizu</title>
</head>
<body>
	<main class="main">
		<div class="container">
			<div class="main__wp">
				<?include("includes/header.php")?>
				<div class="main__stats">
					<div class="main__title-wp">
						<h1 class="main__title">Упрости своё изучение японского</h1>
					</div>
					<?php if($_SESSION['admin']) { ?>
						<div class="main__stats-info-wp">
							<p class="main__stats-info">На сегодняшний день изучено<br><span class="main__stats-num"><?=$kanjiAmount?></span> иероглифов и <span class="main__stats-num"><?=$wordsAmount?></span> слов</p>
						</div>
					<?php } else {?>
						<div class="main__stats-info-wp">
							<p class="main__stats-info">И воплоти мечту в жизнь!</p>
						</div>
					<?php }?>
				</div>
			</div>
		</div>
		<div class="main__clouds">
			<img src="images/index/clouds/cloud1.png" alt="cloud" class="cloud1">
			<img src="images/index/clouds/cloud2.png" alt="cloud" class="cloud2">
			<img src="images/index/clouds/cloud3.png" alt="cloud" class="cloud3">
		</div>
	</main>
</body>
</html>