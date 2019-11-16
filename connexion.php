<html>
    <head>
       <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="inscription.css">
        <title>page connexion</title>
    </head>
    <body class="bodyc">
        <header>
            <nav class="nav">
                <ul>
                    <li><a href="connexion.php">Connexion</a></li>
                
                    <li class="navig"><a href="inscription.php">Inscription</a></li>
                </ul>
                    
            </nav>
        </header>
        <div id="formc">
            
            <form action="" method="get">
                <h1>Connexion</h1>
                
                <label><b>LOGIN</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="login" required>

                <label><b>PASSWORD</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>

                <input type="submit" id='submit' value='LOGIN' >
                <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2)
                        echo "<p style='color:#6E0C06'><b>Utilisateur ou mot de passe incorrect</b></p>";
                }
                ?>
            </form>
           
        </div>

    </body>
</html>

<?php


if(isset($_GET['login']) && isset($_GET['password']))
{
   
    $connexion = mysqli_connect ("localhost", "root", "", "moduleconnexion");
          
    
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $login = mysqli_real_escape_string($connexion,htmlspecialchars($_GET['login']));
    $password = mysqli_real_escape_string($connexion,htmlspecialchars($_GET['password']));
    
    if($login !== "" && $password !== "")
    {
        $requete = "SELECT count(*) FROM utilisateurs where 
              login = '".$login."' and password = '".$password."' ";
        $query = mysqli_query($connexion,$requete);
        $reponse = mysqli_fetch_array($query);
        $count = $reponse['count(*)'];

        if($count!=0 &&$_SESSION['login'] !== "")
        {
            session_start();
            $_SESSION['login'] = $_GET['login'];
            $user = $_SESSION['login'];
            echo "Bonjour $user, vous êtes connecté";
            header('Location: index.php');

        }
         else
        {
           header('Location: connexion.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }

    }
}  

?>
