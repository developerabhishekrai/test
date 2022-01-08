<?php
    require('inc/header.php');
?>
	<style>
        #show-table th, #show-table1 th {
            padding: 10px;
            text-align: center;
			white-space: nowrap;
        }
        #show-table td, #show-table1 td {
            line-height: 13px;
            text-align: center;
			/* white-space: nowrap; */
        }
        .div-table {
            min-height: auto;
            max-height: 425px;
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
            height: 334px;
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
        .fa-star {
            color: #e0e0e0;
            font-size: 26px;
            cursor: pointer;
        }
        .color {
            color: #FFCC33;
        }
        .rate-res {
            position: absolute;
            font-weight: 600;
            font-size: 18px;
        }
        #toast-container > div {
            opacity: 1;
            font-size: 16px;
            font-weight: 600;
        }
    </style>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
            <div class="x_title">
            <h2>Contact Query</h2>
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
							<th scope="col">Name</th>
							<th scope="col">Mobile No.</th>
							<th scope="col">Email ID</th>
							<th scope="col">Message</th>
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
        <div class="modal fade" id="view-feedback" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-l-offset-1 col-m-offset-1" style="margin-top: 15px;">
                                <div class="box1">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 group" style="text-align: left;">
                                            <div style="text-align: center;" id="user_img">
                                                <!--image-->
                                            </div>
                                            <br/><br/>
                                            <div class="form-group form-control" style="text-align: center;border: 1px solid #ced4da;background: #fff;height: 36px;">
                                                <label id="user_id" class="lable-for" style="font-size: 16px;font-weight: 600;float: none;">
                                                    <!--Id-->
                                                </label>
                                            </div><br/>
                                            <div class="form-group form-control" style="text-align: center;border: 1px solid #ced4da;background: #fff;height: 36px;">
                                                <label id="user_name" class="lable-for" style="font-size: 16px;font-weight: 600;float: none;">
                                                    <!--name-->
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8 col-md-8" style="margin-top: 15px;">
                                <div class="box1" style="height: 440px;">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 group" style="text-align: left;">
                                            <label class="lable-for" style="font-size: 16px;font-weight: 600;float: none;">
                                                Customer Feedback
                                            </label>
                                            <div class="form-group form-control" style="border: 1px solid #ced4da;background: #fff;height: 360px;overflow: auto;text-align: left;">
                                                <span style="font-size: 16px;font-weight: 600;color: #888;">
                                                    Subject - &nbsp;
                                                    <label id="subject" class="lable-for" style="font-size: 16px;font-weight: 500;float: none;"></label>
                                                    <hr/>
                                                    Feedback -&nbsp;
                                                    <label id="feedback" class="lable-for" style="font-size: 16px;font-weight: 500;float: none;"></label>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
            <div class="x_title">
            <h2>Franchise</h2>
            <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
            </ul>
            <div class="clearfix"></div>
            </div>
            <div class="x_content div-table table-responsive">
                <table id="show-table1" width="100%" class="table table-hover table-bordered">
                    <thead>
                    <tr class="fixed-head">
                        <th scope="col">S.N</th>
                        <th scope="col">Name</th>
                        <th scope="col">Number</th>
                        <th scope="col">Email</th>
                        <th scope="col">City</th>
                        <th scope="col">Message</th>
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
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
            <div class="x_title">
            <h2>Career</h2>
            <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
            </ul>
            <div class="clearfix"></div>
            </div>
            <div class="x_content div-table table-responsive">
                <table id="show-table2" width="100%" class="table table-hover table-bordered">
                    <thead>
                    <tr class="fixed-head">
                        <th scope="col">S.N</th>
                        <th scope="col">Name</th>
                        <th scope="col">Number</th>
                        <th scope="col">Email</th>
                        <th scope="col">City</th>
                        <th scope="col">Job Category</th>
                        <th scope="col">Message</th>
                        <th scope="col">CV/Resume</th>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('#show-table').DataTable({
                "pageLength" : 10,
                "ajax": {
                    url : '<?php echo site_url('Authority/DataTable').'?flag=contact'; ?>',
                    type : 'GET'
                },
            });
			$('#show-table1').DataTable({
                "pageLength" : 10,
                "ajax": {
                    url : '<?php echo site_url('Authority/DataTable').'?flag=franchise'; ?>',
                    type : 'GET'
                },
            });
        });
        $('#show-table2').DataTable({
                "pageLength" : 10,
                "ajax": {
                    url : '<?php echo site_url('Authority/DataTable').'?flag=career'; ?>',
                    type : 'GET'
                },
            });
    </script>
	<script>
		function remove(e){
			$.ajax({
				type: "POST",
				data: {id:e.id},
				url: '<?= site_url('Authority/crud').'?flag=contact'; ?>',
				success: function(response){
					if (response == "success") {
						fire_toast("Data Removed successfully.", "success");
						setTimeout(function() {
							location.reload();
						}, 1000);
					}
					else if (response == "error") {				
						fire_toast("Something went wrong.", "error");
					}
				},
				error:function(){
					alert("Something went wrong.");
				}					 
			});
        }
        function remove1(e){
			$.ajax({
				type: "POST",
				data: {id:e.id},
				url: '<?= site_url('Authority/crud').'?flag=franchise'; ?>',
				success: function(response){
					if (response == "success") {
						fire_toast("Data Removed successfully.", "success");
						setTimeout(function() {
							location.reload();
						}, 1000);
					}
					else if (response == "error") {				
						fire_toast("Something went wrong.", "error");
					}
				},
				error:function(){
					alert("Something went wrong.");
				}					 
			});
		}
           function remove2(e){
            $.ajax({
                type: "POST",
                data: {id:e.id},
                url: '<?= site_url('Authority/crud').'?flag=career'; ?>',
                success: function(response){
                    if (response == "success") {
                        fire_toast("Data Removed successfully.", "success");
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                    else if (response == "error") {             
                        fire_toast("Something went wrong.", "error");
                    }
                },
                error:function(){
                    alert("Something went wrong.");
                }                    
            });
        }
	</script>
<?php
    require('inc/footer.php');
?>    