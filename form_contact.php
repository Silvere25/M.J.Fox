<?php include("includes/x_com.php"); ?>
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
		              <h2>Votre message</h2>
			<!-- traitement du contact à créer en PHP -->
			<form method="post" action="contact.php" enctype="multipart/form-data">
				<fieldset>
					<legend>Vos coordonnées</legend>
					<p>
					<input type="radio" name="sexe" value="Madame" id="madame" /> <label for="madame">Mme</label>
					<input type="radio" name="sexe" value="Monsieur" id="monsieur" /> <label for="monsieur">Mr</label>
					</p>
					<p><label for="nom">Votre nom</label></p>
					<input type="text" name="nom" id="nom" size="80" required />
					<p><label for="prenom">Votre prénom</label></p>
					<input type="text" name="prenom" id="prenom" size="80" required />
					<p><label for="email">Votre adresse e-mail</label></p>
					<input type="email" name="email" id="email" size="80" required />
				</fieldset>
				
				<fieldset>
					<legend>Votre message</legend>
					<p><label for="objet">Objet</label></p>
					<input type="text" name="objet" id="objet" size="80" required />
					<p><label for="message">Votre message</label></p>
					<textarea name="contenu_message" id="message" rows="20" cols="80"></textarea>
                    <p><label for="pj">Votre document (au format .doc, .docx, .odt, .rtf ou .txt) - Taille max : 1 Mo.</label></p>
                    <input type="file" name="pj" id="pj" />
				</fieldset>
				
				<p id="envoyer"><input type="submit" value="envoyer" class="bouton" title="page en cours de création"/></p>
				
			</form>
		
		              </section>
		          </section>
		      </section>
        </section>
		
		<?php include("includes/x_footer.php"); ?>
		
	</body>
</html>