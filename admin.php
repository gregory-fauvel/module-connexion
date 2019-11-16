<html>
    <head>
      <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="inscription.css">
        <title>page administrateur</title>
    </head>
    <body>
      <header>
            <nav class="nav">
                <ul>
                    <li class="navig"><a href="profil.php">Modification</a></li>
                    <li><a href="admin.php">administrateur</a></li>
                    <li><a href="index.php?deconnexion=true">Déconnexion</a></li>
                </ul>
            </nav>
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
     </header>
     
        <div id="formc">
        
            
            <form action="" method="get">
                <h1>Connexion Admin</h1>
                
                <label><b>LOGIN</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="login" required>

                <label><b>PASSWORD</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="password" required>

                <input type="submit" id='submit' value='LOGIN' >
                <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2)
                        echo "<p style='color:#6E0C06'>Utilisateur ou mot de passe incorrect</p>";
                }
                ?>

<?php
session_start();
if(isset($_GET['login']) && isset($_GET['password']))
{

    $connexion = mysqli_connect ("localhost", "root", "", "moduleconnexion");
       
    $login = mysqli_real_escape_string($connexion,htmlspecialchars($_GET['login'])); 
    $password = mysqli_real_escape_string($connexion,htmlspecialchars($_GET['password']));

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
            echo "Bonjour $user, vous n'avez pas le droit d'accés<br><br>";

            echo "<a href='admin.php?deconnexion=true'><span>Déconnexion</span></a>";
              if(isset($_GET['deconnexion']))
                { 
                   if($_GET['deconnexion']==true)
                   {  
                      session_unset();
                      header("location:admin.php");
                   }
                }    
        }
       else
        {
           header('Location: admin.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }   
    }   
}
?>
          </form>
       </div>

       <div id="tableau">
         <table>
            <thead>
               <tr><th>id</th><th>login</th><th>prenom</th><th>nom</th><th>password</th></tr>
           </thead>
              <?php
             if(isset($resultat))
    
              foreach ($resultat as $affich):?>
          <tbody>
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
          </tbody>
        </table>
      </div>

   </body>
</html>



