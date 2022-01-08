<?php
    require($_SERVER['DOCUMENT_ROOT'].'/config/config.php');
    require(APP_PATH.'config/helper.php');
    require(APP_PATH.'models/Model.php');
    $db = new Model;

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if ($_REQUEST['flag'] == "area") {
            if (!empty($_POST['data'])) {
                $area = array();
                $data = $db->location1('users_address', ['district' => $_POST['data']]);

                foreach ($data as $row) {
                    $area[] = array(
                        "area" => $row['area']
                    );
                }

                echo json_encode($area);
            }
        }
        else if ($_REQUEST['flag'] == "user-area") {
            if (!empty($_POST['data'])) {
                $area = array(); $dist = $_POST['data'];
                $data = $db->Query("select distinct address from registration where district = '$dist'");

                foreach ($data as $row) {
                    $area[] = array(
                        "area" => $row['address']
                    );
                }

                echo json_encode($area);
            }
        }
        else if ($_REQUEST['flag'] == "agent-area") {
            if (!empty($_POST['data'])) {
                $area = array();
                $data = $db->location1('agent_area', ['district' => $_POST['data']]);

                foreach ($data as $row) {
                    $area[] = array(
                        "area" => $row['area']
                    );
                }

                echo json_encode($area);
            }
        }
        else if ($_REQUEST['flag'] == "filter-state") {
            $tr = null;
            $address = $db->select_row('users_address', ['state' => $_POST['data']]);

            foreach ($address as $row) {
                $j = 0; $all_service = "";
                $user = $db->select('users', ['id' => $row['id']]);
                $agent = $db->select('agent_data', ['ag_id' => $user['agent_id']]);
                $category = $db->select('category', ['id' => $user['category']]);
                $service = $db->select_row('users_service', ['id' => $user['id']]);

                foreach ($service as $key) {
                    $j++;
                    $subcate = $db->select('service', ['id' => $key['service']]);
                    if (sizeof($service) > $j) {
                        $all_service.= $subcate['service'].", ";
                    }else {
                        $all_service.= $subcate['service'];
                    }
                }
                $tr.= '<tr>
                        <td>'.$row['id'].'</td>
                        <td>'.ucwords($user['business']).'</td>
                        <td>'.ucwords($agent['ag_name']).'</td>
                        <td>'.$category['category'].'</td>
                        <td>'.$all_service.'</td>
                        <td>'.$row['district'].'</td>
                        <td>'.$user['plan'].'</td>
                        <td><a onclick="action(this)" id="'.$row['id'].'"><span class="action">'.$user['status'].'</span></a></td>
                        <td>
                            <a onclick="detail(this)" id="'.$row['id'].'"><img src="https://kamgaro.com/bootstrap/image/detail-icon.png" class="cate-image" /></a>
                            <a onclick="remove(this)" id="'.$row['id'].'"><img src="https://kamgaro.com/bootstrap/image/delete-icon.png" class="cate-image" /></a>
                        </td>
                        <td>'.date_format(date_create($user['date']), 'd-M-Y h:i A').'</td>
                    </tr>';
            }
            echo $tr;
        }
        else if ($_REQUEST['flag'] == "filter-district") {
            $tr = null;
            $address = $db->select_row('users_address', ['state' => $_POST['state'], 'district' => $_POST['data']]);

            foreach ($address as $row) {
                $j = 0; $all_service = "";
                $user = $db->select('users', ['id' => $row['id']]);
                $agent = $db->select('agent_data', ['ag_id' => $user['agent_id']]);
                $category = $db->select('category', ['id' => $user['category']]);
                $service = $db->select_row('users_service', ['id' => $user['id']]);

                foreach ($service as $key) {
                    $j++;
                    $subcate = $db->select('service', ['id' => $key['service']]);
                    if (sizeof($service) > $j) {
                        $all_service.= $subcate['service'].", ";
                    }else {
                        $all_service.= $subcate['service'];
                    }
                }
                $tr.= '<tr>
                        <td>'.$row['id'].'</td>
                        <td>'.ucwords($user['business']).'</td>
                        <td>'.ucwords($agent['ag_name']).'</td>
                        <td>'.$category['category'].'</td>
                        <td>'.$all_service.'</td>
                        <td>'.$row['district'].'</td>
                        <td>'.$user['plan'].'</td>
                        <td><a onclick="action(this)" id="'.$row['id'].'"><span class="action">'.$user['status'].'</span></a></td>
                        <td>
                            <a onclick="detail(this)" id="'.$row['id'].'"><img src="https://kamgaro.com/bootstrap/image/detail-icon.png" class="cate-image" /></a>
                            <a onclick="remove(this)" id="'.$row['id'].'"><img src="https://kamgaro.com/bootstrap/image/delete-icon.png" class="cate-image" /></a>
                        </td>
                        <td>'.date_format(date_create($user['date']), 'd-M-Y h:i A').'</td>
                    </tr>';
            }
            echo $tr;
        }
        else if ($_REQUEST['flag'] == "filter-area") {
            $tr = null;
            $address = $db->select_row('users_address', ['state' => $_POST['state'], 'district' => $_POST['dist'], 'area' => $_POST['data']]);

            foreach ($address as $row) {
                $j = 0; $all_service = "";
                $user = $db->select('users', ['id' => $row['id']]);
                $agent = $db->select('agent_data', ['ag_id' => $user['agent_id']]);
                $category = $db->select('category', ['id' => $user['category']]);
                $service = $db->select_row('users_service', ['id' => $user['id']]);

                foreach ($service as $key) {
                    $j++;
                    $subcate = $db->select('service', ['id' => $key['service']]);
                    if (sizeof($service) > $j) {
                        $all_service.= $subcate['service'].", ";
                    }else {
                        $all_service.= $subcate['service'];
                    }
                }
                $tr.= '<tr>
                        <td>'.$row['id'].'</td>
                        <td>'.ucwords($user['business']).'</td>
                        <td>'.ucwords($agent['ag_name']).'</td>
                        <td>'.$category['category'].'</td>
                        <td>'.$all_service.'</td>
                        <td>'.$row['district'].'</td>
                        <td>'.$user['plan'].'</td>
                        <td><a onclick="action(this)" id="'.$row['id'].'"><span class="action">'.$user['status'].'</span></a></td>
                        <td>
                            <a onclick="detail(this)" id="'.$row['id'].'"><img src="https://kamgaro.com/bootstrap/image/detail-icon.png" class="cate-image" /></a>
                            <a onclick="remove(this)" id="'.$row['id'].'"><img src="https://kamgaro.com/bootstrap/image/delete-icon.png" class="cate-image" /></a>
                        </td>
                        <td>'.date_format(date_create($user['date']), 'd-M-Y h:i A').'</td>
                    </tr>';
            }
            echo $tr;
        }
        else if ($_REQUEST['flag'] == "state-user") {
            $tr = null;
            $result = $db->select_row('registration', ['state' => $_POST['data']]);
			
            foreach($result as $row) {  
                $tr.= '<tr>
                        <td>'.$row['id'].'</td>
                        <td><a href="'.site_url('Authority/login').'?cid='.$row['id'].'" target="_blank">'.img(["../Customer/picture/".$row['profile'], 'cate-image']).'</a></td>
                        <td>'.ucwords($row['name']).'</td>
                        <td><a onclick="action(this)" id="'.$row['id'].'"><span class="action">'.$row['status'].'</span></a></td>
                        <td><a onclick="detail(this)" id="'.$row['id'].'"><img src="https://kamgaro.com/bootstrap/image/detail-icon.png" class="cate-image" /></a></td>
                        <td><a onclick="remove(this)" id="'.$row['id'].'"><img src="https://kamgaro.com/bootstrap/image/delete-icon.png" class="cate-image" /></a></td>
                        <td>'.date_format(date_create($row['date']), 'd-M-Y h:i A').'</td>
                    </tr>';
            }
            echo $tr;
        }
        else if ($_REQUEST['flag'] == "district-user") {
            $tr = null;
            $result = $db->select_row('registration', ['state' => $_POST['state'], 'district' => $_POST['data']]);
			
            foreach($result as $row) {    
                $tr.= '<tr>
                        <td>'.$row['id'].'</td>
                        <td><a href="'.site_url('Authority/login').'?cid='.$row['id'].'" target="_blank">'.img(["../Customer/picture/".$row['profile'], 'cate-image']).'</a></td>
                        <td>'.ucwords($row['name']).'</td>
                        <td><a onclick="action(this)" id="'.$row['id'].'"><span class="action">'.$row['status'].'</span></a></td>
                        <td><a onclick="detail(this)" id="'.$row['id'].'"><img src="https://kamgaro.com/bootstrap/image/detail-icon.png" class="cate-image" /></a></td>
                        <td><a onclick="remove(this)" id="'.$row['id'].'"><img src="https://kamgaro.com/bootstrap/image/delete-icon.png" class="cate-image" /></a></td>
                        <td>'.date_format(date_create($row['date']), 'd-M-Y h:i A').'</td>
                    </tr>';
            }
            echo $tr;
        }
        else if ($_REQUEST['flag'] == "area-user") {
            $tr = null;
            $result = $db->select_row('registration', ['state' => $_POST['state'], 'district' => $_POST['dist'], 'address' => $_POST['data']]);
			
            foreach($result as $row) {    
                $tr.= '<tr>
                        <td>'.$row['id'].'</td>
                        <td><a href="'.site_url('Authority/login').'?cid='.$row['id'].'" target="_blank">'.img(["../Customer/picture/".$row['profile'], 'cate-image']).'</a></td>
                        <td>'.ucwords($row['name']).'</td>
                        <td><a onclick="action(this)" id="'.$row['id'].'"><span class="action">'.$row['status'].'</span></a></td>
                        <td><a onclick="detail(this)" id="'.$row['id'].'"><img src="https://kamgaro.com/bootstrap/image/detail-icon.png" class="cate-image" /></a></td>
                        <td><a onclick="remove(this)" id="'.$row['id'].'"><img src="https://kamgaro.com/bootstrap/image/delete-icon.png" class="cate-image" /></a></td>
                        <td>'.date_format(date_create($row['date']), 'd-M-Y h:i A').'</td>
                    </tr>';
            }
            echo $tr;
        }
        else if ($_REQUEST['flag'] == "state-agent") {
            $tr = null;
            $result = $db->select_row('agent_contact', ['ag_state' => $_POST['data']]);
			
            foreach($result as $row) {
                $count = $db->num_row('users', ['agent_id' => $row['ag_id']]);
                $agent = $db->select('agent_data', ['ag_id' => $row['ag_id']]);    
                
                $tr.= '<tr>
                        <td>'.$row['ag_id'].'</td>
                        <td><a href="'.site_url('Authority/login')."?aid=".$row['ag_id'].'" target="_blank">'.img(["../Agent/picture/".$agent['ag_profile'], 'cate-image']).'</a></td>
                        <td>'.ucwords($agent['ag_name']).'</td>
                        <td>'.$count.'</td>
                        <td>'.$row['ag_city'].'</td>
                        <td>
                            <a onclick="detail(this)" id="'.$row['ag_id'].'"><img src="https://kamgaro.com/bootstrap/image/detail-icon.png" class="cate-image" /></a>
                            <a onclick="remove(this)" id="'.$row['ag_id'].'"><img src="https://kamgaro.com/bootstrap/image/delete-icon.png" class="cate-image" /></a>
                        </td>
                        <td>'.date_format(date_create($agent['date']), 'd-M-Y h:i A').'</td>
                    </tr>';
            }  
            echo $tr;
        }
        else if ($_REQUEST['flag'] == "district-agent") {
            $tr = null;
            $result = $db->select_row('agent_contact', ['ag_state' => $_POST['state'], 'ag_city' => $_POST['data']]);
			
            foreach($result as $row) {
                $count = $db->num_row('users', ['agent_id' => $row['ag_id']]);
                $agent = $db->select('agent_data', ['ag_id' => $row['ag_id']]);    
                
                $tr.= '<tr>
                        <td>'.$row['ag_id'].'</td>
                        <td><a href="'.site_url('Authority/login')."?aid=".$row['ag_id'].'" target="_blank">'.img(["../Agent/picture/".$agent['ag_profile'], 'cate-image']).'</a></td>
                        <td>'.ucwords($agent['ag_name']).'</td>
                        <td>'.$count.'</td>
                        <td>'.$row['ag_city'].'</td>
                        <td>
                            <a onclick="detail(this)" id="'.$row['ag_id'].'"><img src="https://kamgaro.com/bootstrap/image/detail-icon.png" class="cate-image" /></a>
                            <a onclick="remove(this)" id="'.$row['ag_id'].'"><img src="https://kamgaro.com/bootstrap/image/delete-icon.png" class="cate-image" /></a>
                        </td>
                        <td>'.date_format(date_create($agent['date']), 'd-M-Y h:i A').'</td>
                    </tr>';
            }  
            echo $tr;
        }
        else if ($_REQUEST['flag'] == "area-agent") {
            $tr = null;
            $result = $db->select_row('agent_contact', ['ag_state' => $_POST['state'], 'ag_city' => $_POST['dist']]);
			
            foreach($result as $row) {
                $count = $db->num_row('users', ['agent_id' => $row['ag_id']]);
                $agent = $db->select('agent_data', ['ag_id' => $row['ag_id']]);    
                
                $tr.= '<tr>
                        <td>'.$row['ag_id'].'</td>
                        <td><a href="'.site_url('Authority/login')."?aid=".$row['ag_id'].'" target="_blank">'.img(["../Agent/picture/".$agent['ag_profile'], 'cate-image']).'</a></td>
                        <td>'.ucwords($agent['ag_name']).'</td>
                        <td>'.$count.'</td>
                        <td>'.$row['ag_city'].'</td>
                        <td>
                            <a onclick="detail(this)" id="'.$row['ag_id'].'"><img src="https://kamgaro.com/bootstrap/image/detail-icon.png" class="cate-image" /></a>
                            <a onclick="remove(this)" id="'.$row['ag_id'].'"><img src="https://kamgaro.com/bootstrap/image/delete-icon.png" class="cate-image" /></a>
                        </td>
                        <td>'.date_format(date_create($agent['date']), 'd-M-Y h:i A').'</td>
                    </tr>';
            }  
            echo $tr;
        }
        else {
            echo "required";
        }
    }
    else {
        echo "required";
    }
?>