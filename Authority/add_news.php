<?php
    require('inc/header.php');
    $cate = $db->select('category', null);
    $newscate = $db->select('news_category', null);
?>
    <style>
        .show-table th {
            padding: 10px;
            text-align: center;
            white-space: nowrap;
        }
        #show-table td, #show-table1 td {
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
    <div class="row">
        <div class="col-md-5 col-sm-12 col-xs-12">
            <button id="btncate-box" class="btn btn-primary">NEWS</button>
            <!-- <button id="btnsub-box" class="btn btn-info">SUBCATEGORY</button> -->
        </div>
    </div>
    <div class="row" id="cate-box">
        <!-- <div class="col-md-3 col-sm-12 col-xs-12"></div> -->
        <div class="col-md-5 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>ADD NEWS</h2>
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
                            <form  enctype="multipart/form-data" id="new_category" data-parsley-validate class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <select class="form-control" name="category" id="category" >
                                            <option value="">Select Category</option>
                                            <?php foreach($newscate as $row){ ?>
                                            <option value="<?= $row['category']; ?>"><?= $row['category']; ?></option>
                                        <?php } ?>
                                        </select>
                                        <!-- <input type="text" maxlength="100" name="heading" id="heading" placeholder="Enter Title" required class="form-control"> -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" maxlength="100" name="heading" id="heading" placeholder="Enter Title" required class="form-control">
                                    </div>
                                </div>
                                 
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <textarea name="description" id="description" placeholder="Enter Description" required class="form-control" ></textarea>
                                        <!-- <input type="text" name="description" id="description" placeholder="Enter Description" required class="form-control"> -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="url" id="url" placeholder="Enter Url Here" required class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="file-input">
                                            <input type="file" id="img" name="image1">
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
                                        <div class="file-input">
                                            <input type="file" id="banner1" name="image2">
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
                                        <!-- <textarea name="posted" id="description" placeholder="Posted By" required class="form-control" ></textarea> -->
                                        <input type="text" name="posted" id="description" placeholder="Posted By" required class="form-control">
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1">
                                        <input type="button" id="btnsubmit" class="btn btn-success" value="Submit">
                                        <button class="btn btn-primary" type="reset">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add category -->
        <div class="row" id="cate-box">
        <div class="col-md-3 col-sm-12 col-xs-12"></div>
        <div class="col-md-5 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>ADD Category</h2>
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
                            <form  enctype="multipart/form-data" id="new_category" data-parsley-validate class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" maxlength="100" name="category" id="heading" placeholder="Enter Category" required class="form-control">
                                    </div>
                                </div>
                                 
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1">
                                        <input type="button" id="btnsubmit1" class="btn btn-success" value="Submit">
                                        <button class="btn btn-primary" type="reset">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- End -->


        <!-- <div class="col-md-7 col-sm-12 col-xs-12 all-width1">
            <div class="x_panel">
            <div class="x_title">
            <h2>ALL NEWS</h2>
            <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
            </ul>
            <div class="clearfix"></div>
            </div>
                <div class="x_content div-table table-responsive">
                    <table id="show-table1" width="100%" class="table table-hover table-bordered show-table">
                        <thead>
                            <tr class="fixed-head">
                                <th scope="col">ID</th>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Image1</th>
                                <th scope="col">Image2</th>
                                <th scope="col">Posted By</th>
                                <th scope="col">Date</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> -->
    </div>
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
    <div class="row" id="subcate-box" style="display:none">
        <div class="col-md-5 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>ADD SUBCATEGORY</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                        <li><a class="close-link" id="close-btn"><i class="fa fa-close"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                <br />
                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-2">
                            <form data-parsley-validate class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <select name="category" id="cate_name" required class="form-control">
                                        <option value="">Select Category</option>
                                        <?php 
                                            foreach($cate as $row) {
                                                echo "<option value=".$row['id'].">".$row['category']."</option>";
                                            }
                                        ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="service" id="sub_name" placeholder="Name" required class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="file-input">
                                            <input type="file" id="sub_img" name="image">
                                            <span class="button">Choose</span>
                                            <span class="label" style="font-size: 12px;font-weight: 500;padding: .2em 0em .3em;" data-js-label>No Icon selected</label>
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
                                        <div class="file-input">
                                            <input type="file" id="banner" name="banner">
                                            <span class="button">Choose</span>
                                            <span class="label" style="font-size: 12px;font-weight: 500;padding: .2em 0em .3em;" data-js-label>No Banner selected</label>
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
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1">
                                        <input type="button" id="btnsubcate" class="btn btn-success" value="Submit">
                                        <button class="btn btn-primary" type="reset">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-7 col-sm-12 col-xs-12 all-width">
            <div class="x_panel">
            <div class="x_title">
            <h2>ALL SUBCATEGORY</h2>
            <ul class="nav navbar-right panel_toolbox">
            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
            </li>
            <li><a class="close-link"><i class="fa fa-close"></i></a>
            </li>
            </ul>
            <div class="clearfix"></div>
            </div>
                <div class="x_content div-table table-responsive">
                    <table id="show-table" width="100%" class="table table-hover table-bordered show-table">
                        <thead>
                            <tr class="fixed-head">
                                <th scope="col">ID</th>
                                <th scope="col">Image</th>
                                <th scope="col">Subcategory</th>
                                <th scope="col">Banner</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="row">
        <div class="modal fade" id="edit-service" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <span style="font-size: 18px;" class="modal-title" id="exampleModalLabel">Update Subcategory</span>
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
                                            <input type="hidden" id="edit_id" name="id">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <input type="text" name="service" id="edit_name" placeholder="Name" required class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <div class="file-input">
                                                        <input type="file" id="edit_file" name="image">
                                                        <span class="button">Choose</span>
                                                        <span class="label" style="font-size: 12px;font-weight: 500;padding: .2em 0em .3em;" data-js-label>No icon selected</label>
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
                                                        <input type="file" id="edit_banner" name="banner">
                                                        <span class="button">Choose</span>
                                                        <span class="label" style="font-size: 12px;font-weight: 500;padding: .2em 0em .3em;" data-js-label>No banner selected</label>
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
                                            <div class="ln_solid"></div>
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input type="button" id="subupdate" class="btn btn-success" value="Submit">
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
    </div> -->
    <script type="text/javascript">
        $(document).ready(function() {
             
            $('#show-table1').DataTable({
                "pageLength" : 8,
                "ajax": {
                    url : '<?= site_url("Authority/DataTable").'?flag=news'; ?>',
                    type : 'GET'
                },
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            if (localStorage.getItem("box") == "cate") {
                $('#cate-box').show();
                $('#subcate-box').hide();
            }
            else if (localStorage.getItem("box") == "subcate") {
                $('#cate-box').hide();
                $('#subcate-box').show();
            }
            
            $('#close-btn').click(function() {
                $('.all-width').addClass("col-md-12");
                $('.all-width').removeClass("col-md-7");
            })
            $('#close-btn1').click(function() {
                $('.all-width1').addClass("col-md-12");
                $('.all-width1').removeClass("col-md-7");
            })
            $('#btncate-box').click(function() {
                localStorage.setItem("box", "cate");
                $('#cate-box').show();
                $('#subcate-box').hide();
            })
            $('#btnsub-box').click(function() {
                localStorage.setItem("box", "subcate");
                $('#cate-box').hide();
                $('#subcate-box').show();
            })
        })
    </script>
    <script>
        $(document).ready(function() {
            $('#btnsubmit').click(function() {
                var data = new FormData(this.form);
                $.ajax({
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    url: "<?= site_url('Authority/code').'?flag=addNews'; ?>",
                    success: function(response){
                        // alert(response);
                        if (response == "success") {
                            fire_toast("News added successfully.", "success");
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                        else if (response == "file-error") {
                            fire_toast("Select a valid file.", "info");
                        }
                        else {
                            fire_toast("Please fill all details.", "warning");
                        }
                    },
                    error:function(){
                        alert("Something went wrong.");
                    }                    
                });
            });
            $('#btnsubmit1').click(function() {
                var data = new FormData(this.form);
                $.ajax({
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    url: "<?= site_url('Authority/code').'?flag=addNewsCategory'; ?>",
                    success: function(response){
                        // alert(response);
                        if (response == "success") {
                            fire_toast("Category added successfully.", "success");
                            setTimeout(function() {
                                location.reload();
                            }, 1000);
                        }
                        else if (response == "file-error") {
                            fire_toast("Select a valid file.", "info");
                        }
                        else {
                            fire_toast("Please fill all details.", "warning");
                        }
                    },
                    error:function(){
                        alert("Something went wrong.");
                    }                    
                });
            });
             
            $('#updatecate').click(function() {
                var data = new FormData(this.form);
                $.ajax({
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    url: "<?= site_url('Authority/crud').'?flag=updateNews'; ?>",
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
             
            $('#updatecate').click(function() {
                var data = new FormData(this.form);
                $.ajax({
                    type: "POST",
                    data: data,
                    processData: false,
                    contentType: false,
                    url: "<?= site_url('Authority/crud').'?flag=updateNews'; ?>",
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
    </script>
    <script>
        function remove(e) {
            $.ajax({
                type: "POST",
                data: {id:e.id},
                url: '<?= site_url("Authority/crud")."?flag=remove-news"; ?>',
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
        
        // function update(e) {
        //     $.ajax({
        //         type: "POST",
        //         data: {id:e.id},
        //         url: '<?= site_url("Admin/getData")."?flag=news"; ?>',
        //         success: function(response){
        //             alert(response);
        //             var obj = jQuery.parseJSON(response);
        //             $('#edit_id').val(obj.id);
        //             $('#edit_name').val(obj.service);
        //             $('#edit-service').modal('show');
        //         },
        //         error:function(){
        //             alert("Something went wrong.");
        //         }                    
        //     });
        // }
        function update1(e) {
            $.ajax({
                type: "POST",
                data: {id:e.id},
                url: '<?= site_url("Authority/getData")."?flag=news"; ?>',
                success: function(response) {
                    // alert(response);
                    var obj = jQuery.parseJSON(response);
                    $('#edit_id').val(obj.id);
                    $('#edit_heading').val(obj.heading);
                    $('#edit_description').val(obj.description);
                    // $('#edit_image1').val(obj.image1);
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
<?php
    require('inc/footer.php');
?>