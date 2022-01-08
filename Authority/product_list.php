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
    </style>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
            <div class="x_title">
            <h2>Product List </h2>
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
                            <th scope="col">S No.</th>
							<th scope="col">Vendor Id</th>
                            <th scope="col">Vendor Name</th>
                            <th scope="col">Busssiness Name</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Product Image</th>
							<th scope="col">Date</th>
							<th scope="col">Delete</th>
						</tr>
                    </thead>
                    <?php $i=0;
                     $result = $db->select_order('product', null,'date','desc');
                     foreach ($result as $value): 
                    $i++;
                    $hrvendor = $db->select('users',['id' => $value['vender_id']]);
                    $product_image = $db->select('product_image',['product_id' => $value['product_id']]);
                    ?>
                        
                    <tbody>
                        <td><?= $i; ?></td>
                        <td><?= $value['vender_id']; ?></td>
                        <td><?= ucwords($hrvendor['name']); ?></td>
                        <td><?= ucwords($hrvendor['business']); ?></td>
                        <td><?= ucwords($value['product_name']); ?></td>
                        <td><img src="../Vendor/uploads/<?= $product_image['image']; ?>" height="100" width="100"></td>
                        <td><?= date_format(date_create($value['date']), 'd-M-Y h:i A'); ?></td>
                        <td><a onclick='remove(this)' id="<?= base64_encode($value['product_id']); ?>"><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a></td>
                    </tbody>
                    <?php endforeach ?>
                </table>
            </div>
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $('#show-table').DataTable({
                "pageLength" : 10,
                 
            });
        });
    </script>
	<script>
		function remove(e){
            // console.log(e);
            // alert(e.id);
			$.ajax({
				type: "POST",
				data: {id:e.id},
				url: '<?= site_url('Admin/crud').'?flag=product_list_delete'; ?>',
				success: function(response){
                    // alert(response);
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