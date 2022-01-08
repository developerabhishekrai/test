<?php
    require('inc/header.php');
    $data = $db->select('ui_control', null);
    $logo = $db->select('logo', null);
     // print_r($logo);
?>
    <style>
        .show-table th {
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
    <div class="row" id="cate-box">
        <div class="col-md-8 col-sm-12 col-xs-12 col-md-offset-2">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Update UI</h2>
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
                            <form id="form-ui" data-parsley-validate class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <input type="text" name="video" id="video" value="<?= $data[0]['video']; ?>" placeholder="YouTube Video Link" required class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <div class="file-input">
                                            <input type="file" id="banner" name="banner">
                                            <span class="button">Choose</span>
                                            <span class="label" style="font-size: 14px;font-weight: 500;padding: .2em 0em .3em;" data-js-label><?= $data[0]['banner']; ?></label>
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
                                            <input type="file" id="advertise" name="advertise">
                                            <span class="button">Choose</span>
                                            <span class="label" style="font-size: 14px;font-weight: 500;padding: .2em 0em .3em;" data-js-label><?= $data[0]['advertise']; ?></label>
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
                                    <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1">
                                        <input type="button" id="btn-submit" class="btn btn-success" value="Submit">
                                        <button class="btn btn-primary" type="reset">Reset</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-2">
                            <form  id="form-logo"  class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <h2><center>Update Logo</center></h2>
                                    </div>
                                </div>
                               <!--  <div class="form-group m-1">
                            <span>Upload Product Image</span>
                            <input name="upload" class="form-control" type="file" required>
                                </div> -->
                                        <div class="file-input">
                                            <input type="file" id="upload" name="upload">
                                            <span class="button">Choose</span>
                                            <span class="label" style="font-size: 14px;font-weight: 500;padding: .2em 0em .3em;" data-js-label><?= $logo[0]['logo']; ?></label>
                                        </div>
                                
                                <div class="ln_solid"></div>
                                <div class="">
                                    <div class="col-md-10 col-sm-10 col-xs-12 col-md-offset-1 col-sm-offset-1">
                                        <input type="button" id="btn-submit1" value="Submit">
                                        <!-- <button class="btn btn-primary" type="reset">Reset</button> -->
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
            $('#close-btn').click(function() {
                $('.all-width').addClass("col-md-12");
                $('.all-width').removeClass("col-md-7");
            })
        })
    </script>
	<script>
		$(document).ready(function() {
			$('#btn-submit').click(function() {
				var data = new FormData(this.form);
				$.ajax({
					type: "POST",
					data: data,
					processData: false,
					contentType: false,
					url: "<?= site_url('Authority/crud').'?flag=ui-control'; ?>",
					success: function(response){
						if (response == "success") {
							fire_toast("Data updated successfully.", "success");
							setTimeout(function() {
								location.reload();
							}, 1000);
                        }
						else {
							fire_toast("Please fill all details.", "info");
						}
					},
					error:function(){
						alert("Something went wrong.");
					}					 
				});
			});
		});
        $('#btn-submit1').click(function() {
            var data = new FormData(this.form);
            $.ajax({
                type: "POST",
                data: data,
                processData: false,
                contentType: false,
                url: "<?= site_url('Authority/crud').'?flag=update_logo'; ?>",
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
	</script>
<?php
    require('inc/footer.php');
?>