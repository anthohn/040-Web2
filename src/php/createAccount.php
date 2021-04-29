<?php 
$title = 'Créer un compte';
require ('template/header.php');
?>

<div class="login-container">
    <?php if(!isLogged()): ?>
        <form method="post" action="createAccount.php">

            <table>
                <tr>
                    <td float='right'>
                        <label for="login">Pseudo :</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Nom d'utilisateur" name="login" id="login">
                    </td>
                </tr>
                <tr>
                    <td float='right'>
                        <label for="psw">Mot de passe :</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Votre mot de passe" name="psw" id="psw">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="psw2">Mot de passe :</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Confirmez votre mot de passe" name="psw2" id="psw2">
                    </td>
                </tr>    

            </table>
            <button type="submit" name="forminscription">Créer mon compte</button>

        </form>
    <?php else: ?>
            <div class="notlog">
                <a href="connexion.php?auth=logout">Se deconnecter</a>
            </div>
    <?php endif; ?>
</div>

<?php require ('template/footer.php'); ?>