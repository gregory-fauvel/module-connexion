<?php
    session_start();
?>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="inscription.css">
    <title>page index</title>
</head>
<body>
    <?php 
    if (isset($_SESSION['login'])==false)
    {
    ?>
        <header>
            <nav class="nav">
                <ul>
                    <li><a href="connexion.php">Connexion</a></li>
                
                    <li class="navig"><a href="inscription.php">Inscription</a></li>
                </ul>
                    
            </nav>
     </header>
     <?php
    }
     elseif(isset($_SESSION['login'])==true)

    {
    $user = $_SESSION['login'];
            echo "<h3><b>Bonjour <u>$user,</u> vous êtes connecté</b></h3>";    
    ?>
        <header>
            <nav class="nav">
                <ul>
                    <li class="navig"><a href="profil.php">Modification</a></li>
                    <li><a href="admin.php">administrateur</a></li>
                    <li><a href="index.php?deconnexion=true">Déconnexion</a></li>
                </ul>
            </nav>
     </header>
     <?php
                
                if(isset($_GET['deconnexion']))
                { 
                   if($_GET['deconnexion']==true)
                   {  
                      session_unset();
                      header("location:index.php");
                   }
                }
             
            ?>
<?php
}
?>

</body>
</html>




