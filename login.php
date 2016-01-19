<?php
session_start();
include("includes/x_com.php");
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=mjfox;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

$req = $bdd->query('SELECT login, password FROM users');

if (isset($_POST['login']))
{
    $_SESSION['login']= htmlspecialchars($_POST['login']);
    $_POST['mdp'] = htmlspecialchars($_POST['mdp']);
    while ($data=$req->fetch())
    {
        if ($_SESSION['login']==$data['login'] && $_POST['mdp']==$data['password'])
        {
            $_SESSION['login_active']=true;
            setcookie('login',$_SESSION['login'],time() + 365*24*3600,null,null,false,true);
            echo "<script>window.location = 'fan_page.php'</script>";
            break;
        }
        else
        {
            $_SESSION['login_active']=false;
        }
    }
    if ($_SESSION['login_active']==false)
    {
        echo "<script>window.location = " . "\"" . $_SESSION['active_page'] . "#bas" . "\"</script>";
    }
}

$req->closeCursor();

?>