<?

    require_once('common.php');
    header("Content-type: application/json");

    $users = [
        'admin' => get_hash("0000")
    ];

    if (!array_key_exists("UserName", $request) || !array_key_exists("Password", $request))
       response(400, 'Bad Request');
    else if (!array_key_exists($request['UserName'], $users))
        response(101, 'User not found');
    else if ($users[$request['UserName']] !== get_hash($request['Password']))
        response(102, 'Wrong Password');
    else 
        response(200, 'Ok', true);
?>