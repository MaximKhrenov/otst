<?
    require_once('common.php');
    
    if (!$_SESSION['userid'])
        echo $_SESSION['userid'];
    
    check_req(['by']);

    if ($request['by'] === 'id') {
        check_req(['id']);
        q("SELECT * FROM Product WHERE id_prod = $request[id]");
    }
?>