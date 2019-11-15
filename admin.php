<html>
    <head>
       <meta charset="utf-8">
     
        <link rel="stylesheet" href="style.css" media="screen" type="text/css" />
    </head>
    <body>
        <div id="container">
        
            
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
        </div>
         
        <div id="content">
            
            <a href='admin.php?deconnexion=true'><span>Déconnexion</span></a>
            
          
            <?php
                
                if(isset($_GET['deconnexion']))
                { 
                   if($_GET['deconnexion']==true)
                   {  
                      session_unset();
                      header("location:admin.php");
                   }
                }
             
            ?>
        </div>
    </body>
</html>

<?php
session_start();
if(isset($_POST['login']) && isset($_POST['password']))
{

    $connexion = mysqli_connect ("localhost", "root", "", "moduleconnexion");
       
    $login = mysqli_real_escape_string($connexion,htmlspecialchars($_POST['login'])); 
    $password = mysqli_real_escape_string($connexion,htmlspecialchars($_POST['password']));

     if($login !== "" && $password !== "")
    {
        $requete = "SELECT count(*) FROM utilisateurs where 
              login = '".$login."' and password = '".$password."' ";
        $query = mysqli_query($connexion,$requete);
        $reponse = mysqli_fetch_array($query);
        $count = $reponse['count(*)'];
    
       if($login == "admin" && $password == "admin")
            {
             $requete = "Select * from utilisateurs ;";
             $query = mysqli_query($connexion,$requete);
             $resultat = mysqli_fetch_all($query);
             echo "Bonjour admin";
    
            }

       elseif($count!=0 &&$_SESSION['login'] !== "")
        {
            $_SESSION['login'] = $login;
            $user = $_SESSION['login'];
            echo "Bonjour $user, vous êtes connecté, mais vous n'avez pas le droit d'accés";
        }
        
       else
        {
           header('Location: admin.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }   
    }
    
}

?>
 <table>
    <thead>
    <tr><th>id</th><th>login</th><th>prenom</th><th>nom</th><th>password</th></tr>
   </thead>
   <?php
   if(isset($resultat))
    
   foreach ($resultat as $affich):?>
    <tr>
   <td><?php echo $affich[0] ?></td>
   <td><?php echo $affich[1] ?></td>
   <td><?php echo $affich[2] ?></td>
   <td><?php echo $affich[3] ?></td>
   <td><?php echo $affich[4] ?></td>
   </tr>
   
   <?php
     endforeach;
    ?>



