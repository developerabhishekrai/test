<?php
    require('inc/header.php');
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
            <h2>All Vendor</h2>
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
                            <th scope="col">S.N</th>
                            <th scope="col">Vendor ID</th>
                            <th scope="col">Business Name</th>
                            <th scope="col">Mobile No.</th>
                            <th scope="col">Agent Name</th>
                            <th scope="col">Freelancer Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Service</th>
                            <th scope="col">Area</th>
                            <th scope="col">District</th>
                            <th scope="col">State</th>
                            <th scope="col">Plan</th>
                            <th scope="col">Visit</th>
                            <th scope="col">Enquery</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                            <th scope="col">Delete</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
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
                                                <label id="user_name" class="lable-for" style="font-size: 12px;font-weight: 300;float: none;">
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
                                                <label class="lable-for" style="font-size: 12px;font-weight: 300;float: left;">
                                                    Vendor ID - <span id="user_id"><!--user_id--></span>
													<br/><br/>
                                                    Email-ID - <span id="user_email"><!--email--></span>
                                                    <br/><br/>
													Mobile No. - <span id="user_no"><!--number--></span>
													<br/><br/>
													Gender - <span id="user_gender"><!--gender--></span>
                                                    <br/><br/>
													Business - <span id="user_business"><!--business--></span>
                                                </label>
                                            </div>
                                            <div class="form-group">
                                                <form id="form-plan">
                                                    <input type="hidden" id="id" name="id" />
                                                    <select class="form-control" name="plan">
                                                        <option>Select Plan</option>
                                                        <option value="Gold">Gold</option>
                                                        <option value="Insured">Insured</option>
                                                        <option value="Prime">Prime</option>
                                                        <option value="Free">Free</option>
                                                    </select>
                                                    <p></p>
                                                    <input type="button" id="btn-update" class="btn btn-success" value="Update">
                                                </form>
                                            </div>
                                            <br/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="" target="_blank" rel="noopener noreferrer" id="btn-login"><button class="btn btn-success">Login</button></a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#show-table').DataTable({
                "pageLength" : 10,
                "ajax": {
                    url : '<?= site_url("Authority/DataTable")."?flag=users"; ?>',
                    type : 'GET'
                },
                "order": [[ 14, "desc" ]]
            });
            $('#btn-update').click(function() {
                $.ajax({
                    type: "POST",
                    data: $('#form-plan').serialize(),
                    url: "<?= site_url('Authority/code').'?flag=plan'; ?>",
                    success: function(response) {
                        if (response == "success") {
                            fire_toast('Data updated.', 'success');
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                        else {
                            fire_toast('Something went wrong.', 'info');
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
				url: '<?= site_url("Authority/crud")."?flag=remove-users"; ?>',
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
				url: '<?= site_url("Authority/getData")."?flag=users"; ?>',
				success: function(response) {
					var obj = jQuery.parseJSON(response);
					$('#id').val(obj.id);
					$('#user_id').html(obj.id);
					$('#user_no').html(obj.number);
					$('#user_name').html(obj.name);
					$('#user_img').html(obj.profile);
					$('#user_email').html(obj.email);
					$('#user_gender').html(obj.gender);
					$('#user_business').html(obj.business);
					$('#btn-login').attr('href', '<?= site_url('Authority/login').'?id='; ?>'+obj.id);
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
				url: '<?= site_url("Authority/crud")."?flag=users"; ?>',
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