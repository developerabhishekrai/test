<?php
    require('inc/header.php');

    $result = $db->select('users', null);

    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://wedarranger.com/api/getState?country=India',
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
            line-height: 13px;
            text-align: center;
        }
        .div-table {
            min-height: 435px;
            max-height: 750px;
            overflow: auto;
        }
        table {
            position: relative;
        }
        table th, td {
            text-align: center;
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
        .input-text {
            width: 200px;
            height: 30px;
            border: 1px solid;
            margin-bottom: 5px;
            margin-right: 4px;
        }
    </style>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>All Search</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content div-table table-responsive">
                    <select id="state" class="input-text">
                        <option value="">Select State</option>
                        <?php foreach($state as $row): ?>
                        <option><?= $row['state']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <select id="district" class="input-text">
                        <option value="">Select District</option>
                    </select>
                    <select id="area" class="input-text">
                        <option value="">Select Area</option>
                    </select>
                    <input type="text" name="search" onkeyup="filter(this)" class="input-text" placeholder="Search..." />
                    <table width="100%" class="table table-hover table-bordered">
                        <thead>
                            <tr class="fixed-head">
                                <th scope="col">Agent ID</th>
                                <th scope="col">Profile</th>
                                <th scope="col">Name</th>
                                <th scope="col">Users</th>
                                <th scope="col">City</th>
                                <th scope="col">Action</th>
                                <th scope="col">Delete</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody id="table">
                            <?php 
                                $result = $db->select('agent_data', null);
			
                                foreach($result as $row) {
                                    $count = $db->num_row('users', ['agent_id' => $row['ag_id']]);
                                    $contact = $db->select('agent_contact', ['ag_id' => $row['ag_id']]);

                            $value1 = $db->select('authority', ['user_id' => $_SESSION['authority'], 'authority' => 'Filter Agent']);

                            ?>    
                            <tr>
                                <td><?= $row['ag_id']; ?></td>
                                <?php if ($value1['edit1'] == 'Yes') { ?>
                                <td><a href="<?= site_url('Authority/login').'?aid='.$row['ag_id']; ?>" target='_blank'><?= img(["Agent/picture/".$row['ag_profile'], 'cate-image']); ?></a></td>
                                <?php }else{ ?>
                                <td><a target='_blank'><?= img(["Agent/picture/".$row['ag_profile'], 'cate-image']); ?></a></td>
                                <?php } ?>
                                <td><?= ucwords($row['ag_name']); ?></td>
                                <td><?= $count; ?></td>
                                <td><?= $contact['ag_city']; ?></td>
                                <?php if ($value1['edit1'] == 'Yes') { ?>
                                <td>
                                    <a onclick='detail(this)' id="<?= $row['ag_id']; ?>"><img src='http://kamgaro.com/bootstrap/image/detail-icon.png' class='cate-image' /></a>
                                </td>
                                <?php }else{ ?>
                                <td>
                                     
                                    <a><img src='http://kamgaro.com/bootstrap/image/detail-icon.png' class='cate-image' /></a>
                                </td>
                                <?php } ?>
                                <?php if ($value1['delete1'] == 'Yes') { ?>
                                <td> <a onclick='remove(this)' id="<?= $row['ag_id']; ?>"><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a></td>
                                <?php }else{ ?>
                                <td> <a><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a></td>
                                 <?php } ?>
                                <td><?= date_format(date_create($row['date']), 'd-M-Y h:i A'); ?></td>
                            </tr>
                            <?php } ?>    
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="modal fade" id="customer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-5 col-md-5" style="margin-top: 15px;">
                                <div class="box1">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 group" style="text-align: left;">
                                            <div style="text-align: center;" id="user_img">
                                                <!--image-->
                                            </div>
                                            <br/><br/>
                                            <div class="form-group form-control" style="text-align: center;border: 1px solid #ced4da;background: #fff;height: 40px;">
                                                <label id="user_name" class="lable-for" style="font-size: 12px;font-weight: bolder;float: none;">
                                                    <!--name-->
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7" style="margin-top: 15px;">
                                <div class="box1">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 group" style="text-align: left;">
                                            <div class="form-group form-control" style="border: 1px solid #ced4da;background: #fff;height: 200px;">
                                                <label class="lable-for" style="font-size: 12px;font-weight: bolder;float: left;">
                                                    Agent ID - <span id="user_id"><!--user_id--></span>
													<br/><br/>
                                                    Email-ID - <span id="user_email"><!--email--></span>
                                                    <br/><br/>
													Mobile No. - <span id="user_no"><!--number--></span>
													<br/><br/>
													Gender - <span id="user_gender"><!--gender--></span>
                                                    <br/><br/>
													Address - <span id="user_company"><!--company--></span>
                                                </label>
                                            </div>
                                            <br/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href=""target="_blank" rel="noopener noreferrer" id="btn-login"><button class="btn btn-success">Login</button></a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#state').change(function() {
                var data = $('#state').val();
                $.ajax({
                    type: "POST",
                    data: {data:data},
                    url: "<?= site_url('getData').'?flag=district'; ?>",
                    success: function(response) {
                        var opt = "<option>Select District</option>";
                        var obj = jQuery.parseJSON(response);
                        for (var i = 0; i < obj.length; i++) {
                            opt+= "<option>"+obj[i].district+"</option>";
                        }
                        $('#district').html(opt);

                        $.ajax({
                            type: "POST",
                            data: {data:data},
                            url: "<?= site_url('Authority/filterData').'?flag=state-agent'; ?>",
                            success: function(response) {
                                $('#table').html(response);
                            },
                            error: function() {
                                alert('Something went wrong.');
                            }
                        })
                    },
                    error: function() {
                        alert('Something went wrong.');
                    }
                })
            });
            $('#district').change(function() {
                var state = $('#state').val();
                var data = $('#district').val();
                $.ajax({
                    type: "POST",
                    data: {data:data},
                    url: "<?= site_url('Authority/filterData').'?flag=agent-area'; ?>",
                    success: function(response) {
                        var opt = "<option>Select Area</option>";
                        var obj = jQuery.parseJSON(response);
                        for (var i = 0; i < obj.length; i++) {
                            opt+= "<option>"+obj[i].area+"</option>";
                        }
                        $('#area').html(opt);

                        $.ajax({
                            type: "POST",
                            data: {state:state, data:data},
                            url: "<?= site_url('Authority/filterData').'?flag=district-agent'; ?>",
                            success: function(response) {
                                $('#table').html(response);
                            },
                            error: function() {
                                alert('Something went wrong.');
                            }
                        })
                    },
                    error: function() {
                        alert('Something went wrong.');
                    }
                })
            });
            $('#area').change(function() {
                var data = $('#area').val();
                var state = $('#state').val();
                var dist = $('#district').val();
            
                $.ajax({
                    type: "POST",
                    data: {state:state, dist:dist, data:data},
                    url: "<?= site_url('Authority/filterData').'?flag=area-agent'; ?>",
                    success: function(response) {
                        $('#table').html(response);
                    },
                    error: function() {
                        alert('Something went wrong.');
                    }
                })
            });
            $('#btn-submit').click(function() {
                $.ajax({
                    type: "POST",
                    data: $('#form-area').serialize(),
                    url: "<?= site_url('Authority/code').'?flag=agent-area'; ?>",
                    success: function(response) {
                        if (response == "success") {
                            fire_toast('Data updated successfully.', 'success');
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                        else if (response == "required") {
                            fire_toast('All fields required.', 'info');
                        }
                        else {
                            fire_toast('Something went wrong.', 'error');
                        }
                    },
                    error: function() {
                        alert('Something went wrong.');
                    }
                })
            })
        });
    </script>
	<script>
		function remove(e) {
			$.ajax({
				type: "POST",
				data: {id:e.id},
				url: '<?= site_url("Authority/crud")."?flag=remove-agent"; ?>',
				success: function(response) {
					if (response == "success") {
						fire_toast("Agent Removed successfully.", "success");
						setTimeout(function() {
							location.reload();
						}, 1000);
					}
					else {				
						fire_toast("Something went wrong.", "error");
					}
				},
				error:function(){
					alert("Something went wrong.");
				}					 
			});
		}
		function detail(e) {
			$.ajax({
				type: "POST",
				data: {id:e.id},
				url: '<?= site_url("Authority/getData")."?flag=agent"; ?>',
				success: function(response) {
					var obj = jQuery.parseJSON(response);
                    $('#id').val(obj.id);
					$('#user_id').html(obj.id);
					$('#user_no').html(obj.number);
					$('#user_name').html(obj.name);
                    $('#user_img').html(obj.profile);
					$('#user_email').html(obj.email);
					$('#user_gender').html(obj.gender);
					$('#user_company').html(obj.address);
					$('#btn-login').attr('href', '<?= site_url('Authority/login').'?aid='; ?>'+obj.id);
                    $('#customer').modal('show');
                    if (obj.status == "Pending") {
                        var btn = '<button type="button" onclick="hire()" class="btn btn-success">Approve</button>';
                        $('#verify-btn').html(btn);
                    }else {
                        var btn = '<button type="button" onclick="hire()" class="btn btn-danger">Dismiss</button>';
                        $('#verify-btn').html(btn);
                    }
				},
				error:function(){
					alert("Something went wrong.");
				}					 
			});
		}
        function hire() {
            var id = $('#user_id').html();
            $.ajax({
                type: "POST",
                data: {id:id},
                url: "<?= site_url('Authority/code').'?flag=approve'; ?>",
                success: function(response) {
                    if (response == "success") {
                        location.reload();
                    }
                    else {
                        alert(response);
                    }
                },
                error: function() {
                    alert('Something went wrong.');
                }
            })
        }
        function action(e) {
			$.ajax({
				type: "POST",
				data: {id:e.id},
				url: '<?= site_url("Authority/crud")."?flag=agent"; ?>',
				success: function(response) {
					if (response == "success") {
                        fire_toast('Data updated successfully.', 'success');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                    else {
                        fire_toast('Something went wrong.', 'error');
                    }
				},
				error:function(){
					alert("Something went wrong.");
				}					 
			});
		}
	</script>