<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Page de Téléchargement</title> <!-- Titre de la page -->

    <style>
body {
    background-color: #023b60; /* Couleur de fond du corps en bleu foncé */
    color: #ffffff; /* Couleur du texte du corps en blanc */
}
    </style>
    
</head>
<body>

<?php

if (isset($_FILES["profile_pic"])) { // Vérification si un fichier a été soumis via le formulaire
    $uploadDir = "Destination/"; // Répertoire de destination pour le téléchargement des fichiers

    $uploadedFile = $_FILES["profile_pic"]; // Récupération des informations sur le fichier téléchargé
    $fileName = basename($uploadedFile["name"]); // Nom du fichier
    $targetPath = $uploadDir . $fileName; // Chemin complet pour le stockage du fichier téléchargé

    if (is_uploaded_file($uploadedFile["tmp_name"])) { // Vérification si le fichier a été téléchargé avec succès
        if (move_uploaded_file($uploadedFile["tmp_name"], $targetPath)) { // Déplacement du fichier téléchargé vers le répertoire de destination
            echo '<p style="color: #ffffff;">Le fichier a été téléchargé avec succès dans le dossier spécifique.</p>'; // Message de succès

            echo '<img src="' . $targetPath . '" alt="Image téléchargée">'; // Affichage de l'image téléchargée avec une alternative
        } else {
            echo "Une erreur s'est produite lors du téléchargement du fichier."; // Message d'erreur en cas d'échec du déplacement du fichier
        }
    } else {
        echo "Erreur : Tentative de téléchargement de fichier invalide."; // Message d'erreur en cas de fichier non téléchargé correctement
    }
} else {
    echo "Erreur : Aucun fichier n'a été envoyé!..."; // Message d'erreur en cas d'absence de fichier dans la requête
}
?>

</body>
</html>
