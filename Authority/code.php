<?php
    require($_SERVER['DOCUMENT_ROOT'].'/config/config.php');
    require(APP_PATH.'config/fileupload.php');
    require(APP_PATH.'config/helper.php');
    // require(APP_PATH.'config/smsApi.php');
    require(APP_PATH.'config/newSmsApi.php');
    require(APP_PATH.'models/Model.php');
    $db = new Model;

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if ($_REQUEST['flag'] == "authority_login") {
            if (!empty($_POST['username']) && !empty($_POST['password'])) {
                $valid = $db->select('admin_user', ['email' => strtolower($_POST['username']), 'password' => md5($_POST['password'])]);

                if ($valid > 0) {
                    $_SESSION['authority'] = $valid['id'];
                    echo "success";
                }else {
                    echo "invalid";
                }
            }
            else {
                echo "required";
            }
        }
        else if ($_REQUEST['flag'] == "active") {
            $status = $db->select('agency_daily_data', ['id' => $_POST['id']]);
            if ($status['status'] == 1) {
                $db->update('agency_daily_data', ['status' => 0], ['id' => $_POST['id']]);
                echo "success";
            }
            else {
                $db->update('agency_daily_data', ['status' => 1], ['id' => $_POST['id']]);
                echo "success";
            }
        }
        else if ($_REQUEST['flag'] == "category") {
            $value1 = $db->select('authority', ['user_id' => $_SESSION['authority'], 'authority' => 'Category']);
                if ($value1['edit1'] == 'Yes') {
            if (!empty($_POST['category'])) {
                $id = "ID".rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
                $data = array(
                    "id" => $id,
                    "category" => $_POST['category'],
                    "image" => $_FILES['image1']['name'],
                    "banner" => $_FILES['banner1']['name'],
                    "date" => date('Y:m:d H:i:s')
                );
                if (file_upload('image1', null, 'Admin/uploads/category/') == true && file_upload('banner1', null, 'Admin/uploads/banner/') == true) {
                    $db->insert('category', $data);
                    echo "success";
                }else {
                    echo "file-error";
                }
            }else {
                echo "required";
            }
        }else{
                echo "Not View";
        }
    }
         
        else if ($_REQUEST['flag'] == "service") {
            $value1 = $db->select('authority', ['user_id' => $_SESSION['authority'], 'authority' => 'Category']);
                if ($value1['edit1'] == 'Yes') {
            if (!empty($_POST['category']) && !empty($_POST['service'])) {
                $id = "ID".rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
                $data = array(
                    "id" => $id,
                    "category" => $_POST['category'],
                    "service" => $_POST['service'],
                    "image" => $_FILES['image']['name'],
                    "banner" => $_FILES['banner']['name'],
                    "date" => date('Y:m:d H:i:s')
                );
                if (file_upload('image', null, 'Admin/uploads/service/') == true && file_upload('banner', null, 'Admin/uploads/banner/') == true) {
                    $db->insert('service', $data);
                    echo "success";
                }else {
                    echo "file-error";
                }
            }else {
                echo "required";
            }
        }else{
                echo "Can not update";

        }
    }
        else if ($_REQUEST['flag'] == "agent-area") {
            if (!empty($_POST['state']) && !empty($_POST['district']) && !empty($_POST['area'])) {
                $valid = $db->select('agent_area', ['ag_id' => $_POST['id']]);
                $data = array(
                    "ag_id" => $_POST['id'],
                    "area" => $_POST['area'],
                    "district" => $_POST['district'],
                    "state" => $_POST['state']
                );

                if ($valid == 0) {
                    $db->insert('agent_area', $data);
                    echo "success";
                }else {
                    $db->update('agent_area', $data, ["ag_id" => $_POST['id']]);
                    echo "success";
                }
            }else {
                echo "required";
            }
        }

         else if ($_REQUEST['flag'] == "addNews") {
            if (!empty($_POST['heading']) && !empty($_POST['category']) && !empty($_POST['description'])) {
                // $id = "ID".rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
                $data = array(
                    // "id" => $id,
                    "category" => $_POST['category'],
                    "heading" => $_POST['heading'],
                    "description" => $_POST['description'],
                    "postedBy" => $_POST['posted'],
                    "url" => $_POST['url'],
                    "image1" => $_FILES['image1']['name'],
                    "image2" => $_FILES['image2']['name'],
                );
                if (file_upload('image1', null, 'Admin/uploads/') == true && file_upload('image2', null, 'Admin/uploads/') == true) {
                    $db->insert('news', $data);
                    echo "success";
                }else {
                    echo "file-error";
                }
            }else {
                echo "required";
            }
        }
        else if ($_REQUEST['flag'] == "addNewsCategory") {
            if (!empty($_POST['category'])) {
                // $id = "ID".rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
                $data = array(
                    // "id" => $id,
                    "category" => $_POST['category'],
                    "date" =>date("Y:m:d H:i:s")
                );
                if ($db->insert('news_category', $data)) {
                    echo "success";
                } 
            }else {
                echo "required";
            }
        }
         else if ($_REQUEST['flag'] == "subadmin") {
            if (!empty($_POST['insert_user']) && !empty($_POST['update_user']) && !empty($_POST['delete_user']) && !empty($_POST['select_user'])) {
                $valid = $db->select('role', ['id' => $_POST['user_id']]);

                $data = array(
                  
                    "insert_user" => $_POST['insert_user'],
                    "update_user" => $_POST['update_user'],
                    "delete_user" => $_POST['delete_user'],
                    "select_user" => $_POST['select_user']
                );

                    $db->update('role', $data, ["id" => $_POST['user_id']]);
                    echo "success";
             
            }else {
                echo "required";
            }
        }
		else if ($_REQUEST['flag'] == "city") {
            $value1 = $db->select('authority', ['user_id' => $_SESSION['authority'], 'authority' => 'Location']);
                // print_r($value1);
                if ($value1['edit1'] == 'Yes') {
            if (!empty($_POST['district']) && !empty($_POST['state'])) {
                $data = array(
                    "state" => $_POST['state'],
                    "district" => $_POST['district']
                );
                $result = json_encode($data);

                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://api.upgradeads.in/addarea',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $result,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json',
                    'Cookie: PHPSESSID=13f70958fda8f9679797afff6bce38d6'
                ),
                ));

                $response = curl_exec($curl);
                curl_close($curl);
                $res = json_decode($response, true);
                echo $res['message'];
            }else {
                echo "required";
            }
        }else{
                echo "Can't Update";

        }
    }
        else if ($_REQUEST['flag'] == "plan") {
            if (!empty($_POST['plan']) && !empty($_POST['plan'])) {
                $data = array(
                    "plan" => $_POST['plan']
                );
                $db->update('users', $data, ['id' => $_POST['id']]);
                echo "success";
            }else {
                echo "required";
            }
        }
        else if ($_REQUEST['flag'] == "approve") {
            if (!empty($_POST['id'])) {
                $agent = $db->select('agent_data', ['ag_id' => $_POST['id']]);

                if ($agent['status'] == "Pending") {
                    $contact = $db->select('agent_contact', ['ag_id' => $_POST['id']]);
                    $password = rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);

                    $data = array(
                        "id" => $agent['ag_id'],
                        "number" => $contact['ag_number'],
                        "email" => $contact['ag_email'],
                        "password" => md5($password),
                        "date" => date('Y:m:d H:i:s')
                    );

                    
                    $message = "Hi! Welcome to Kamgaro. Your login Password is ".$password.". To login visit http://kamgaro.com/Agent/.";
                    if (sms($contact['ag_number'], $message) == true) {
                        $db->remove('agent_login', ['id' => $agent['ag_id']]);
                        $db->insert('agent_login', $data);
                        $db->update('agent_data', ['status' => 'Verified'], ['ag_id' => $agent['ag_id']]);
                        echo "success";
                    }else {
                        echo "not-send";
                    }
                }else {
                    $db->update('agent_data', ['status' => 'Pending'], ['ag_id' => $agent['ag_id']]);
                    echo "success";
                }
            }else {
                echo "required";
            }
        }
        else if ($_REQUEST['flag'] == "agency") {
            if (!empty($_POST['name']) && !empty($_POST['number']) && !empty($_POST['email'])) {
                $valid_email = $db->num_row('agency', ['email' => $_POST['email']]);
                $valid_number = $db->num_row('agency', ['number' => $_POST['number']]);
                if ($valid_email == 0 && $valid_number == 0) {
                    $password = rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
                    $id  =rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
                    $valid = $_POST['number'];
                    $data = array(
                        "id" => $id,
                        "name" => $_POST['name'],
                        "number" => $_POST['number'],
                        "email" => $_POST['email'],
                        "area" => $_POST['area'],
                        "district" => $_POST['district'],
                        "state" => $_POST['state'],
                        "password" => md5($password),
                        "status" => 1,
                        "date" => date('Y:m:d H:i:s')
                    );

                    $subadmin = array(
                        "user_id" => $id,
                        "user_pass" => $password,
                        "usertype" => "Agency",
                    );
                    $message = "Hi! Welcome to Kamgaro. Your login Password is ".$password.". To login visit http://kamgaro.com/Agency/.";
                    if (sms($valid, $message, '1707162531214988345') == true) {
                        $db->insert('agency', $data);
                        $db->insert('subadmin', $subadmin);
                        echo "success";
                    }else {
                        echo "Something went wrong";
                    }
                }else {
                    echo "Already registered";
                }
            }else {
                echo "All fields required";
            }
        }
        else if ($_REQUEST['flag'] == "admin_user") {
            if (!empty($_POST['name']) && !empty($_POST['number']) && !empty($_POST['email']) && !empty($_POST['designation'])) {
                $valid_email = $db->num_row('admin_user', ['email' => $_POST['email']]);
                $valid_number = $db->num_row('admin_user', ['number' => $_POST['number']]);
                $valid= $db->select('admin_user', ['number' => $_POST['number']]);
                if ($valid_email == 0 && $valid_number == 0) {
                    $password = rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
                    $id  ="AU".rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
                    $data = array(
                        "id" => $id,
                        "name" => $_POST['name'],
                        "number" => $_POST['number'],
                        "email" => $_POST['email'],
                        "designation" => $_POST['designation'],
    
                        "password" => md5($password)
                    );

                 
                    $message = "Hi! Welcome to Kamgaro. Your login Password is ".$password.". To login visit http://kamgaro.com/.";
                    if (sms($_POST['number'], $message) == true) {
                        $db->insert('admin_user', $data);
                      //  $db->insert('subadmin', $subadmin);
                        echo "success";
                    }else {
                        echo "Something went wrong";
                    }
                }else {
                    echo "Already registered";
                }
            }else {
                echo "All fields required";
            }
        }
        else if ($_REQUEST['flag'] == "allow_service") {
            $value1 = $db->select('authority', ['user_id' => $_SESSION['authority'], 'authority' => 'Service List']);
            if ($value1['edit1'] == 'Yes') {
            $db->remove('allow_service', null);
            if (isset($_POST['service'])) {
                foreach($_POST['service'] as $row) {
                    $db->insert('allow_service', ['id' => $row]);
                }
                echo "success";
            }
            else {
                echo "success";
            }
        }else{
            echo "Not eligible";
        }
    }
        else {
            echo "required";
        }
    }
    else {
        echo "required";
    }
?>