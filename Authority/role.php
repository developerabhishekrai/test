<?php
    require('inc/header.php');

?>
<style>
    .agency-row{
        display: flex;
        justify-content: center;
    }
    .card-agency{
        width: 600px;
        background: white;
        padding: 2rem;
        margin-top: 2rem;
        border: 1px solid lightgray;
    }
      #show-table th {
            padding: 10px;
            text-align: center;
            white-space: nowrap;
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
<div class="container">
    <div class="row agency-row">
        <div class="card-agency">
            <h5 class="text-center p-3">Add User</h5>
            <div class="card-body">
                <form id="form-agency">
                    <div class="form-group">
                        <span>Name</span>
                        <input type="text" name="name" class="form-control" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <span>Mobile No.</span>
                        <input type="number" name="number" class="form-control" placeholder="Mobile No.">
                    </div>
                    <div class="form-group">
                        <span>Email</span>
                        <input type="email" name="email" class="form-control" placeholder="Email Address">
                    </div>
                    <div class="form-group">
                        <span>Designation</span>
                        <input type="text" name="designation" class="form-control" placeholder="Designation">
                    </div>
      
                    <div class="form-group agency-row" style="margin-top: 10px;">
                        <button type="button" id="btn-submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
            <div class="x_title">
            <h2>Role</h2>
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
                        <th scope="col">User ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Number</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                        
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
           
                            <div class="col-lg-7 col-md-7" style="margin-top: 15px;">
                                <div class="box1">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 group" style="text-align: left;">
                                               <div class="form-group form-control" style="border: 1px solid #ced4da;background: #fff;height: 200px;">
                                                <label class="lable-for" style="font-size: 12px;font-weight: bolder;float: left;">
                                                    Agent ID - <span id="usertype"><!--user_id--></span>
                                                    <br/><br/>
                                                    Email-ID - <span id="insert_user"><!--email--></span>
                                                    <br/><br/>
                                                    Mobile No. - <span id="update_user"><!--number--></span>
                                                    <br/><br/>
                                                    Gender - <span id="delete_user"><!--gender--></span>
                                                    <br/><br/>
                                                    Address - <span id="select_user"><!--address--></span>
                                               
                                                </label>
                                            </div>
                                            <form id="form-area">
                                                <div class="form-group form-control" style="border: 1px solid #ced4da;background: #fff;height: auto;">
                                                    <select name="usertype" id="usertype" class="form-control">
                                                        <option value="">Yes</option>
                                                      
                                                        <option value="">No</option>   
                                                    </select>
                                                    <p></p>
                                                    <div id="district-box">
                                                        <select name="district" id="district" class="form-control">
                                                            <option value="">Select District</option>
                                                        </select>
                                                    </div>
                                                    <p></p>
                                                    <input type="hidden" id="id" name="id">
                                                    <input type="text" name="area" class="form-control" placeholder="Area Name">
                                                </div>
                                                <div id="verify-btn" class="text-center col-sm-6">
                                                    <!--button-->
                                                </div>
                                                <div class="text-center col-sm-6">
                                                    <button type="button" id="btn-submit" class="btn btn-primary">Update</button>
                                                </div> 
                                            </form>    
                                            <br/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href=""target="_blank" rel="noopener noreferrer" id="btn-login"><button class="btn btn-success">Login</button></a>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                    url : '<?= site_url("Authority/DataTable").'?flag=role'; ?>',
                    type : 'GET'
                },
            });
        });
    </script>
<script>
    $(document).ready(function() {
   
        $('#btn-submit').click(function() {
            $.ajax({
                type: "POST",
                data: $('#form-agency').serialize(),
                url: "<?= site_url('Authority/code').'?flag=admin_user'; ?>",
                success: function(response) {
                    if (response == "success") {
                        fire_toast('Data added successfully.', 'success');
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    }
                    else {
                        fire_toast(response, 'info');
                    }
                },
                error: function() {
                    alert('Something went wrong.');
                }
            })
        })
    })
</script>
<script>
    function update(e) {
      $.ajax({
        type: "POST",
        data: {id:e.id},
        url: "<?= site_url('Vendor/code').'?flag=remove_product_list'; ?>",
        success: function(response) {
          window.location.href = 'product_list';
          // alert(response);
        },
        error: function() {
          alert('Something went wrong.');
        }
      })
    }
</script>


