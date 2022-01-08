<?php
    require('inc/header.php');
    $vendor = $db->num_row('users', null);
    $service = $db->num_row('service', null);
    $agent = $db->num_row('agent_data', null);
    $user = $db->num_row('registration', null);
    $category = $db->num_row('category', null);
    $freelancer = $db->num_row('freelancer', null);
?>
<style>
    .canvasjs-chart-credit {
		display: none !important;
	}
    #show-table th {
        padding: 10px;
        text-align: center;
    }
    #show-table td {
        line-height: 40px;
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
    .card {
        height: 115px;
        box-shadow: 0 .15rem 1.75rem 0 rgba(58,59,69,.15);
        border-left: 4px solid #1ABB9C;
        border-radius: 6px;
        line-height: 62px;
        display: block;
    }
    .text {
        color: #2A3F54;
        font-size: 20px;
        font-weight: 500;
        height: 23px;
        cursor: default;
    }
    .icon {
        font-size: 48px;
        color: red;
        float: right;
        margin-top: 13px;
    }
</style>
<div class="row">
    <div class="col-lg-2 col-md-6 col-sm-6 col-12">
        <div class="x_panel card">
            <div style="float: left;">
                <div class="text">Users</div>
                <div class="text"><?= $user; ?></div>
            </div>
            <div class="icon">
                <a href="<?= site_url('Authority/customer'); ?>"><i class="fa fa-users"></i></a>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-6 col-sm-6 col-12">
        <div class="x_panel card">
            <div style="float: left;">
                <div class="text">Vendor</div>
                <div class="text"><?= $vendor; ?></div>
            </div>
            <div class="icon">
                <a href="<?= site_url('Authority/users'); ?>"><i class="fa fa-male"></i></a>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="x_panel card">
            <div style="float: left;">
                <div class="text">Freelancer</div>
                <div class="text"><?= $freelancer; ?></div>
            </div>
            <div class="icon">
                <a href="<?= site_url('Authority/freelancer'); ?>"><i class="fa fa-male"></i></a>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-md-6 col-sm-6 col-12">
        <div class="x_panel card">
            <div style="float: left;">
                <div class="text">Service</div>
                <div class="text"><?= $service; ?></div>
            </div>
            <div class="icon">
                <a href="<?= site_url('Authority/allow_service'); ?>"><i class="fa fa-first-order"></i></a>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="x_panel card">
            <div style="float: left;">
                <div class="text">Category</div>
                <div class="text"><?= $category; ?></div>
            </div>
            <div class="icon">
                <a href="<?= site_url('Authority/category'); ?>"><i class="fa fa-th-list"></i></a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12 p-2">
        <div id="chartContainer"></div>
    </div>
</div>
<?php
    require('inc/footer.php');
?>
<script type="text/javascript">
	window.onload = function() {

		var options = {
			data: [{
					type: "pie",
					startAngle: 45,
					showInLegend: "true",
					legendText: "{label}",
					indexLabel: "{label} ({y})",
					yValueFormatString:"#,##0.#"%"",
					dataPoints: [
						{ label: "Users", y: <?= $user; ?> },
						{ label: "Agent", y: <?= $agent; ?> },
						{ label: "Vendor", y: <?= $vendor; ?> },
                        { label: "Freelancer", y: <?= $freelancer; ?> },
						{ label: "Category", y: <?= $category; ?> },
						{ label: "Services", y: <?= $service; ?> }
					]
			}]
		};
		$("#chartContainer").CanvasJSChart(options);
	}
</script>
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>  
<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>