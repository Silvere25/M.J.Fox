<?php
session_start();
$_SESSION['active_page']="archive_post.php";
if (!isset($_SESSION['login']))
{
    echo "<script>window.location = './index.php'</script>";
}
include("includes/x_com.php");
?>
<!DOCTYPE html>
<html>
	<head>
        <?php include("includes/x_head.php"); ?>
		<title>Chat Archives</title>
	</head>
	
	<body>
		<section class="page">
            <?php include("includes/album.php"); ?>
		
			<section class="contenu">
                <?php include("includes/header.php"); ?>
			
				<section class="corps">		
		              <section class="texte">
		              <h2>Les archives de notre chat</h2>
                        <p>
                            <form method="POST" action="archive_post.php">
                                <label for="date">Les messages archivés du</label>
                                    <input name="date" type="date" placeholder="AAAA-MM-JJ"/>
                                <button type="submit">Rafraîchir</button>
                            </form>
                            
                          <?php
                            // ouverture de la base de données et traitement des erreurs
                            try
                            {
                                $bdd = new PDO('mysql:host=localhost;dbname=mjfox;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
                            }
                            catch (Exception $e)
                            {
                                die('Erreur : ' . $e->getMessage());
                            }
                          
                            // préparation de la requête
                            $req = $bdd->prepare('SELECT pseudo, message, DATE_FORMAT(insert_date,"%d/%m/%Y à %Hh%im%ss") AS date FROM chat WHERE insert_date >= ? AND insert_date <= ? ORDER BY insert_date');
                            // exécution avec traitement du champ formulaire
                            if (isset($_POST['date']))
                            {
                                $_POST['date']=htmlspecialchars($_POST['date']);
                                $date = date_create_from_format('Y-m-d', $_POST['date']);
                                if ($date==false)
                                {
                                    echo "<p>La date renseignée doit respecter le format AAAA-MM-JJ.<br />Par exemple le 19/01/2016 doit être saisi sous la forme 2016-01-19.</p>";
                                    
                                }
                                else
                                {
                                    $req->execute(array($_POST['date'] . ' 00:00:00', $_POST['date'] . ' 23:59:59'));
                                }
                            }
                            else
                            {
                                // bug sur le catch de la date...
                                $date = date('Y-m-d');
                                $req->execute(array($date . ' 00:00:00',$date . ' 23:59:59'));
                            }
                          
                            // affichage du résultat
                            while ($data = $req->fetch())
                            {
                                echo '<p><em>' . htmlspecialchars($data['pseudo']) . '</em> a écrit le ' . $data['date'] . ' :<br /><strong>' . htmlspecialchars($data['message']) . '</strong></p>';
                            }

                            $req->closeCursor();
                          
                          ?>
                        </p>
		              </section>
                      
                      <section class="texte">
		              <h2></h2>
                          <p style="text-align:center">Revenir à la l'espace des fans :</p>
                          <form method="POST" action="fan_page.php" style="text-align:center">
                            <button type="submit"><p>Go !</p></button>
                          </form>
		              </section>
                
		          </section>
		      </section>
        </section>
		
		<?php include("includes/x_footer.php"); ?>
		
	</body>
</html>