<?php
	require($_SERVER['DOCUMENT_ROOT'].'/config/config.php');
	require(APP_PATH.'config/helper.php');
	require(APP_PATH.'models/Model.php');
	$db = new Model;
	
	$i = 0; $data = array();
	
	if ($_SERVER['REQUEST_METHOD'] == "GET") {
		if ($_REQUEST['flag'] == "users") {
			$result = $db->select_order('users', null,'date','desc');
			$i=0;
			foreach($result as $row) {
				$i++; $j = 0;
				$all_service = "";
				$hire_now = $db->num_row('hire_now', ['vendor' => $row['id']]);
				$agent = $db->select('agent_data', ['ag_id' => $row['agent_id']]);
                $freelancer = $db->select('freelancer', ['fr_id' => $row['agent_id']]);
				$address = $db->select('users_address', ['id' => $row['id']]);
				$category = $db->select('category', ['id' => $row['category']]);
				$service = $db->select_row('users_service', ['id' => $row['id']]);
				$data2 = $db->select_row('profile_visiter', ['venderId' => $row['id']]);
                $count = count($data2);

				$value1 = $db->select('authority', ['user_id' => $_SESSION['authority'], 'authority' => 'Vender']);
				// print_r($value1);
				if ($value1['edit1'] == 'Yes') {
					$action = "<a onclick='action(this)' id=".$row['id']."><span class='action'>".$row['status']."</span></a>";
					$show1 =  "<a onclick='detail(this)' id=".$row['id']."><img src='http://kamgaro.com/bootstrap/image/detail-icon.png' class='cate-image' /></a> ";
				}else {
					$action = "<a><span class='action'>". $row['status']."</span></a>";
					$show1 =  "<a><img src='http://kamgaro.com/bootstrap/image/detail-icon.png' class='cate-image' /></a> ";
				}
				if ($value1['delete1'] == 'Yes') {
					$delete4 =  "<a onclick='remove(this)' id=".$row['id']."><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a>";
				}else {
					$delete4 =  "<a><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a>";
				}

				// $count =count($hire_now['vendor']);
				foreach ($service as $key) {
					$j++;
					$subcate = $db->select('service', ['id' => $key['service']]);
					if (sizeof($service) > $j) {
						$all_service.= $subcate['service'].", ";
					}else {
						$all_service.= $subcate['service'];
					}
				}
			
				$data[] = array(
					$i,
					$row['id'],
					ucwords($row['business']),
					$row['number'],
					ucwords($agent['ag_name']),
					ucwords($freelancer['fr_name']),
					$category['category'],
					$all_service,
					$address['area'],
					$address['district'],
					// $address['state'],
					$address['state'],
					$row['plan'],
					$count,
					$hire_now,
					$action,
					$show1,
					$delete4,
					$row['date']
				);
			}
		}
		else if ($_REQUEST['flag'] == "news") {
			$result = $db->select_order('news', null,'date','desc');
			$i=0;
			foreach($result as $row) {
				$i++;
				$data[] = array(
					
					$i,
					$row['heading'],
					$row['description'],
					"".img(["Admin/uploads/".$row['image1'], 'cate-image'])."",
					"".img(["Admin/uploads/".$row['image2'], 'cate-image'])."",
					$row['postedBy'],
					$row['date'],
					"<a onclick='update1(this)' id=".$row['id']."><img src='http://kamgaro.com/bootstrap/image/edit-icon.png' class='cate-image' /></a>",
					"<a onclick='remove(this)' id=".$row['id']."><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a>"
				);
			}
		}
		else if ($_REQUEST['flag'] == "freelancer") {
			$result = $db->select_order('freelancer', null,'date','desc');
			$i=0;
			foreach($result as $row) {
			
				$frvendor = $db->select('users',['agent_id' => $row['fr_id']]);
				$free = $db->num_row('users', ['agent_id' => $row['fr_id'], 'plan' => 'Free']);
				$paid = $db->num_row('users', ['agent_id' => $row['fr_id'], 'plan' => 'Gold']);
				$insured = $db->num_row('users', ['agent_id' => $row['fr_id'], 'plan' => 'Insured']);
				$prime = $db->num_row('users', ['agent_id' => $row['fr_id'], 'plan' => 'Prime']);
				$i++;

				$value1 = $db->select('authority', ['user_id' => $_SESSION['authority'], 'authority' => 'Freelancer']);
				// print_r($value1);
				if ($value1['edit1'] == 'Yes') {
					$action = "<a onclick='action(this)' id=".$row['fr_id']."><span class='action'>".$row['status']."</span></a>";
					$show1 =  "<a onclick='detail(this)' id=".$row['fr_id']."><img src='http://kamgaro.com/bootstrap/image/detail-icon.png' class='cate-image' /></a>";
				}else {
					$action ="<a><span class='action'>".$row['status']."</span></a>";
					$show1 =  "<a><img src='http://kamgaro.com/bootstrap/image/detail-icon.png' class='cate-image' /></a>";
				}
				if ($value1['delete1'] == 'Yes') {
					$delete4 =  "<a onclick='remove(this)' id=".$row['fr_id']."><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a>";
				}else {
					$delete4 =  "<a><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a>";
				}
				$data[] = array(
					$i,
					$row['fr_id'],
					"<a href='".site_url('Authority/login')."?fid=".$row['fr_id']."' target='_blank'>".img(["Freelancer/picture/".$row['fr_profile'], 'cate-image'])."</a>",
					ucwords($row['fr_name']),
					$row['number'],
					$free,
					$paid,
					$insured,
					$prime,
					$row['fr_address'],
					$row['fr_district'],
					$row['fr_state'],
					$action,
					$show1,
					$delete4,
					$row['date']
				);
			}
		}
		else if ($_REQUEST['flag'] == "cust_order") {
			$result = $db->select_order('order_list', null,'date','desc');
			$i=0;
			foreach($result as $row) {$i++;
			
				 	$users = $db->select('users', ['id' => $row['vender_id']]);
				 	$registration = $db->select('registration', ['id' => $row['customer_id']]);
                    $product = $db->select('product', ['product_id' => $row['product_id']]);
                    $category = $db->select('product_category', ['id' => $product['category_id']]);
				
				if (!empty($registration)) {
				if ($row['status'] == 1) {
				$data[] = array(
					$i,
					$row['vender_id'].'/'.$users['name'],
					$row['customer_id'].'/'.$registration['name'],
					$registration['address'],
					$registration['district'],
					$registration['state'],
					$product['product_name'],
					$product['price'],
					$row['qty'],
					"<button class='btn btn-danger'>".'Ordered'."</button>",
					date_format(date_create($row['date']), 'd-M-Y h:i A')

				);
			} else{
				$data[] = array(
					$i,
					$row['vender_id'].'/'.$users['name'],
					$row['customer_id'].'/'.$registration['name'],
					$registration['address'],
					$registration['district'],
					$registration['state'],
					$product['product_name'],
					$product['price'],
					$row['qty'],
					"<button class='btn btn-success'>".'Cancled'."</button>",
					date_format(date_create($row['date']), 'd-M-Y h:i A')

				);

			}
		}
		}
		}
		else if ($_REQUEST['flag'] == "ven_order") {
			$result = $db->select_order('order_list', null,'id','desc');
			$i=0;
			foreach($result as $row) {
			
				 	$users = $db->select('users', ['id' => $row['vender_id']]);
				 	$users1 = $db->select('users', ['id' => $row['customer_id']]);
				 	$registration = $db->select('users_address', ['id' => $row['customer_id']]);
                    $product = $db->select('product', ['product_id' => $row['product_id']]);
                    $category = $db->select('product_category', ['id' => $product['category_id']]);
				$i++;
				if (!empty($users)) {
				if ($row['status'] == 1) {
				$data[] = array(
					$i,
					$row['vender_id'].'/'.$users['name'],
					$row['customer_id'].'/'.$users1['name'],
					$registration['address'],
					$registration['district'],
					$registration['state'],
					$product['product_name'],
					$product['price'],
					$row['qty'],
					"<button class='btn btn-danger'>".'Ordered'."</button>",
					date_format(date_create($row['date']), 'd-M-Y h:i A')

				);
			} else{
				$data[] = array(
					$i,
					$row['vender_id'].'/'.$users['name'],
					$row['customer_id'].'/'.$users1['name'],
					$registration['address'],
					$registration['district'],
					$registration['state'],
					$product['product_name'],
					$product['price'],
					$row['qty'],
					"<button class='btn btn-success'>".'Cancled'."</button>",
					date_format(date_create($row['date']), 'd-M-Y h:i A')

				);

			}
		}
		}
		}
		else if ($_REQUEST['flag'] == "customer") {
			$result = $db->select_order('registration', null,'date','desc');
				 $i=0;
			foreach($result as $row) {
				$i++;
				$value1 = $db->select('authority', ['user_id' => $_SESSION['authority'], 'authority' => 'Users']);
 
				if ($value1['edit1'] == 'Yes') {
					$profile ="<a href='".site_url('Authority/login')."?cid=".$row['id']."' target='_blank'>".img(["../Customer/picture/".$row['profile'], 'cate-image'])."</a>";
					$action = "<a onclick='action(this)' id=".$row['id']."><span class='action'>".$row['status']."</span></a>";
					$show1 =  "<a onclick='detail(this)' id=".$row['id']."><img src='http://kamgaro.com/bootstrap/image/detail-icon.png' class='cate-image' /></a>";
				}else {
					$profile ="<a target='_blank'>".img(["../Customer/picture/".$row['profile'], 'cate-image'])."</a>";
					$action ="<a><span class='action'>".$row['status']."</span></a>";
					$show1 = "<a><img src='http://kamgaro.com/bootstrap/image/detail-icon.png' class='cate-image' /></a>";
				}
				if ($value1['delete1'] == 'Yes') {
					$delete4 =   "<a onclick='remove(this)' id=".$row['id']."><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a>";
				}else {
					$delete4 =   "<a><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a>";
				}
				$data[] = array(
					$i,
					$row['id'],
					$profile,
					ucwords($row['name']),
					$row['number'],
					$row['email'],
					$row['address'],
					$row['district'],
					$row['state'],
					$action,
					$show1,
				    $delete4,
					$row['date']
				);
			}
		}
		else if ($_REQUEST['flag'] == "agent") {
			$result = $db->select_order('agent_data', null,'date',"DESC");
			  $i=0;
			foreach($result as $row) {
				if ($row['status1'] == 1) { 
				$i++;
				$count = $db->num_row('users', ['agent_id' => $row['ag_id']]);
				$agency = $db->select('agency', ['id' => $row['agency_name']]);
				$contact = $db->select('agent_area', ['ag_id' => $row['ag_id']]);
				$free = $db->num_row('users', ['agent_id' => $row['ag_id'], 'plan' => 'Free']);
				$paid = $db->num_row('users', ['agent_id' => $row['ag_id'], 'plan' => 'Paid']);
				$insured = $db->num_row('users', ['agent_id' => $row['ag_id'], 'plan' => 'Insured']);

				$value1 = $db->select('authority', ['user_id' => $_SESSION['authority'], 'authority' => 'Agents']);
				// print_r($value1);
				if ($value1['edit1'] == 'Yes') {
					$action ="<a href='".site_url('Authority/login')."?aid=".$row['ag_id']."' target='_blank'>".img(["Agent/picture/".$row['ag_profile'], 'cate-image'])."</a>";
					$show1 =  "<a onclick='detail(this)' id=".$row['ag_id']."><img src='http://kamgaro.com/bootstrap/image/detail-icon.png' class='cate-image' /></a>";
				}else {
					$action= "<a target='_blank'>".img(["Agent/picture/".$row['ag_profile'], 'cate-image'])."</a>";
					$show1 =  "<a><img src='http://kamgaro.com/bootstrap/image/detail-icon.png' class='cate-image' /></a>";
				}
				if ($value1['delete1'] == 'Yes') {
					$delete4 =  "<a onclick='remove(this)' id=".$row['ag_id']."><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a>";
				}else {
					$delete4 =  "<a><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a>";
				}
				$data[] = array(
					$i,
					$row['ag_id'],
					$action,
					ucwords($row['ag_name']),
					$count,
					$agency['name'],
					$contact['area'],
					$contact['district'],
					$contact['state'],
					$free,
					$paid,
					$insured,
					$show1,
					$delete4,
					$row['date']
				);
			}}
		}
		else if ($_REQUEST['flag'] == "category") {
			$result = $db->select_order('category', null,'date','desc');
			
			foreach($result as $row) {
				$i++;

				$value1 = $db->select('authority', ['user_id' => $_SESSION['authority'], 'authority' => 'Category']);
				// print_r($value1);
				if ($value1['edit1'] == 'Yes') {
					$show1 = "<a onclick='update1(this)' id=".$row['id']."><img src='http://kamgaro.com/bootstrap/image/edit-icon.png' class='cate-image' /></a>";
				}else {
					$show1 =  "<a><img src='http://kamgaro.com/bootstrap/image/edit-icon.png' class='cate-image' /></a>";
				}
				if ($value1['delete1'] == 'Yes') {
					$delete4 =  "<a onclick='remove1(this)' id=".$row['id']."><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a>";
				}else {
					$delete4 =  "<a><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a>";
				}
				$data[] = array(
					$row['id'],
					"".img(["../Admin/uploads/category/".$row['image'], 'cate-image'])."",
					ucwords($row['category']),
					$show1,
					$delete4,
					$row['date']
				);
			}
		}
		else if ($_REQUEST['flag'] == "product_category") {
			$result = $db->select('product_category', null);
			
			foreach($result as $row) {
				$i++;

				$value1 = $db->select('authority', ['user_id' => $_SESSION['authority'], 'authority' => 'Product Category']);
				if ($value1['delete1'] == 'Yes') {
					$delete4 = "<a onclick='remove1(this)' id=".$row['id']."><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a>";
				}else {
					$delete4 = "<a><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a>";
				}
				$data[] = array(
					$row['id'],
					ucwords($row['category']),
					// "<a onclick='update1(this)' id=".$row['id']."><img src='http://kamgaro.com/bootstrap/image/edit-icon.png' class='cate-image' /></a>",
					$delete4,
				);
			}
		}
		else if ($_REQUEST['flag'] == "service") {
			$result = $db->select('service', null);
			
			foreach($result as $row) {
				$i++;

				$value1 = $db->select('authority', ['user_id' => $_SESSION['authority'], 'authority' => 'Category']);
				// print_r($value1);
				if ($value1['edit1'] == 'Yes') {
					$show1 = "<a onclick='update(this)' id=".$row['id']."><img src='http://kamgaro.com/bootstrap/image/edit-icon.png' class='cate-image' /></a>";
				}else {
					$show1 = "<a><img src='http://kamgaro.com/bootstrap/image/edit-icon.png' class='cate-image' /></a>";
				}
				if ($value1['delete1'] == 'Yes') {
					$delete4 = "<a onclick='remove(this)' id=".$row['id']."><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a>";
				}else {
					$delete4 =  "<a><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a>";
				}
				$data[] = array(
					$row['id'],
					"".img(["../Admin/uploads/service/".$row['image'], 'cate-image'])."",
					ucwords($row['service']),
					"".img(["../Admin/uploads/banner/".$row['banner'], 'cate-image'])."",
					$show1,
					$delete4,
					$row['date']
				);
			}
		}
		else if ($_REQUEST['flag'] == "city") {
			$curl = curl_init();
			curl_setopt_array($curl, array(
			CURLOPT_URL => 'http://api.upgradeads.in/allDistrict',
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => '',
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => 'GET',
			));

			$response = curl_exec($curl);
			curl_close($curl);
			$district = json_decode($response, true);
			
			foreach($district as $row) {
				$i++;

				$value1 = $db->select('authority', ['user_id' => $_SESSION['authority'], 'authority' => 'Location']);
				// print_r($value1);
				if ($value1['edit1'] == 'Yes') {
					$show1 =  "<a onclick='update(this)' id=".$row['id']."><img src='http://kamgaro.com/bootstrap/image/edit-icon.png' class='cate-image' /></a>";
				}else {
					$show1 =  "<a><img src='http://kamgaro.com/bootstrap/image/edit-icon.png' class='cate-image' /></a>";
				}
				 
				$data[] = array(
					$row['id'],
					ucwords($row['district']),
					$show1,
				);
			}
		}
		else if ($_REQUEST['flag'] == "payment") {
			$result = $db->select('transaction', null);
			
			foreach($result as $row) {
				$i++;
				$vendor = $db->select('users', ['id' => $row['id']]);
				$data[] = array(
					$row['txnid'],
					ucwords($vendor['business']),
					$vendor['profile'],
					$row['amount'],
					$row['status'],
					date_format(date_create($row['date']), 'd-M-Y h:i A')
				);
			}
		}
		else if ($_REQUEST['flag'] == "due_payement") {
			 // $result = $db->select_order('agency_daily_data', null,'id','desc');
			 $result = $db->select_order('agency_daily_data', null, 'date','desc');
			// echo $result;
			 $k=0;
			 foreach($result as $row) {$k++;
				
				$agency = $db->select('agency', ['id' => $row['agency_id']]);
				if ($row['status'] == 1) {
				$data[] = array(
					 
					$k,
					$agency['id'],
					$agency['name'],
					$row['total_amt'],
					$row['receive_amt'],
					$row['deliver_amt'],
					$row['balance'],
					date_format(date_create($row['date']), 'd-M-Y h:i A'),
					"<a onclick='action(this)' id=".$row['id']."><span class='btn btn-success'>Clear</<span></a>",
					
				);
			} else {
								$data[] = array(
					 
					$k,
					$agency['id'],
					$agency['name'],
					$row['total_amt'],
					$row['receive_amt'],
					$row['deliver_amt'],
					$row['balance'],
					date_format(date_create($row['date']), 'd-M-Y h:i A'),
					"<a onclick='action(this)' id=".$row['id']."><span class='btn btn-danger'>Pending</<span></a>",
					
				);
			}
			}
			 
		}
		else if ($_REQUEST['flag'] == "contact") {
			$result = $db->select_order('contact', null,'date','desc');
			$i=0;
			foreach($result as $row) {
				$i++;

				$value1 = $db->select('authority', ['user_id' => $_SESSION['authority'], 'authority' => 'Query And Review']);
				 
				if ($value1['delete1'] == 'Yes') {
					$delete4 = "<a onclick='remove(this)' id=".$row['id']."><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a>";
				}else {
					$delete4 =  "<a><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a>";
				}
				$data[] = array(
					$i,
					ucwords($row['name']),
					$row['number'],
					$row['email'],
					$row['message'],
					$delete4,
					date_format(date_create($row['date']), 'd-M-Y h:i A')
				);
			}
		}
		else if ($_REQUEST['flag'] == "franchise") {
			$result = $db->select_order('franchise', null,'date','desc');
			$i=0;
			foreach($result as $row) {
				$i++;
				$value1 = $db->select('authority', ['user_id' => $_SESSION['authority'], 'authority' => 'Query And Review']);
				 
				if ($value1['delete1'] == 'Yes') {
					$delete4 ="<a onclick='remove1(this)' id=".$row['id']."><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a>";
				}else {
					$delete4 =  "<a><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a>";
				}
				$data[] = array(
					$i,
					ucwords($row['name']),
					$row['number'],
					$row['email'],
					$row['city'],
					$row['message'],
					$delete4,
					date_format(date_create($row['date']), 'd-M-Y h:i A')
				);
			}
		}
		else if ($_REQUEST['flag'] == "career") {
			$result = $db->select_order('career', null,'date','desc');
			$i=0;
			foreach($result as $row) {
				$i++;
				$value1 = $db->select('authority', ['user_id' => $_SESSION['authority'], 'authority' => 'Query And Review']);
				 if ($value1['edit1'] == 'Yes') {
					$show1 =  "<a href='".site_url('../Admin/uploads/resume/').$row['doc']."' _target='blank'><i class='fa fa-download'></i></a>";
				}else {
					$show1 =  "<a  _target='blank'><i class='fa fa-download'></i></a>";
				}
				if ($value1['delete1'] == 'Yes') {
					$delete4 ="<a onclick='remove2(this)' id=".$row['id']."><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a>";
				}else {
					$delete4 =  "<a><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a>";
				}
				$data[] = array(
					$i,
					ucwords($row['name']),
					$row['email'],
					$row['number'],
					$row['city'],
					$row['job_category'],
					$row['message'],
					$show1,
					$delete4,
					date_format(date_create($row['date']), 'd-M-Y h:i A')
				);
			}
		}
		else if ($_REQUEST['flag'] == "hire") {
			$result = $db->select_order('hire_now', null,'date','desc');
			
			foreach($result as $row) {
				$i++;

				$value1 = $db->select('authority', ['user_id' => $_SESSION['authority'], 'authority' => 'Hire Enquery']);
				if ($value1['delete1'] == 'Yes') {
					$delete4 =  "<a onclick='remove(this)' id=".$row['id']."><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a>";
				}else {
					$delete4 =  "<a><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a>";
				}
				$hrvendor = $db->select('users',['id' => $row['vendor']]);
				$hrcategory = $db->select('category',['id' => $hrvendor['category']]);
				$data[] = array(
					$i,
					$row['vendor'],
					ucwords($hrvendor['name']),
					ucwords($hrcategory['category']),
					ucwords($row['name']),
					$row['number'],
					$row['message'],
					$row['city'],
					$delete4,
					date_format(date_create($row['date']), 'd-M-Y h:i A')
				);
			}
		}
		else if ($_REQUEST['flag'] == "role") {
			$result = $db->select('Authority_user', null);
			
			foreach($result as $row) {
				$i++;
				$data[] = array(
					$row['id'],
					ucwords($row['name']),
					$row['number'],
					$row['email'],
					$row['designation'],
					"<a href='role_update?id=".$row['id']."'><img src='http://kamgaro.com/bootstrap/image/edit-icon.png' class='cate-image' /></a>"
				);
			}
		}
		else {
			echo "required";
		}

		$output = array(
			"recordsTotal" => $i,
			"recordsFiltered" => $i,
			"data" => $data
		);
		echo json_encode($output);
		exit();
	}
	else {
		echo "required";
	}
?>