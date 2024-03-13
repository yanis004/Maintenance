<?php
// Fonction pour uploader un fichier
if(isset($_POST['envoyer_fichier'])){
    $dossier = 'upload/';
    $fichier = basename($_FILES['fichier']['name']);

    try {
        if (empty($fichier)) {
            throw new Exception('Aucun fichier sélectionné');
        }

        // Récupère l'extension du fichier et définie celle autorisée
        $extension = strtolower(pathinfo($fichier, PATHINFO_EXTENSION));
        $extensionsAutorisees = array('jpg', 'jpeg', 'png', 'pdf');

        // Vérifie si le fichier existe déjà
        $compteur_fichier = 1;
        $nouveauNom = $fichier;
        while (file_exists($dossier . $nouveauNom)) {
            $nouveauNom = pathinfo($fichier, PATHINFO_FILENAME) . $compteur_fichier . '.' . $extension;
            $compteur_fichier++;
        }

        // Vérifie si l'extension du fichier est autorisée
        if (!in_array($extension, $extensionsAutorisees)) {
            throw new Exception('Extension de fichier non autorisée !');
        }

        if (move_uploaded_file($_FILES['fichier']['tmp_name'], $dossier . $nouveauNom)) {
            echo 'Upload effectué avec succès !';
        } else {
            throw new Exception('Echec de l\'upload !');
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}
?>