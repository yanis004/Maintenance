<?php include 'entete.php'; ?> <!-- Inclusion du fichier 'entete.php' -->

<form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="profile_pic">Téléchargez votre fichier !</label>
    <input type="file" name="profile_pic" id="profile_pic" accept=".pdf, .jpg, .jpeg, .png" max-size="100000">
    <!--
        - L'attribut 'action' spécifie le script pour traiter les données du formulaire.
        - L'attribut 'method' définit la méthode HTTP (POST dans ce cas).
        - L'attribut 'enctype' spécifie comment les données du formulaire doivent être encodées (multipart/form-data pour les téléchargements de fichiers).
    -->
    <br>
    <input type="submit" value="Envoyer"> <!-- Bouton de soumission pour envoyer les données du formulaire -->
</form>
</div>
</body>
</html>