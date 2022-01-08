<?php
    require($_SERVER['DOCUMENT_ROOT'].'/config/config.php');
    require(APP_PATH.'config/helper.php');
    require(APP_PATH.'models/Model.php');
    $db = new Model;

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if ($_REQUEST['flag'] == "users") {
            $result = $db->select('users', ['id' => $_POST['id']]);
            $cate = $db->select('category', ['id' => $result['category']]);
            $data = array(
                "id" => $result['id'],
                "name" => ucwords($result['name']),
                "number" => $result['number'],
                "email" => $result['email'],
                "gender" => $result['gender'],
                "business" => $result['business'],
                "profile" => img(['Vendor/uploads/profile/'.$result['profile'], 'show-img'])
            );
            echo json_encode($data);
            exit;
        }
        else if ($_REQUEST['flag'] == "news") {
            $result = $db->select('news', ['id' => $_POST['id']]);
            $data = array(
                "id" => $result['id'],
                "heading" => $result['heading'],
                "description" => $result['description'],
                "image1" => $result['image1'],
                "image2" => $result['image2'],
                "postedBy" => $result['postedBy']

            );
            echo json_encode($data);
            exit;
        }
        else if ($_REQUEST['flag'] == "customer") {
            $result = $db->select('registration', ['id' => $_POST['id']]);

            $data = array(
                "id" => $result['id'],
                "name" => ucwords($result['name']),
                "number" => $result['number'],
                "email" => $result['email'],
                "address" => $result['address'],
                "profile" => img(['Customer/picture/'.$result['profile'], 'show-img'])
            );
            echo json_encode($data);
            exit;
        }
        else if ($_REQUEST['flag'] == "freelancer") {
            $result = $db->select('freelancer', ['fr_id' => $_POST['id']]);

            $data = array(
                "fr_id" => $result['fr_id'],
                "fr_name" => ucwords($result['fr_name']),
                "number" => $result['number'],
                "email" => $result['email'],
                "fr_address" => $result['fr_address'],
                "fr_profile" => img(['Freelancer/picture/'.$result['fr_profile'], 'show-img'])
            );
            echo json_encode($data);
            exit;
        }
        else if ($_REQUEST['flag'] == "agent") {
            $result = $db->select('agent_data', ['ag_id' => $_POST['id']]);
            $contact = $db->select('agent_contact', ['ag_id' => $_POST['id']]);

            $data = array(
                "id" => $result['ag_id'],
                "name" => ucwords($result['ag_name']),
                "number" => $contact['ag_number'],
                "email" =>  $contact['ag_email'],
                "gender" => $result['ag_gender'],
                "status" => $result['status'],
                "address" => $contact['ag_paddress'].' '.$contact['ag_city'].' '.$contact['ag_state'],
                "profile" => img(['Agent/picture/'.$result['ag_profile'], 'show-img']),
                "document" => base_url().'Agent/document/'.$result['ag_document']
            );
            echo json_encode($data);
            exit;
        }
        else if ($_REQUEST['flag'] == "role") {
            $result = $db->select('role', ['usertype' => $_POST['id']]);
         //   $contact = $db->select('agent_contact', ['ag_id' => $_POST['id']]);

            $data = array(
                "user_id" => $result['id'],
                "usertype" => ucwords($result['usertype']),
                "insert_user" => $result['insert_user'],
                "update_user" => $result['update_user'],
                "delete_user" => $result['delete_user'],
                "select_user" => $result['select_user']
            );
            echo json_encode($data);
            exit;
        }
        else if ($_REQUEST['flag'] == "category") {
            $result = $db->select('category', ['id' => $_POST['id']]);
            $data = array(
                "id" => $result['id'],
                "category" => $result['category']
            );
            echo json_encode($data);
            exit;
        }
        else if ($_REQUEST['flag'] == "product_category") {
            $result = $db->select('product_category', ['id' => $_POST['id']]);
            $data = array(
                "id" => $result['id'],
                "category" => $result['category']
            );
            echo json_encode($data);
            exit;
        }
        else if ($_REQUEST['flag'] == "service") {
            $result = $db->select('service', ['id' => $_POST['id']]);
            $data = array(
                "id" => $result['id'],
                "category" => $result['category'],
                "service" => $result['service']
            );
            echo json_encode($data);
            exit;
        }
		else if ($_REQUEST['flag'] == "city") {
            $result = $db->select('location', ['id' => $_POST['id']]);
            $data = array(
                "id" => $result['id'],
                "city" => $result['location']
            );
            echo json_encode($data);
            exit;
        }
        else if ($_REQUEST['flag'] == "agency") {
            $html = ""; $count = 0;
            $result = $db->Query("select * from agency where date >= '".$_POST['data']."' and date <= '".$_POST['data']."'");
            foreach ($result as $row) {
                $count++;
                $html.= '<tr>
                    <td>'.$count.'</td>
                    <td>'.$row['name'].'</td>
                    <td>'.$row['number'].'</td>
                    <td>'.$row['area'].'</td>
                    <td>'.$row['district'].'</td>
                    <td>'.$row['state'].'</td>';
                    if ($row['status'] == 1) {
                        $html.= '<td><span id="'.$row['id'].'" onclick="action(this)" class="open">Active</span></td>';
                    }else {
                        $html.= '<td><span id="'.$row['id'].'" onclick="action(this)" class="disabled">Blocked</span></td>';
                    }
                    $html.= '<td>'.date_format(date_create($row['date']), 'd-M-Y h:i A').'</td>
                    <td>
                        <a href="'.site_url("Authority/login")."?acid=".$row['id'].'" class="fa fa-eye text-success" style="font-size: 20px;"></a>
                        <a id="'.$row['id'].'" onclick="remove(this)" class="fa fa-close text-danger" style="font-size: 20px; padding-left: 3px;"></a>
                    </td>
                </tr>';
            }
            echo $html;
        }
        else {
            echo "required";
        }
    }
    else {
        echo "required";
    }
?>