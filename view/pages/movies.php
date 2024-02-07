<?php include MAIN_PATH . '/view/components/start.php';
/**
 * @var array $data
 */
?>
<h1> Movies page! </h1>

<h1><?php echo $data['foo'] ?? 'dfgdfgdfg'?></h1>
<h1><?php echo $data['course']['usd'] ?> rub</h1>

<p>Новинки на число: <?php echo $data['date'] ?></p>

<?php foreach ($data['movies'] ?? [] as $movie) {?>

    <img style="width: 100%" src="<?php echo $movie['image']?>" alt="<?php $movie['name']?>">
    
<?php }?>
<?php include MAIN_PATH . '/view/components/end.php'?>