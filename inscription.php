<?php
session_start();
$connexion = mysqli_connect("localhost","root","","moduleconnexion");

if (isset($_POST['connexion']))
{
	if ($_POST['mdp']==$_POST['mdp2'])
	{
    $requet="SELECT* FROM utilisateurs";
    $query2=mysqli_query($connexion,$requet);
    $resultat=mysqli_fetch_all($query2);
    $trouve=false;
   foreach ($resultat as $key => $value) {
   	if ($resultat[$key][1]==$_POST['login'])
   	{
   		echo "Login deja existant!!";
   		$trouve=true;

   	}
 }
   	if ($trouve==false)
   	{
    	$sql = "INSERT INTO utilisateurs (login,prenom,nom,password)
				VALUES ('".$_POST['login']."', '".$_POST['prenom']."', '".$_POST['nom']."','".$_POST['mdp']."')";
    $query=mysqli_query($connexion,$sql);
    header('location:connexion.php');
   	}

}
	else{
		echo "Les mots de passe doivent etre identique!";
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="inscription.css">
	<title>page connexion</title>
</head>
<body>
	<header>
		<nav class="nav">
		    <ul>
		    	<li class="navig"><a href="#">Inscription</a></li>
		        <li><a href="connexion.php">Connexion</a></li>
		    </ul>
		</nav>
		<h1>Inscription</h1>
	</header>
	<div class="form" align="center">
		<form method="POST" action="">
			<table align="center">
		<tr>
			<td align="right"><label>Login;</label>
			<input type="text" name="login" placeholder="Entrez votre Login"></td><br/>
		</tr>
		<tr>
			<td align="right"><label>Prénom:</label>
			<input type="text" name="prenom" placeholder="Entrez votre Prénom"></td><br/>
		</tr>
			<td align="right"><label>Nom:</label>
			<input type="text" name="nom" placeholder="Entrez votre Nom"></td><br/>
		</tr>	
		<tr>
			<td align="right"><label>Mot de passe:</label>
			<input type="password" name="mdp" placeholder="Entrez votre mot de passe"></td><br/>
		</tr>
			<tr>
			<td align="right"><label>Confirmez Mot de passe:</label>
			<input type="password" name="mdp2" placeholder="Confirmez votre mot de passe"></td><br/>
		</tr>
		<tr>
			<td align="center"><br>
			<input type="submit" value="Je m'inscris" name="connexion"></td><br/>
		</tr>
			</table>
		</form>
	</div>
</body>
</html>