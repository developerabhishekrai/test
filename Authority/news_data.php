<?php
    require('inc/header.php');
    $cate = $db->select('category', null);

    $result = $db->select_order('news', null,'date','desc');

?>


<style>
        .show-table th {
            padding: 10px;
            text-align: center;
            white-space: nowrap;
        }
        #show-table td, #show-table1 td {
            line-height: 15px;
            text-align: center;
            white-space: none;
            /* white-space: nowrap; */
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

<div class="x_panel">
    <div class="x_title">
        <h2>ALL NEWS</h2>
        <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
            <li><a class="close-link"><i class="fa fa-close"></i></a></li>
        </ul>
        <div class="clearfix"></div>
    </div>
    <div class="table-responsive">
        <table id="show-table1" width="100%" class="table table-hover table-bordered">
            <thead>
                <tr class="fixed-head">
                    <th>ID</th>
                    <th>Date</th>
                    <th>Posted By</th>
                    <th>Category</th>
                    <th>Title</th>
                    <th>Url</th>
                    <th>Description</th>
                    <th>Image1</th>
                    <th>Image2</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
            
                <?php $i=0; foreach($result as $row) {  $i++; ?>
                <tr>
                    <td class="p-1"> <?= $i; ?></td>
                    <td class="p-1"> <?= date_format(date_create($row['date']), 'd-M-Y h:i A') ?></td>
                    <td class="p-1"> <?= $row['postedBy']; ?></td>
                    <td class="p-1"> <?= $row['category']; ?></td>
                    <td class="p-1"> <?= $row['heading']; ?></td>
                    <td class="p-1"> <?= $row['url']; ?></td>
                    <td class="p-1" data-toggle="modal" data-target="#viewDetail" style="cursor: pointer;"><a onclick='detail(this)' id="<?= $row['id']; ?>">View Details</a> 
                     </td>
                    <td class="p-1"> <img src="../Admin/uploads/<?= $row['image1']; ?>" class="cate-image"></td>
                    <td class="p-1"> <img src="../Admin/uploads/<?= $row['image2']; ?>" class="cate-image"></td>
                    <td class="p-1" data-toggle="modal" data-target="#edit-cate" style="cursor: pointer;"> 
                        <!-- <i class="fas fa-edit"> -->
                        <a onclick='update(this)' id="<?= $row['id']; ?>"><img src='http://kamgaro.com/bootstrap/image/edit-icon.png' class='cate-image' /></a>
                    <!-- </i>  -->
                    </td>
                    <td class="p-1"> <a onclick='remove(this)' id="<?= $row['id']; ?>"><img src='http://kamgaro.com/bootstrap/image/delete-icon.png' class='cate-image' /></a> </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<!-- modal edit -->
       <div class="row">
        <div class="modal fade" id="edit-cate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span style="font-size: 18px;" class="modal-title" id="exampleModalLabel">Update NEWS</span>
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
                                                <input type="hidden" id="edit_id" name="id">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <input type="text" name="heading" id="edit_heading" placeholder="Heading" required class="form-control">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <textarea name="description" id="edit_description" placeholder="Enter Description" required class="form-control" ></textarea>
                                                <!-- <input type="text" name="description" id="description" placeholder="Enter Description" required class="form-control"> -->
                                            </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="file-input">
                                                        <input type="file" id="edit_image1" name="edit_image1">
                                                        <span class="button">Choose</span>
                                                        <span class="label" style="font-size: 14px;font-weight: 500;padding: .2em 0em .3em;" data-js-label>No file selected</label>
                                                    </div>
                                                    <script>
                                                        var inputs = document.querySelectorAll('.file-input')
                                                            
                                                        for (var i = 0, len = inputs.length; i < len; i++) {
                                                            customInput(inputs[i])
                                                        }
                                                            
                                                        function customInput (el) {
                                                            const fileInput = el.querySelector('[type="file"]')
                                                            const label = el.querySelector('[data-js-label]')
                                                                
                                                            fileInput.onchange =
                                                            fileInput.onmouseout = function () {
                                                                if (!fileInput.value) return
                                                                
                                                                var value = fileInput.value.replace(/^.*[\\\/]/, '')
                                                            el.className += ' -chosen'
                                                                if(value.length > 18)
                                                                {
                                                                    var lastWord = value.substr(value.length - 7);
                                                                    var firstWord = value.substring(0,9);
                                                                    label.innerText = firstWord+"... "+lastWord
                                                                }
                                                                else
                                                                {
                                                                    label.innerText = value
                                                                }
                                                            }
                                                        }
                                                    </script>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="file-input">
                                                        <input type="file" id="edit_image2" name="edit_image2">
                                                        <span class="button">Choose</span>
                                                        <span class="label" style="font-size: 12px;font-weight: 500;padding: .2em 0em .3em;" data-js-label>No File selected</label>
                                                    </div>
                                                        <script>

                                                            var inputs = document.querySelectorAll('.file-input')
                                                            
                                                            for (var i = 0, len = inputs.length; i < len; i++) {
                                                                customInput(inputs[i])
                                                            }
                                                            
                                                            function customInput (el) {
                                                            const fileInput = el.querySelector('[type="file"]')
                                                            const label = el.querySelector('[data-js-label]')
                                                            
                                                            fileInput.onchange =
                                                            fileInput.onmouseout = function () {
                                                                if (!fileInput.value) return
                                                                
                                                                var value = fileInput.value.replace(/^.*[\\\/]/, '')
                                                                el.className += ' -chosen'
                                                                if(value.length > 16)
                                                                {
                                                                    var lastWord = value.substr(value.length - 7);
                                                                    var firstWord = value.substring(0,6);
                                                                    label.innerText = firstWord+"... "+lastWord
                                                                }
                                                                else
                                                                {
                                                                label.innerText = value
                                                                }
                                                            }
                                                            }
                                                        </script>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <input type="text" name="url" id="edit_url" placeholder="Enter Url"  class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <input type="text" name="posted" id="edit_postedBy" placeholder="Posted By"  class="form-control">
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
<!-- Modal -->
<div class="modal fade" id="viewDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Description</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="desc"  >
                <p >
               <!--  कोरोना के लिए एक और दवा को मंजूरी, DRDO की मेडिसिन से कम होगी ऑक्सीजन की जरूरत https://www.aajtak.in/coronavirus/story/dcgi-approves-anti-covid-drug-developed-by-drdo-for-emergency-use-1251374-2021-05-08 -->
                   
               </p>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('#show-table1').DataTable();
    });

    function detail(e) {
        // alert("hello");
            $.ajax({
                type: "POST",
                data: {id:e.id},
                url: '<?= site_url("Admin/getData")."?flag=getNews"; ?>',
                success: function(response) {
                    // alert(response);
                    var obj = jQuery.parseJSON(response);
                    $('#desc').html(obj.description);
                    $('#viewDetail').modal('show');
                },
                error:function(){
                    alert("Something went wrong.");
                }                    
            });
        }
        function remove(e) {
            $.ajax({
                type: "POST",
                data: {id:e.id},
                url: '<?= site_url("Admin/crud")."?flag=remove-news"; ?>',
                success: function(response) {
                    if (response == "success") {
                        fire_toast("News Removed.", "success");
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
        function update(e) {
            $.ajax({
                type: "POST",
                data: {id:e.id},
                url: '<?= site_url("Admin/getData")."?flag=news"; ?>',
                success: function(response) {
                    // alert(response);
                    var obj = jQuery.parseJSON(response);
                    $('#edit_id').val(obj.id);
                    $('#edit_heading').val(obj.heading);
                    $('#edit_description').val(obj.description);
                    $('#edit_url').val(obj.url);
                    // $('#edit_image2').val(obj.image2);
                    $('#edit_postedBy').val(obj.postedBy);
                    $('#edit-cate').modal('show');
                },
                error:function(){
                    alert("Something went wrong.");
                }                    
            });
        }


</script>
    <script>
        $(document).ready(function() {
            $('#updatecate').click(function() {
                var data = new FormData(this.form);
                $.ajax({
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    url: "<?= site_url('Admin/crud').'?flag=updateNews'; ?>",
                    success: function(response) {
                        // alert(response);
                        if (response == "success") {
                            fire_toast("News updated successfully.", "success");
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                        else if (response == "file-error") {
                            fire_toast("Select a valid file.", "info");
                        }
                        else if (response == "required") {
                            fire_toast("Please fill all details1.", "warning");
                        }
                        else {
                            fire_toast("Please fill all details2.", "warning");
                        }
                    },
                    error:function() {
                        alert("Something went wrong.");
                    }                    
                });
            });
             
        });
$(document).ready(function() {
        
        
        
        });
    </script>
    <script>

      </script>  

<?php
    require('inc/footer.php');
?>