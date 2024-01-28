<?php /** @var \App\Kernel\View\View $view */?>
<?php /** @var \App\Kernel\Session\Session $session */?>

<?php $view->component('start');?>

<h1>Добавление фильма</h1>
<form action="/admin/movie/add" method="post">
    <label for="name">Название фильма</label>
    <div><input name="name" type="text"></div>

    <!-- проверяю есть ли в сессии ошибка с таким названием name -->
    <?php if ($session->has('name')){ ?>
    <div>
        <ul>
            <!-- обхожу значение и вывожу каждую ошибку -->
            <?php foreach ($session->getFlash('name') as $error){?>
            <li style="color: red"><?= $error ?></li>
            <?php }?>
        </ul>
    </div>
    <?php } ?>
    <div><button type="submit"> Добавить</button></div>
</form>
<?php $view->component('end');?>

