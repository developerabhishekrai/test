<?php
    require('inc/header.php');

    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://wedarranger.com/api/getState?country=India',
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
</style>
<div class="container">
    <div class="row agency-row">
        <div class="card-agency">
            <h5 class="text-center p-3">Add Agency</h5>
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
                        <span>Area</span>
                        <input type="text" name="area" class="form-control" placeholder="Area">
                    </div>
                    <div class="form-group">
                        <span>State</span>
                        <select name="state" id="state" class="form-control">
                            <option>-Select State-</option>
                            <?php foreach($state as $row): ?>
                            <option><?= $row['state']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <span>District</span>
                        <select id="city-box" name="district" class="form-control">
                            <option value="">-Select District-</option>
                        </select>
                    </div>
                    <div class="form-group agency-row" style="margin-top: 10px;">
                        <button type="button" id="btn-submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        // $('#state').change(function() {
        //     var data = $('#state').val();
        //     $.ajax({
        //         type: "POST",
        //         data: {data:data},
        //         url: "<?= site_url('getData').'?flag=district'; ?>",
        //         success: function(response) {
        //             var opt = "<option>-Select District-</option>";
        //             var obj = jQuery.parseJSON(response);
        //             for (var i = 0; i < obj.length; i++) {
        //                 opt+= "<option>"+obj[i].district+"</option>";
        //             }
        //             $('#district').html(opt);
        //         },
        //         error: function() {
        //             alert('Something went wrong.');
        //         }
        //     })
        // });
        $('#btn-submit').click(function() {
            $.ajax({
                type: "POST",
                data: $('#form-agency').serialize(),
                url: "<?= site_url('Authority/code').'?flag=agency'; ?>",
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
        $('#state').change(function() {
            var data = $('#state').val();
            // alert(data);
            $.ajax({
                type: "POST",
                data: {data:data},
                url: 'https://wedarranger.com/api/getDistrict?state='+data,
                success: function(response) {
                    // alert(response);
                      var opt = "<option value=''>Select City</option>";
                      for (var i = 0; i < response.length; i++) {
                        opt+= "<option value="+response[i].district+">"+response[i].district+"</option>";
                      }
                    $('#city-box').html(opt);
                },
                error: function() {
                    alert('Something went wrong.');
                }
            })
        });
    })
</script>