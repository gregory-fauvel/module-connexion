<html>
    <head>
       <meta charset="utf-8">
        <!-- importer le fichier de style -->
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body>
        <div id="container">
            <!-- zone de connexion -->
            
            <form action="" method="POST">
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
                        echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                }
                ?>
            </form>
            <p><?php verif()?> </p>
        </div>
        <div id="content">
            
            <a href='connexion.php?deconnexion=true'><span>Déconnexion</span></a>
            
            <!-- tester si l'utilisateur est connecté -->
            <?php
                
                if(isset($_GET['deconnexion']))
                { 
                   if($_GET['deconnexion']==true)
                   { 
                      header("location:connexion.php");
                   }
                }
             
            ?>
            
        </div>
    </body>
</html>

<?php

function verif()

{
if(isset($_POST['login']) && isset($_POST['password']))
{
    // connexion à la base de données
    $connexion = mysqli_connect ("localhost", "root", "", "moduleconnexion");
          
    
    // on applique les deux fonctions mysqli_real_escape_string et htmlspecialchars
    // pour éliminer toute attaque de type injection SQL et XSS
    $login = mysqli_real_escape_string($connexion,htmlspecialchars($_POST['login']));
    $password = mysqli_real_escape_string($connexion,htmlspecialchars($_POST['password']));
    
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
            $_SESSION['login'] = $_POST['login'];
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

}

  

?>
