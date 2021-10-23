<?php
    require_once 'Player.php';
    $play = new Player();

    if(!empty($_POST['idPlayer']))
        $player = $play->getPlayer($_POST['idPlayer']);
    else if(!empty($_GET['newId']))
        $player = $play->getPlayer($_GET['newId']);

    if(!empty($player))
        header('Location: ../play.php?jou='.$player->id);
    else
        header('Location: ../index.php?ret=3');
?>