<?
    session_start();
    require_once('settings.php');
    
    $conn = mysqli_connect(DB_ADRESS, DB_LOGIN, DB_PSWD, DB_NAME);

    function get_hash($val) {
        for ($i = 0; $i < 1000; $i++) 
            $val = hash("sha256", $val);
        return $val;
    } 
?>