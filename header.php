<html id="section1" lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=yes">
    <?php wp_head();?>

    <title>Test-3</title>
</head>
<header class="header">
<?php if (isset($_GET['search'])):
    $search = $_GET['search'];
endif;
?>
    <a href="http://test3.local/" class="header__logo">iLookup</a>
      <nav>
        <ul class="header__menu">
          <li class="header__menu-item"><a href="http://test3.local/" class="header__menu-link">Home</a></li>
          <li class="header__menu-item"><a href="https://www.youtube.com/watch?v=xvFZjo5PgG0" class="header__menu-link">Meme</a></li>
          <li class="header__menu-item"><a href="http://test3.local/spaces/" class="header__menu-link">Spaces</a></li>
          <li class="header__menu-item"><a href="http://test3.local/contact/" class="header__menu-link">Contact</a></li>
          <li class="header__menu-item" onclick="location.reload()"><a href="">Click to see recent about: <?= $search ?></a></li>
        </ul>
      </nav>

      
</header>
<body <?php body_class(); ?>>
    



    
