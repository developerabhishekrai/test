<?php
   require('inc/header.php');
   $user_id = $_GET['id'];
   // echo $user_id;
   if (isset($_REQUEST['msg'])) {
      if ($_REQUEST['msg'] == "success") {
         echo "<script>fire_toast('Update successful.', 'success');</script>";
      }
      else if ($_REQUEST['msg'] == "already") {
         echo "<script>fire_toast('Alreday Data.', 'info');</script>";
      }
      else if ($_REQUEST['msg'] == "file-error") {
         echo "<script>fire_toast('Select a valid file.', 'error');</script>";
      }
      else {
         echo "<script>fire_toast('Something went wrong.', 'error');</script>";
      }
  }
   ?>
<style>
   .mr-top {
   margin-top: 20px;
   }
   .std_image {
   padding-right: 0 !important;
   }
   .padd-right {
   padding: 0px !important;
   }
   .outer {
   background: #0E4F6E;
   color: #fff;
   padding: 6px 15px;
   font-size: 18px;
   font-weight: 600;
   border-radius: .25rem;
   }
   .btn_slider {
   float: right;
   margin-top: -6px !important;
   font-size: 34px;
   line-height: 38px;
   padding: 0px 10px;
   color: #fff;
   border: 0;
   will-change: unset;
   box-shadow: 0 0 0 0;
   position: relative;
   letter-spacing: .025em;
   cursor: pointer;
   text-align: center;
   vertical-align: middle;
   border-radius: .25rem;
   background-color: transparent;
   }
   .minus {
   margin-top: -10px !important;
   display: none;
   }
   .btn_slider:focus {
   outline: 0;
   border: 0;
   box-shadow: 0 0 0 0;
   }
   .upload_div_outer {
   height: 122px;
   padding-top: 1px;
   text-align: center;
   position: relative;
   }
   .upload_div_outer img {
   height: 120px;
   width: 100%;
   }
   .upload_div_outer_sign {
   height: 40px;
   padding-top: 1px;
   text-align: center;
   position: relative;
   }
   .upload_div_outer_sign img {
   height: 42px;
   width: 100%;
   }
   .upload_div {
   padding: 4px;
   background: #337AB7;
   color: #fff;
   font-weight: 600;
   font-size: 16px;
   text-align: center;
   cursor: pointer;
   }
   .form-control-height {
   height: 35px;
   }
   .msg {
   position: absolute;
   color: rgba(0,0,0,0.4);
   font-weight: 400;
   font-size: .9rem;
   text-align: center;
   height: 40px;
   top: 10%;
   left: 5%;
   width: 90%;
   }
   @media only screen and (max-width: 600px) {
   .std_image {
   display: none;
   }
   .padd-right {
   padding-right: 15px !important;
   }
   }
   #form-priview {
   padding: 0 !important;
   }
   .modal-header {
   border-bottom: 1px solid #e9ecef;
   }
   .modal-footer {
   border-top: 1px solid #e9ecef;
   }
   .modal-body .table th, .modal-body .table td {
   border-top: 1px solid #e9ecef;
   font-size: .82rem;
   padding: 5px !important;
   }
   .show_check {
   height: auto;
   position: absolute;
   top: 100%;
   z-index: 1;
   transition: none 0s ease 0s;
   display: none;
   }
