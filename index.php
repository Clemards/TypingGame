<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Cards Typing</title>
    <link href="css/index.css" rel="stylesheet">
</head>
<?php 
    require_once 'inc/Player.php';
    $play = new Player();
    $lesJoueurs = $play->getAll();
    $lesScores = $play->getAllScore(1);
?>
<body>
    <h1>Typing Game by CARDS<i>™</i></h1>
    <div id="usrInfos">
        <div id="selectPlayer">
            <h2>Joueur Existant</h2>
            <form action="inc/launchPlay.php" method="post">
                <label for="idPlayer">Choisir un joueur</label>
                <select id="idPlayer" name="idPlayer">
                    <?php foreach($lesJoueurs as $jou) {?>
                        <option value="<?= $jou->id ?>"><?= $jou->name ?></option>
                    <?php } ?>
                </select>
                <input type="submit" value="Jouer"/>
            </form>
        </div>

        <div id="highScore">
            <h2>Meilleurs Scores</h2>
            <ol>
                <?php foreach($lesScores as $scr) { 
                    $player = $play->getPlayer($scr->idPlayer);?>
                    <li> <?=$player->name ?> / <?= $scr->time ?></li>
                <?php } ?>
            </ol>
        </div>

        <div id="newPlayer">
            <h2>Nouveau Joueur</h2>
            <form action="inc/addNplay.php" method="post">
                <label for="player">Nom joueur</label>
                <input autocomplete="off" type="text" name="player"  id="player"/>
                <input type="submit" value="Jouer"/>
            </form>
        </div>
    </div>

    <?php 
    if(!empty($_GET['ret'])) {
        if($_GET['ret'] == 1) {
            echo '<p id="eptName">Veuillez renseigner un nom de joueur !</p>';
        } else if($_GET['ret'] == 2) {
            echo '<p id="eptName">Problème de création du joueur !</p>';
        } else if($_GET['ret'] == 3) {
            echo '<p id="eptName">Le joueur semble inexistant !</p>';
        } else if($_GET['ret'] == 4) {
            echo '<p id="eptName">Problème de récupération du joueur !</p>';
        } else if($_GET['ret'] == 5) {
            echo '<p id="eptName">Nom de joeur déjà prit !</p>';
        }
    } ?>

    <span id="footer">Enjoy your game !</span>
</body>
</html>