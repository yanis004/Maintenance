<?php

function isJoinable($NumberOfTheCourse, $accessCodeArrayed){
    // Ajoutez ici les règles d'accès au challenge pour chaque cours
    // Par exemple, si le cours nécessite au moins 2 défis complétés pour être rejoint :
    $requiredChallenges = 2;

    // Vérifiez si le nombre de défis complétés est suffisant pour rejoindre le cours
    return $accessCodeArrayed[$NumberOfTheCourse] >= $requiredChallenges;
}

function isJoined($NumberOfTheCourse, $accessCodeArrayed){
    // Vérifiez si le cours est déjà rejoint
    return $accessCodeArrayed[$NumberOfTheCourse] >= 1;
}

function displayCourseLink($NumberOfTheCourse, $accessCodeArrayed){
    if(isJoinable($NumberOfTheCourse, $accessCodeArrayed)){
        return '<form method="POST" name="course'.$NumberOfTheCourse.'"><input type="hidden" name="course" value="'.$NumberOfTheCourse.'"><a class="noUnderline" href="#" onclick="javascript:document.course'.$NumberOfTheCourse.'.submit();"><i class="fas fa-shoe-prints"></i> Joindre</a></form>';
    }
    elseif(isJoined($NumberOfTheCourse, $accessCodeArrayed)){
        // Utilisez isJoinable() pour déterminer si le cours est toujours accessible
        if (isJoinable($NumberOfTheCourse, $accessCodeArrayed)) {
            return '<a class="noUnderline continue" href="bcaWorkUpload.php?course='.$NumberOfTheCourse.'&challenge='.getNextChallenge($NumberOfTheCourse, $accessCodeArrayed).'"><i class="fas fa-arrow-right"></i> Continuer</a>';
        }
        else {
            return '<span class="disabled"><i class="fas fa-arrow-right"></i> Continuer</span>';
        }
    }
    else{
        return '<a href="#"><i href="#" class="fas fa-info-circle" title="Vous devez compléter d\'autres défis avant de commencer ce parcours"></i></a>';
    }
}
?>
