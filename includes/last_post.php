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

// exécution de la requête sélection des 10 derniers posts
    $req = $bdd->query('SELECT pseudo, message, DATE_FORMAT(insert_date,"%d/%m/%Y à %Hh%im%ss") AS date FROM chat ORDER BY insert_date DESC LIMIT 0,10');

// affichage du résultat
    while ($data = $req->fetch())
    {
        echo '<p><em>' . htmlspecialchars($data['pseudo']) . '</em> a écrit le ' . $data['date'] . ' :<br /><strong>' . htmlspecialchars($data['message']) . '</strong></p>';
    }

    $req->closeCursor();

?>