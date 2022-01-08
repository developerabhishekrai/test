<?php
    require('inc/header.php');

    $data = $db->select_order('agency', null,'date','desc');
?>
<style>
    .open {
        background: green; 
        color: white; 
        cursor: pointer;
        padding: 5px 10px; 
        border-radius: 5px;
    }
    .disabled {
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
                <h2>All Agency</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content div-table table-responsive">
                <div class="row">
                    <div class="col-md-8"></div>
                    <div class="row col-md-4" style="margin-bottom: 8px;">
                        <div class="col-sm-6"> <input type="date" id="date" class="input-text" /> </div>
                        <div class="col-sm-6"> <input type="text" id="search" class="input-text" placeholder="Search..." /> </div>
                    </div>
                </div>
                <table width="100%" class="table table-hover table-bordered">
                    <thead>   
                        <tr class="fixed-head">
                            <th scope="col">S.No.</th>
                            <th scope="col">Agency Name</th>
                            <th scope="col">Agent Number</th>
                            <th scope="col">Location</th>
                            <th scope="col">District</th>
                            <th scope="col">State</th>
                            <!-- <th scope="col">Free</th>
                            <th scope="col">Paid</th>
                            <th scope="col">Insured</th> -->
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                            <th scope="col">Delete</th>
                        </tr>  
                    </thead>
                    <tbody id="filter">
                    <?php $count = 0; foreach ($data as $row): $count++;
                    $value1 = $db->select('authority', ['user_id' => $_SESSION['authority'], 'authority' => 'Agencies']);
                // print_r($value1);
                    
                     ?> 
                        <tr>
                            <td><?= $count; ?></td>
                            <td><?= $row['name']; ?></td>
                            <td><?= $row['number']; ?></td>
                            <td><?= $row['area']; ?></td>
                            <td><?= $row['district']; ?></td>
                            <td><?= $row['state']; ?></td>
                            <?php if ($value1['edit1'] == 'Yes') { ?>
                            <?php if ($row['status'] == 1) { ?>
                            <td><span id="<?= $row['id']; ?>" onclick="action(this)" class="open">Active</span></td>
                            <?php }else { ?>
                            <td><span id="<?= $row['id']; ?>" onclick="action(this)" class="disabled">Blocked</span></td>
                            <?php } ?>
                            <?php }else{ ?>
                            <?php if ($row['status'] == 1) { ?>
                            <td><span  class="open">Active</span></td>
                            <?php }else { ?>
                            <td><span class="disabled">Blocked</span></td>
                            <?php }} ?>
                            <td><?= date_format(date_create($row['date']), 'd-M-Y h:i A'); ?></td>
                            <?php if ($value1['edit1'] == 'Yes') { ?>
                            <td>	&nbsp;
                                <a href="<?= site_url('Authority/login').'?acid='.$row['id']; ?>" class="fa fa-eye text-success" style="font-size: 20px;"></a> 
                                
                            </td>
                        <?php }else{ ?>
                            <td>    &nbsp;
                                <a class="fa fa-eye text-success" style="font-size: 20px;"></a> 
                                
                            </td>
                        <?php }  ?>
                            <?php if ($value1['delete1'] == 'Yes') { ?>
                            <td><a id="<?= $row['id']; ?>" onclick="remove(this)" class="fa fa-close text-danger" style="font-size: 20px; padding-left: 3px;"></a></td>
                        </tr>
                    <?php }else{ ?>
                        <td><a class="fa fa-close text-danger" style="font-size: 20px; padding-left: 3px;"></a></td>
                        </tr>
                    <?php } ?>
                    <?php endforeach; ?>      
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#search').keyup(function() {
            var value = $('#search').val().toLowerCase();
            $("#filter tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
        $('#date').change(function() {
            var data = $('data').val();
            $.ajax({
                type: "POST",
                data: {data:data},
                url: "<?= site_url('Authority/getData').'?flag=agency'; ?>",
                success: function(response) {
                    $('#filter').html(response);
                },
                error: function() {
                    alert('Something went wrong');
                }
            })
        })
    })
    function action(e) {
        $.ajax({
            type: "POST",
            data: {id:e.id},
            url: "<?= site_url('Authority/crud').'?flag=agency'; ?>",
            success: function(response) {
                if (response == "success") {
                    location.reload();
                }else {
                    fire_toast(response, 'info');
                }
            },
            error: function() {
                alert('Something went wrong');
            }
        })
    }
    function remove(e) {
        $.ajax({
            type: "POST",
            data: {id:e.id},
            url: "<?= site_url('Authority/crud').'?flag=remove-agency'; ?>",
            success: function(response) {
                if (response == "success") {
                    location.reload();
                }else {
                    fire_toast(response, 'info');
                }
            },
            error: function() {
                alert('Something went wrong');
            }
        })
    }
</script>