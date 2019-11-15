<?php
session_start();

$connexion = mysqli_connect("localhost","root","","moduleconnexion");
	$requet2="SELECT* FROM utilisateurs ";
	$query2=mysqli_query($connexion,$requet2);
	$resultat2=mysqli_fetch_assoc($query2);
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="inscription.css">
	<title>page changer de profil</title>
</head>
<body>
	<header>
		<h1>Modifier Profil</h1>
	</header>
	<div class="form" method=post align="center">
		<form method="POST" action="">
			<table align="center">
		<tr>
			<td align="right"><label>Login:</label>
			<input type="text" name="login" value="<?php echo $resultat2['login'];?>"></td>
		</tr>
		<tr>
			<td align="right"><label>Prénom:</label>
			<input type="text" name="prenom" value="<?php echo $resultat2['prenom'];?>"></td>
		</tr>
			<td align="right"><label>Nom:</label>
			<input type="text" name="nom" value="<?php echo $resultat2['nom'];?>"></td>
		</tr>	
		<tr>
			<td align="right"><label>Mot de passe:</label>
			<input type="password" name="password" value="<?php echo $resultat2['password'];?>"></td>
		</tr>
		<tr>
			<td align="center"><br>
			<input type="submit" value="Je modifie" name="Modifier"></td>

		</tr>
		
			</table>
		</form>
	</div>
</body>
</html>

<?php




if (isset($_POST['Modifier']))

{
	if (!empty ($_POST['login'] && $_POST['prenom'] && $_POST['nom'] && $_POST['password']))
{
	echo "Votre modification a bien été enregistrée !";

	$requet ="UPDATE utilisateurs SET login= '".$_POST['login']."',prenom= '".$_POST['prenom']."',nom= '".$_POST['nom']."',password= '".$_POST['password']."' where id= 30";
	$query= mysqli_query($connexion,$requet);
	header('location:index.php');	
}
}


?>