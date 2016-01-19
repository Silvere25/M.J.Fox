<?php
session_start();
// ouverture de la base de données et traitement des erreurs
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=mjfox;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }
    catch (Exception $e)
    {
        die('Erreur : ' . $e->getMessage());
    }

if (isset($_POST['pseudo']) && isset($_POST['message']))
{
// vérification que le pseudo est bien connu
    $req_p = $bdd->query('SELECT login FROM users');
    $_POST['pseudo']=htmlspecialchars($_POST['pseudo']);
    $pseudos = $req_p->fetchAll(PDO::FETCH_UNIQUE);
        
    foreach($pseudos as $pseudo=>$val)
    {
        if ($_POST['pseudo']==$pseudo)
        {
            $_SESSION['pseudo_valid']=true;
            break;
        }
        else
        {
            $_SESSION['pseudo_valid']=false;
        }
    }

    if ($_SESSION['pseudo_valid'])
    {
// préparation de la requête d'insertion
        $req = $bdd->prepare('INSERT INTO chat(pseudo, message) VALUES(:pseudo, :message)');

// récupération des données de formulaire et traitement anti faille XSS avant intégration en table
        $param = array('pseudo'=>htmlspecialchars($_POST['pseudo']), 'message'=>htmlspecialchars($_POST['message']));

// exécution de la requête d'insertion
        $req->execute($param);
        $req->closeCursor();
        $req_p->closeCursor();

// retour à la fan_page
        header('Location: fan_page.php');
    }
    else
    {
?>
<!DOCTYPE html>
<html>
	<head>
        <?php include("includes/x_head.php"); ?>
		<title>Wrong pseudo !</title>
	</head>
	
	<body>
		<section class="page">
            <?php include("includes/album.php"); ?>
		
			<section class="contenu">
                <?php include("includes/header.php"); ?>
			
				<section class="corps">		
		              <section class="texte">
                      <h2>Tu souhaites changer d'identité ?</h2>
                          <p>Le pseudo indiqué n'est pas un pseudo connu dans ma base de fans.<br />Merci de renseigner un pseudo autorisé ;-)</p>
                      </section>
                      
                      <section class="texte">
                      <h2>On retente l'aventure ?</h2>
                          <p><a href="fan_page.php" alt="j'ai compris j'arrête de faire le malin">OK</a>, je retourne sur la page des fans.</p>
                      </section>
		          </section>
		      </section>
        </section>
		
		<?php include("includes/x_footer.php"); ?>
		
	</body>
</html>

<?php
    }
}
?>