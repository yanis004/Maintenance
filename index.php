<?php include 'header.php'; ?>

<form action="upload.php" method="post" enctype="multipart/form-data">
    <label for="profile_pic">Upload your file!</label>
    <input type="file" name="profile_pic" id="profile_pic" accept=".pdf, .jpg, .jpeg, .png" max-size="100000">
    <br>
    <input type="submit" value="Envoyer">
</form>
</div>
</body>
</html>
