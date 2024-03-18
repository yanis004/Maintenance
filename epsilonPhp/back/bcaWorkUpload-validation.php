<?php

include('header.php');

$isConnected = (isset($_COOKIE['mail']) || isset($_SESSION['mail'])) ? true : false;
if (!$isConnected) {
  echo 'Vous n\'êtes pas connecté, veuillez vous inscrire ou vous connecter sur la page d\'accueil<br><a href="index.php">Retour</a>';
  exit();
}

function getIdUser(){
  require('env.php');
  global $mail;
  $select = $db->query('SELECT id FROM user WHERE mail="'.$mail.'"');
  $result = $select->fetch();
  $counttable = count((is_countable($result)?$result:[]));
  if($counttable!=0){
      return $result['id'];
  }
  else{
    return 'erreur req';
  }
}

$idUser = getIdUser();

if(!is_dir($idUser)){
  mkdir($idUser, 0777);
}

$nameOfDirForWork = $_GET['course'].' '.$_GET['challenge'];
$target_dir = $idUser.'/'.$nameOfDirForWork;

if(!is_dir($target_dir)){
  mkdir($target_dir, 0777);
}

// Démarre la boucle pour un multi upload
$uploadOk = 1;

if(isset($_POST["submit"])) {
  $files = $_FILES['fileToUpload'];
  $numFiles = count($files['name']);

  for ($i = 0; $i < $numFiles; $i++) {
    $target_file = $target_dir .'/'. basename($files["name"][$i]);
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    // Vérifier si le fichier existe déjà
    if (file_exists($target_file)) {
      echo "Désolé, le fichier " . htmlspecialchars(basename($files["name"][$i])) . " existe déjà.<br>";
      $uploadOk = 0;
    }

    // Vérifier la taille du fichier
    if ($files["size"][$i] > 500000) {
      echo "Désolé, votre fichier " . htmlspecialchars(basename($files["name"][$i])) . " est trop gros.<br>";
      $uploadOk = 0;
    }

    // Autoriser certains formats de fichier
    $allowedFormats = array("jpg", "jpeg", "png", "gif", "pdf", "ppt", "pptx");
    if (!in_array($imageFileType, $allowedFormats)) {
      echo "Désolé, seuls les fichiers JPG, JPEG, PNG, GIF, PDF, PPT & PPTX sont autorisés pour " . htmlspecialchars(basename($files["name"][$i])) . ".<br>";
      $uploadOk = 0;
    }

    // Vérifier s'il y a une erreur
    if ($uploadOk == 0) {
      echo " Votre fichier " . htmlspecialchars(basename($files["name"][$i])) . " n'a pas été uploadé.<br>";
    } else {
      if (move_uploaded_file($files["tmp_name"][$i], $target_file)) {
        echo "Le fichier " . htmlspecialchars(basename($files["name"][$i])) . " a été uploadé avec succès.<br>";
      } else {
        echo "Désolé, il y a eu une erreur lors de l'upload du fichier " . htmlspecialchars(basename($files["name"][$i])) . ".<br>";
      }
    }
  }
}

// Fin de la boucle pour un multi upload

?>

<br>
<a href="index.php">Retour</a>
