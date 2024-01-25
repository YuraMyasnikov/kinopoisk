<?php /** @var \App\Kernel\View\View $view */?>
<?php /** @var \App\Kernel\Session\Session $session */?>

<?php $view->component('start');?>
<h1>Добавление фильма</h1>
<form action="/admin/movie/add" method="post">
    <label for="name_movie">Название фильма</label>
    <div><input name="name_movie" type="text"></div>
    <?php if ($session->has('name_movie')){ ?>
    <div>
        <ul>
            <?php foreach ($session->getFlash('name_movie') as $error){?>
            <li style="color: red"><?= $error ?></li>
            <?php }?>
        </ul>
    </div>
    <?php } ?>
    <div><button type="submit"> Добавить</button></div>
</form>
<?php $view->component('end');?>

