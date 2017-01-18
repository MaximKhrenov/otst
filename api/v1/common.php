<?
    header("Content-type: application/json");
    
    require_once('../../common.php');

    $raw_request = file_get_contents('php://input');
    $request = json_decode($raw_request, true);


    function unauthorized() {
        response(401, 'Unauthorized');
    }
    function bad_req() {
        response(400, 'Bad request');
    }

    function response($status, $message, $is_log_in=false) {
        global $request;
        $answer = [
            'Status' => $status,
            'Message' => $message
        ];

        if ($is_log_in)
            $_SESSION['userid'] = $request['UserName'];
   
        $json = json_encode($answer);
        echo $json;

        exit();
    }
    function check_req($options) {
        global $request;
        foreach($options as $option) {
            if (!array_key_exists($option, $request))
                bad_req();
        }
    }

    function q($sql) {
        global $conn;
        $query = mysqli_query($conn, $sql);
        if (mysqli_error($conn))
            response(400, $sql."->".mysqli_error($conn));
        
        if (!(gettype($query) === gettype(true))) {
            $result = [];            
            while ($row = mysqli_fetch_assoc($query))
                $result[] = $row;
            
            if (count($result) === 1)
                $result = $result[0];
        } else {
            $result = $query;
        }


        echo json_encode($result);

    }

    if ($request === null)
        bad_req();
?>