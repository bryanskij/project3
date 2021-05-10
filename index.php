<?

header('Content-Type: text/html; charset=utf-8');
header("Cache-control: public");
header("Expires: " . gmdate("D, d M Y H:i:s", time() + 60*60*24*30) . " GMT");


$page = array(
    'mode' => 'site',
    'template' => 'main'
);

if($_SERVER['REQUEST_URI'] == '/request'){
    $page['mode'] = 'ajax';
    $return['status'] = 1;

    $email = mb_strtolower(trim($_POST['email']));
    if (preg_match('#^([\w]+\.?)+(?<!\.)@(?!\.)[\w\.-]+\.+[\w]{2,}$#ui', $email)) {
//    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $return['status'] = 2;

        require_once $_SERVER['DOCUMENT_ROOT'] . '/Db.class.php';
        $db = new Db(array(
            'host' => 'localhost',
            'user' => 'root',
            'password' => 'root',
            'database' => 'project3'
        ));

        $count = 0;
        $user = $db->query('SELECT * FROM users WHERE u_email = "' . addslashes($email) . '" LIMIT 1');
        if(is_array($user)){
            if(empty($user)){
                ++$count;

                $email_id = $db->insert('users', array(
                    'u_email' => $email,
                    'u_count' => $count
                ));
                if($email_id){
                    logged($db, $email_id);
                }
            } else {
                $count = ++$user[0]['u_count'];
                $is_good = $db->update('users', array(
                    'u_count' => $count
                ), array(
                    'u_email' => $email
                ));
                if($is_good){
                    logged($db, $user[0]['u_id']);
                }
            }
        }

        $return['text'] = $email . ' => ' . $count;
    } else {
        $return['status'] = 3;
    }

    echo json_encode($return, JSON_UNESCAPED_UNICODE);
}

if($page['mode'] == 'site') {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/smarty-3.1.33/libs/Smarty.class.php';
    $smarty = new Smarty();
    $smarty->assign('page', $page);
    $smarty->display('template.tpl');
}

function logged($db, $email_id){
    $db->insert('log', array(
        'l_email_id' => $email_id,
        'l_date' => date('Y-m-d H:i:s'),
        'l_user_data' => addslashes(json_encode(array(
            'ip' => $_SERVER['REMOTE_ADDR'],
            'useragent' => $_SERVER['HTTP_USER_AGENT']
        ), JSON_UNESCAPED_UNICODE))
    ));
}