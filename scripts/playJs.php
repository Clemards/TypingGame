<?php
    $filename = 'inc/quote.txt';
    $contents = file($filename);
    $tabArray = array();
    foreach($contents as $cont)
        $tabArray[] = preg_replace( "/\r|\n/", "", $cont);

?>

<script>
    var quoteArray;
    var i;
    var score = 1;
    var hours; var minutes; var seconds;
    $( document ).ready(function() {
        // Gestion du timer
        var dateLoad = new Date().getTime();
        document.cookie = "start="+new Date().getTime();
        setInterval(function() {
            var now = new Date().getTime();
            var distance = now - dateLoad;
                
            hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            seconds = Math.floor((distance % (1000 * 60)) / 1000);
                
            if(hours != 0)
                $("#timer").html(hours + " h " + minutes + " min " + seconds + " sec");
            else if(minutes != 0)
                $("#timer").html(minutes + " min " + seconds + " sec");
            else
                $("#timer").html(seconds + " sec");
        }, 1000);

        // Affichage des quotes
        var quotes = <?php echo json_encode($tabArray),';'; ?>
        quoteArray = getRandomSentence(quotes);
        displayQuote(quoteArray);

        // Gestion des events de l'ecriture
        $('#typing').keyup(function() {
            // Reset class
            var correct = 0;
            var elems = document.querySelectorAll(".qp");
            for (i = 0; i < elems.length; ++i) {
                elems[i].classList.remove("correct");
                elems[i].classList.remove("incorrect");
            }
            // Ajout de la classe selon la valeur
            var tabTyp = $(this).val().split('');
            var elem = document.getElementsByClassName("qp");
            for (i = 0; i < tabTyp.length; ++i) {
                if(elem[i].innerHTML == tabTyp[i]) {
                    elem[i].classList.add("correct");
                    correct ++;
                } else {
                    elem[i].classList.add("incorrect");
                    correct --;
                }
            }
            if(elem.length == correct) {
                quoteArray = getRandomSentence(quotes);
                displayQuote(quoteArray);
                score ++;
                $('#score').text(score + " / 5");
                if(score > 5) {
                    document.cookie = "finish="+new Date().getTime();
                    window.location.replace("../win.php");
                }
            }
        });
    });

    function getRandomSentence(quotes) {
        var idx = getRandomInt(quotes.length);
        var splitSentece = quotes[idx];
        return splitSentece.split('');
    }

    function displayQuote(array) {
        $("#quote").html("");
        $('#typing').val("");
        var html;
        for (i = 0; i < array.length; ++i) {
            html = $("#quote").html();
            $("#quote").html(html+"<span class='qp'>"+array[i]+"</span>");
        }
    }

    function getRandomInt(max) {
        return Math.floor(Math.random() * Math.floor(max));
    }
</script>