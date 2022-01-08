
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
                    <h2>Vendor Order</h2>
                    <form class="form-horizontal form-label-left">
                            <!-- <div class="form-group float-right" >
                                <div class="col-lg-3 col-md-4 col-xs-12">
                                    <a href="<?= site_url('Admin/save-data').'?flag=customer_order'; ?>">
                                        <input type="button" id="btndownload" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="DOWNLOAD DATA" value="DOWNLOAD">
                                    </a>
                                </div>
                            </div> -->
                            <!-- <div class="ln_solid"></div> -->
                        </form>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content div-table table-responsive">
                    <table id="show-table" width="100%" class="table table-hover table-bordered">
                        <thead>
                            <tr class="fixed-head">
                                <th scope="col">S.N</th>
                                <th scope="col">Vendor ID / Vendor Name</th>
                                <th scope="col">Vendor ID / Vendor Name</th>
                                <th scope="col">Area</th>
                                <th scope="col">City</th>
                                <th scope="col">State</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">QTY</th>
                                <th scope="col">Status</th>
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
        // $(document).ready(function() {
        //     var table = $('#show-table').DataTable( {
        //         fixedHeader: true
        //     });
        // });
        $(document).ready(function() {
            $('#show-table').DataTable({
                "pageLength" : 10,
                "ajax": {
                    url : '<?= site_url("Admin/DataTable")."?flag=ven_order"; ?>',
                    type : 'GET'
                },
                // "order": [[ 10, "desc" ]]
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
	</script>