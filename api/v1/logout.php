<?
    require_once('common.php');

    if (isset($_SESSION['userid']))
        unset($_SESSION['userid']);

    response(200, 'OK');
?>