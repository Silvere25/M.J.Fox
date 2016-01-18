<header>
    <img src="images/Michael_J._Fox_2012.jpg" alt="mon portrait" id="portrait" />
    <h1><a href="https://fr.wikipedia.org/wiki/Michael_J._Fox" title="ma page wikipédia">Michael J. Fox</a></h1>					
    <p class="intro">alias Marty McFly</p>
    <p>né le 9 juin 1961</p>
    <p class="phead">
        <?php
        if ($_SESSION['login_active'] && isset($_COOKIE['login']))
        {
            echo 'Salut ' . $_COOKIE['login'] . ' !';
        }
        ?>
    </p>
</header>