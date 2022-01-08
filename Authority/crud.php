<?php
    require($_SERVER['DOCUMENT_ROOT'].'/config/config.php');
    require(APP_PATH.'config/fileupload.php');
    require(APP_PATH.'config/helper.php');
    require(APP_PATH.'models/Model.php');
    $db = new Model;

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if ($_REQUEST['flag'] == "detail") {
            if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['number'])) {
                $data = array(
                    "name" => $_POST['name'],
                    "number" => $_POST['number'],
                    "email" => $_POST['email']
                );
                if ($db->update('admin', $data, ['id' => $_SESSION['admin']]) == true) {
                    echo "success";
                }else {
                    echo "error";
                }
            }
            else {
                echo "required";
            }
        }
        else if ($_REQUEST['flag'] == "updateNews") {
            // if (!empty($_POST['heading'])) {
                if ($_FILES['edit_image1']['name'] || $_FILES['edit_image1']['name'] != null) {
                    $data = array(
                        "heading" => $_POST['heading'],
                        "description" => $_POST['description'],
                        "image1" => $_FILES['edit_image1']['name'],
                        "image2" => $_FILES['edit_image2']['name'],
                        "postedBy" => $_POST['posted']
                    );
                    if (file_upload('edit_image1', null, 'Admin/uploads/') == true && file_upload('edit_image2', null, 'Admin/uploads/') == true) {
                        $db->update('news', $data, ['id' => $_POST['id']]);
                        echo "success";
                    }else {
                        echo "file-error";
                    }
                }

              
        }
        // role Start
        else if ($_REQUEST['flag'] == "role_update") { // role update
                if (isset($_POST['users'])) {
                $valid = $db->num_row('authority', ['authority' => $_POST['users'], 'user_id' => $_POST['user_id']]);
                if ($valid == 0) {
                // $valid = $db->num_row('authority', ['authority' => $_POST['users']]);
                $user = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['users'],
                "view1" => $_POST['user_view'],
                "edit1" => $_POST['user_edit'],
                "delete1" => $_POST['user_delete']
                );
                // print_r($user);
                $db->insert('authority', $user); 
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }else { 
                $user = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['users'],
                "view1" => $_POST['user_view'],
                "edit1" => $_POST['user_edit'],
                "delete1" => $_POST['user_delete']
                );
                $db->update('authority', $user, ['user_id' => $_POST['user_id']]);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }
                }
                elseif (isset($_POST['agents'])) {  
                $valid1 = $db->num_row('authority', ['authority' => $_POST['agents'], 'user_id' => $_POST['user_id']]);
                if ($valid1 == 0) {
                $agent = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['agents'],
                "view1" => $_POST['agent_view'],
                "edit1" => $_POST['agent_edit'],
                "delete1" => $_POST['agent_delete']
                );
                $db->insert('authority', $agent);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                } else{
                $agent = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['agents'],
                "view1" => $_POST['agent_view'],
                "edit1" => $_POST['agent_edit'],
                "delete1" => $_POST['agent_delete']
                );
                $db->update('authority', $agent,['authority' => $_POST['agents']]);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }
                }
                // header('Location:role_update?msg=success');
                else if (isset($_POST['vender'])) {  
                $valid2 = $db->num_row('authority', ['authority' => $_POST['vender'], 'user_id' => $_POST['user_id']]);
                if ($valid2 == 0) {  
                $vender = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['vender'],
                "view1" => $_POST['vender_view'],
                "edit1" => $_POST['vender_edit'],
                "delete1" => $_POST['vender_delete']
                );
                $db->insert('authority', $vender);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }else{
                $vender = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['vender'],
                "view1" => $_POST['vender_view'],
                "edit1" => $_POST['vender_edit'],
                "delete1" => $_POST['vender_delete']
                );
                $db->update('authority', $vender,['authority' => $_POST['vender']]);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }
                }
                else if (isset($_POST['customer_order'])) {
                $valid3 = $db->num_row('authority', ['authority' => $_POST['customer_order'], 'user_id' => $_POST['user_id']]);
                if ($valid3 == 0) {     
                $customer_order = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['customer_order'],
                "view1" => $_POST['customer_view'],
                "edit1" => $_POST['customer_edit'],
                "delete1" => $_POST['customer_delete']
                );
                $db->insert('authority', $customer_order);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }else{
                $customer_order = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['customer_order'],
                "view1" => $_POST['customer_view'],
                "edit1" => $_POST['customer_edit'],
                "delete1" => $_POST['customer_delete']
                );
                $db->update('authority', $customer_order,['authority' => $_POST['customer_order']]);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }
                }
                else if (isset($_POST['freelancer'])) { 
                $valid4 = $db->num_row('authority', ['authority' => $_POST['freelancer'], 'user_id' => $_POST['user_id']]);
                if ($valid4 == 0) {   
                $freelancer = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['freelancer'],
                "view1" => $_POST['freelancer_view'],
                "edit1" => $_POST['freelancer_edit'],
                "delete1" => $_POST['freelancer_delete']
                );
                $db->insert('authority', $freelancer);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }else{
                $freelancer = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['freelancer'],
                "view1" => $_POST['freelancer_view'],
                "edit1" => $_POST['freelancer_edit'],
                "delete1" => $_POST['freelancer_delete']
                );
                $db->update('authority', $freelancer,['authority' => $_POST['freelancer']]);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }
                }
                else if (isset($_POST['add_agency'])) {
                $valid5 = $db->num_row('authority', ['authority' => $_POST['add_agency'], 'user_id' => $_POST['user_id']]);
                if ($valid5 == 0) {      
                $add_agency = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['add_agency'],
                "view1" => $_POST['addagency_view'],
                "edit1" => $_POST['addagency_edit'],
                "delete1" => $_POST['addagency_delete']
                );
                $db->insert('authority', $add_agency);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }else{
                $add_agency = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['add_agency'],
                "view1" => $_POST['addagency_view'],
                "edit1" => $_POST['addagency_edit'],
                "delete1" => $_POST['addagency_delete']
                );
                $db->update('authority', $add_agency,['authority' => $_POST['add_agency']]);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }
                }
                else if (isset($_POST['agencies'])) {  
                $valid6 = $db->num_row('authority', ['authority' => $_POST['agencies'], 'user_id' => $_POST['user_id']]);
                if ($valid6 == 0) {        
                $agencies = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['agencies'],
                "view1" => $_POST['agency_view'],
                "edit1" => $_POST['agency_edit'],
                "delete1" => $_POST['agency_delete']
                );
                $db->insert('authority', $agencies);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }else{
                $agencies = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['agencies'],
                "view1" => $_POST['agency_view'],
                "edit1" => $_POST['agency_edit'],
                "delete1" => $_POST['agency_delete']
                );
                $db->update('authority', $agencies,['authority' => $_POST['agencies']]);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }
                }
                else if (isset($_POST['payment'])) { 
                $valid7 = $db->num_row('authority', ['authority' => $_POST['payment'], 'user_id' => $_POST['user_id']]);
                if ($valid7 == 0) {      
                $payment = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['payment'],
                "view1" => $_POST['payment_view'],
                "edit1" => $_POST['payment_edit'],
                "delete1" => $_POST['payment_delete']
                );
                $db->insert('authority', $payment);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }else{
                $payment = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['payment'],
                "view1" => $_POST['payment_view'],
                "edit1" => $_POST['payment_edit'],
                "delete1" => $_POST['payment_delete']
                );
                $db->update('authority', $payment,['authority' => $_POST['payment']]);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }
                }
                else if (isset($_POST['agency_payment'])) { 
                $valid8 = $db->num_row('authority', ['authority' => $_POST['agency_payment'], 'user_id' => $_POST['user_id']]);
                if ($valid8 == 0) {       
                $agency_payment = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['agency_payment'],
                "view1" => $_POST['agency_payment_view'],
                "edit1" => $_POST['agency_payment_edit'],
                "delete1" => $_POST['agency_payment_delete']
                );
                $db->insert('authority', $agency_payment);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }else{
                $agency_payment = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['agency_payment'],
                "view1" => $_POST['agency_payment_view'],
                "edit1" => $_POST['agency_payment_edit'],
                "delete1" => $_POST['agency_payment_delete']
                );
                $db->update('authority', $agency_payment,['authority' => $_POST['agency_payment']]);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }
                }
                else if (isset($_POST['location'])) {   
                $valid9 = $db->num_row('authority', ['authority' => $_POST['location'], 'user_id' => $_POST['user_id']]);
                if ($valid9 == 0) {   
                $location = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['location'],
                "view1" => $_POST['location_view'],
                "edit1" => $_POST['location_edit'],
                "delete1" => $_POST['location_delete']
                );
                $db->insert('authority', $location);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }else{
                $location = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['location'],
                "view1" => $_POST['location_view'],
                "edit1" => $_POST['location_edit'],
                "delete1" => $_POST['location_delete']
                );
                $db->update('authority', $location,['authority' => $_POST['location']]);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }
                }
                else if (isset($_POST['category'])) {    
                $valid10 = $db->num_row('authority', ['authority' => $_POST['category'], 'user_id' => $_POST['user_id']]);
                if ($valid10 == 0) { 
                $category = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['category'],
                "view1" => $_POST['category_view'],
                "edit1" => $_POST['category_edit'],
                "delete1" => $_POST['category_delete']
                );
                $db->insert('authority', $category);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }else{
                $category = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['category'],
                "view1" => $_POST['category_view'],
                "edit1" => $_POST['category_edit'],
                "delete1" => $_POST['category_delete']
                );
                $db->update('authority', $category,['authority' => $_POST['category']]);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }
                }
                else if (isset($_POST['product_category'])) {   
                $valid11 = $db->num_row('authority', ['authority' => $_POST['product_category'], 'user_id' => $_POST['user_id']]);
                if ($valid11 == 0) {  
                $product_category = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['product_category'],
                "view1" => $_POST['product_category_view'],
                "edit1" => $_POST['product_category_edit'],
                "delete1" => $_POST['product_category_delete']
                );
                $db->insert('authority', $product_category);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }else{
                $product_category = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['product_category'],
                "view1" => $_POST['product_category_view'],
                "edit1" => $_POST['product_category_edit'],
                "delete1" => $_POST['product_category_delete']
                );
                $db->update('authority', $product_category,['authority' => $_POST['product_category']]);
                header('Location:role_update?id='.$_POST['user_id'].' ');   
                }
                }
                else if (isset($_POST['hire_enquery'])) {  
                $valid12 = $db->num_row('authority', ['authority' => $_POST['hire_enquery'], 'user_id' => $_POST['user_id']]);
                if ($valid12 == 0) {    
                $hire_enquery = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['hire_enquery'],
                "view1" => $_POST['hire_enquery_view'],
                "edit1" => $_POST['hire_enquery_edit'],
                "delete1" => $_POST['hire_enquery_delete']
                );
                $db->insert('authority', $hire_enquery);
                header('Location:role_update?id='.$_POST['user_id'].' ');   
                }else{
                $hire_enquery = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['hire_enquery'],
                "view1" => $_POST['hire_enquery_view'],
                "edit1" => $_POST['hire_enquery_edit'],
                "delete1" => $_POST['hire_enquery_delete']
                );
                $db->update('authority', $hire_enquery,['authority' => $_POST['hire_enquery']]);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }
                }
                else if (isset($_POST['filter_user'])) {  
                $valid14 = $db->num_row('authority', ['authority' => $_POST['filter_user'], 'user_id' => $_POST['user_id']]);
                if ($valid14 == 0) {      
                $filter_user = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['filter_user'],
                "view1" => $_POST['filter_user_view'],
                "edit1" => $_POST['filter_user_edit'],
                "delete1" => $_POST['filter_user_delete']
                );
                $db->insert('authority', $filter_user);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }else{
                $filter_user = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['filter_user'],
                "view1" => $_POST['filter_user_view'],
                "edit1" => $_POST['filter_user_edit'],
                "delete1" => $_POST['filter_user_delete']
                );
                $db->update('authority', $filter_user,['authority' => $_POST['filter_user']]);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }
                }
                else if (isset($_POST['filter_agent'])) { 
                $valid16 = $db->num_row('authority', ['authority' => $_POST['filter_agent'], 'user_id' => $_POST['user_id']]);
                if ($valid16 == 0) {        
                $filter_agent = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['filter_agent'],
                "view1" => $_POST['filter_agent_view'],
                "edit1" => $_POST['filter_agent_edit'],
                "delete1" => $_POST['filter_agent_delete']
                );
                $db->insert('authority', $filter_agent);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }else{
                $filter_agent = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['filter_agent'],
                "view1" => $_POST['filter_agent_view'],
                "edit1" => $_POST['filter_agent_edit'],
                "delete1" => $_POST['filter_agent_delete']
                );
                $db->update('authority', $filter_agent,['authority' => $_POST['filter_agent']]);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }
                }
                else if (isset($_POST['filter_vender'])) {
                $valid17 = $db->num_row('authority', ['authority' => $_POST['filter_vender'], 'user_id' => $_POST['user_id']]);
                if ($valid17 == 0) {        
                $filter_vender = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['filter_vender'],
                "view1" => $_POST['filter_vender_view'],
                "edit1" => $_POST['filter_vender_edit'],
                "delete1" => $_POST['filter_vender_delete']
                );
                $db->insert('authority', $filter_vender);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }else{
                $filter_vender = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['filter_vender'],
                "view1" => $_POST['filter_vender_view'],
                "edit1" => $_POST['filter_vender_edit'],
                "delete1" => $_POST['filter_vender_delete']
                );
                $db->update('authority', $filter_vender,['authority' => $_POST['filter_vender']]);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }
                }
                else if (isset($_POST['service_list'])) {
                $valid18 = $db->num_row('authority', ['authority' => $_POST['service_list'], 'user_id' => $_POST['user_id']]);
                if ($valid18 == 0) {       
                $service_list = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['service_list'],
                "view1" => $_POST['service_list_view'],
                "edit1" => $_POST['service_list_edit'],
                "delete1" => $_POST['service_list_delete']
                );
                $db->insert('authority', $service_list);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }else{
                $service_list = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['service_list'],
                "view1" => $_POST['service_list_view'],
                "edit1" => $_POST['service_list_edit'],
                "delete1" => $_POST['service_list_delete']
                );
                $db->update('authority', $service_list,['authority' => $_POST['service_list']]);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }
                }
                else if (isset($_POST['download_data'])) {  
                $valid19 = $db->num_row('authority', ['authority' => $_POST['download_data'], 'user_id' => $_POST['user_id']]);
                if ($valid19 == 0) {  
                $download_data = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['download_data'],
                "view1" => $_POST['download_data_view'],
                "edit1" => $_POST['download_data_edit'],
                "delete1" => $_POST['download_data_delete']
                );
                $db->insert('authority', $download_data);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }else{
                $download_data = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['download_data'],
                "view1" => $_POST['download_data_view'],
                "edit1" => $_POST['download_data_edit'],
                "delete1" => $_POST['download_data_delete']
                );
                $db->update('authority', $download_data,['authority' => $_POST['download_data']]);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }
                }
                else if (isset($_POST['query_review'])) {  
                $valid20 = $db->num_row('authority', ['authority' => $_POST['query_review'], 'user_id' => $_POST['user_id']]);
                if ($valid20 == 0) {   
                $query_review = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['query_review'],
                "view1" => $_POST['query_review_view'],
                "edit1" => $_POST['query_review_edit'],
                "delete1" => $_POST['query_review_delete']
                );
                $db->insert('authority', $query_review);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }else{
                $query_review = array(
                "user_id" => $_POST['user_id'],
                "authority" => $_POST['query_review'],
                "view1" => $_POST['query_review_view'],
                "edit1" => $_POST['query_review_edit'],
                "delete1" => $_POST['query_review_delete']
                );
                $db->update('authority', $query_review,['authority' => $_POST['query_review']]);
                header('Location:role_update?id='.$_POST['user_id'].' ');
                }             
                }
}

        // end role update
        else if ($_REQUEST['flag'] == "privacy") {
            if (!empty($_POST['npass']) && !empty($_POST['cpass'])) {
                $data = array(
                    "password" => md5($_POST['npass']),
                   
                );
                if ($db->update('admin_user', $data, ['id' => $_SESSION['authority']]) == true) {
                    echo "success";
                }else {
                    echo "error";
                }
            }
            else {
                echo "required";
            }
        }
        
        else if ($_REQUEST['flag'] == "category") {
            if (!empty($_POST['category'])) {
                if ($_FILES['edit_image1']['name'] != "" || $_FILES['edit_image1']['name'] != null) {
                    $data = array(
                        "category" => $_POST['category'],
                        "image" => $_FILES['edit_image1']['name']
                    );
                    if (file_upload('edit_image1', null, 'Admin/uploads/category/') == true) {
                        $db->update('category', $data, ['id' => $_POST['id']]);
                        echo "success";
                    }else {
                        echo "file-error";
                    }
                }

                if ($_FILES['edit_banner1']['name'] != "" || $_FILES['edit_banner1']['name'] != null) {
                    $data = array(
                        "category" => $_POST['category'],
                        "banner" => $_FILES['edit_banner1']['name']
                    );
                    if (file_upload('edit_banner1', null, 'Admin/uploads/banner/') == true) {
                        $db->update('category', $data, ['id' => $_POST['id']]);
                        echo "success";
                    }else {
                        echo "file-error";
                    }
                }

                if ($_FILES['edit_banner1']['name'] == "" && $_FILES['edit_image1']['name'] == "") {
                    $db->update('category', ['category' => $_POST['category']], ['id' => $_POST['id']]);
                    echo "success";
                }
            }else {
                echo "required";
            }
        }
        else if ($_REQUEST['flag'] == "update_logo") {
            if (!empty($_FILES['upload']['name'])) {
                    $data = array(
                        "logo" => $_FILES['upload']['name'],
                    );
                   // print_r($data);
                if (file_upload('upload', null, 'Admin/uploads/') == true ) {
                    $db->update('logo', $data, ['id' => 0]);
                    echo "success";
                }else {
                    echo "file-error";
                }
            }else {
                echo "required2";
            }
        }
        else if ($_REQUEST['flag'] == "product_category") {
            $data = array(
                        "category" => $_POST['category'],
                    );
             $status = $db->select('product_category', ['id' => $_POST['id']]);
             $db->update('product_category', $data, ['id' => $_POST['id']]);
              
             echo "success";
        }
        else if ($_REQUEST['flag'] == "service") {
            if (!empty($_POST['service'])) {
                if ($_FILES['image']['name'] != "" || $_FILES['image']['name'] != null) {
                    $data = array(
                        "service" => $_POST['service'],
                        "image" => $_FILES['image']['name']
                    );
                    if (file_upload('image', null, 'Admin/uploads/service/') == true) {
                        $db->update('service', $data, ['id' => $_POST['id']]);
                        echo "success";
                    }else {
                        echo "file-error";
                    }
                }

                if ($_FILES['banner']['name'] != "" || $_FILES['banner']['name'] != null) {
                    $data = array(
                        "service" => $_POST['service'],
                        "banner" => $_FILES['banner']['name']
                    );
                    if (file_upload('banner', null, 'Admin/uploads/banner/') == true) {
                        $db->update('service', $data, ['id' => $_POST['id']]);
                        echo "success";
                    }else {
                        echo "file-error";
                    }
                }

                if ($_FILES['banner']['name'] == "" && $_FILES['image']['name'] == "") {
                    $db->update('service', ['service' => $_POST['service']], ['id' => $_POST['id']]);
                    echo "success";
                }
            }else {
                echo "required";
            }
        }
        else if ($_REQUEST['flag'] == "ui-control") {
            if (!empty($_POST['video'])) {
                if ($_FILES['advertise']['name'] != "" || $_FILES['advertise']['name'] != null) {
                    $data = array(
                        "video" => $_POST['video'],
                        "advertise" => $_FILES['advertise']['name']
                    );
                    if (file_upload('advertise', null, 'Admin/uploads/ui/') == true) {
                        $db->update('ui_control', $data, ['id' => 'ID124356']);
                        echo "success";
                    }else {
                        echo "file-error";
                    }
                }

                if ($_FILES['banner']['name'] != "" || $_FILES['banner']['name'] != null) {
                    $data = array(
                        "video" => $_POST['video'],
                        "banner" => $_FILES['banner']['name']
                    );
                    if (file_upload('banner', null, 'Admin/uploads/ui/') == true) {
                        $db->update('ui_control', $data, ['id' => 'ID124356']);
                        echo "success";
                    }else {
                        echo "file-error";
                    }
                }

                if ($_FILES['banner']['name'] == "" && $_FILES['advertise']['name'] == "") {
                    $db->update('ui_control', ['video' => $_POST['video']], ['id' => 'ID124356']);
                    echo "success";
                }
            }else {
                echo "required";
            }
        }
		else if ($_REQUEST['flag'] == "city") {
            if (!empty($_POST['district'])) {
                $data = array(
                    "id" => $_POST['id'],
                    "district" => $_POST['district']
                );
                $result = json_encode($data);

                $curl = curl_init();
                curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://api.upgradeads.in/updateDistrict',
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
        }
        else if ($_REQUEST['flag'] == "users") {
            $status = $db->select('users', ['id' => $_POST['id']]);
            if ($status['status'] == "Pending") {
                $db->update('users', ['status' => 'Active'], ['id' => $_POST['id']]);
                echo "success";
            }
            else {
                $db->update('users', ['status' => 'Pending'], ['id' => $_POST['id']]);
                echo "success";
            }
        }
        else if ($_REQUEST['flag'] == "agency") {
            $status = $db->select('agency', ['id' => $_POST['id']]);
            if ($status['status'] == 1) {
                $db->update('agency', ['status' => 0], ['id' => $_POST['id']]);
                echo "success";
            }
            else {
                $db->update('agency', ['status' => 1], ['id' => $_POST['id']]);
                echo "success";
            }
        }
        else if ($_REQUEST['flag'] == "customer") {
            $status = $db->select('registration', ['id' => $_POST['id']]);
            if ($status['status'] == "Pending") {
                $db->update('registration', ['status' => 'Active'], ['id' => $_POST['id']]);
                echo "success";
            }
            else {
                $db->update('registration', ['status' => 'Pending'], ['id' => $_POST['id']]);
                echo "success";
            }
        }
        else if ($_REQUEST['flag'] == "freelancer") {
            $status = $db->select('freelancer', ['fr_id' => $_POST['id']]);
            if ($status['status'] == "Pending") {
                $db->update('freelancer', ['status' => 'Active'], ['fr_id' => $_POST['id']]);
                echo "success";
            }
            else {
                $db->update('freelancer', ['status' => 'Pending'], ['fr_id' => $_POST['id']]);
                echo "success";
            }
        }
          else if ($_REQUEST['flag'] == "subadmin") {
           // $status = $db->select('subadmin', ['usertype' => $_POST['id']]);
          
                $db->update('role', ['insert_user' => $_POST['select_user']], ['id' => $_POST['user_id']]);
                echo "success";
           
        }
        else if ($_REQUEST['flag'] == "agent") {
           echo "success";
        }
        else if ($_REQUEST['flag'] == "remove-users") {
            $db->remove('users', ['id' => $_POST['id']]);
            $db->remove('users_address', ['id' => $_POST['id']]);
            $db->remove('users_service', ['id' => $_POST['id']]);
            $db->remove('users_gallery', ['id' => $_POST['id']]);
            $db->remove('users_review', ['id' => $_POST['id']]);
            $db->remove('users_information', ['id' => $_POST['id']]);
            echo "success";
        }
        else if ($_REQUEST['flag'] == "remove-customer") {
            $db->remove('registration', ['id' => $_POST['id']]);
            echo "success";
        }
        else if ($_REQUEST['flag'] == "remove-freelancer") {
            $db->remove('freelancer', ['fr_id' => $_POST['id']]);
            echo "success";
        }
        else if ($_REQUEST['flag'] == "remove-agency") {
            $db->remove('agency', ['id' => $_POST['id']]);
            echo "success";
        }
        else if ($_REQUEST['flag'] == "remove-agent") {
            $db->remove('agent_data', ['ag_id' => $_POST['id']]);
            $db->remove('agent_contact', ['ag_id' => $_POST['id']]);
            $db->remove('agent_education', ['ag_id' => $_POST['id']]);
            echo "success";
        }
        else if ($_REQUEST['flag'] == "remove-category") {
            $db->remove('category', ['id' => $_POST['id']]);
            $db->remove('service', ['category' => $_POST['id']]);
            echo "success";
        }
        else if ($_REQUEST['flag'] == "remove-product_category") {
            $db->remove('product_category', ['id' => $_POST['id']]);
            echo "success";
        }

        else if ($_REQUEST['flag'] == "remove-service") {
            $db->remove('service', ['id' => $_POST['id']]);
            echo "success";
        }
        else if ($_REQUEST['flag'] == "remove-news") {
            $db->remove('news', ['id' => $_POST['id']]);
            echo "success";
        }
		else if ($_REQUEST['flag'] == "remove-city") {
            $db->remove('location', ['id' => $_POST['id']]);
            echo "success";
        }
        else if ($_REQUEST['flag'] == "franchise") {
            $db->remove('franchise', ['id' => $_POST['id']]);
            echo "success";
        }
        else if ($_REQUEST['flag'] == "contact") {
            $db->remove('contact', ['id' => $_POST['id']]);
            echo "success";
        }
        else if ($_REQUEST['flag'] == "career") {
            $db->remove('career', ['id' => $_POST['id']]);
            echo "success";
        }
        else if ($_REQUEST['flag'] == "hire") {
            $db->remove('hire_now', ['id' => $_POST['id']]);
            echo "success";
        }
        else {
            echo "required";
        }
    }
    else {
        echo "required";
    }
?>