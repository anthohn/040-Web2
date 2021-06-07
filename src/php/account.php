<?php 

/**
* ETML 
* Author : Anthony Höhn
* Date : 04.05.2021
* Description : Manage the connected user's page
*/

$title = 'Compte';
require ('template/header.php');

// Check if the user is connected (session variable exist)
if(!isset($_SESSION['idUser']))
{
    header('Location:connexion.php');
}
else
{
    $idUser = $_SESSION['idUser'];
    $userInfos = $db->getOneUser($idUser);
}


// Check if the user is logged
if(isLogged()):

    // Disconnect the user, destroy the session and redirect him to the connexion page
    if(isset($_GET['auth']) && !empty($_GET['auth']) && $_GET['auth'] == 'logout') 
    {
        // frees all session variables currently registered.
        session_unset();
        // destroys all of the data associated with the current session
        session_destroy();
        header("Location:connexion.php");
    }

    // Disconnect the user, destroy the session, delete the user and redirect him to the connexion page
    if(isset($_GET['auth']) && !empty($_GET['auth']) && $_GET['auth'] == "deleteAccount") 
    {
        $idUser = $_SESSION['idUser'];
        $db->deleteUser($idUser);
        // frees all session variables currently registered
        session_unset();
        // destroys all of the data associated with the current session
        session_destroy();
        header('Location:connexion.php');
    }
?>

<div class="accountFormcontent">
    <form>
        <!-- title -->
        <h2>Compte</h2>
        <table>
            <tr>
                <td>
                    <div class="logo">
                        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                        </svg>
                    </div>
                    <p>Utilisateur : <?= $userInfos[0]['useLogin'] ?></p>
                    <p>Livres suggérés : <?= $userInfos[0]['useSuggestBook'] ?></p>
                    <p>Appréciations : <?= $userInfos[0]['useAppreciationNumber'] ?></p>
                    <p>Inscription : <?= $userInfos[0]['useInscriptionDate'] ?></p>
                </td>
            </tr>
            <tr>
                <td>
                    <!-- logout button -->
                    <div class="logout">
                        <a href="account.php?auth=logout">Déconnexion</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <!-- delete account button (confirm pop-up) -->
                    <div class="deleteAccount">
                        <a href="account.php?auth=deleteAccount" onclick="return confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.')">Supprimer mon compte</a>
                    </div>  
                </td>
            </tr>  
        </table>
    </form>
</div>   

<?php endif; ?>

<?php require ('template/footer.php'); ?>