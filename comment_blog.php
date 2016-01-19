<?php
session_start();
$_SESSION['active_page']="comment_blog.php";
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
		<title>Blog with Marty !</title>
	</head>
	
	<body>
		<section class="page">
            <?php include("includes/album.php"); ?>
		
			<section class="contenu">
                <?php include("includes/header.php"); ?>
			
				<section class="corps">		
		              <section class="texte">
		              <h2>Blog with Marty !</h2>
                        <p>
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
                    // test existence du get id_blog
                            if (isset($_GET['id_blog']))
                            {
                    
                    // préparation de la requête ciblée sur id_blog
                            $req = $bdd->prepare('SELECT id, title, article, author_pseudo, DATE_FORMAT(insert_date,"%d/%m/%Y à %Hh%im%ss") AS date FROM blog WHERE id = ?');
                            $req->execute(array($_GET['id_blog']));
                            $data = $req->fetch();

                    // affichage de l'article
                            echo '<fieldset><legend><em>' . htmlspecialchars($data['author_pseudo']) . '</em> a écrit le ' . $data['date'] . '</legend><p><strong>' . htmlspecialchars($data['title']) . '</strong><br />' . nl2br(htmlspecialchars($data['article'])) . '</fieldset>';

                    // préparation de la requête des commentaires
                            $req_c = $bdd->prepare('SELECT id, id_blog, author_comments, comment, DATE_FORMAT(insert_date,"%d/%m/%Y à %Hh%im%ss") AS date FROM blog_comments WHERE id_blog = ? ORDER BY insert_date DESC, id DESC');
                            
                            $req_c->execute(array($_GET['id_blog']));
                          
                    // affichage des commentaires
                            while ($data_c = $req_c->fetch())
                            {
                                echo '<p style="text-align:right"><em>' . htmlspecialchars($data_c['author_comments']) . '</em> a écrit le ' . $data_c['date'] . ' :<br /><strong>' . htmlspecialchars($data_c['comment']) . '</strong></p>';
                            }
                            }
                            else
                            {
                                echo 'Le lien vers le commentaires est corrompu.';
                            }
                            $req->closeCursor();
                            $req_c->closeCursor();
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