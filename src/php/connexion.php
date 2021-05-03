<?php 
$title = 'Connexion';
require ('template/header.php');
?>

<div class="loginContainer">
    <?php if(!isLogged()): ?>
        <div class="formcontent">
            <form method="post" action="connexion.php">
            <!-- J'aimerais faire un tableau pour le login mais j'ai une vieille erreur inconnu au battaillon -->
                <h2>Se connecter</h2>
                <table>
                    <tr>
                        <td>
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg>
                            <input type="text" placeholder="Nom d'utilisateur" name="login" id="login">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" fill="currentColor" class="bi bi-key" viewBox="0 0 16 16">
                                <path d="M0 8a4 4 0 0 1 7.465-2H14a.5.5 0 0 1 .354.146l1.5 1.5a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0L13 9.207l-.646.647a.5.5 0 0 1-.708 0L11 9.207l-.646.647a.5.5 0 0 1-.708 0L9 9.207l-.646.647A.5.5 0 0 1 8 10h-.535A4 4 0 0 1 0 8zm4-3a3 3 0 1 0 2.712 4.285A.5.5 0 0 1 7.163 9h.63l.853-.854a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.646-.647a.5.5 0 0 1 .708 0l.646.647.793-.793-1-1h-6.63a.5.5 0 0 1-.451-.285A3 3 0 0 0 4 5z"/>
                                <path d="M4 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0z"/>
                            </svg>
                            <input type="password" placeholder="Mot de passe" name="psw" id="psw">
                        </td>
                    </tr>                       
                </table>
                <button type="submit" name="forminscription">Se Connecter</button>
                <p>Pas de compte ? <a href="#">Créez-en un</a></p>
            </form>
        </div>   
    <?php endif; ?>
</div>

<?php
// Lors de la déconnexion de l'utilisateur la session se désactive puis se détruit avant de recharger la page
if(isset($_GET['auth']) && !empty($_GET['auth']) && $_GET['auth'] == "logout") 
{
	session_unset();
	session_destroy();
	header("Location:connexion.php");
}

if(isset($_POST["forminscription"]))
{
    if(!empty($_POST["login"]) || (!empty($_POST["psw"])))
    {	
        // echo 'tesWt';
        $users = $db->getUsers();
        foreach($users as $user)
        {

            if($user['useLogin'] == $_POST['login'])
            {
                if(password_verify($_POST['psw'], $user['usePassword']))
                {
                    $_SESSION['username'] = $user['useLogin'];
                    $_SESSION['isAdmin'] = $user['useIsAdmin'];
                    header("Location:home.php");
                }
                
            }
            // bug car le text s'affiche 3 fois..
            // else {
            //     echo 'Mot de passe incorrect ';
            // }
            
        }
    }
    else
    {
        echo '<div class="errorLoginContainer">
                <h3 class="errorLogin">Veuillez renseignez tous les champs !</h3>
              </div>';
    }
}
?>

<?php require ('template/footer.php'); ?>