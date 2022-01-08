<?php
	require($_SERVER['DOCUMENT_ROOT'].'/config/config.php');
	require(APP_PATH.'Admin/inc/PHPExcel.php');
	require(APP_PATH.'models/Model.php');
	$db = new Model;

	// Create new object
	$objPHPExcel = new PHPExcel();

	if ($_SERVER['REQUEST_METHOD'] == "POST") {
		if($_REQUEST['flag'] == "users") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'ID')
						->setCellValue('B1', 'User Name')
						->setCellValue('C1', 'Mobile No.')
						->setCellValue('D1', 'Email Address')
						->setCellValue('E1', 'Address')
						->setCellValue('F1', 'District')
						->setCellValue('G1', 'State')
						->setCellValue('H1', 'Reg. Date');

			// Add Some Data
			$i = 1;
			$data = $db->select_order('registration', null,'date','asc');
			foreach ($data as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {
					 
				$i++;
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$row['id'].'')
							->setCellValue('B'.$i.'', ''.$row['name'].'')
							->setCellValue('C'.$i.'', ''.$row['number'].'')
							->setCellValue('D'.$i.'', ''.$row['email'].'')
							->setCellValue('E'.$i.'', ''.$row['address'].'')
							->setCellValue('F'.$i.'', ''.$row['district'].'')
							->setCellValue('G'.$i.'', ''.$row['state'].'')
							->setCellValue('H'.$i.'', ''.$row['date'].'');
						}
			}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Users Data');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="users.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
			exit;
		}
		// Agent data

		// End
		else if($_REQUEST['flag'] == "vendors") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'ID')
						->setCellValue('B1', 'User Name')
						->setCellValue('C1', 'Agent Name')
						->setCellValue('D1', 'Freelancer Name')
						->setCellValue('E1', 'Business')
						->setCellValue('F1', 'Category')
						->setCellValue('G1', 'Service')
						->setCellValue('H1', 'Mobile No.')
						->setCellValue('I1', 'Email Address')
						->setCellValue('J1', 'Aadhar No.')
						->setCellValue('K1', 'Area')
						->setCellValue('L1', 'District')
						->setCellValue('M1', 'State')
						->setCellValue('N1', 'Nominee')
						->setCellValue('O1', 'Relation')
						->setCellValue('P1', 'Age')
						->setCellValue('Q1', 'Plan')
						->setCellValue('R1', 'Visited')
						->setCellValue('S1', 'Reg. Date');

			// Add Some Data
			$i = 1;
			$data = $db->select_order('users', null,'date','asc');
			
			foreach ($data as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {

				$i++; $j = 0; $all_service = "";
				$nominee = $db->select('nominee', ['id' => $row['id']]);
				$service = $db->select_row('users_service', ['id' => $row['id']]);
				$data2 = $db->select_row('profile_visiter', ['venderId' => $row['id']]);
				$agent = $db->select('agent_data', ['ag_id' => $row['agent_id']]);
                $freelancer = $db->select('freelancer', ['fr_id' => $row['agent_id']]);
                $count = count($data2);
				foreach ($service as $key) {
					$j++;
					$subcate = $db->select('service', ['id' => $key['service']]);
					if (sizeof($service) > $j) {
						$all_service.= $subcate['service'].", ";
					}else {
						$all_service.= $subcate['service'];
					}
				}
				$cate = $db->select('category', ['id' => $row['category']]);
				$location = $db->select('users_address', ['id' => $row['id']]);
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$row['id'].'')
							->setCellValue('B'.$i.'', ''.$row['name'].'')
							->setCellValue('C'.$i.'', ''.ucwords($agent['ag_name']).'')
							->setCellValue('D'.$i.'', ''.ucwords($freelancer['fr_name']).'')
							->setCellValue('E'.$i.'', ''.$row['business'].'')
							->setCellValue('F'.$i.'', ''.$cate['category'].'')
							->setCellValue('G'.$i.'', ''.$all_service.'')
							->setCellValue('H'.$i.'', ''.$row['number'].'')
							->setCellValue('I'.$i.'', ''.$row['email'].'')
							->setCellValue('J'.$i.'', ''.$row['aadharno'].'')
							->setCellValue('K'.$i.'', ''.$location['area'].'')
							->setCellValue('L'.$i.'', ''.$location['district'].'')
							->setCellValue('M'.$i.'', ''.$location['state'].'')
							->setCellValue('N'.$i.'', ''.$nominee['name'].'')
							->setCellValue('O'.$i.'', ''.$nominee['relation'].'')
							->setCellValue('P'.$i.'', ''.$nominee['age'].'')
							->setCellValue('Q'.$i.'', ''.$row['plan'].'')
							->setCellValue('R'.$i.'', ''.$count.'')
							->setCellValue('S'.$i.'', ''.$row['date'].'');
						}
			}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Vendors Data');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="vendors.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
			exit;
		}
		else if($_REQUEST['flag'] == "customer_order") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'S.N')
						->setCellValue('B1', 'Vender ID')
						->setCellValue('C1', 'Vender Name')
						->setCellValue('D1', 'Customer ID')
						->setCellValue('E1', 'Customer Name')
						->setCellValue('F1', 'Product ID')
						->setCellValue('G1', 'Product Name')
						->setCellValue('H1', 'Price')
						->setCellValue('I1', 'Quantity')
						->setCellValue('J1', 'Area')
						->setCellValue('K1', 'City')
						->setCellValue('L1', 'State')
						->setCellValue('M1', 'Date');
						// ->setCellValue('N1', 'Action');

			// Add Some Data
			 $result = $db->select_order('order_list', null,'date','asc');
			$i=1;

			// print_r($result);
			foreach($result as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {
				$i++;
				 	$users = $db->select('users', ['id' => $row['vender_id']]);
				 	$registration = $db->select('registration', ['id' => $row['customer_id']]);
                    $product = $db->select('product', ['product_id' => $row['product_id']]);
                    $category = $db->select('product_category', ['id' => $product['category_id']]);

                    $users1 = $db->select('users', ['id' => $row['customer_id']]);
				 	$users2 = $db->select('users_address', ['id' => $row['customer_id']]);
				if (!empty($registration)) {
				 if ($row['status'] == 1) {
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['vender_id'].'')
							->setCellValue('C'.$i.'', ''.$users['name'].'')
							->setCellValue('D'.$i.'', ''.$row['customer_id'].'')
							->setCellValue('E'.$i.'', ''.$registration['name'].'')
							->setCellValue('F'.$i.'', ''.$row['product_id'].'')
							->setCellValue('G'.$i.'', ''.$product['product_name'].'')
							->setCellValue('H'.$i.'', ''.$product['price'].'')
							->setCellValue('I'.$i.'', ''.$row['qty'].'')
							->setCellValue('J'.$i.'', ''.$registration['address'].'')
							->setCellValue('K'.$i.'', ''.$registration['district'].'')
							->setCellValue('L'.$i.'', ''.$registration['state'].'')
							->setCellValue('M'.$i.'', ''.$row['date'].'');
							// ->setCellValue('N'.$i.'', ''.$row['Order'].'');
			} else{
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['vender_id'].'')
							->setCellValue('C'.$i.'', ''.$users['name'].'')
							->setCellValue('D'.$i.'', ''.$row['customer_id'].'')
							->setCellValue('E'.$i.'', ''.$registration['name'].'')
							->setCellValue('F'.$i.'', ''.$row['product_id'].'')
							->setCellValue('G'.$i.'', ''.$product['product_name'].'')
							->setCellValue('H'.$i.'', ''.$product['price'].'')
							->setCellValue('I'.$i.'', ''.$row['qty'].'')
							->setCellValue('J'.$i.'', ''.$registration['address'].'')
							->setCellValue('K'.$i.'', ''.$registration['district'].'')
							->setCellValue('L'.$i.'', ''.$registration['state'].'')
							->setCellValue('M'.$i.'', ''.$row['date'].'');
							// ->setCellValue('N'.$i.'', ''.$row['Pending'].'');
			}
		}else{
			if ($row['status'] == 1) {
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['vender_id'].'')
							->setCellValue('C'.$i.'', ''.$users['name'].'')
							->setCellValue('D'.$i.'', ''.$row['customer_id'].'')
							->setCellValue('E'.$i.'', ''.$users1['name'].'')
							->setCellValue('F'.$i.'', ''.$row['product_id'].'')
							->setCellValue('G'.$i.'', ''.$product['product_name'].'')
							->setCellValue('H'.$i.'', ''.$product['price'].'')
							->setCellValue('I'.$i.'', ''.$row['qty'].'')
							->setCellValue('J'.$i.'', ''.$users2['address'].'')
							->setCellValue('K'.$i.'', ''.$users2['district'].'')
							->setCellValue('L'.$i.'', ''.$users2['state'].'')
							->setCellValue('M'.$i.'', ''.$row['date'].'');
							// ->setCellValue('N'.$i.'', ''.$row['Order'].'');
			} else{
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['vender_id'].'')
							->setCellValue('C'.$i.'', ''.$users['name'].'')
							->setCellValue('D'.$i.'', ''.$row['customer_id'].'')
							->setCellValue('E'.$i.'', ''.$users1['name'].'')
							->setCellValue('F'.$i.'', ''.$row['product_id'].'')
							->setCellValue('G'.$i.'', ''.$product['product_name'].'')
							->setCellValue('H'.$i.'', ''.$product['price'].'')
							->setCellValue('I'.$i.'', ''.$row['qty'].'')
							->setCellValue('J'.$i.'', ''.$users2['address'].'')
							->setCellValue('K'.$i.'', ''.$users2['district'].'')
							->setCellValue('L'.$i.'', ''.$users2['state'].'')
							->setCellValue('M'.$i.'', ''.$row['date'].'');
							// ->setCellValue('N'.$i.'', ''.$row['Pending'].'');
			}
		 }
		}
		} 
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Order Data');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			// header('Content-Disposition: attachment;filename="order.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			ob_end_clean();
			// We'll be outputting an excel file
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename="order.xlsx"');
			$objWriter->save('php://output');
			exit;
		}

		else if($_REQUEST['flag'] == "vendor_order") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'S.N')
						->setCellValue('B1', 'Vender ID')
						->setCellValue('C1', 'Vender Name')
						->setCellValue('D1', 'Customer ID')
						->setCellValue('E1', 'Customer Name')
						->setCellValue('F1', 'Product ID')
						->setCellValue('G1', 'Product Name')
						->setCellValue('H1', 'Price')
						->setCellValue('I1', 'Quantity')
						->setCellValue('J1', 'Area')
						->setCellValue('K1', 'City')
						->setCellValue('L1', 'State')
						->setCellValue('M1', 'Date');
						// ->setCellValue('N1', 'Action');

			// Add Some Data
			 $result = $db->select_order('order_list', null,'date','asc');
			$i=1;

			// print_r($result);
			foreach($result as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {
				$i++;
				 	$users = $db->select('users', ['id' => $row['vender_id']]);
				 	$users1 = $db->select('users', ['id' => $row['customer_id']]);
				 	$registration = $db->select('users_address', ['id' => $row['customer_id']]);
                    $product = $db->select('product', ['product_id' => $row['product_id']]);
                    $category = $db->select('product_category', ['id' => $product['category_id']]);
				if (!empty($users)) {
				 if ($row['status'] == 1) {
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['vender_id'].'')
							->setCellValue('C'.$i.'', ''.$users['name'].'')
							->setCellValue('D'.$i.'', ''.$row['customer_id'].'')
							->setCellValue('E'.$i.'', ''.$users1['name'].'')
							->setCellValue('F'.$i.'', ''.$row['product_id'].'')
							->setCellValue('G'.$i.'', ''.$product['product_name'].'')
							->setCellValue('H'.$i.'', ''.$product['price'].'')
							->setCellValue('I'.$i.'', ''.$row['qty'].'')
							->setCellValue('J'.$i.'', ''.$registration['address'].'')
							->setCellValue('K'.$i.'', ''.$registration['district'].'')
							->setCellValue('L'.$i.'', ''.$registration['state'].'')
							->setCellValue('M'.$i.'', ''.$row['date'].'');
							// ->setCellValue('N'.$i.'', ''.$row['Order'].'');
			} else{
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['vender_id'].'')
							->setCellValue('C'.$i.'', ''.$users['name'].'')
							->setCellValue('D'.$i.'', ''.$row['customer_id'].'')
							->setCellValue('E'.$i.'', ''.$users1['name'].'')
							->setCellValue('F'.$i.'', ''.$row['product_id'].'')
							->setCellValue('G'.$i.'', ''.$product['product_name'].'')
							->setCellValue('H'.$i.'', ''.$product['price'].'')
							->setCellValue('I'.$i.'', ''.$row['qty'].'')
							->setCellValue('J'.$i.'', ''.$registration['address'].'')
							->setCellValue('K'.$i.'', ''.$registration['district'].'')
							->setCellValue('L'.$i.'', ''.$registration['state'].'')
							->setCellValue('M'.$i.'', ''.$row['date'].'');
							// ->setCellValue('N'.$i.'', ''.$row['Pending'].'');
			}
		}else{
			if ($row['status'] == 1) {
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['vender_id'].'')
							->setCellValue('C'.$i.'', ''.$users['name'].'')
							->setCellValue('D'.$i.'', ''.$row['customer_id'].'')
							->setCellValue('E'.$i.'', ''.$users1['name'].'')
							->setCellValue('F'.$i.'', ''.$row['product_id'].'')
							->setCellValue('G'.$i.'', ''.$product['product_name'].'')
							->setCellValue('H'.$i.'', ''.$product['price'].'')
							->setCellValue('I'.$i.'', ''.$row['qty'].'')
							->setCellValue('J'.$i.'', ''.$users2['address'].'')
							->setCellValue('K'.$i.'', ''.$users2['district'].'')
							->setCellValue('L'.$i.'', ''.$users2['state'].'')
							->setCellValue('M'.$i.'', ''.$row['date'].'');
							// ->setCellValue('N'.$i.'', ''.$row['Order'].'');
			} else{
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['vender_id'].'')
							->setCellValue('C'.$i.'', ''.$users['name'].'')
							->setCellValue('D'.$i.'', ''.$row['customer_id'].'')
							->setCellValue('E'.$i.'', ''.$users1['name'].'')
							->setCellValue('F'.$i.'', ''.$row['product_id'].'')
							->setCellValue('G'.$i.'', ''.$product['product_name'].'')
							->setCellValue('H'.$i.'', ''.$product['price'].'')
							->setCellValue('I'.$i.'', ''.$row['qty'].'')
							->setCellValue('J'.$i.'', ''.$users2['address'].'')
							->setCellValue('K'.$i.'', ''.$users2['district'].'')
							->setCellValue('L'.$i.'', ''.$users2['state'].'')
							->setCellValue('M'.$i.'', ''.$row['date'].'');
							// ->setCellValue('N'.$i.'', ''.$row['Pending'].'');
			}
		 }
		}
		} 
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Vendor Order');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			// header('Content-Disposition: attachment;filename="order.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			ob_end_clean();
			// We'll be outputting an excel file
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename="vendor_order.xlsx"');
			$objWriter->save('php://output');
			exit;
		}
		else if($_REQUEST['flag'] == "agency_data") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'S.No.')
						->setCellValue('B1', 'Agent ID')
						->setCellValue('C1', 'Agent Name')
						->setCellValue('D1', 'Free')
						->setCellValue('E1', 'Prime')
						->setCellValue('F1', 'Insured')
						->setCellValue('G1', 'Gold')
						->setCellValue('H1', 'Total Amount')
						->setCellValue('I1', 'Received Amount')
						->setCellValue('J1', 'Deliver Amount')
						->setCellValue('K1', 'Balance')
						->setCellValue('L1', 'Any Excuses')
						->setCellValue('M1', 'Date');

			// Add Some Data
			  $user = $db->select('agency', ['id' => $_SESSION['agency']]);
    		  $result = $db->Query("SELECT  * FROM agent_data where agent_data.agency_name='".$user['id']."'");
			  $total = 0; $count1 = 0;
                        $i=1; 
                        foreach ($result as $row){
                        		 $i++;
                            if ($row['status1'] == 1) {
                                $count = $db->num_row('users', ['agent_id' => $row['ag_id']]);
                                $contact = $db->select('agent_area', ['ag_id' => $row['ag_id']]);

                                $agency_data = $db->Query("SELECT  * FROM agency_data where agency_id = '".$row['agency_name']."' and agent_id = '".$row['ag_id']."' and date >= '".date('Y-m-d')."' and date <= '".date('Y-m-d', strtotime("+1 day"))."' order by date DESC");
                                // print_r($agency_data);

                                $free = $db->num_row('users', ['agent_id' => $row['ag_id'], 'plan' => 'Free']);
                                $prime = $db->num_row('users', ['agent_id' => $row['ag_id'], 'plan' => 'Prime']);
                                $insured = $db->num_row('users', ['agent_id' => $row['ag_id'], 'plan' => 'Insured']);
                                $gold = $db->num_row('users', ['agent_id' => $row['ag_id'], 'plan' => 'Gold']);
                    			$val = (float)($paid*100)+(float)($insured*500);
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['ag_id'].'')
							->setCellValue('C'.$i.'', ''.$row['ag_name'].'')
							->setCellValue('D'.$i.'', ''.$free.'')
							->setCellValue('E'.$i.'', ''.$prime.'')
							->setCellValue('F'.$i.'', ''.$insured.'')
							->setCellValue('G'.$i.'', ''.$gold.'')
							->setCellValue('H'.$i.'', ''.$val.'')
							->setCellValue('I'.$i.'', ''.$agency_data[0]['receive_amt'].'')
							->setCellValue('J'.$i.'', ''.$agency_data[0]['deliver_amt'].'')
							->setCellValue('K'.$i.'', ''.$agency_data[0]['balance'].'')
							->setCellValue('L'.$i.'', ''.$agency_data[0]['query'].'')
							->setCellValue('M'.$i.'', ''.$row['date'].'');
			}}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Agent Data');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="Agent Data.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
			exit;
		}
		else if($_REQUEST['flag'] == "freelancer") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'Id')
						->setCellValue('B1', 'Freelancer Id')
						->setCellValue('C1', 'Freelancer Name')
						->setCellValue('D1', 'Number')
						->setCellValue('E1', 'Email')
						->setCellValue('F1', 'Address')
						->setCellValue('G1', 'District')
						->setCellValue('H1', 'State')
						->setCellValue('I1', 'Free')
						->setCellValue('J1', 'Gold')
						->setCellValue('K1', 'Insured')
						->setCellValue('L1', 'Prime')
						->setCellValue('M1', 'Date');

			// Add Some Data
			$result = $db->select_order('freelancer', null,'date','asc');
			  $i = 1;
			foreach($result as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {
			
				$frvendor = $db->select('users',['agent_id' => $row['fr_id']]);
				$free = $db->num_row('users', ['agent_id' => $row['fr_id'], 'plan' => 'Free']);
				$gold = $db->num_row('users', ['agent_id' => $row['fr_id'], 'plan' => 'Gold']);
				$insured = $db->num_row('users', ['agent_id' => $row['fr_id'], 'plan' => 'Insured']);
				$prime = $db->num_row('users', ['agent_id' => $row['fr_id'], 'plan' => 'Prime']);
				$i++;
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['fr_id'].'')
							->setCellValue('C'.$i.'', ''.$row['fr_name'].'')
							->setCellValue('D'.$i.'', ''.$row['number'].'')
							->setCellValue('E'.$i.'', ''.$row['email'].'')
							->setCellValue('F'.$i.'', ''.$row['fr_address'].'')
							->setCellValue('G'.$i.'', ''.$row['fr_district'].'')
							->setCellValue('H'.$i.'', ''.$row['fr_state'].'')
							->setCellValue('I'.$i.'', ''.$free.'')
							->setCellValue('J'.$i.'', ''.$gold.'')
							->setCellValue('K'.$i.'', ''.$insured.'')
							->setCellValue('L'.$i.'', ''.$prime.'')
							->setCellValue('M'.$i.'', ''.$row['date'].'');
						}
			}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Freelancer Data');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="Freelancer Data.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
			exit;
		}
		else if($_REQUEST['flag'] == "agencies_data") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'S.N')
						->setCellValue('B1', 'Agency Name')
						->setCellValue('C1', 'Agent Number')
						->setCellValue('D1', 'Email')
						->setCellValue('E1', 'Location')
						->setCellValue('F1', 'District')
						->setCellValue('G1', 'State')
						->setCellValue('H1', 'Date');

			// Add Some Data
    		$data = $db->select_order('agency', null,'date','asc');
			 
			  $i = 1;
               foreach ($data as $row) { 
               	$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {

               	$i++;

				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['name'].'')
							->setCellValue('C'.$i.'', ''.$row['number'].'')
							->setCellValue('D'.$i.'', ''.$row['email'].'')
							->setCellValue('E'.$i.'', ''.$row['area'].'')
							->setCellValue('F'.$i.'', ''.$row['district'].'')
							->setCellValue('G'.$i.'', ''.$row['state'].'')
							->setCellValue('H'.$i.'', ''.$row['date'].'');
						}
					}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Agencies Data');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="Agencies Data.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');

			exit;
		}
		else if($_REQUEST['flag'] == "agents") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'ID')
						->setCellValue('B1', 'Agent Name')
						->setCellValue('C1', 'Father Name')
						->setCellValue('D1', 'Gender')
						->setCellValue('E1', 'DOB')
						->setCellValue('F1', 'Mobile No.')
						->setCellValue('G1', 'Email Address')
						->setCellValue('H1', 'Qualification')
						->setCellValue('I1', 'Address')
						->setCellValue('J1', 'Area')
						->setCellValue('K1', 'District')
						->setCellValue('L1', 'State')
						->setCellValue('M1', 'Free')
						->setCellValue('N1', 'Prime')
						->setCellValue('O1', 'Insured')
						->setCellValue('P1', 'Gold')
						->setCellValue('Q1', 'Reg. Date');

			// Add Some Data
			$i = 1;
			$data = $db->select_order('agent_data', null,'date','asc');
			foreach ($data as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {
				$i++;
				$area = $db->select('agent_area', ['ag_id' => $row['ag_id']]);
				$contact = $db->select('agent_contact', ['ag_id' => $row['ag_id']]);
				$free = $db->num_row('users', ['agent_id' => $row['ag_id'], 'plan' => 'Free']);
				$paid = $db->num_row('users', ['agent_id' => $row['ag_id'], 'plan' => 'Prime']);
				$insured = $db->num_row('users', ['agent_id' => $row['ag_id'], 'plan' => 'Insured']);
				$gold = $db->num_row('users', ['agent_id' => $row['ag_id'], 'plan' => 'Gold']);

				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$row['ag_id'].'')
							->setCellValue('B'.$i.'', ''.$row['ag_name'].'')
							->setCellValue('C'.$i.'', ''.$row['ag_father'].'')
							->setCellValue('D'.$i.'', ''.$row['ag_gender'].'')
							->setCellValue('E'.$i.'', ''.$row['ag_dob'].'')
							->setCellValue('F'.$i.'', ''.$contact['ag_number'].'')
							->setCellValue('G'.$i.'', ''.$contact['ag_email'].'')
							->setCellValue('H'.$i.'', ''.$row['ag_qualification'].'')
							->setCellValue('I'.$i.'', ''.$contact['ag_paddress'].'')
							->setCellValue('J'.$i.'', ''.$area['area'].'')
							->setCellValue('K'.$i.'', ''.$area['district'].'')
							->setCellValue('L'.$i.'', ''.$area['state'].'')
							->setCellValue('M'.$i.'', ''.$free.'')
							->setCellValue('N'.$i.'', ''.$paid.'')
							->setCellValue('O'.$i.'', ''.$insured.'')
							->setCellValue('P'.$i.'', ''.$gold.'')
							->setCellValue('Q'.$i.'', ''.$row['date'].'');
						}
			}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Agent Data');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="agents.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
			exit;
		}
		else if($_REQUEST['flag'] == "agency_payment") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'S.N')
						->setCellValue('B1', 'Agency Id')
						->setCellValue('C1', 'Agency Name')
						->setCellValue('D1', 'Total Amount')
						->setCellValue('E1', 'Received Amount')
						->setCellValue('F1', 'Deliver Amount')
						->setCellValue('G1', 'Balance')
						->setCellValue('H1', 'Date')
						->setCellValue('I1', 'Action');

			// Add Some Data
			$i = 1;
			$result = $db->select_order('agency_daily_data', null,'date','asc');
			 
			foreach ($result as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {
				$i++;
				$agency = $db->select('agency', ['id' => $row['agency_id']]);
				if ($row['status'] == 1) {
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$agency['id'].'')
							->setCellValue('C'.$i.'', ''.$agency['name'].'')
							->setCellValue('D'.$i.'', ''.$row['total_amt'].'')
							->setCellValue('E'.$i.'', ''.$row['receive_amt'].'')
							->setCellValue('F'.$i.'', ''.$row['deliver_amt'].'')
							->setCellValue('G'.$i.'', ''.$row['balance'].'')
							->setCellValue('H'.$i.'', ''.$row['date'].'')
							->setCellValue('I'.$i.'', ''.'Clear'.'');
			}else {

			$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$agency['id'].'')
							->setCellValue('C'.$i.'', ''.$agency['name'].'')
							->setCellValue('D'.$i.'', ''.$row['total_amt'].'')
							->setCellValue('E'.$i.'', ''.$row['receive_amt'].'')
							->setCellValue('F'.$i.'', ''.$row['deliver_amt'].'')
							->setCellValue('G'.$i.'', ''.$row['balance'].'')
							->setCellValue('H'.$i.'', ''.$row['date'].'')
							->setCellValue('I'.$i.'', ''.'Pending'.'');
		}
	  }
	}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Agency Daily Data');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="Agency Daily Data.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
			exit;
		}
		else if($_REQUEST['flag'] == "wallet_money") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'S.N')
						->setCellValue('B1', 'Freelancer ID/ Freelancer Name')
						->setCellValue('C1', 'User Name')
						->setCellValue('D1', 'Txn ID')
						->setCellValue('E1', 'Amount')
						->setCellValue('F1', 'Payment Method')
						->setCellValue('G1', 'Payment Type')
						->setCellValue('H1', 'Date');

			// Add Some Data
			 $result = $db->select_order('wallet', null,'date','asc');
			$i=1;

			// print_r($result);
			foreach($result as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {
				$i++;
				$registration = $db->select('registration', ['id' => $row['userId']]);
				$users = $db->select('users', ['id' => $row['userId']]);
				$agent_data = $db->select('agent_data', ['ag_id' => $row['userId']]);
				$agent_contact = $db->select('agent_contact', ['ag_id' => $row['userId']]);
				$freelancer = $db->select('freelancer', ['fr_id' => $row['userId']]);
				$agency = $db->select('agency', ['id' => $row['userId']]);
				$users1 = $db->select('users', ['number' => $row['mobile']]);
				if ($registration >0) {
					$name = $registration['name'];
					$email = $registration['email'];
					$number = $registration['number'];
				}else if ($users >0){
					$name = $users['name'];
					$email = $users['email'];
					$number = $users['number'];
				}else if($agent_data >0){
					$name = $agent_data['ag_name'];
					$email = $agent_contact['ag_email'];
					$number = $agent_contact['ag_number'];
				}else if($freelancer >0){
					$name = $freelancer['fr_name'];
					$email = $freelancer['email'];
					$number = $freelancer['number'];
				}else{
					$name = $agency['name'];
					$email = $agency['email'];
					$number = $agency['number'];
				}
				 
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['userId'].$name.'')
							->setCellValue('C'.$i.'', ''.$name.'')
							->setCellValue('D'.$i.'', ''.$row['transaction_id'].'')
							->setCellValue('E'.$i.'', ''.$row['amount'].'')
							->setCellValue('F'.$i.'', ''.$row['payment_method'].'')
							->setCellValue('G'.$i.'', ''.$row['payment_type'].'')
							->setCellValue('H'.$i.'', ''.$row['date'].'');
		 }
		}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Wallet Data');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			// header('Content-Disposition: attachment;filename="order.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			ob_end_clean();
			// We'll be outputting an excel file
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename="wallet.xlsx"');
			$objWriter->save('php://output');
			exit;
		}
		else if($_REQUEST['flag'] == "withdraw_request") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'S.N')
						->setCellValue('B1', 'User ID')
						->setCellValue('C1', 'Holder Name')
						->setCellValue('D1', 'Bank Name')
						->setCellValue('E1', 'Account Number')
						->setCellValue('F1', 'IFSC Code')
						->setCellValue('G1', 'Request Amount')
						->setCellValue('H1', 'Date');

			// Add Some Data
			 $result = $db->select_order('withdraw_request', null,'date','asc');
			$i=1;

			// print_r($result);
			foreach($result as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {
				$i++;
				$req = $db->select('bank_details', ['userId' => $row['user_id']]);
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['user_id'].'')
							->setCellValue('C'.$i.'', ''.$req['holder_name'].'')
							->setCellValue('D'.$i.'', ''.$req['bank_name'].'')
							->setCellValue('E'.$i.'', ''.$req['account_number'].'')
							->setCellValue('F'.$i.'', ''.$req['ifsc_code'].'')
							->setCellValue('G'.$i.'', ''.$row['amount'].'')
							->setCellValue('H'.$i.'', ''.$row['date'].'');
				}
			}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Withdraw Request');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			// header('Content-Disposition: attachment;filename="order.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			ob_end_clean();
			// We'll be outputting an excel file
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename="withdraw_request.xlsx"');
			$objWriter->save('php://output');
			exit;
		}
		else if($_REQUEST['flag'] == "user_refer") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'S.N')
						->setCellValue('B1', 'User ID')
						->setCellValue('C1', 'User Name')
						->setCellValue('D1', 'District')
						->setCellValue('E1', 'Amount')
						->setCellValue('F1', 'Date');

			// Add Some Data
			 $result = $db->select_order('registration', null,'date','asc');
			$i=1;
			foreach($result as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {
				$i++;
				if ($row['status'] == "Active") { 
				$val = $db->select_row('refer', ['venderId' => $row['id'] , 'status' => 'Active' ]);
                $count = count($val)*5;
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['id'].'')
							->setCellValue('C'.$i.'', ''.ucwords($row['name']).'')
							->setCellValue('D'.$i.'', ''.$row['district'].'')
							->setCellValue('E'.$i.'', ''.$count.'')
							->setCellValue('F'.$i.'', ''.$row['date'].'');
				}
			  }
			}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('User Refer ');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			// header('Content-Disposition: attachment;filename="order.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			ob_end_clean();
			// We'll be outputting an excel file
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename="user_refer.xlsx"');
			$objWriter->save('php://output');
			exit;
		}
		else if($_REQUEST['flag'] == "vendor_refer") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'S.N')
						->setCellValue('B1', 'User ID')
						->setCellValue('C1', 'User Name')
						->setCellValue('D1', 'District')
						->setCellValue('E1', 'Amount')
						->setCellValue('F1', 'Date');

			// Add Some Data
			 $result = $db->select_order('users', null,'date','asc');
			$i=1;
			foreach($result as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {
				$i++;
				$hire_now = $db->num_row('hire_now', ['vendor' => $row['id']]);
				$agent = $db->select('agent_data', ['ag_id' => $row['agent_id']]);
				$address = $db->select('users_address', ['id' => $row['id']]);
				$category = $db->select('category', ['id' => $row['category']]);
				$service = $db->select_row('users_service', ['id' => $row['id']]);
				$val = $db->select_row('refer', ['venderId' => $row['id'] , 'status' => 'Active' ]);
                $count = count($val)*5;

				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['id'].'')
							->setCellValue('C'.$i.'', ''.ucwords($row['name']).'')
							->setCellValue('D'.$i.'', ''.$address['district'].'')
							->setCellValue('E'.$i.'', ''.$count.'')
							->setCellValue('F'.$i.'', ''.$row['date'].'');
			  }
			}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Vendor Refer ');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			// header('Content-Disposition: attachment;filename="order.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			ob_end_clean();
			// We'll be outputting an excel file
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename="vendor_refer.xlsx"');
			$objWriter->save('php://output');
			exit;
		}
		else if($_REQUEST['flag'] == "agent_refer") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'S.N')
						->setCellValue('B1', 'User ID')
						->setCellValue('C1', 'User Name')
						->setCellValue('D1', 'District')
						->setCellValue('E1', 'Amount')
						->setCellValue('F1', 'Date');

			// Add Some Data
			 $result = $db->select_order('agent_data', null,'date','asc');
			$i=1;
			foreach($result as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {
					if ($row['status1'] == 1) { 
				$i++;
				$count = $db->num_row('users', ['agent_id' => $row['ag_id']]);
				$agency = $db->select('agency', ['id' => $row['agency_name']]);
				$contact = $db->select('agent_area', ['ag_id' => $row['ag_id']]);
    			$val = $db->select_row('refer', ['venderId' => $row['ag_id'] , 'status' => 'Active' ]);
                $count = count($val)*5;
                
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['ag_id'].'')
							->setCellValue('C'.$i.'', ''.ucwords($row['ag_name']).'')
							->setCellValue('D'.$i.'', ''.$contact['district'].'')
							->setCellValue('E'.$i.'', ''.$count.'')
							->setCellValue('F'.$i.'', ''.$row['date'].'');
			  		}
				}
			}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Agent Refer ');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			// header('Content-Disposition: attachment;filename="order.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			ob_end_clean();
			// We'll be outputting an excel file
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename="agent_refer.xlsx"');
			$objWriter->save('php://output');
			exit;
		}
		else if($_REQUEST['flag'] == "freelancer_refer") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'S.N')
						->setCellValue('B1', 'User ID')
						->setCellValue('C1', 'User Name')
						->setCellValue('D1', 'District')
						->setCellValue('E1', 'Amount')
						->setCellValue('F1', 'Date');

			// Add Some Data
			 $result = $db->select_order('freelancer', null,'date','asc');
			$i=1;
			foreach($result as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {
				$i++;
				$frvendor = $db->select('users',['agent_id' => $row['fr_id']]);
				$val = $db->select_row('refer', ['venderId' => $row['fr_id'] , 'status' => 'Active' ]);
                $count = count($val)*5;
                
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['fr_id'].'')
							->setCellValue('C'.$i.'', ''.ucwords($row['fr_name']).'')
							->setCellValue('D'.$i.'', ''.$row['fr_district'].'')
							->setCellValue('E'.$i.'', ''.$count.'')
							->setCellValue('F'.$i.'', ''.$row['date'].'');
				}
			}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Freelancer Refer ');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			// header('Content-Disposition: attachment;filename="order.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			ob_end_clean();
			// We'll be outputting an excel file
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename="freelancer_refer.xlsx"');
			$objWriter->save('php://output');
			exit;
		}
		else if($_REQUEST['flag'] == "refer") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'S.N')
						->setCellValue('B1', 'ID')
						->setCellValue('C1', 'Refer ID')
						->setCellValue('D1', 'Status')
						->setCellValue('E1', 'Date');

			// Add Some Data
			 $result = $db->select_order('refer', null,'date','asc');
			$i=1;
			foreach($result as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {
				$i++;
				$frvendor = $db->select('users',['agent_id' => $row['fr_id']]);
				$val = $db->select_row('refer', ['venderId' => $row['fr_id'] , 'status' => 'Active' ]);
                $count = count($val)*5;
                
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['venderId'].'')
							->setCellValue('C'.$i.'', ''.($row['referId']).'')
							->setCellValue('D'.$i.'', ''.$row['status'].'')
							->setCellValue('E'.$i.'', ''.$row['date'].'');
				}
			}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Refer ');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			// header('Content-Disposition: attachment;filename="order.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			ob_end_clean();
			// We'll be outputting an excel file
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename="refer.xlsx"');
			$objWriter->save('php://output');
			exit;
		}
		else if($_REQUEST['flag'] == "user_feedback") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'S.N')
						->setCellValue('B1', 'Name')
						->setCellValue('C1', 'Mobile')
						->setCellValue('D1', 'Email')
						->setCellValue('E1', 'Feedback')
						->setCellValue('F1', 'Date');

			// Add Some Data
			// $result = $db->select_order('refer', null,'date','asc');
            $result = $db->Query("select * from feedback where type = 'user' order by date DESC");
			$i=1;
			foreach($result as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {
				$i++;
				$user = $db->select('registration',['id' => $row['userid']]);
                
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['name'].'')
							->setCellValue('C'.$i.'', ''.($row['mobile']).'')
							->setCellValue('D'.$i.'', ''.$row['email'].'')
							->setCellValue('E'.$i.'', ''.$row['feedback'].'')
							->setCellValue('F'.$i.'', ''.$row['date'].'');
				}
			}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('User Feedback');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			// header('Content-Disposition: attachment;filename="order.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			ob_end_clean();
			// We'll be outputting an excel file
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename="user_feedback.xlsx"');
			$objWriter->save('php://output');
			exit;
		}
		else if($_REQUEST['flag'] == "vendor_feedback") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'S.N')
						->setCellValue('B1', 'Name')
						->setCellValue('C1', 'Mobile')
						->setCellValue('D1', 'Email')
						->setCellValue('E1', 'Feedback')
						->setCellValue('F1', 'Date');

			// Add Some Data
			// $result = $db->select_order('refer', null,'date','asc');
            $result = $db->Query("select * from feedback where type = 'vendor' order by date DESC");
			$i=1;
			foreach($result as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {
				$i++;
				$user = $db->select('users',['id' => $row['userid']]);
                
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['name'].'')
							->setCellValue('C'.$i.'', ''.($row['mobile']).'')
							->setCellValue('D'.$i.'', ''.$row['email'].'')
							->setCellValue('E'.$i.'', ''.$row['feedback'].'')
							->setCellValue('F'.$i.'', ''.$row['date'].'');
				}
			}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Vendor Feedback');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			// header('Content-Disposition: attachment;filename="order.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			ob_end_clean();
			// We'll be outputting an excel file
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename="vendor_feedback.xlsx"');
			$objWriter->save('php://output');
			exit;
		}
		else if($_REQUEST['flag'] == "freelancer_feedback") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'S.N')
						->setCellValue('B1', 'Name')
						->setCellValue('C1', 'Mobile')
						->setCellValue('D1', 'Email')
						->setCellValue('E1', 'Feedback')
						->setCellValue('F1', 'Date');

			// Add Some Data
			// $result = $db->select_order('refer', null,'date','asc');
            $result = $db->Query("select * from feedback where type = 'freelancer' order by date DESC");
			$i=1;
			foreach($result as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {
				$i++;
				$user = $db->select('users',['id' => $row['userid']]);
                
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['name'].'')
							->setCellValue('C'.$i.'', ''.($row['mobile']).'')
							->setCellValue('D'.$i.'', ''.$row['email'].'')
							->setCellValue('E'.$i.'', ''.$row['feedback'].'')
							->setCellValue('F'.$i.'', ''.$row['date'].'');
				}
			}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Freelancer Feedback');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			// header('Content-Disposition: attachment;filename="order.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			ob_end_clean();
			// We'll be outputting an excel file
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename="freelancer_feedback.xlsx"');
			$objWriter->save('php://output');
			exit;
		}
		else if($_REQUEST['flag'] == "agent_feedback") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'S.N')
						->setCellValue('B1', 'Name')
						->setCellValue('C1', 'Mobile')
						->setCellValue('D1', 'Email')
						->setCellValue('E1', 'Feedback')
						->setCellValue('F1', 'Date');

			// Add Some Data
			// $result = $db->select_order('refer', null,'date','asc');
            $result = $db->Query("select * from feedback where type = 'agent' order by date DESC");
			$i=1;
			foreach($result as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {
				$i++;
				$user = $db->select('users',['id' => $row['userid']]);
                
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['name'].'')
							->setCellValue('C'.$i.'', ''.($row['mobile']).'')
							->setCellValue('D'.$i.'', ''.$row['email'].'')
							->setCellValue('E'.$i.'', ''.$row['feedback'].'')
							->setCellValue('F'.$i.'', ''.$row['date'].'');
				}
			}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Agent Feedback');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			// header('Content-Disposition: attachment;filename="order.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			ob_end_clean();
			// We'll be outputting an excel file
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename="agent_feedback.xlsx"');
			$objWriter->save('php://output');
			exit;
		}
		else if($_REQUEST['flag'] == "contact_query") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'S.N')
						->setCellValue('B1', 'Name')
						->setCellValue('C1', 'Mobile')
						->setCellValue('D1', 'Email')
						// ->setCellValue('E1', 'City')
						// ->setCellValue('F1', 'Job Category')
						->setCellValue('E1', 'Message')
						->setCellValue('F1', 'Date');

			// Add Some Data
			$result = $db->select_order('contact', null,'date','asc');
			$i=1;
			foreach($result as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {
				$i++;
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['name'].'')
							->setCellValue('C'.$i.'', ''.($row['number']).'')
							->setCellValue('D'.$i.'', ''.$row['email'].'')
							->setCellValue('E'.$i.'', ''.$row['message'].'')
							->setCellValue('F'.$i.'', ''.$row['date'].'');
				}
			}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Contact Query');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			// header('Content-Disposition: attachment;filename="order.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			ob_end_clean();
			// We'll be outputting an excel file
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename="contact_query.xlsx"');
			$objWriter->save('php://output');
			exit;
		}
		else if($_REQUEST['flag'] == "franchise") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'S.N')
						->setCellValue('B1', 'Name')
						->setCellValue('C1', 'Mobile')
						->setCellValue('D1', 'Email')
						->setCellValue('E1', 'City')
						// ->setCellValue('F1', 'Job Category')
						->setCellValue('F1', 'Message')
						->setCellValue('G1', 'Date');

			// Add Some Data
			$result = $db->select_order('franchise', null,'date','asc');
			$i=1;
			foreach($result as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {
				$i++;
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['name'].'')
							->setCellValue('C'.$i.'', ''.($row['number']).'')
							->setCellValue('D'.$i.'', ''.$row['email'].'')
							->setCellValue('E'.$i.'', ''.$row['city'].'')
							->setCellValue('F'.$i.'', ''.$row['message'].'')
							->setCellValue('G'.$i.'', ''.$row['date'].'');
				}
			}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Franchise');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			// header('Content-Disposition: attachment;filename="order.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			ob_end_clean();
			// We'll be outputting an excel file
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename="franchise.xlsx"');
			$objWriter->save('php://output');
			exit;
		}
		else if($_REQUEST['flag'] == "career") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'S.N')
						->setCellValue('B1', 'Name')
						->setCellValue('C1', 'Mobile')
						->setCellValue('D1', 'Email')
						->setCellValue('E1', 'City')
						->setCellValue('F1', 'Job Category')
						->setCellValue('G1', 'Message')
						->setCellValue('H1', 'Date');

			// Add Some Data
			$result = $db->select_order('career', null,'date','asc');
			$i=1;
			foreach($result as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {
				$i++;
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['name'].'')
							->setCellValue('C'.$i.'', ''.($row['number']).'')
							->setCellValue('D'.$i.'', ''.$row['email'].'')
							->setCellValue('E'.$i.'', ''.$row['city'].'')
							->setCellValue('F'.$i.'', ''.$row['job_category'].'')
							->setCellValue('G'.$i.'', ''.$row['message'].'')
							->setCellValue('H'.$i.'', ''.$row['date'].'');
				}
			}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Career');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			// header('Content-Disposition: attachment;filename="order.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			ob_end_clean();
			// We'll be outputting an excel file
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename="career.xlsx"');
			$objWriter->save('php://output');
			exit;
		}
		else if($_REQUEST['flag'] == "news") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'S.N')
						->setCellValue('B1', 'Category')
						->setCellValue('C1', 'Title')
						->setCellValue('D1', 'Url')
						->setCellValue('E1', 'Description')
						->setCellValue('F1', 'Image1')
						->setCellValue('G1', 'Image2')
						->setCellValue('H1', 'Post By')
						->setCellValue('I1', 'Date');

			// Add Some Data
			$result = $db->select_order('news', null,'date','asc');
			$i=1;
			foreach($result as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {
				$i++;
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['category'].'')
							->setCellValue('C'.$i.'', ''.($row['heading']).'')
							->setCellValue('D'.$i.'', ''.$row['url'].'')
							->setCellValue('E'.$i.'', ''.$row['description'].'')
							->setCellValue('F'.$i.'', ''."https://kamgaro.com/Admin/uploads/".$row['image1'].'')
							->setCellValue('G'.$i.'', ''."https://kamgaro.com/Admin/uploads/".$row['image2'].'')
							->setCellValue('H'.$i.'', ''.$row['postedBy'].'')
							->setCellValue('I'.$i.'', ''.$row['date'].'');
				}
			}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('News Data');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			// header('Content-Disposition: attachment;filename="order.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			ob_end_clean();
			// We'll be outputting an excel file
			header('Content-type: application/vnd.ms-excel');
			header('Content-Disposition: attachment; filename="news.xlsx"');
			$objWriter->save('php://output');
			exit;
		}
		else if($_REQUEST['flag'] == "nominee") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'S.N')
						->setCellValue('B1', 'Vendor Id')
						->setCellValue('C1', 'Vendor Name')
						->setCellValue('D1', 'Nominee Name')
						->setCellValue('E1', 'Nominee Mobile No.')
						->setCellValue('F1', 'Nominee Age')
						->setCellValue('G1', 'Nominee Realtion')
						->setCellValue('H1', 'Insurance No.')
						->setCellValue('I1', 'Status')
						->setCellValue('J1', 'date');

			// Add Some Data
			$i = 1;
			$data = $db->select_order('nominee', null,'date','asc');
			foreach ($data as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {

				$i++;
				$user = $db->select('users', ['id' => $row['id']]);

				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['id'].'')
							->setCellValue('C'.$i.'', ''.$user['name'].'')
							->setCellValue('D'.$i.'', ''.$row['name'].'')
							->setCellValue('E'.$i.'', ''.$row['number'].'')
							->setCellValue('F'.$i.'', ''.$row['age'].'')
							->setCellValue('G'.$i.'', ''.$row['relation'].'')
							->setCellValue('H'.$i.'', ''.$row['insurance_no'].'')
							->setCellValue('I'.$i.'', ''.$row['status'].'')
							->setCellValue('J'.$i.'', ''.$row['date'].'');
						}
			}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Nominee Data');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="nominee.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
			exit;
		}
		else if($_REQUEST['flag'] == "product_list") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'S.N')
						->setCellValue('B1', 'Vendor Id')
						->setCellValue('C1', 'Vendor Name')
						->setCellValue('D1', 'Busssiness Name')
						->setCellValue('E1', 'Product Name')
						->setCellValue('F1', 'Product Image')
						->setCellValue('G1', 'date');

			// Add Some Data
			$i = 1;
			$data = $db->select_order('product', null,'date','asc');
			foreach ($data as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {

				$i++;
                $user = $db->select('users',['id' => $row['vender_id']]);
                $product_image = $db->select('product_image',['product_id' => $row['product_id']]);

				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['vender_id'].'')
							->setCellValue('C'.$i.'', ''.$user['name'].'')
							->setCellValue('D'.$i.'', ''.$user['business'].'')
							->setCellValue('E'.$i.'', ''.$row['product_name'].'')
							->setCellValue('F'.$i.'', ''."https://kamgaro.com/Vendor/uploads/".$product_image['image'].'')
								->setCellValue('G'.$i.'', ''.$row['date'].'');
						}
			}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Product List');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="product_list.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
			exit;
		}
		else if($_REQUEST['flag'] == "category") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'S.N')
						->setCellValue('B1', 'Category Id')
						->setCellValue('C1', 'Category Name')
						->setCellValue('D1', 'Category Image')
						->setCellValue('E1', 'date');

			// Add Some Data
			$i = 1;
			$data = $db->select_order('category', null,'date','asc');
			foreach ($data as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {

				$i++;
                
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['id'].'')
							->setCellValue('C'.$i.'', ''.$row['category'].'')
							->setCellValue('D'.$i.'', ''."https://kamgaro.com/Admin/uploads/category/".$row['image'].'')
								->setCellValue('E'.$i.'', ''.$row['date'].'');
						}
			}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Category List');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="category.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
			exit;
		}
		else if($_REQUEST['flag'] == "sub_category") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'S.N')
						->setCellValue('B1', 'Sub Category Id')
						->setCellValue('C1', 'Category Name')
						->setCellValue('D1', 'Sub Category Name')
						->setCellValue('E1', 'Image')
						->setCellValue('F1', 'Banner')
						->setCellValue('G1', 'date');

			// Add Some Data
			$i = 1;
			$data = $db->select_order('service', null,'date','asc');
			foreach ($data as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {

				$i++;
				$cat = $db->select('category',['id'=>$row['category']]);
                
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['id'].'')
							->setCellValue('C'.$i.'', ''.$cat['category'].'')
							->setCellValue('D'.$i.'', ''.$row['service'].'')
							->setCellValue('E'.$i.'', ''."https://kamgaro.com/Admin/uploads/service/".$row['image'].'')
							->setCellValue('F'.$i.'', ''."https://kamgaro.com/Admin/uploads/banner/".$row['banner'].'')
								->setCellValue('G'.$i.'', ''.$row['date'].'');
						}
			}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Sub Category List');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="subcategory.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
			exit;
		}
		else if($_REQUEST['flag'] == "role") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'S.N')
						->setCellValue('B1', 'Id')
						->setCellValue('C1', 'Name')
						->setCellValue('D1', 'Number')
						->setCellValue('E1', 'Email')
						->setCellValue('F1', 'Designation')
						->setCellValue('G1', 'Image')
						->setCellValue('H1', 'date');

			// Add Some Data
			$i = 1;
			$data = $db->select_order('admin_user', null,'date','asc');
			foreach ($data as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {

				$i++;
                
				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$i.'')
							->setCellValue('B'.$i.'', ''.$row['id'].'')
							->setCellValue('C'.$i.'', ''.$row['name'].'')
							->setCellValue('D'.$i.'', ''.$row['number'].'')
							->setCellValue('E'.$i.'', ''.$row['email'].'')
							->setCellValue('F'.$i.'', ''.$row['designation'].'')
							->setCellValue('G'.$i.'', ''."https://kamgaro.com/Admin/uploads/service/".$row['image'].'')
								->setCellValue('H'.$i.'', ''.$row['date'].'');
						}
			}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Role List');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="role.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
			exit;
		}

		else if($_REQUEST['flag'] == "payment") {
			//Add Header
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValue('A1', 'Transaction ID')
						->setCellValue('B1', 'User Id')
						->setCellValue('C1', 'Business')
						->setCellValue('D1', 'Amount')
						->setCellValue('E1', 'Status')
						->setCellValue('F1', 'date');

			// Add Some Data
			$i = 1;
			$data = $db->select_order('transaction', null,'date','asc');
			foreach ($data as $row) {
				$date = date("Y-m-d",strtotime($_POST['date']));
				$date1 = date("Y-m-d",strtotime($_POST['date1']));
				$date2 = date("Y-m-d",strtotime($row['date']));
				if ($date <= $date2 && $date1 >= $date2) {

				$i++;
				$user = $db->select('users', ['id' => $row['id']]);

				$objPHPExcel->setActiveSheetIndex(0)
							->setCellValue('A'.$i.'', ''.$row['txnid'].'')
							->setCellValue('B'.$i.'', ''.$user['id'].'')
							->setCellValue('C'.$i.'', ''.$user['business'].'')
							->setCellValue('D'.$i.'', ''.$row['amount'].'')
							->setCellValue('E'.$i.'', ''.$row['status'].'')
							->setCellValue('F'.$i.'', ''.$row['date'].'');
						}
			}
			// Rename worksheet
			$objPHPExcel->getActiveSheet()->setTitle('Payment Data');

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$objPHPExcel->setActiveSheetIndex(0);

			// Redirect output to a client’s web browser (Excel2007)
			header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
			header('Content-Disposition: attachment;filename="payment.xlsx"');
			header('Cache-Control: max-age=0');

			// If you're serving to IE 9, then the following may be needed
			header('Cache-Control: max-age=1');

			// If you're serving to IE over SSL, then the following may be needed
			header ('Expires: Wed, 01 Jun 2020 05:00:00 GMT'); // Date in the past
			header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
			header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
			header ('Pragma: public'); // HTTP/1.0

			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
			$objWriter->save('php://output');
			exit;
		}
		else
			header("Location:download");
	}
?>