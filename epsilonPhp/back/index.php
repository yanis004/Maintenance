<?php

function isJoinable($NumberOfTheCourse, $accessCodeArrayed){
    // Ajoutez ici les règles d'accès au challenge pour chaque cours
    // Par exemple, si le cours nécessite au moins 2 défis complétés pour être rejoint :
    $requiredChallenges = 2;

    // Vérifiez si le nombre de défis complétés est suffisant pour rejoindre le cours
    return $accessCodeArrayed[$NumberOfTheCourse] >= $requiredChallenges;
}

function isJoined($NumberOfTheCourse, $accessCodeArrayed){
    // Utilisez la fonction isJoinable() pour vérifier si le cours est rejoignable
    return $accessCodeArrayed[$NumberOfTheCourse] >= 1 && isJoinable($NumberOfTheCourse, $accessCodeArrayed);
}

include('header.php');

$isConnected = (isset($_COOKIE['mail']) || isset($_SESSION['mail'])) ? true : false;

if($isConnected) {
    include('bcaAccessCodeSystem.php');

    $accessCode = getAccessCodeFromDB();
    $accessCodeArrayed = stringToArrayAccessCode($accessCode);

    if(isset($_POST['course'])){
        setToOneNewJoinedCourse($_POST['course'], $accessCodeArrayed);
    }
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> PAGE </title>
</head>
<body>
<div class="container">
    <section>
        <h2 id="community">Mes parcours & badges</h2>
        <?php
        if($isConnected) {
            displayCoursesList($accessCodeArrayed);
        }
        ?>
    </section>

    <section>
        <h2 id="courses">Badges disponibles</h2>
        <ul id="badges-list">
            <li><i class="fa fa-graduation-cap"></i> Apprenti</li>
            <li><i class="fa fa-handshake"></i> Développeur</li>
            <li><i class="fa fa-hand-holding"></i> Passeur</li>
            <li><i class="fa fa-star"></i> Guide</li>
        </ul>
    </section>
</div>
</body>
</html>
