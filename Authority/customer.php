<?php
    require('inc/header.php');
    if (isset($_POST['submit']))
     {
        $data = $_POST['data'];
        echo $data;
    }
?>    
    <style>
        #show-table th {
            padding: 9px;
            text-align: center;
			white-space: nowrap;
        }
        #show-table td {
            line-height: 13px;
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
        .form-control {
			border: 1px solid #ced4da;
			height: 45px;
			padding: 6px 12px;
			width: 100%;
			font-size: 14px;
			font-weight: 600;
			border-radius: 0px;
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
            <h2>All Users</h2>
                <form id="form-plan" method="post" action="">
            <!-- <form id="form-customer"> -->
            <h2 style="margin-left:750px;">
                <!-- <input type="hidden" name="id" value="12"> -->
                <!-- <button class="btn btn-success" type="button" id="save_value">Delete</button> </h2> -->
            <!-- </form> -->
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
                        <!-- <th scope="col"><input type="checkbox" id="checkAl">Select</th> -->
                            <!-- <input type="hidden" name="id" value="1"> -->
                        <th scope="col">S.N</th>
                        <th scope="col">User ID</th>
                        <th scope="col">Profile</th>
                        <th scope="col">Name</th>
                        <th scope="col">Mobile No.</th>
                        <th scope="col">Email-ID</th>
                        <th scope="col">Address</th>
                        <th scope="col">District</th>
                        <th scope="col">State</th>
                        <th scope="col">Status</th>
                        <th scope="col">Details</th>
                        <th scope="col">Delete</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php $i=0;
            $result = $db->select_order('registration', null,'date','desc');
            foreach($result as $row) { $i++;

                         ?>
                        <tr>
                            <!-- ".site_url('Admin/login')."?cid=".$row['id']." -->
                            <!-- <td><input type="checkbox" id="data[]"  name="data[]" value="<?php echo $row['id'];?>"></td> -->
                            <td><?= $i; ?></td>
                            <td><?= $row['id']; ?></td>
                            <td><a href='<?= site_url('Admin/login').'?cid='.$row['id'] ?>' target='_blank'>
                                <img src='<?= site_url('Customer/picture/').$row['profile']; ?>' class='cate-image' />
                                </a>
                            </td>
                            <td><?= $row['name']; ?></td>
                            <td><?= $row['number']; ?></td>
                            <td><?= $row['email']; ?></td>
                            <td><?= $row['address']; ?></td>
                            <td><?= $row['district']; ?></td>
                            <td><?= $row['state']; ?></td>
                            <td><a onclick='action(this)' id="<?= $row['id']; ?>"><span class='action'>
                                <?= $row['status']; ?></span></a></td>
                            <td><a onclick='detail(this)' id="<?= $row['id']; ?>"><img src='http://kamgaro.com/bootstrap/image/detail-icon.png' class='cate-image' /></a></td>
                            <td><a onclick='remove(this)' id="<?= $row['id']; ?>"><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a></td>
                            <td><?= date_format(date_create($row['date']), 'd-M-Y h:i A'); ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                    <!-- <input type="button" name="update" value="Update" onClick="setUpdateAction();" /> -->
                    <!-- <input type="button" name="delete" value="Delete"  onClick="setDeleteAction();" /> -->
                </table>
                <input type="submit" value="Delete" name="submit"   >
                <!-- <button type="button"  name="btnsubmit" >Delete </button> -->
                </form>
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
                                                    User ID - <span id="user_id"><!--user_id--></span>
													<br/><br/>
                                                    Email-ID - <span id="user_email"><!--email--></span>
                                                    <br/><br/>
													Mobile No. - <span id="user_no"><!--number--></span>
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

    <script type="text/javascript">
        // $(document).ready(function() {
        //     $('#show-table').DataTable({
        //         "pageLength" : 10,
        //         "ajax": {
        //             url : '<?= site_url("Admin/DataTable")."?flag=customer"; ?>',
        //             type : 'GET'
        //         },
        //         "order": [[ 10, "desc" ]]
        //     });
        // });
        $(document).ready(function() {
            $('#show-table').DataTable({
                "pageLength" : 10,
            });
        });
    </script>
    
	<script>
		function remove(e) {
			$.ajax({
				type: "POST",
				data: {id:e.id},
				url: '<?= site_url("Admin/crud")."?flag=remove-customer"; ?>',
				success: function(response) {
					if (response == "success") {
						fire_toast("User Removed successfully.", "success");
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
				url: '<?= site_url("Admin/getData")."?flag=customer"; ?>',
				success: function(response) {
					var obj = jQuery.parseJSON(response);
					$('#user_img').html(obj.profile);
					$('#user_id').html(obj.id);
					$('#user_no').html(obj.number);
					$('#user_name').html(obj.name);
					$('#user_email').html(obj.email);
					$('#user_company').html(obj.address);
                    $('#btn-login').attr('href', '<?= site_url('Admin/login').'?cust='; ?>'+obj.id);
                    $('#customer').modal('show');
				},
				error:function(){
					alert("Something went wrong.");
				}					 
			});
		}
        function action(e) {
			$.ajax({
				type: "POST",
				data: {id:e.id},
				url: '<?= site_url("Admin/crud")."?flag=customer"; ?>',
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
         $('#save_value').click(function() {
            // alert("hello");
            if (confirm("Are You Sure you want to delete this?")) {
            var id = [];
            $(':checkbox:checkbox').each(function(i) {
                id[i] = $(this).val();
            });
            
            if(id.length === 0){
                alert("Please Select atleast one checkbox")
                // return false;
            }else{
                $.ajax({
                type: "POST",
                data: {id:id},
                // data:$('#form-plan').serialize(),
                url: "<?= site_url('Admin/code').'?flag=customer_delete'; ?>",
                success: function(response) {
                    alert(response);
                    if (response == "success") {
                        fire_toast('Data delete successfully.', 'success');
                        setTimeout(() => {
                            // location.reload();
                        }, 1000);
                    }
                    else {
                        fire_toast(response, 'info');
                    }
                },
                error: function() {
                    alert('Something went wrong.');
                }
            })

            }
        }else{
            return false;
        }
            
        })
 
	</script>