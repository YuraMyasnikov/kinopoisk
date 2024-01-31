<?php  /** @var \App\Kernel\Auth\AuthInterface $auth */ ?>

<?php

    $user = $auth->user(); ?>



<header>
<?php if ( $auth->check()){ ?>
    <h4> user: <?php echo $user->email()?></h4>
    <form action="/logout" method="post">
        <button>Log out</button>
    </form>

    <hr>
    <?php } ?>
</header>

