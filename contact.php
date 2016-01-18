<?php
session_start();
$_SESSION['active_page']="contact";
include("includes/x_com.php");
?>
<!DOCTYPE html>
<html>
	<head>
        <?php include("includes/x_head.php"); ?>
		<title>Your Contact Form</title>
	</head>

	<body>
        
        <p>
            <?php
            if (isset($_POST['sexe']) && isset($_POST['nom']) && isset($_POST['prenom']))
            {
                echo $_POST['sexe'] . ' ' . htmlspecialchars($_POST['prenom']) . ' ' . htmlspecialchars($_POST['nom']) . '<br />email : ' . htmlspecialchars($_POST['email']);
            }
            else
            {
                echo 'Vous avez omis de remplir un champ de vos coordonnées.';
            }    
            ?>
            <br/>
            <?php
            if (isset($_POST['objet']) && isset($_POST['contenu_message']))
            {
                echo '<em>' . htmlspecialchars($_POST['objet']) . '</em><br/>' . htmlspecialchars($_POST['contenu_message']);
            }
            else
            {
                echo 'Vous avez omis de remplir des éléments de votre message.';
            }
            ?>
            <br/>
            <?php
            function stripAccents($texte)
            {
                $texte = str_replace(
                    array(
                        'à', 'â', 'ä', 'á', 'ã', 'å',
                        'î', 'ï', 'ì', 'í', 
                        'ô', 'ö', 'ò', 'ó', 'õ', 'ø', 
                        'ù', 'û', 'ü', 'ú', 
                        'é', 'è', 'ê', 'ë', 
                        'ç', 'ÿ', 'ñ',
                        'À', 'Â', 'Ä', 'Á', 'Ã', 'Å',
                        'Î', 'Ï', 'Ì', 'Í', 
                        'Ô', 'Ö', 'Ò', 'Ó', 'Õ', 'Ø', 
                        'Ù', 'Û', 'Ü', 'Ú', 
                        'É', 'È', 'Ê', 'Ë', 
                        'Ç', 'Ÿ', 'Ñ', '°',
                    ),
                    array(
                        'a', 'a', 'a', 'a', 'a', 'a', 
                        'i', 'i', 'i', 'i', 
                        'o', 'o', 'o', 'o', 'o', 'o', 
                        'u', 'u', 'u', 'u', 
                        'e', 'e', 'e', 'e', 
                        'c', 'y', 'n', 
                        'A', 'A', 'A', 'A', 'A', 'A', 
                        'I', 'I', 'I', 'I', 
                        'O', 'O', 'O', 'O', 'O', 'O', 
                        'U', 'U', 'U', 'U', 
                        'E', 'E', 'E', 'E', 
                        'C', 'Y', 'N', '_',
                    ),$texte);
                return $texte;
            }
            
            if (isset($_FILES['pj']))
            {
                if ($_FILES['pj']['error']==0)
                {
                    if ($_FILES['pj']['size']<=1048576)
                    {
                        $fileinfo = pathinfo($_FILES['pj']['name']);
                        $filetype = $fileinfo['extension'];
                        $authorizedtypes = array('doc', 'docx', 'odt', 'rtf', 'txt');
                        $_FILES['pj']['name'] = htmlspecialchars(stripAccents(basename($_FILES['pj']['name'])));
                        if (in_array($filetype, $authorizedtypes))
                        {
                            /* ne pas oublier de donner les droits d'accès au répertoire sur le serveur ! */
                            move_uploaded_file($_FILES['pj']['tmp_name'], 'uploads/' . $_FILES['pj']['name']);
                            echo 'Le fichier ' . $_FILES['pj']['name'] . ' a bien été transféré !';
                        }
                        else
                        {
                            echo 'Le type du fichier n\'est pas autorisé.';
                        }
                    }
                    else
                    {
                        echo 'Le fichier déposé dépasse la taille limite.';
                    }
                }
                else
                {
                    echo 'L\'upload du fichier présente l\'erreur ' . $_FILES['pj']['error'] . '.';
                }
            }
            else
            {
                echo 'Aucun fichier n\'a été déposé.';
            }
            ?>
        </p>
        
    </body>
</html>