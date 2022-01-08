<?php
     require('inc/header.php');
    $result = $db->Query("SELECT  * FROM authority ");
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://api.upgradeads.in/getState',
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

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
            <div class="x_title">
            <h2><center>Authority Page</center></h2>
            <ul class="nav navbar-right panel_toolbox">
            <!-- <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li> -->
            </ul>
            <div class="clearfix"></div>
            </div>
            <div class="x_content div-table table-responsive">
                <table id=" " width="100%" class="table table-hover table-bordered">
                    <thead>
                    <tr class="fixed-head">
                        <th scope="col"> ID</th>
                        <th scope="col">Authority</th>
                        <th scope="col">View</th>
                        <th scope="col">Edit</th>
                        <th scope="col">Delete</th>

                    </tr>
                    </thead>
                    <?php 
                        foreach ($result as $row):
                             
                    ?>
                    <tr class="text-center">

                        <td nowrap="nowrap"><?= $row['id']; ?></td>
                        <td nowrap="nowrap"><?= $row['authority']; ?></td>
                        <?php if ($row['view'] == 1) { ?>
                        <td><a onclick='action(this)' id="<?= $row['ag_id']; ?>"><span class='action'>Yes</span></a></td>
                        <?php }else { ?>
                        <td><a onclick='action(this)' id="<?= $row['ag_id']; ?>"><span style="background-color:green;" class='action'>No</span></a></td>
                        <?php } ?>
                        <?php if ($row['edit'] == 1) { ?>
                        <td><a onclick='action(this)' id="<?= $row['ag_id']; ?>"><span class='action'>Yes</span></a></td>
                        <?php }else { ?>
                        <td><a onclick='action(this)' id="<?= $row['ag_id']; ?>"><span style="background-color:green;" class='action'>No</span></a></td>
                        <?php } ?>
                        <?php if ($row['delete'] == 1) { ?>
                        <td><a onclick='action(this)' id="<?= $row['ag_id']; ?>"><span class='action'>Yes</span></a></td>
                        <?php }else { ?>
                        <td><a onclick='action(this)' id="<?= $row['ag_id']; ?>"><span style="background-color:green;" class='action'>No</span></a></td>
                        <?php } ?>    
                        
                    </tr>
                    <?php endforeach; ?>  
                        
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
                            <div class="col-lg-5 col-md-5" style="margin-top: 15px;">
                                <div class="box1">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 group" style="text-align: left;">
                                            <div style="text-align: center;" id="user_img">
                                                <!--image-->
                                            </div>
                                            <br/><br/>
                                            <div class="form-group form-control" style="text-align: center;border: 1px solid #ced4da;background: #fff;height: 40px;">
                                                <label id="user_name" class="lable-for" style="font-size: 12px;font-weight: bolder;float: none;">
                                                    <!--name-->
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-7 col-md-7" style="margin-top: 15px;">
                                <div class="box1">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 group" style="text-align: left;">
                                            <div class="form-group form-control" style="border: 1px solid #ced4da;background: #fff;height: 200px;">
                                                <label class="lable-for" style="font-size: 12px;font-weight: bolder;float: left;">
                                                    Agent ID - <span id="user_id"><!--user_id--></span>
                                                    <br/><br/>
                                                    Email-ID - <span id="user_email"><!--email--></span>
                                                    <br/><br/>
                                                    Mobile No. - <span id="user_no"><!--number--></span>
                                                    <br/><br/>
                                                    Gender - <span id="user_gender"><!--gender--></span>
                                                    <br/><br/>
                                                    Address - <span id="user_address"><!--address--></span>
                                                    <br/><br/>
                                                    Document - <a href="" target="_blank" id="user_document" download>View Document</a>
                                                </label>
                                            </div>
                                            <form id="form-area">
                                                <div class="form-group form-control" style="border: 1px solid #ced4da;background: #fff;height: auto;">
                                                    <select name="state" id="state" class="form-control">
                                                        <option value="">Select State</option>
                                                        <?php foreach($state as $row): ?>
                                                        <option><?= $row['state']; ?></option>    
                                                        <?php endforeach; ?>    
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
                "pageLength" : 10,
                "ajax": {
                    url : '<?= site_url("Authority/DataTable")."?flag=agent"; ?>',
                    type : 'GET'
                },
                "order": [[ 11, "desc" ]]
            });
            $('#state').change(function() {
                var data = $('#state').val();
                $.ajax({
                    type: "POST",
                    data: {data:data},
                    url: "<?= site_url('getData').'?flag=district'; ?>",
                    success: function(response) {
                        var opt = "<select name='district' class='form-control'><option>Select District</option>";
                        var obj = jQuery.parseJSON(response);
                        for (var i = 0; i < obj.length; i++) {
                            opt+= "<option>"+obj[i].district+"</option>";
                        }
                        $('#district-box').html(opt+"</select>");
                    },
                    error: function() {
                        alert('Something went wrong.');
                    }
                })
            });
            $('#btn-submit').click(function() {
                $.ajax({
                    type: "POST",
                    data: $('#form-area').serialize(),
                    url: "<?= site_url('Authority/code').'?flag=agent-area'; ?>",
                    success: function(response) {
                        if (response == "success") {
                            fire_toast('Data updated successfully.', 'success');
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                        else if (response == "required") {
                            fire_toast('All fields required.', 'info');
                        }
                        else {
                            fire_toast('Something went wrong.', 'error');
                        }
                    },
                    error: function() {
                        alert('Something went wrong.');
                    }
                })
            })
        });
    </script>
    <script>
        function remove(e) {
            $.ajax({
                type: "POST",
                data: {id:e.id},
                url: '<?= site_url("Agency/code")."?flag=remove-agent"; ?>',
                success: function(response) {
                    if (response == "success") {
                        fire_toast("Agent Deleted successfully.", "success");
                        setTimeout(function() {
                            window.location.href = 'agent';
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
                url: '<?= site_url("Authority/getData")."?flag=agent"; ?>',
                success: function(response) {
                    var obj = jQuery.parseJSON(response);
                    $('#id').val(obj.id);
                    $('#user_id').html(obj.id);
                    $('#user_no').html(obj.number);
                    $('#user_name').html(obj.name);
                    $('#user_img').html(obj.profile);
                    $('#user_email').html(obj.email);
                    $('#user_gender').html(obj.gender);
                    $('#user_address').html(obj.address);
                    $('#user_document').attr('href', obj.document);
                    $('#btn-login').attr('href', '<?= site_url('Authority/login').'?aid='; ?>'+obj.id);
                    $('#customer').modal('show');
                    if (obj.status == "Pending") {
                        var btn = '<button type="button" onclick="hire()" class="btn btn-success">Approve</button>';
                        $('#verify-btn').html(btn);
                    }else {
                        var btn = '<button type="button" onclick="hire()" class="btn btn-danger">Dismiss</button>';
                        $('#verify-btn').html(btn);
                    }
                },
                error:function(){
                    alert("Something went wrong.");
                }                    
            });
        }
        function hire() {
            var id = $('#user_id').html();
            $.ajax({
                type: "POST",
                data: {id:id},
                url: "<?= site_url('Authority/code').'?flag=approve'; ?>",
                success: function(response) {
                    if (response == "success") {
                        location.reload();
                    }
                    else {
                        alert(response);
                    }
                },
                error: function() {
                    alert('Something went wrong.');
                }
            })
        }
        function action(e) {
            $.ajax({
                type: "POST",
                data: {id:e.id},
                url: '<?= site_url("Agency/code")."?flag=active"; ?>',
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