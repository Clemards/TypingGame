<?php if(!empty($_GET['jou']))
    $player = setcookie("Player", htmlspecialchars($_GET["jou"])); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Cards Typing</title>
    <link href="css/play.css" rel="stylesheet">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <?php require_once 'scripts/playJs.php'; ?>
</head>
<?php 
    if(!empty($_GET['jou'])) {
        require_once 'inc/Player.php';
        $play = new Player();
        $player = $play->getPlayer($_GET['jou']);
    } else
        header('Location: ../index.php?ret=4');
?>
<body>
    <p id="player"><?=$player->name ?></p>
    <p id="timer">0</p>

    <div id="game">
        <p id="quote"></p>
        <textarea id="typing" autofocus></textarea>
    </div>

    <span id="score">1 / 5</span>

    <span id="footer">Typing Game | CARDS<i>™</i></span>
</body>
</html>