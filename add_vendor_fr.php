<?php 
    require($_SERVER['DOCUMENT_ROOT']."/config/config.php");
	require(APP_PATH."config/fileupload.php");
	require(APP_PATH."config/helper.php");
	require(APP_PATH."models/Model.php");
	require(APP_PATH.'config/newSmsApi.php');

	$db = new Model;
 
                $area = $_SESSION['area'];

				if (isset($_SESSION['agent'])) {
					$agent = $_SESSION['agent'];
				}else {
					$agent = null;
				}
                $i = 0;
				$valid_number = $db->num_row('users', ['number' => $_SESSION['number']]);
                $id = "ID".rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
				$password = rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);

				

                // if ($valid_number == 0) {
                   $data = array(
						"id" => $id,
						"agent_id" => $_SESSION['freelancer'],
                  "name" => $_SESSION['name'],
                  "business" => $_SESSION['business'],
                  "email" => strtolower($_SESSION['email']),
                  "number" => $_SESSION['number'],
                  "gender" => $_SESSION['gender'],
                  "aadharno" => $_SESSION['aadhar'],
						"profile" => "user.png",
						"category" => ($_SESSION['category']),
						"background" => "banner.png",
						"password" => md5($password),
						"plan" => $_SESSION['plan'],
                  "status" => "Active",
                  "date" => date('Y:m:d H:i:s')
                    );

					$address = array(
						"id" => $id,
						"address" => $_SESSION['address'],
						"area" => ucwords($area[0]),
						"district" => $_SESSION['district'],
						"state" => $_SESSION['state'],
						"pincode" => $_SESSION['pincode']
					);
					$about = array(
						"id" => $id,
						"about" => "Hi My Name is ".$_SESSION['name']
					);
					$social = array(
                        "vendor_id" => $id,
                        "website" => "website"
                    );


					 
					foreach ($_SESSION['service'] as $key) {
						$i++;
						if ($i < 5) {
							$service = array(
								"id" => $id,
								"service" => base64_decode($key)
							);
							$db->insert('users_service', $service);
						}
					}
						 
						$messagef = "Hii ! Welcome to kamgaro. Your password is ".$password.". Pls don't share your password. To login visit http://www.kamgaro.com/vendorlogin";
						if($db->insert('users', $data)) {
							// $db->insert('users', $data);
                     $db->insert('user_social', $social);
							$db->insert('users_address', $address);
							$db->insert('users_information', $about);
            			     sms($_SESSION['number'], $messagef, '1707161191455869037');
						     mail($_SESSION['email'],"Kamgaro Password",$messagef);
						     echo "<script>
						       alert('Registered Successfuly');
                               window.location.href = 'https://kamgaro.com/Freelancer/dashboard';
						     </script>";
						}


 ?>