</style>
<!-- <div class=""> -->
<div class="qualification_div" style="">
   <br/>
   <div class="row">
      <div class="col-sm-12 table-responsive">
         <!-- <form action=""> -->
         <table class="table table-bordered">
            <h1>
               <center>Authority</center>
            </h1>
            <tr>
               <th>Authority</th>
               <th>View</th>
               <th>Edit</th>
               <th>Delete</th>
               <th>Action</th>
            </tr>
            <form action="<?= site_url('Authority/crud'); ?>?flag=role_update" method="post">
            <tr>
               <td>Users</td>
               <input type="hidden" id="" name="users" value="Users" />
               <input type="hidden" id="" name="user_id" value="<?= $user_id; ?>" />
               <td>
                  <select style="padding: 0;" id=""  name="user_view" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="user_edit" class="form-control form-control-height">
                    <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="user_delete" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <input type="submit" name="submit" value="Submit">
               </td>
            </tr>
            </form>
            <form action="<?= site_url('Authority/crud'); ?>?flag=role_update" method="post">
            <tr>
               <td>Agents</td>
               <input type="hidden" id="" name="user_id" value="<?= $user_id; ?>" />
               <input type="hidden" id="" name="agents" value="Agents" />
               <td>
                  <select style="padding: 0;" id=""  name="agent_view" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="agent_edit" class="form-control form-control-height">
                    <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="agent_delete" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
                <td>
                  <input type="submit" name="submit" value="Submit">
               </td>
            </tr>
         </form>
            <form action="<?= site_url('Authority/crud'); ?>?flag=role_update" method="post">
            <tr>
               <td>Vender</td>
               <input type="hidden" name=vender value="Vender" />
               <input type="hidden" id="" name="user_id" value="<?= $user_id; ?>" />
               <td>
                  <select style="padding: 0;" id=""  name="vender_view" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="vender_edit" class="form-control form-control-height">
                    <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="vender_delete" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
                <td>
                  <input type="submit" name="submit" value="Submit">
               </td>
            </tr>
         </form>
            <form action="<?= site_url('Authority/crud'); ?>?flag=role_update" method="post">
             
         
            <tr>
               <td>Customer Order</td>
               <input type="hidden" id="" name="user_id" value="<?= $user_id; ?>" />
               <input type="hidden" id="" name="customer_order" value="Customer Order" />
               <td>
                  <select style="padding: 0;" id=""  name="customer_view" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="customer_edit" class="form-control form-control-height">
                    <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="customer_delete" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
                <td>
                  <input type="submit" name="submit" value="Submit">
               </td>
            </tr>
         </form>
            <form action="<?= site_url('Authority/crud'); ?>?flag=role_update" method="post">
          
            <tr>
               <td>Freelancer</td>
               <input type="hidden" id="" name="user_id" value="<?= $user_id; ?>" />
               <input type="hidden" id="" name="freelancer" value="Freelancer" />
               <td>
                  <select style="padding: 0;" id=""  name="freelancer_view" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="freelancer_edit" class="form-control form-control-height">
                    <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="freelancer_delete" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
                <td>
                  <input type="submit" name="submit" value="Submit">
               </td>
            </tr>
         </form>
            <form action="<?= site_url('Authority/crud'); ?>?flag=role_update" method="post">
           
            <tr>
               <td>Add Agency</td>
               <input type="hidden" id="" name="user_id" value="<?= $user_id; ?>" />
               <input type="hidden" name="add_agency" value="Add Agency" />
               <td>
                  <select style="padding: 0;" id=""  name="addagency_view" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="addagency_edit" class="form-control form-control-height">
                    <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="addagency_delete" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
                <td>
                  <input type="submit" name="submit" value="Submit">
               </td>
            </tr>
         </form>
            <form action="<?= site_url('Authority/crud'); ?>?flag=role_update" method="post">
         
            <tr>
               <td>Agencies</td>
               <input type="hidden" id="" name="user_id" value="<?= $user_id; ?>" />
               <input type="hidden" id="" name="agencies" value="Agencies" />
               <td>
                  <select style="padding: 0;" id=""  name="agency_view" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="agency_edit" class="form-control form-control-height">
                    <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>

               <td>
                  <select style="padding: 0;" id=""  name="agency_delete" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
                <td>
                  <input type="submit" name="submit" value="Submit">
               </td>
            </tr>
         </form>
            <form action="<?= site_url('Authority/crud'); ?>?flag=role_update" method="post">
         
            <tr>
               <td>Payment</td>
               <input type="hidden" id="" name="user_id" value="<?= $user_id; ?>" />
               <input type="hidden" id="" name="payment" value="Payment" />
               <td>
                  <select style="padding: 0;" id=""  name="payment_view" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="payment_edit" class="form-control form-control-height">
                    <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="payment_delete" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
                <td>
                  <input type="submit" name="submit" value="Submit">
               </td>
            </tr>
         </form>
            <form action="<?= site_url('Authority/crud'); ?>?flag=role_update" method="post">
          
            <tr>
               <td>Agency Payment</td>
               <input type="hidden" id="" name="user_id" value="<?= $user_id; ?>" />
               <input type="hidden" name="agency_payment" value="Agency Payment" />
               <td>
                  <select style="padding: 0;" id=""  name="agency_payment_view" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="agency_payment_edit" class="form-control form-control-height">
                    <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="agency_payment_delete" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
                <td>
                  <input type="submit" name="submit" value="Submit">
               </td>
            </tr>
         </form>
            <form action="<?= site_url('Authority/crud'); ?>?flag=role_update" method="post">
         
            <tr>
               <td>Location</td>
               <input type="hidden" id="" name="user_id" value="<?= $user_id; ?>" />
               <input type="hidden" id="" name="location" value="Location" />
               <td>
                  <select style="padding: 0;" id=""  name="location_view" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="location_edit" class="form-control form-control-height">
                    <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="location_delete" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
                <td>
                  <input type="submit" name="submit" value="Submit">
               </td>
            </tr>
         </form>
            <form action="<?= site_url('Authority/crud'); ?>?flag=role_update" method="post">
          
            <tr>
               <td>Category</td>
               <input type="hidden" id="" name="user_id" value="<?= $user_id; ?>" />
               <input type="hidden" id="" name="category" value="Category" />
               <td>
                  <select style="padding: 0;" id=""  name="category_view" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="category_edit" class="form-control form-control-height">
                    <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="category_delete" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
                <td>
                  <input type="submit" name="submit" value="Submit">
               </td>
            </tr>
         </form>
            <form action="<?= site_url('Authority/crud'); ?>?flag=role_update" method="post">
          
            <tr>
               <td>Product Category</td>
               <input type="hidden" id="" name="user_id" value="<?= $user_id; ?>" />
               <input type="hidden" name="product_category" value="Product Category" />
               <td>
                  <select style="padding: 0;" id=""  name="product_category_view" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="product_category_edit" class="form-control form-control-height">
                    <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="product_category_delete" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
                <td>
                  <input type="submit" name="submit" value="Submit">
               </td>
            </tr>
         </form>
            <form action="<?= site_url('Authority/crud'); ?>?flag=role_update" method="post">
         
            <tr>
               <td>Hire Enquery</td>
               <input type="hidden" id="" name="user_id" value="<?= $user_id; ?>" />
               <input type="hidden" id="" name="hire_enquery" value="Hire Enquery" />
               <td>
                  <select style="padding: 0;" id=""  name="hire_enquery_view" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="hire_enquery_edit" class="form-control form-control-height">
                    <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="hire_enquery_delete" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
                <td>
                  <input type="submit" name="submit" value="Submit">
               </td>
            </tr>
         </form>
            <form action="<?= site_url('Authority/crud'); ?>?flag=role_update" method="post">
          
            <tr>
               <td>Filter User</td>
               <input type="hidden" id="" name="user_id" value="<?= $user_id; ?>" />
               <input type="hidden" id="" name="filter_user" value="Filter User" />
               <td>
                  <select style="padding: 0;" id=""  name="filter_user_view" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="filter_user_edit" class="form-control form-control-height">
                    <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="filter_user_delete" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
                <td>
                  <input type="submit" name="submit" value="Submit">
               </td>
            </tr>
         </form>
            <form action="<?= site_url('Authority/crud'); ?>?flag=role_update" method="post">
          
            <tr>
               <td>Filter Agent</td>
               <input type="hidden" id="" name="user_id" value="<?= $user_id; ?>" />
               <input type="hidden" name="filter_agent" value="Filter Agent" />
               <td>
                  <select style="padding: 0;" id=""  name="filter_agent_view" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="filter_agent_edit" class="form-control form-control-height">
                    <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="filter_agent_delete" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
                <td>
                  <input type="submit" name="submit" value="Submit">
               </td>
            </tr>
         </form>
            <form action="<?= site_url('Authority/crud'); ?>?flag=role_update" method="post">
          
            <tr>
               <td>Filter Vender</td>
               <input type="hidden" id="" name="user_id" value="<?= $user_id; ?>" />
               <input type="hidden" id="" name="filter_vender" value="Filter vender" />
               <td>
                  <select style="padding: 0;" id=""  name="filter_vender_view" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="filter_vender_edit" class="form-control form-control-height">
                    <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="filter_vender_delete" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
                <td>
                  <input type="submit" name="submit" value="Submit">
               </td>
            </tr>
         </form>
            <form action="<?= site_url('Authority/crud'); ?>?flag=role_update" method="post">
            
            <tr>
               <td>Service List</td>
               <input type="hidden" id="" name="user_id" value="<?= $user_id; ?>" />
               <input type="hidden" id="" name="service_list" value="Service List" />
               <td>
                  <select style="padding: 0;" id=""  name="service_list_view" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="service_list_edit" class="form-control form-control-height">
                    <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="service_list_delete" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
                <td>
                  <input type="submit" name="submit" value="Submit">
               </td>
            </tr>
         </form>
            <form action="<?= site_url('Authority/crud'); ?>?flag=role_update" method="post">
          
            <tr>
               <td>Download Data </td>
               <input type="hidden" id="" name="user_id" value="<?= $user_id; ?>" />
               <input type="hidden" name="download_data" value="Download Data" />
               <td>
                  <select style="padding: 0;" id=""  name="download_data_view" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="download_data_edit" class="form-control form-control-height">
                    <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="download_data_delete" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
                <td>
                  <input type="submit" name="submit" value="Submit">
               </td>
            </tr>
         </form>
            <form action="<?= site_url('Authority/crud'); ?>?flag=role_update" method="post">
          
            <tr>
               <td>Query And Review </td>
               <input type="hidden" id="" name="user_id" value="<?= $user_id; ?>" />
               <input type="hidden" name="query_review" value="Query And Review" />
               <td>
                  <select style="padding: 0;" id=""  name="query_review_view" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="query_review_edit" class="form-control form-control-height">
                    <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
               <td>
                  <select style="padding: 0;" id=""  name="query_review_delete" class="form-control form-control-height">
                     <option value="">Select</option>
                     <option value="Yes">Yes</option>
                     <option value="No">No</option>
                  </select>
               </td>
                <td>
                  <input type="submit" name="submit" value="Submit">
               </td>
            </tr>
         </form>
         </table>
               <!-- <input style="" type="submit" name="submit" value="Submit"> -->
               <!-- <button type="submit" name="submit" class="btn btn-dark">Submit</button> -->
         <!-- </form> -->
      </div>
   </div>
   <br/>
</div>
</div>
 
 