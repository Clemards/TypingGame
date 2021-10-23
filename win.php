<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Cards Typing</title>
    <link href="css/win.css" rel="stylesheet">
</head>
<?php
    require_once 'inc/Player.php';
    $play = new Player();
    $player = $play->getPlayer($_COOKIE['Player']);
    // calcul du temps
    $start = intval($_COOKIE['start'] / 1000);
    $finish = intval($_COOKIE['finish'] / 1000);
    $time = $finish - $start;
    $timeDisplay = date('i:s',$time);
    $time = date('H:i:s',$time);
    // Gestion du record
    $record = $play->getScore($_COOKIE['Player'], 1);
    if(empty($record))
        $record = "Vous venez d'établir votre premier record";
    else if($record->time <= $time)
        $record = "Trés bon temps mais vous n'avez pas battu votre record de ".$record->time;
    else
        $record = "Vous avez battu votre record qui était de ".$record->time;

    $play->saveScore($_COOKIE['Player'], $time);
?>
<body>
    <h1>NICE JOOOOOOB <?= $player->name ?>!!</h1>

    <span id="score">Votre temps est de <?= $timeDisplay ?></span>
    <span id="record"><?= $record ?></span>
    <div id="link">
        <a id="tryAgain" href="inc/launchPlay.php?newId=<?= $_COOKIE['Player'] ?>">Rejouer</a>
        <a id="home" href="index.php">Accueil</a>
    </div>
    <span id="footer">Typing Game | CARDS<i>™</i></span>
</body>