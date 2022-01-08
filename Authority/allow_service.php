<?php
    require('inc/header.php');

    $list = $db->select('category', null);
?>
    <div class="row" id="cate-box">
        <div class="col-md-3 col-sm-12 col-xs-12"></div>
        <div class="col-md-6 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Home Screen Services</h2>
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
                            <form id="service" data-parsley-validate class="form-horizontal form-label-left">
                                <div class="form-group">
                                <?php 
                                    foreach($list as $row):
                                        $allow = $db->select('allow_service', ['id' => $row['id']]);
                                        if ($allow > 0) { 
                                ?>
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <input type="checkbox" name="service[]" value="<?= $row['id']; ?>" checked /> <?= $row['category']; ?>
                                    </div>
                                <?php 
                                        }
                                        else {
                                ?>
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <input type="checkbox" name="service[]" value="<?= $row['id']; ?>"> <?= $row['category']; ?>
                                    </div>
                                <?php
                                        }
                                    endforeach; 
                                ?>    
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="button" id="btnsubmit" class="btn btn-success" value="Submit">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#btnsubmit').click(function() {
                $.ajax({
                    type: "POST",
                    data: $('#service').serialize(),
                    url: "<?= site_url('Authority/code').'?flag=allow_service'; ?>",
                    success: function(response) {
                        if (response == "success") {
                            fire_toast('Data updated successfully.', 'success');
                        }
                        else {
                            fire_toast('Can not update.', 'error');
                        }
                    },
                    error: function() {
                        alert('Something went wrong');
                    }
                })
            })
        })
    </script>    
<?php
    require('inc/footer.php');
?>