<?php
    require('inc/header.php');
    $cate = $db->select('category', null);
     $db = new Model;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $value1 = $db->select('authority', ['user_id' => $_SESSION['authority'], 'authority' => 'Product Category']);
                if ($value1['edit1'] == 'Yes') {
         if (!empty($_POST['category'])) {
        $id = "ID".rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9).rand(0, 9);
        $category = $_POST['category'];
        $sql =  "INSERT INTO product_category (id, category) VALUES('$id','$category') ";
        $result1 =$db->db()->query($sql);
        $message = "Added Successfully.";
        }
         
      }else{
        echo "Not eligible";
      }
}
?>
    <style>
        .show-table th {
            padding: 10px;
            text-align: center;
            white-space: nowrap;
        }
        #show-table td, #show-table1 td {
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
        .file-input {
            display: inline-block;
            text-align: left;
            background: #fff;
            border: 1px solid #ccc;
            padding: 6px 12px;
            width: 100%;
            position: relative;
            border-radius: 3px;
        }

        .file-input > [type='file'] {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            z-index: 10;
            cursor: pointer;
        }

        .file-input > .button {
            display: inline-block;
            cursor: pointer;
            background: #eee;
            padding: 8px 16px;
            border-radius: 2px;
            margin-right: 8px;
        }

        .file-input:hover > .button {
            background: dodgerblue;
            color: white;
        }

        .file-input > .label {
            color: #333;
            white-space: nowrap;
            opacity: .7;
        }

        .file-input.-chosen > .label {
            opacity: 1;
        }
    </style>
    <div class="row">
        <div class="col-md-5 col-sm-12 col-xs-12">
            <button id="btncate-box" class="btn btn-primary">PRODUCT CATEGORY</button>
            <!-- <button id="btnsub-box" class="btn btn-info">SUBCATEGORY</button> -->
        </div>
    </div>
    <div class="row" id="cate-box">
        <div class="col-md-5 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>ADD PRODUCT CATEGORY</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link" id="close-btn1"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                <br />
                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-2">
                            <form method="post"  enctype="multipart/form-data" id="new_category" data-parsley-validate class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="category" id="name" placeholder="Category" required class="form-control">
                                    </div>
                                </div>
                                
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1">
                                        <input type="submit" id="btnsubmit" class="btn btn-success" value="Submit">
                                        <button class="btn btn-primary" type="reset">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-7 col-sm-12 col-xs-12 all-width1">
            <div class="x_panel">
            <div class="x_title">
            <h2>ALL PRODUCT CATEGORY</h2>
            <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
            </ul>
            <div class="clearfix"></div>
            </div>
                <div class="x_content div-table table-responsive">
                    <table id="show-table1" width="100%" class="table table-hover table-bordered show-table">
                        <thead>
                            <tr class="fixed-head">
                                <th scope="col">ID</th>
                                <th scope="col">Category</th>
                                <!-- <th scope="col">Edit</th> -->
                                <th scope="col">Delete</th>
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
        <div class="modal fade" id="edit-cate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span style="font-size: 18px;" class="modal-title" id="exampleModalLabel">Update Category</span>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
                                        <form class="form-horizontal form-label-left">
                                            <div class="form-group">
                                                <input type="hidden" id="edit_id1" name="id">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <input type="text" name="category" id="edit_name1" placeholder="Name" required class="form-control">
                                                </div>
                                            </div>
                                            
                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <input type="button" id="updatecate" class="btn btn-success" value="Submit">
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
                    url : '<?= site_url("Authority/DataTable").'?flag=service'; ?>',
                    type : 'GET'
                },
            });
            $('#show-table1').DataTable({
                "pageLength" : 5,
                "ajax": {
                    url : '<?= site_url("Authority/DataTable").'?flag=product_category'; ?>',
                    type : 'GET'
                },
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            if (localStorage.getItem("box") == "cate") {
                $('#cate-box').show();
                $('#subcate-box').hide();
            }
            else if (localStorage.getItem("box") == "subcate") {
                $('#cate-box').hide();
                $('#subcate-box').show();
            }
            
            $('#close-btn').click(function() {
                $('.all-width').addClass("col-md-12");
                $('.all-width').removeClass("col-md-7");
            })
            $('#close-btn1').click(function() {
                $('.all-width1').addClass("col-md-12");
                $('.all-width1').removeClass("col-md-7");
            })
            $('#btncate-box').click(function() {
                localStorage.setItem("box", "cate");
                $('#cate-box').show();
                $('#subcate-box').hide();
            })
            $('#btnsub-box').click(function() {
                localStorage.setItem("box", "subcate");
                $('#cate-box').hide();
                $('#subcate-box').show();
            })
        })
    </script>
	<script>
		$(document).ready(function() {
			$('#btnsubmit').click(function() {
				var data = new FormData(this.form);
				$.ajax({
					type: "POST",
					data: data,
					processData: false,
					contentType: false,
					url: "<?= site_url('Authority/code').'?flag=product_category'; ?>",
					success: function(response){
						if (response == "success") {
							fire_toast("Category added successfully.", "success");
							setTimeout(function() {
								location.reload();
							}, 1000);
						}
						else if (response == "file-error") {
							fire_toast("Select a valid file.", "info");
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
			 
			$('#updatecate').click(function() {
				var data = new FormData(this.form);
				$.ajax({
					type: "POST",
					data: data,
					processData: false,
					contentType: false,
					url: "<?= site_url('Authority/crud').'?flag=product_category'; ?>",
					success: function(response) {
						if (response == "success") {
							fire_toast("Category updated successfully.", "success");
							setTimeout(function() {
								location.reload();
							}, 1000);
						}
						else if (response == "file-error") {
							fire_toast("Select a valid file.", "info");
						}
						else if (response == "required") {
							fire_toast("Please fill all details.", "warning");
                        }
                        else {
							fire_toast("Please fill all details.", "warning");
						}
					},
					error:function() {
						alert("Something went wrong.");
					}					 
				});
			});
			 
	</script>
    <script>
         
        function remove1(e) {
            $.ajax({
                type: "POST",
                data: {id:e.id},
                url: '<?= site_url("Authority/crud")."?flag=remove-product_category"; ?>',
                success: function(response) {
                    if (response == "success") {
                        fire_toast("Category Removed successfully.", "success");
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
         
        function update1(e) {
            $.ajax({
                type: "POST",
                data: {id:e.id},
                url: '<?= site_url("Authority/getData")."?flag=product_category"; ?>',
                success: function(response) {
                    var obj = jQuery.parseJSON(response);
                    $('#edit_name1').val(obj.category);
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