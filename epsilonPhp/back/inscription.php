<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<title>Espilon</title>
	<meta name="description" content="Epsilon">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="assets/css/fontawesome.css" rel="stylesheet">
	<link href="assets/css/brands.css" rel="stylesheet">
	<link href="assets/css/solid.css" rel="stylesheet">
	<script defer src="assets/js/all.js"></script>
	<script defer src="assets/js/brands.js"></script>
	<script defer src="assets/js/solid.js"></script>
	<script defer src="assets/js/fontawesome.js"></script>
    <style type="text/css">
        #retour{float: left;}
        #return>a{color: rgb(70, 114, 70); text-decoration: none;}
        table{margin: auto;}
        td{float: left;}
        .label{min-width: 8em; text-align: left}
    </style>
</head>
<body>

<div class="container">
    <header>
        <nav>
            <ul id="connection">
                <li id="signin">
						<a href="connexion.php"><i class="fas fa-sign-in-alt"></i> Connexion</a>
                </li>
            </ul>
        </nav>
        <div class="cleared"></div>

        <h1>Inscription</h1>
    </header>

    <section>
        <form action="inscription-validation.php" method="post">
            <table>
                <tr>
                    <td class="label">Mail</td>
                    <td><input type="email" name="bca-mail" id="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"><br></td>
                </tr>
                <tr>
                    <td class="label">Mot de passe</td>
                    <td><input type="password" name="bca-pwd" id="" pattern=".{8,}"></td>
                </tr>
                <tr>
                    <td class="label"></td>
                    <td><input type="submit" name="valid"></td>
                </tr>
            </table>
        </form>
    </section>

    <section>
        <ul id="retour">
            <li id="return">
                <a href="index.php">Retour</a></li>
        </ul>
    </section>

</div>
    
</body>
</html>