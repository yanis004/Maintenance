<?php
var_dump($_POST);
var_dump($_FILES);

if (isset($_FILES["profile_pic"])) {
    $uploadDir = "Destination/";

    $uploadedFile = $_FILES["profile_pic"];
    $fileName = basename($uploadedFile["name"]);
    $targetPath = $uploadDir . $fileName;

    if (is_uploaded_file($uploadedFile["tmp_name"])) {
        if (move_uploaded_file($uploadedFile["tmp_name"], $targetPath)) {
            echo "Le fichier a été téléchargé avec succès dans le dossier spécifique.";
        } else {
            echo "Une erreur s'est produite lors du téléchargement du fichier.";
        }
    } else {
        echo "Erreur : Tentative de téléchargement de fichier invalide.";
    }
} else {
    echo "Erreur : Aucun fichier n'a été envoyé!...";
}
?>
