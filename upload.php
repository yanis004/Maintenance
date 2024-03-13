<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>EPSI | LON</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body class="main_page">
    <div class="center_page">
        <?php include 'header.html';?>
        <form action="uploadfile.php" method="post" enctype="multipart/form-data">
            <!-- Ajoutez les extensions de fichiers Word -->
            <input class="link-upload" type="file" name="fichier" accept=".pdf, .jpg, .jpeg, .png, .doc, .docx">
            <br>
            <button class="link-upload" type="submit" name="envoyer">Envoyer</button>
        </form>
        <?php include 'footer.html';?>
    </div>
</body>
</html>

