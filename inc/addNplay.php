<?php
    if(!empty($_POST['player'])) {  
        require_once 'Player.php';
        $play = new Player();
        $searchPlayer = $play->getPlayerByName($_POST['player']);
        if(empty($searchPlayer))
            $idPlay = $play->save($_POST['player']);
        else
            header('Location: ../index.php?ret=5');
    } else {
        header('Location: ../index.php?ret=1');
    }

    if(!empty($idPlay))
        header('Location: launchPlay.php?newId="'.$idPlay.'"');
    else
        header('Location: ../index.php?ret=2');
?>