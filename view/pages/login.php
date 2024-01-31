<?php /** @var \App\Kernel\View\ViewInterface $view */ ?>
<?php /** @var \App\Kernel\Session\SessionInterface $session */ ?>

<?php include MAIN_PATH . '/view/components/start.php'?>

    <h1> Авторизация! </h1>

    <div style="display:flex; justify-content:center" />
    <form action="/login" method="post" style="width: 30%;">
        <div class="input">
            <label for="email">Электронная почта</label>
            <input type="text" name="email" placeholder="Введи email@.ru">
           <!-- <?php /*if ($session->has('email')){*/?>
                <ul>
                    <?php /*foreach ($session->getFlash('email') as $error) {*/?>
                        <li style="color: red"> <?php /*echo $error */?> </li>
                    <?php /*}*/?>
                </ul>
            --><?php /*}*/?>
        </div>

        <div class="input">
            <label for="password">Электронная почта</label>
            <input type="password" name="password" placeholder="Введи password">
            <?php /*if ($session->has('password')){*/?><!--
                <ul>
                    <?php /*foreach ($session->getFlash('password') as $error) {*/?>
                        <li style="color: red"> <?php /*echo $error */?> </li>
                    <?php /*}*/?>
                </ul>
            --><?php /*}*/?>
        </div>

        <div style="padding-top: 15px; display: flex; justify-content: center;">
            <button type="submit" style="width: 30%;">Готово</button>
        </div>

    </form>
    </div>

<?php include MAIN_PATH . '/view/components/end.php'?>