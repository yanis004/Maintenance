<?php

/*

Parcours = course
Challenge = challenge
Défi = work

TODO : 

Completer isJoined avec isJoinable qui contiendra en plus les regles d'acces au challenge

*/

$rank0 = "Parcours non suivi";
$rank1 = "Parcours suivi";
$rank2 = "Apprenti";
$rank3 = "Compagnon";
$rank4 = "Passeur";
$rank5 = "Guide";

$course0 = "Apprentissage et transmission";
$course1 = "Culture en pot";
$course2 = "Art de l'ouvrage";
$course3 = "Arts Associés";

$mail = isset($_COOKIE['mail']) ? $_COOKIE['mail'] : $_SESSION['mail'];

function getNextChallenge($selectedCourse, $accessCodeArrayed){
	$nextChallengeNumber = $accessCodeArrayed[$selectedCourse]+1;
	return $nextChallengeNumber;
}

// Access Code functions

function isAuthorizedToJoin($NumberOfTheCourse, $accessCodeArrayed){
	if($NumberOfTheCourse == 0){
		if($accessCodeArrayed[0]==0){
			$isAuthorized = true;
		}
		else{
			$isAuthorized = false;
		}
	}
	if($NumberOfTheCourse == 1){
		if($accessCodeArrayed[1]>=2){
			$isAuthorized = true;
		}
		else{
			$isAuthorized = false;
		}
	}	
	if($NumberOfTheCourse == 2){
		if($accessCodeArrayed[0]>=2){
			$isAuthorized = true;
		}
		else{
			$isAuthorized = false;
		}
	}

	if($NumberOfTheCourse == 3){
		if($accessCodeArrayed[0]>=2){
			$isAuthorized = true;
		}
		else{
			$isAuthorized = false;
		}
	}
	return isset($isAuthorized) ? $isAuthorized : false;//$isAuthorized;
}

function isJoined($NumberOfTheCourse, $accessCodeArrayed){
	return $accessCodeArrayed[$NumberOfTheCourse] >= 1 ? true : false;
}

function isJoinable($NumberOfTheCourse, $accessCodeArrayed) {
    // Ajoutez ici vos règles spécifiques pour déterminer si l'utilisateur peut rejoindre le parcours ou le challenge
    // Par exemple, vous pouvez vérifier le nombre de défis terminés, le temps écoulé depuis l'inscription, etc.

    // Exemple de règle : pour rejoindre le parcours 1, l'utilisateur doit avoir complété au moins 2 défis dans le parcours 0
    if ($NumberOfTheCourse == 1) {
        if ($accessCodeArrayed[0] >= 2) {
            return true;
        } else {
            return false;
        }
    }

    // Autres règles à ajouter ici selon vos besoins

    // Par défaut, retourner true si aucune règle spécifique n'est définie
    return true;
}

function displayCourseLink($NumberOfTheCourse, $accessCodeArrayed){
	if(isAuthorizedToJoin($NumberOfTheCourse, $accessCodeArrayed)){
		return ' <form method="POST" name="course'.$NumberOfTheCourse.'"><input type="hidden" name="course" value="'.$NumberOfTheCourse.'"><a class="noUnderline" href="#" onclick="javascript:document.course'.$NumberOfTheCourse.'.submit();"><i class="fas fa-shoe-prints"></i> Joindre</a></form>';
	}
	elseif(isJoined($NumberOfTheCourse, $accessCodeArrayed)){
		if (isJoinable($NumberOfTheCourse, $accessCodeArrayed)) {
			// Si l'utilisateur peut rejoindre le parcours selon les règles définies
			return ' <a class="noUnderline continue" href="bcaWorkUpload.php?course='.$NumberOfTheCourse.'&challenge='.getNextChallenge($NumberOfTheCourse, $accessCodeArrayed).'"><i class="fas fa-arrow-right"></i> Continuer</a></form>';
		} else {
			// Si l'utilisateur ne peut pas rejoindre le parcours selon les règles définies
			return ' <a href="#"><i href="#" class="fas fa-info-circle" title="Vous devez compléter d\'autres défis avant de commencer ce parcours"></i></a>';
		}
	}
	else{
		return ' <a href="#"><i href="#" class="fas fa-info-circle" title="Vous devez compléter d\'autres défis avant de commencer ce parcours"></i></a>';
	}
}

function setToOneNewJoinedCourse($NumberOfJoinedCourse, $accessCodeArrayed){
	$accessCodeArrayed[$NumberOfJoinedCourse] = 1;
	$accessCodeForDB = arrayToStringAccessCode($accessCodeArrayed);
	// insertion en base $accessCodeForDB
	require('env.php');
	global $mail;
	$update = $db->prepare('UPDATE user SET accessCode=:accessCode WHERE mail=:mail');
	$update->execute(array('accessCode' => $accessCodeForDB, 'mail' => $mail));
	header("Refresh:0");
}

function getAccessCodeFromDB(){
	require('env.php');
	global $mail;
	$select = $db->query('SELECT accessCode FROM user WHERE mail="'.$mail.'"');
	$result = $select->fetch();
	$counttable = count((is_countable($result)?$result:[]));
	if($counttable!=0){
	    return $result['accessCode'];
	}
	else{
		return 'erreur: no accessCode';
	}
}

function stringToArrayAccessCode($accessCodeFromDB){
	return explode(' ', $accessCodeFromDB);
}

function arrayToStringAccessCode($accessCodeForDB){
	return implode(' ', $accessCodeForDB);
}

function numberToRankNamed($numberFromArray){
	global $rank0, $rank1, $rank2, $rank3, $rank4, $rank5;
	if($numberFromArray == 0){ $rankNamed='<span class="disabled">'.$rank0.'</span>'; }
	if($numberFromArray == 1){ $rankNamed='<span class="enabled">'.$rank1.'</span>'; }
	if($numberFromArray == 2){ $rankNamed='<i class="fa fa-graduation-cap"></i> <span class="'.$rank2.'">'.$rank2.'</span>'; }
	if($numberFromArray == 3){ $rankNamed='<i class="fa fa-handshake"></i> <span class="'.$rank3.'">'.$rank3.'</span>'; }
	if($numberFromArray == 4){ $rankNamed='<i class="fa fa-hand-holding"></i> <span class="'.$rank4.'">'.$rank4.'</span>'; }
	if($numberFromArray == 5){ $rankNamed='<i class="fa fa-star"></i> <span class="'.$rank5.'">'.$rank5.'</span>'; }
	return $rankNamed;
}

function displayCoursesList($accessCodeArrayed){
	global $course0, $course1, $course2, $course3;
	echo '<ul id="parcours-list">
	<li><strong>'.$course0.' : </strong>'.numberToRankNamed($accessCodeArrayed[0]).displayCourseLink(0,$accessCodeArrayed).' <span class="see"><i class="fas fa-eye"></i> Voir</span></li>';
echo '<li><strong>'.$course1.' : </strong>'.numberToRankNamed($accessCodeArrayed[1]).displayCourseLink(1,$accessCodeArrayed).' <span class="see"><i class="fas fa-eye"></i> Voir</span></li>';
echo '<li><strong>'.$course2.' : </strong>'.numberToRankNamed($accessCodeArrayed[2]).displayCourseLink(2,$accessCodeArrayed).' <span class="see"><i class="fas fa-eye"></i> Voir</span></li>';
echo '<li><strong>'.$course3.' : </strong>'.numberToRankNamed($accessCodeArrayed[3]).displayCourseLink(3,$accessCodeArrayed).' <span class="see"><i class="fas fa-eye"></i> Voir</span></li>
</ul>';
}
