<?php
session_start();
$_SESSION['active_page']="fan_page.php";
if (!isset($_SESSION['login']))
{
    echo "<script>window.location = './index.php'</script>";
}
else
{
    $_SESSION['pseudo_valid']=true;
}
include("includes/x_com.php");
?>
<!DOCTYPE html>
<html>
	<head>
        <?php include("includes/x_head.php"); ?>
		<title>Welcome in Marty's world !</title>
	</head>
	
	<body>
		<!-- organisation de la page : d'abord une section bandeau latéral "album" et une section "contenu" -->
		<section class="page">
            <?php include("includes/album.php"); ?>
		
			<section class="contenu">
				<!-- dans la section contenu, un bandeau horizontal header et une section "corps" -->
                <?php include("includes/header.php"); ?>
			
				<section class="corps">		
		              <section class="texte">
                      <h2>Bienvenue sur l'espace fans !</h2>
                          <p>Ici on blog !</p>
                          <?php include("includes/last_blog.php") ?>
                      </section>
                    
                      <section class="texte">
                      <h2>Discutez !</h2>
                          <p>Ici on chat !</p>
                          <form method="POST" action="chat_post.php">
                            <p>
                                <fieldset>
                                <legend>Votre message</legend>
                                    <label for="pseudo">Votre pseudo</label>
                                    <input name="pseudo" type="text" value=<?php echo $_COOKIE['login']; ?> required />
                                    <br/>
                                    <label for="message">Votre message</label>
                                    <input name="message" type="text" required />
                                </fieldset>
                                <p style="text-align:right"><button type="submit"><p>Publier</p></button></p>
                                <?php
                                    if ($_SESSION['pseudo_valid']==false)
                                    {
                                        echo '<p>Le pseudo indiqué n\'est pas un pseudo connu dans ma base de fans. Merci de renseigner un pseudo autorisé ;-)</p>';
                                    }
                                ?>
                            </p>
                          </form>
                        
                        <h2>Consultez <a href="archive_post.php" alt="les archives du chat">les archives</a> du chat !</h2>
                    
                        <h2>Contactez-nous !</h2>
                          <p>Accédez au <a href="form_contact.php" alt="Contactez-nous">formulaire sécurisé</a>.</p>
                    
                      </section>
    
                      <section class="texte">
		              <h2>Nos derniers messages postés</h2>
                        <p>
                        <form method="POST" action="includes/refresh.php" style="text-align:center">
                            <button type="submit"><p>Rafraîchir</p></button>
                        </form>
                        <?php include("includes/last_post.php") ?>
                        </p>
                      
		              </section>

		          </section>
		      </section>
        </section>
		
		<?php include("includes/x_footer.php"); ?>
		
	</body>
</html>