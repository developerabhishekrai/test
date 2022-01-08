<?php
    require('inc/header.php');
    
?>
<style>
    .form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
        text-align: center;
        background: cadetblue;
        color: #fff;
    }
</style>
<div class="row">
    <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
        <div class="x_panel">
            <div class="x_title">
                <h2>Download Data</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li><a class="close-link" id="close-btn"><i class="fa fa-close"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <br>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-1">
                        <form class="form-horizontal form-label-left" action="save-data?flag=users" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <span style="margin-left: 40px;" >Data</span>
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <span style="margin-left: 40px;">Starting Date</span>
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <span style="margin-left: 40px;">Ending Date</span>
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <span style="margin-left: 10px;">Action</span>
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                          <?php foreach ($value as $row) {?>
                            <?php  if ($row['authority'] == 'Users' && $row['status'] == 1) { ?>
                        <form class="form-horizontal form-label-left" action="save-data?flag=users" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="Users" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                        <?php } if ($row['authority'] == 'Freelancer' && $row['status'] == 1) { ?>
                        <form class="form-horizontal form-label-left" action="save-data?flag=freelancer" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="Freelancer" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                        <?php } if ($row['authority'] == 'Agencies' && $row['status'] == 1) { ?>
                        <form class="form-horizontal form-label-left" action="save-data?flag=agencies_data" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="Agenices" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                        <?php } if ($row['authority'] == 'Vender' && $row['status'] == 1) { ?>
                        <form class="form-horizontal form-label-left" action="save-data?flag=vendors" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="Vendors" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                        <?php } if ($row['authority'] == 'Payment' && $row['status'] == 1) { ?>
                        <form class="form-horizontal form-label-left" action="save-data?flag=payment" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="Payments" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                        <?php } if ($row['authority'] == 'Agency Payment' && $row['status'] == 1) { ?>
                         <form class="form-horizontal form-label-left" action="save-data?flag=agency_payment" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="Agency" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                        <?php } if ($row['authority'] == 'Agents' && $row['status'] == 1) { ?>
                        <form class="form-horizontal form-label-left" action="save-data?flag=agents" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="Agents Data" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                        <?php } if ($row['authority'] == 'Customer Order' && $row['status'] == 1) { ?>
                        <form class="form-horizontal form-label-left" action="save-data?flag=customer_order" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="Customer Order" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                        <?php } if ($row['authority'] == 'Vendor Order' && $row['status'] == 1) { ?>
                        <form class="form-horizontal form-label-left" action="save-data?flag=vendor_order" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="Vendor Order" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                        <?php } if ($row['authority'] == 'Wallet Money' && $row['status'] == 1) { ?>
                        <form class="form-horizontal form-label-left" action="save-data?flag=wallet_money" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="Wallet" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                        <?php } if ($row['authority'] == 'Withdraw Request' && $row['status'] == 1) { ?>
                        <form class="form-horizontal form-label-left" action="save-data?flag=withdraw_request" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="Withdraw" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                        <?php } if ($row['authority'] == 'User Refer' && $row['status'] == 1) { ?>
                        <form class="form-horizontal form-label-left" action="save-data?flag=user_refer" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="User Refer" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                        <?php } if ($row['authority'] == 'Vendor Refer' && $row['status'] == 1) { ?>
                        <form class="form-horizontal form-label-left" action="save-data?flag=vendor_refer" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="Vendor Refer" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                        <?php } if ($row['authority'] == 'Agent Refer' && $row['status'] == 1) { ?>
                        <form class="form-horizontal form-label-left" action="save-data?flag=agent_refer" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="Agent Refer" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                        <?php } if ($row['authority'] == 'Freelancer Refer' && $row['status'] == 1) { ?>
                        <form class="form-horizontal form-label-left" action="save-data?flag=freelancer_refer" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="Freelancer Refer" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                        <?php } if ($row['authority'] == 'Refer' && $row['status'] == 1) { ?>
                        <form class="form-horizontal form-label-left" action="save-data?flag=refer" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="Refer" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                        <?php } if ($row['authority'] == 'News Data' && $row['status'] == 1) { ?>
                        <form class="form-horizontal form-label-left" action="save-data?flag=news" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="News Data" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                        <?php } if ($row['authority'] == 'Agency Payment' && $row['status'] == 1) { ?>
                         <form class="form-horizontal form-label-left" action="save-data?flag=due_payment" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="Agency Payment" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                        <?php } if ($row['authority'] == 'Product List' && $row['status'] == 1) { ?>
                        <form class="form-horizontal form-label-left" action="save-data?flag=product_list" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="Product List" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                        <?php } if ($row['authority'] == 'Category' && $row['status'] == 1) { ?>
                        <form class="form-horizontal form-label-left" action="save-data?flag=category" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="Category" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                        <?php } if ($row['authority'] == 'Category' && $row['status'] == 1) { ?>
                        <form class="form-horizontal form-label-left" action="save-data?flag=sub_category" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="Sub Category" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                            <?php } if ($row['authority'] == 'Nominee' && $row['status'] == 1) { ?>
                        <form class="form-horizontal form-label-left" action="save-data?flag=nominee" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="Nominee" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                            <?php } if ($row['authority'] == 'Query And Review' && $row['status'] == 1) { ?>
                        <form class="form-horizontal form-label-left" action="save-data?flag=contact_query" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="Contact Query" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>

                         <form class="form-horizontal form-label-left" action="save-data?flag=franchise" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="Franchise" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>

                        <form class="form-horizontal form-label-left" action="save-data?flag=career" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="Career" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                        <?php } } ?>

                        <form class="form-horizontal form-label-left" action="save-data?flag=role" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="Role" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>

                        <form class="form-horizontal form-label-left" action="save-data?flag=user_feedback" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="User Feedback" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                        <form class="form-horizontal form-label-left" action="save-data?flag=vendor_feedback" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="Vendor Feedback" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                        <form class="form-horizontal form-label-left" action="save-data?flag=freelancer_feedback" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="Freelancer Feedback" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                        <form class="form-horizontal form-label-left" action="save-data?flag=agent_feedback" method="POST">
                            <div class="form-group">
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="text" name="name" id="name" value="Agent Feedback" class="form-control" readonly="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date" id="date"  class="form-control" required="">
                                </div>
                                <div class="col-lg-3 col-md-5 col-xs-12">
                                    <input type="date" name="date1" id="date1"  class="form-control" required="">
                                </div>
                                <div class="col-lg-2 col-md-4 col-xs-12">
                                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    require('inc/footer.php');
?>