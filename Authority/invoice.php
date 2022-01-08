<?php
	$i = 0; $price = 0; 
	if($order['order_status'] == "Cancelled"){
		$image = "bootstrap/image/cancelled-stamp.png";
	}
	else{
		$image = "";
	}
?>
<html>
    <head>
        <title>Manthan Bharat | INVOICE</title>
        <?php echo link_tag('', 'icon'); ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
        <style>
            .btn1 {
                background: green;
                color: white;
                padding: 5px;
                outline: none;
                cursor: pointer;
            }
            #tblCustomers {
                width:700px;
                padding-left:25px;
                padding-right:25px;
                margin:20px auto;
                border:1px solid gray;
				background: url('<?php echo base_url().$image; ?>');
				background-size: 300px;
				background-repeat: no-repeat;
				background-position: center;
            }
			span {
				line-height:25px;
			}
        </style>
        <script>
            function Export() {
                html2canvas(document.getElementById('tblCustomers'), {
                    onrendered: function (canvas) {
                        var data = canvas.toDataURL();
                        var docDefinition = {
                            content: [{
                                image: data,
                                width: 500
                            }]
                        };
                        pdfMake.createPdf(docDefinition).download("invoice.pdf");
                    }
                });
            }
        </script>
    </head>
    <body>
        <div id="tblCustomers">
            <p style="text-align:center;"><b><u>INVOICE</u></b></p>
            <div id="d1" style="height:130px; width:700px;">
                <div style="float:left; width: 350px;">  
                    <?php echo img(array('src' => 'bootstrap/image/logo.jpg', 'style' => 'height: 70px;width: 70px;border: 1px solid green;')); ?>
                </div>
                                   
                <div style="float:left; text-align:right; width:350px;">
                    <span style="font-size:16px; font-weight:bolder;">RECEIPT</span><br/>
                    <span style="font-size:14px; font-weight:bold;">DATE : <?php echo $order['date']; ?></span><br/>
                    <span style="font-size:14px; font-weight:bold;">RECEIPT NO. : <?php echo $order['order_id']; ?></span>
                </div>
            </div>
            <div id="d2" style="height:200px; width:700px;">
                <div style="float:left; width: 350px;">
				<?php foreach($fee as $cnt): ?>
                    <span style="font-size:16px; font-weight:bolder;">BILL TO</span><br/>
                    <span style="font-size:14px; font-weight:bold;">Contact No.: <?php echo $cnt['contact_no']; ?></span><br/>
                    <span style="font-size:14px; font-weight:bold;">Company Name: MANTHAN BHARAT</span><br/>
                    <span style="font-size:14px; font-weight:bold;"> Email: <?php echo $cnt['email_id']; ?></span><p></p> 
                    <span style="font-size:16px; font-weight:bold;">Address :</span><br/>
                    <span style="font-size:13px; font-weight:bold;"><?php echo $cnt['address']; ?></span>
                    <br/><br/>
				<?php endforeach; ?>	
                </div>
                <div style="float:left; width:350px; text-align:right;">
                    <span style="font-size:16px; font-weight:bolder;">SHIP TO</span><br/> 
                    <span style="font-size:14px; font-weight:bold;">Name : <?php echo $user['name']; ?></span><br/>
                    <span style="font-size:14px; font-weight:bold;">Mobile No. : <?php echo $user['number']; ?></span><br/>
                    <span style="font-size:14px; font-weight:bold;">Email : <?php if($user['email'] != ""){echo $user['email'];}else{echo "Not Given";} ?></span><p></p>
                    <span style="font-size:16px; font-weight:bolder;">Address : </span><br/>
                    <span style="font-size:14px; font-weight:bold;"><?php echo $address['address_type']." Address"; ?><br/><?php echo $address['landmark'].", ".$address['street']; ?><br/><?php echo $address['city'].", India ".$address['pincode']; ?><br/>Number : <?php echo $address['number']; ?><br/><br/><br/>
                </div>
            </div>
            <div id="d3" style="width:700px;">
                <table border="1" cellspacing="0" style="width: 100%;">
                    <thead>
                      <tr>
                        <th>Sr.No.</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Quantity</th>
                        <th>Price</th>
                      </tr>
                    </thead>
                    <tbody>
					<?php foreach($product as $prod): $i++; $price+= $prod['price']; ?>
                      <tr style="text-align:center;">        
                        <td style="width:10%"><?php echo $prod['sr']; ?></td>
                        <td style="width:25%"><?php echo $prod['name']; ?></td>
                        <td><?php echo $prod['desc']; ?></td>
                        <td style="width:15%"><?php echo $prod['quantity']; ?></td>
                        <td style="width:15%"><?php echo $prod['price']; ?></td>
                      </tr>
					<?php endforeach; ?>  
                    </tbody>
                </table>
                <div style="border:1px solid; width:698px; height:50px; line-height:50px;">
                    <div style="float:left; width:150px;">
                        &emsp;Total Item - <?php echo $i; ?>
                    </div>
				<?php foreach($fee as $cnt): ?>
                    <div style="text-align: center; float:left; width:398px;">
					<?php 
						if($cnt['shipping'] < $price) {
							echo "Delivery Fee - FREE";
						}
						else {
							$price+= 30;
							echo "Delivery Fee - 30";
						}
					?>
                    </div>
                    <div style="text-align: right; float:left; width:150px;">
                        Total Price - <?php echo $price; ?>&emsp;
                    </div>
				<?php endforeach; ?>	
                </div>
                <br/><br/>
            </div><br/>
        </div>
        <div style="text-align: center;">
            <button class="btn1" id="btnExport" onclick="print()">&nbsp;Download&nbsp;</button>
        </div>
        <br/>
    </body>
</html>