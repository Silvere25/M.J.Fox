<?php
session_start();
$_SESSION['active_page']="fan_page.php";
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
		<title>Contact Marty !</title>
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
                          <p>ici on va bloger !</p>
                      </section>
                    
                      <section class="texte">
                      <h2>Discutez !</h2>
                          <p>ici on va chatter !</p>
                      </section>  
                    
                      <section class="texte">
		              <h2>Contactez-nous !</h2>
                          <p>Accédez au <a href="form_contact.php" alt="Contactez-nous">formulaire sécurisé</a>.</p>
		              </section>

		          </section>
		      </section>
        </section>
		
		<?php include("includes/x_footer.php"); ?>
		
	</body>
</html>