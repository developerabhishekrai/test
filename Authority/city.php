<?php
    require('inc/header.php');

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
        .show-table th {
            padding: 10px;
            text-align: center;
            white-space: nowrap;
        }
        #show-table td {
            line-height: 40px;
            text-align: center;
            white-space: nowrap;
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
    </style>
    <div class="row">
        <div class="col-md-5 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>ADD LOCATION</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link" id="close-btn"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
					<br />
                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-2">
                            <form data-parsley-validate id="form-city" class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <select name="state" required class="form-control">
                                            <option value="">Select State</option>
                                            <?php foreach ($state as $row): ?>
                                            <option value="<?= $row['id']; ?>"><?= $row['state']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="district" id="sub_name" placeholder="Name" required class="form-control">
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1">
                                        <input type="button" id="btnsubcate" class="btn btn-success" value="Submit">
                                        <button class="btn btn-primary" type="reset">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-sm-12 col-xs-12 all-width">
            <div class="x_panel">
            <div class="x_title">
            <h2>ALL LOCATION</h2>
            <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
            </ul>
            <div class="clearfix"></div>
            </div>
                <div class="x_content div-table table-responsive">
                    <table id="show-table" width="100%" class="table table-hover table-bordered show-table">
                        <thead>
                            <tr class="fixed-head">
                                <th scope="col">ID</th>
                                <th scope="col">District</th>
                                <th scope="col">Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="modal fade" id="edit-city" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span style="font-size: 18px;" class="modal-title" id="exampleModalLabel">Update Location</span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
                                        <form id="city-update" class="form-horizontal form-label-left">
                                            <input type="hidden" id="edit_id" name="id">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <input type="text" name="district" id="edit_name" placeholder="Name" required class="form-control">
                                                </div>
                                            </div>
                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input type="button" id="subupdate" class="btn btn-success" value="Submit">
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#show-table').DataTable({
                "pageLength" : 5,
                "ajax": {
                    url : '<?= site_url("Authority/DataTable").'?flag=city'; ?>',
                    type : 'GET'
                },
            });
        });
    </script>
	<script>
		$(document).ready(function() {
			$('#close-btn').click(function() {
                $('.all-width').addClass("col-md-12");
                $('.all-width').removeClass("col-md-7");
            })
			$('#btnsubcate').click(function() {
				$.ajax({
					type: "POST",
					data: $('#form-city').serialize(),
					url: "<?= site_url('Authority/code').'?flag=city'; ?>",
					success: function(response){
						if (response == "success") {
							fire_toast("City added successfully.", "success");
							setTimeout(function() {
								location.reload();
							}, 1000);
						}
						else {
							fire_toast("Can Not Update", "warning");
						}
					},
					error:function(){
						alert("Something went wrong.");
					}					 
				});
			});
			$('#subupdate').click(function() {
				$.ajax({
					type: "POST",
					data: $('#city-update').serialize(),
					url: "<?= site_url('Authority/crud').'?flag=city'; ?>",
					success: function(response) {
						if (response == "success") {
							fire_toast("City updated.", "success");
							setTimeout(function() {
								location.reload();
							}, 1000);
						}
						else {
							fire_toast("Please fill all details.", "warning");
						}
					},
					error:function(){
						alert("Something went wrong.");
					}					 
				});
			});
		});
	</script>
    <script>
        function update(e) {
            $('#edit_id').val(e.id);
            $('#edit-city').modal('show');    
        }
    </script>
<?php
    require('inc/footer.php');
?>