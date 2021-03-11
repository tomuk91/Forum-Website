<?php include('../private/init.php'); ?>








<?php include_once(SHARED_PATH . '/header.php'); ?>

<div class="banner">
        <div class="banner_text">
            <h1>Create, Discuss & Marvel</br> In All Things Games</h1>
            <h5>Not Registered? Sign up here:</h5>
            <p><a href="<?php echo url_to('/register.php'); ?>">Register</a></p>
        </div>
</div>


<div class="tile_container">
    <div class="tiles">
        <div class="tile-1">
            <h2>Create Topics</h2>
            <img src="<?php echo url_to('/images/create.jpg')?>" alt="big bang image">
            <p>Create new discussions and see the world of<br> possiblities in dialogue</p>
        </div>
        <div class="tile-2">
             <h2>Share Views</h2>
            <img src="<?php echo url_to('/images/share.jpg')?>" alt="gaming poster">
            <p>Share your views with other liked minded people</p>
        </div>
        <div class="tile-3">
            <h2>Enjoy</h2>
            <img src="<?php echo url_to('/images/enjoy.jpg')?>" alt="the joker">
            <p>Share your views with other liked minded people</p>
        </div>
    </div>
</div>


<?php include_once(SHARED_PATH . '/footer.php'); ?>

  