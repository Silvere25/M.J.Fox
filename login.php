<?php
session_start();
include("includes/x_com.php");

if (isset($_POST['login']))
{
    $_SESSION['login']= htmlspecialchars($_POST['login']);
    $_POST['mdp'] = htmlspecialchars($_POST['mdp']);
    if ($_SESSION['login']=="silvere" && $_POST['mdp']=="kangourou")
    {
        $_SESSION['login_active']=true;
        setcookie('login',$_SESSION['login'],time() + 365*24*3600,null,null,false,true);
        echo "<script>window.location = './form_contact.php'</script>";
    }
    else
    {
        $_SESSION['login_active']=false;
        echo "<script>window.location = " . "\"" . $_SESSION['active_page'] . "#bas" . "\"</script>";
    }
}
?>