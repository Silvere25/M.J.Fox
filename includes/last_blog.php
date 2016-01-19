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

// exécution de la requête sélection des 5 derniers blogs
    $req = $bdd->query('SELECT id, title, article, author_pseudo, DATE_FORMAT(insert_date,"%d/%m/%Y à %Hh%im%ss") AS date FROM blog ORDER BY insert_date DESC, id DESC LIMIT 0,5');

// affichage du résultat
    while ($data = $req->fetch())
    {
        echo '<fieldset><legend><em>' . htmlspecialchars($data['author_pseudo']) . '</em> a écrit le ' . $data['date'] . '</legend><p><strong>' . htmlspecialchars($data['title']) . '</strong><br />' . nl2br(htmlspecialchars($data['article'])) . '</fieldset>';
        
        $req_c = $bdd->prepare('SELECT COUNT(*) AS count FROM blog_comments WHERE id_blog = ?');
        $req_c->execute(array($data['id']));
        $count = $req_c->fetch();
        
        if ($count['count']!=0)
        {
            echo '<p style="text-align:right"><em>'. $count['count'] . ' <a href="comment_blog.php?id_blog=' . $data['id'] . '" alt="lien vers les commentaires" title="consultez les commentaires" >commentaire(s)</a> pour cet article.</em></p>';
        }
        else
        {
            echo '<p style="text-align:right"><em>Pas encore de <a href="comment_blog.php?id_blog=' . $data['id'] . '" alt="lien vers les commentaires" title="consultez les commentaires" >commentaires</a>  pour cet article.</em></p>';
        }
    }

    $req->closeCursor();
    $req_c->closeCursor();

?>