<?php /** @var \App\Kernel\View\View $view */?>
<?php /** @var \App\Kernel\Session\Session $session */?>

<?php $view->component('start');?>
<h1>Добавление фильма</h1>
<form action="/admin/movie/add" method="post">
    <label for="name">Название фильма</label>
    <div><input name="name" type="text"></div>
    <?php if ($session->has('name')){ ?>
    <div>
        <ul>
            <?php foreach ($session->getFlash('name') as $error){?>
            <li style="color: red"><?= $error ?></li>
            <?php }?>
        </ul>
    </div>
    <?php } ?>
    <div><button type="submit"> Добавить</button></div>
</form>
<?php $view->component('end');?>

