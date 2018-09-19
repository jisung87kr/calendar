<?php
$filename = basename($_SERVER['PHP_SELF']);
switch ($filename) {
    case 'write.php':
        $title = '일정등록';
    break;

    default:
        $title = '일정관리 서비스';
    break;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title><?php echo $title?></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="./css/master.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="./js/master"></script>
    </head>
     <body>
