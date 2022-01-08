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
            <h2>Hire Enquiry</h2>
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
                            <th scope="col">Category</th>
							<th scope="col">Name</th>
							<th scope="col">Mobile No.</th>
                            <th scope="col">Message</th>
							<th scope="col">City</th>
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
                    url : '<?php echo site_url('Authority/DataTable').'?flag=hire'; ?>',
                    type : 'GET'
                },
            });
        });
    </script>
	<script>
		function remove(e){
			$.ajax({
				type: "POST",
				data: {id:e.id},
				url: '<?= site_url('Authority/crud').'?flag=hire'; ?>',
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