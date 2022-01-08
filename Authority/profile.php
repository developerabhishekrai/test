<?php
    require('inc/header.php');
?>
<style>
    .rgba {
        height:158px;
        width:158px;
        background-repeat:no-repeat;
        background-size:100% 100%;
        border-radius:50%;
        position: relative;
    }
    .profile1 {
        height:158px;
        width:158px;
        background-image: url('<?= base_url()."Admin/uploads/service/".$authority['image']; ?>');
        background-repeat:no-repeat;
        background-size:100% 100%;
        border-radius:50%;
    }
    .rgba:hover {
        background:rgba(0, 0, 0, 0.5);
    }
    #camera {
        display: none;
        cursor: pointer;
        font-size: 25px;
        color: #fff;
        top: 43%;
        left: 43%;
        position: absolute;
    }
    #file {
        display:none;
    }
    .txt {
        width:80%;
        border:none;
        padding:5px;
        outline:none;
        border-bottom:1px solid;
    }
    .txt:focus {
        border-bottom:1px solid blue;
    }
    .fa-pencil {
        color:red;
        margin-top:10px;
        margin-right:10px;
        position:absolute;
        cursor:pointer;
    }
</style>
<div class="row">
	<div class="col-md-2 col-sm-2 col-xs-2"></div>
    <div class="col-md-8 col-sm-8 col-xs-8">
        <div class="x_panel">
            <div class="x_title">
                <h2>My Account</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-lg-3 col-lg-offset-1">
                        <form><br/><br/>
                            <center>
                                <div class="profile1" id="img-pri">
                                    <div class="rgba">
                                        <input type="file" name="profile" id="file" onchange="readURL(this)" required="">
                                        <span id="camera" title="CHANGE PROFILE PHOTO" class="fa fa-camera"></span>
                                    </div>
                                </div>
                                <br>
                                <hr/>
                                <center>
                                    <input type="button" name="submitpic" value="UPDATE" class="btn btn-success" id="btnpic" disabled="true"><br><br>
                                </center>
                            </center>
                        </form>
                        <script>
                            function readURL(input) {
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();

                                    reader.onload = function (e) {
                                        $('#img-pri').css('background-image', 'url('+e.target.result+')');
                                        $('#btnpic').prop('disabled', false);
                                    };

                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                        </script>
                    </div>
                    <div class="col-lg-6 col-lg-offset-1">
                        <form id="profile" method="post"><br><br><p></p>
                            <i class="fa fa-user"></i>
                            <input type="text" id="name" name="name" value="<?= $authority['name']; ?>" required="" readonly="true" onkeypress="return(event.charCode >= 65 &amp;&amp; event.charCode <= 90 || event.charCode >= 97 &amp;&amp; event.charCode <= 122 || event.charCode == 32)" minlength="3" maxlength="30" class="txt">
                            <i class="fa fa-pencil" id="btn_name"></i>
                            <br><br>
                            <i class="fa fa-phone-square"></i>
                            <input type="text" id="num" name="number" value="<?= $authority['number']; ?>" onkeypress="return(event.charCode >= 48 &amp;&amp; event.charCode <= 57)" minlength="10" maxlength="10" required="" readonly="true" class="txt">
                            <i class="fa fa-pencil" id="btn_num"></i>
                            <br><br>
                            <i class="fa fa-envelope"></i>
                            <input type="email" id="email" name="email" value="<?= $authority['email']; ?>" minlength="10" maxlength="80" required="" readonly="true" class="txt">
                            <i class="fa fa-pencil" id="btn_email"></i>
                            <br><br><br/>
                            <hr/>
                            <center>
                            <input type="button" id="btn1" value="CONTINUE" class="btn btn-success" disabled="true"><br><br>
                            </center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">	
	<div class="col-md-2 col-sm-2 col-xs-2"></div>
    <div class="col-md-8 col-sm-8 col-xs-8">
        <div class="x_panel">
            <div class="x_title">
                <h2>Change Password</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                    <li><a class="close-link"><i id="close-btn" class="fa fa-close"></i></a></li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <br>
                <div class="row">
                    <div class="col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
                        <form id="form_privacy" class="form-horizontal form-label-left">
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <input type="password" name="npass" id="newpass" placeholder="New Password" required="" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <input type="password" name="cpass" id="conpass" placeholder="Confirm Password" required="" class="form-control">
                                </div>
                            </div>
                            <div class="ln_solid"></div>
                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-2">
                                    <input type="button" id="btnprivacy" class="btn btn-success" value="SUBMIT">
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
    $(document).ready(function(){
        $('.profile1').mouseover(function(){
            $('#camera').show();
        })
        $('.profile1').mouseleave(function(){
            $('#camera').hide();
        })
        $('#camera').click(function(){
            $('#file').click();
        })
        $('#btn_name').click(function(){
            $('#name').prop('readonly',false);
            $('#btn1').prop('disabled',false);
            $('#name').focus();
        })
        $('#btn_email').click(function(){
            $('#email').prop('readonly',false);
            $('#btn1').prop('disabled',false);
            $('#email').focus();
        })
        $('#btn_num').click(function(){
            $('#num').prop('readonly',false);
            $('#btn1').prop('disabled',false);		
            $('#num').focus();			
        })
    })
</script>
<script>
	$(document).ready(function(){
		$('#btn1').click(function(){
			$.ajax({
				type: "POST",
				url: '<?= site_url("Authority/crud").'?flag=detail'; ?>',
				data: $('#profile').serialize(),
				success: function(response){
					if (response == "required") {
						fire_toast("Please fill all details.", "warning");
					}
					else if (response == "success") {
						fire_toast("Profile updated.", "success");
						setTimeout(function() {
							location.reload();
						}, 1000);
					}
				},
				error:function(){
					alert("Something went wrong.");
				}					 
			});
		})
		$('#btnprivacy').click(function() {
			$.ajax({
				type: "POST",
				url: '<?= site_url("Authority/crud").'?flag=privacy'; ?>',
				data: $('#form_privacy').serialize(),
				success: function(response){
					if (response == "required") {
						fire_toast("Please fill all details.", "warning");
					}
					else if (response == "success") {
						fire_toast("Password updated.", "success");
						setTimeout(function() {
							location.reload();
						}, 1000);
					}
					else if (response == "not-match") {
						fire_toast("Password not matched.", "info");
					}
				},
				error:function(){
					alert("Something went wrong.");
				}					 
			});
		})
		$('#btnpic').click(function(){
			var data = new FormData(this.form);
			$.ajax({
				type: "POST",
				data: data,
				processData: false,
				contentType: false,
				url: '<?= site_url("Authority/crud").'?flag=profile'; ?>',
				success: function(response){
					if (response == "success") {
						fire_toast("Profile updated.", "success");
						setTimeout(function() {
							location.reload();
						}, 1000);
					}
					else if (response == "file-error") { 					
						fire_toast("Select a valid file.", "info");
					}
					else if (response == "error") {
						fire_toast("Something went wrong.", "error");
					}
				},
				error:function(){
					alert("Something went wrong.");
				}					 
			});
		});
	})
</script>
<?php
    require('inc/footer.php');
?>