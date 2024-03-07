<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Téléchargement</title>
    <style>
        body {
            background-color: #023b60;
            color: #ffffff;
        }
    </style>
</head>
<body>

<?php

if (isset($_FILES["profile_pic"])) {
    $uploadDir = "Destination/";

    $uploadedFile = $_FILES["profile_pic"];
    $fileName = basename($uploadedFile["name"]);
    $targetPath = $uploadDir . $fileName;

    if (is_uploaded_file($uploadedFile["tmp_name"])) {
        if (move_uploaded_file($uploadedFile["tmp_name"], $targetPath)) {
            echo '<p style="color: #ffffff;">Le fichier a été téléchargé avec succès dans le dossier spécifique.</p>';
            
            echo '<img src="' . $targetPath . '" alt="Image téléchargée">';
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

</body>
</html>
