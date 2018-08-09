<?php
    $phpversion_all = phpversion();
    $phpversion_split = preg_split('/\./', $phpversion_all)[0];

    if(!empty($_POST['php5'])){
        $select_php = 'php5';
    }elseif (!empty($_POST['php7'])){
        $select_php = 'php7';
    }else{
        $select_php = null;
    }

    if(!empty($select_php)){
        $x = exec('echo "'.$select_php.'" > /run/script/command_php.txt', $y, $i);
        if($i == 0){
            echo "Changement de version de php en cours";
            $refresh = true;
        }else{
            echo "error";
        }
    }

?>

<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php if(!empty($refresh) && $refresh === true): ?>
        <meta http-equiv="refresh" content="10">
    <?php endif; ?>
    <title>Configuration</title>
</head>
<body>
    <h1><?= $phpversion_all ?></h1>
    <hr>
    <form method="post">
        <?php if ($phpversion_split === '5'): ?>
            <input type="submit" value="php 5" disabled/>
            <input type="submit" name="php7" value="php 7"/>
        <?php elseif ($phpversion_split === '7'): ?>
            <input type="submit" name="php5" value="php 5"/>
            <input type="submit" value="php 7" disabled/>
        <?php endif; ?>
    </form>
    <hr>
</body>
</html>

<?php
    phpinfo();
?>