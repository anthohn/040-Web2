<?php 
$title = 'Connexion';
require ('template/header.php');
?>

<!-- <h1>*du site*</h1> -->
<div class="login-container">
    <?php if(!isLogged()): ?>
        <form method="post" action="connexion.php">
            <input type="text" placeholder="Nom d'utilisateur" name="login" id="login">
            <input type="password" placeholder="Mot de passe" name="psw" id="psw">
            <button type="submit" name="forminscription">Se Connecter</button>
        </form>
    <?php else: ?>
            <div class="notlog">
                <a href="connexion.php?auth=logout">Se deconnecter</a>
            </div>
    <?php endif; ?>
</div>

<?php
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
        echo 'tesWt';
        $users = $db->getUsers();
        foreach($users as $user)
        {

            if($user['useLogin'] == $_POST['login'])
            {
                if(password_verify($_POST['psw'], $user['usePassword']))
                {
                    $_SESSION['username'] = $user['useLogin'];
                    $_SESSION['isAdmin'] = $user['useIsAdmin'];
                    header("Location:connexion.php");
                }
            }
        }
    }
    else
    {
        $erreur = "Veuillez renseignez tous les champs !";
        echo $erreur;
    }
}
?>

<?= require ('template/footer.php'); ?>