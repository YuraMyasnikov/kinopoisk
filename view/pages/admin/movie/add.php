<?php /** @var \App\Kernel\View\View $view */?>

<?php $view->component('start');?>
<h1>Добавление фильма</h1>
<form action="/admin/movie/add" method="post">
    <label for="name_movie">Название фильма</label>
    <div><input name="name_movie" type="text"></div>
    <div><button type="submit"> Добавить</button></div>
</form>
<?php $view->component('end');?>

