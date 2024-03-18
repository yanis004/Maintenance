<?php

// TODO: Afficher un listing des fichiers dans le dossier [numDuParcours][numDuChallenge]

$work[0][2] = 'Exemple de travaux 1';
$work[2][4] = 'Exemple de travaux 2';

include('header.php');

$isConnected = (isset($_COOKIE['mail']) || isset($_SESSION['mail'])) ? true : false;

if($isConnected) {
    include('bcaAccessCodeSystem.php');
}

$course = 'course'.$_GET['course'];
$challenge = 'rank'.$_GET['challenge'];

echo '<h2>Description du travail</h2><strong>
            Parcours actuel</strong> : '.$$course.'<br>';
echo '<strong>Challenge visé</strong> : '.$$challenge.'<br>';
echo '<strong>Défi demandé</strong> : <u>'.$work[$_GET['course']][$_GET['challenge']].'</u><br><br>';

?>

<h2>Upload du travail</h2>

<form action="bcaWorkUpload-validation.php?course=<?=$_GET['course']?>&challenge=<?=$_GET['challenge']?>" method="post" enctype="multipart/form-data">
  Sélectionnez un fichier à uploader :
  <input type="file" name="filesToUpload[]" id="filesToUpload" multiple>
  <input type="hidden" name="course" value="<?=$_GET['course'] ?>">
  <input type="hidden" name="challenge" value="<?=$_GET['challenge'] ?>">
  <input type="submit" value="Upload" name="submit">
</form>

<br>
<a href="index.php">Retour</a>

<?php
// Affichage des fichiers uploadés par l'utilisateur
$userDirectory = 'uploads/' . $_SESSION['mail'] . '/'; // Répertoire de l'utilisateur
if (is_dir($userDirectory)) {
    echo '<h2>Fichiers Uploadés</h2>';
    if ($dh = opendir($userDirectory)) {
        while (($file = readdir($dh)) !== false) {
            if ($file != '.' && $file != '..') {
                echo '<a href="' . $userDirectory . $file . '">' . $file . '</a><br>';
            }
        }
        closedir($dh);
    }
} else {
    echo '<p>Aucun fichier uploadé pour le moment.</p>';
}

include('footer.php');
?>
