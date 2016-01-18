<footer>
    <p><strong>Accédez à mon fan club, connectez-vous !</strong></p>
    <form method="POST" action="./login.php">
        <p id="bas" >
            <label for="login">Votre login</label>
            <input name="login" type="text" required />
            <label for="mdp">Votre mot de passe</label>
            <input name="mdp" type="password" required />
            <button type="submit">Se connecter</button>
        </p>
    </form>
    <?php
        if (!$_SESSION['login_active'] && isset($_SESSION['login']))
        {
    ?>
                <p><mark style="color:red">Vous n'avez pas l'autorisation d'accéder au club des fans.</mark></p>
    <?php
        }
    ?>
    <p>© <em>2016</em> - site réalisé par SlyArtWork - dernière mise à jour le 15/01/2016 - 
    <?php
        $file= fopen('datas/compteur.txt','r+');
        $nbvisite= fgets($file);
        $nbvisite++;
        fseek($file,0);
        fputs($file,$nbvisite);
        fclose($file);
        echo "site visité " . $nbvisite . " fois.";
    ?>
    </p>
</footer>