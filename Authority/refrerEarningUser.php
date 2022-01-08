<?php
    require('inc/header.php');
    // $cate = $db->select_order('category', null, 'category', 'ASC');
    // $area = $db->select('agent_area', ['ag_id' => $_SESSION['agent']]);

    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://api.upgradeads.in/getState',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_POSTFIELDS =>'{
        "country": "India"
    }',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
    ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);
    $state = json_decode($response, true);
?>    
    <style>
        #show-table th {
            padding: 10px;
            text-align: center;
			white-space: nowrap;
        }
        #show-table td {
            line-height: 15px;
            text-align: center;
        }
        .div-table {
            min-height: 435px;
            max-height: 600px;
            overflow: auto;
        }
        table {
            position: relative;
        }
        tr.fixed-head th {
            background: #405467;
            color: white;
            z-index: 9;
        }
        th {
            position: sticky;
            top: -1px;
            z-index: 9;
        }
        .cate-image {
            height: 40px;
            width: 40px;
            border-radius: 50%;
            cursor: pointer;
        }
        .show-item {
            width: 90px;
            height: 30px;
            font-size: 14px;
            line-height: 1.42857143;
            color: #555;
            background-color: #fff;
            background-image: none;
            border: 1px solid #ccc;
        }
        .fa-eye {
            color: #fff;
            background: #17a2b8;
            border: medium none;
            border-radius: 2px !important;
            font-size: 15px;
            padding: 7px;
        }
        .box1 {
			min-height: 275px;
            max-height: 330px;
			background: #F1F4F7;
			padding: 10px;
            overflow: auto;
		}
		.group {
			padding-top: 15px;
			text-align: center;
		}
		.lable-for {
			color: #888;
			font-size: 13px;
			margin: 0 0 3px;
			float: left;
		}
        .show-img {
            height: 150px;
            width: 150px;
            border-radius: 50%;
        }
        .action {
            background: red; 
            color: white; 
            cursor: pointer;
            padding: 5px 10px; 
            border-radius: 5px;
        }
    </style>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
            <div class="x_title">
            <h2>All User Earning</h2>
            <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
            </ul>
            <div class="clearfix"></div>
            </div>
            <div class="x_content div-table table-responsive">
                <table id="show-table" width="100%" class="table table-hover table-bordered">
                    <thead>
                    <tr class="fixed-head">
                        <th scope="col">ID</th>
                        <th scope="col">User ID</th>
                        <th scope="col"> User Name</th>
                        <th scope="col">District</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            </div>
        </div>
    </div>
     
    <script type="text/javascript">
        $(document).ready(function() {
            $('#show-table').DataTable({
                "pageLength" : 10,
                "ajax": {
                    url : '<?= site_url("Admin/DataTable")."?flag=userEarning"; ?>',
                    type : 'GET'
                },
                "order": [[ 5, "desc" ]]
            });
             
        });
    </script>
	 