<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Coupon</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php url('admin/dashboard')?>">Home</a></li>
                        <li class="breadcrumb-item active">Add Coupon</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- <button type="button" class=" admin-toastr btn btn-success toastrDefaultSuccess">
        Launch Success Toast
    </button> -->

    <?php if (flash_get('error')) {?>
    <p class="admin-toastr" onclick="toastr_danger('<?php echo flash_get('error') ?>')"></p>
    <?php }if (flash_get('success')) {?>
    <p class="admin-toastr" onclick="toastr_success('<?php echo flash_get('success') ?>')"></p>
    <?php }?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add Coupon</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" method="post" action="<?php url('admin/add-coupon');?>"
                            enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="type">Coupon Type</label>
                                    <div class='row'>
                                    <div class="custom-control custom-radio row mx-3">
                                        <input class="custom-control-input" type="radio" name="type" checked
                                            id="active_type" value="0">
                                        <label for="active_type" class="custom-control-label">Flat Price</label>
                                    </div>
                                    <div class="custom-control custom-radio row mx-3">
                                        <input class="custom-control-input" type="radio" name="type"
                                            id="inactive_type" value="1">
                                        <label for="inactive_type" class="custom-control-label">Percentage</label>
                                    </div>
                                    <?php echo form_error('status', '<div class="form-valid-error">', '</div>'); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="coupon_name">Coupon Name</label>
                                    <input type="text" name="coupon_name" class="form-control" id="coupon_name"
                                        placeholder="Enter coupon name" value="<?php echo set_value('coupon_name') ?>">
                                    <?php echo form_error('coupon_name', '<div class="form-valid-error">', '</div>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="coupon_code">Coupon Code</label>
                                    <input type="text" name="coupon_code" class="form-control" id="coupon_code"
                                        placeholder="Enter coupon code" value="<?php echo set_value('coupon_code') ?>">
                                    <?php echo form_error('coupon_code', '<div class="form-valid-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="discount">Discount</label>
                                    <input type="text" name="discount" class="form-control" id="discount"
                                        placeholder="Enter discount" value="<?php echo set_value('discount') ?>">
                                    <?php echo form_error('discount', '<div class="form-valid-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="limit_count">Use Limit</label>
                                    <input type="text" name="limit_count" class="form-control" id="limit_count"
                                        placeholder="Enter user limit" value="<?php echo set_value('limit_count') ?>">
                                    <?php echo form_error('limit_count', '<div class="form-valid-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="no_of_users">No. of per user</label>
                                    <input type="text" name="no_of_users" class="form-control" id="no_of_users"
                                        placeholder="Enter user limit" value="<?php echo set_value('no_of_users') ?>">
                                    <?php echo form_error('no_of_users', '<div class="form-valid-error">', '</div>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="limit_count">Start date</label>
                                    <input type="date" name="start_date" class="form-control" id="start_date"
                                         value="<?php echo date('Y-m-d'); ?>">
                                    <?php echo form_error('start_date', '<div class="form-valid-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="no_of_users">End date</label>
                                    <input type="date" name="end_date" class="form-control" id="end_date"
                                         value="">
                                    <?php echo form_error('end_date', '<div class="form-valid-error">', '</div>'); ?>
                                </div>

                                <!-- <div class="form-group">
                                    <label>Flavours</label>
                                    <select class="form-control  " style="width: 100%;" name="flavour_id">
                                        <option value="" selected="selected">Select Flavours</option>
                                        <?php //foreach ($vendors_data as $key => $vendor_data) { ?>
                                        <option value="<?php echo $vendor_data['ID'] ?>" <?php echo set_select('flavour_id', $vendor_data['ID']); ?>><?php echo $vendor_data['vendor_name'] ?></option>
                                        <?php //} ?>
                                    </select>
                                    <?php echo form_error('flavour_id', '<div class="form-valid-error">', '</div>'); ?>
                                </div> -->

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" name="status" checked
                                            id="active_status" value="0">
                                        <label for="active_status" class="custom-control-label">Active</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" name="status"
                                            id="inactive_status" value="1">
                                        <label for="inactive_status" class="custom-control-label">Inactive</label>
                                    </div>
                                    <?php echo form_error('status', '<div class="form-valid-error">', '</div>'); ?>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </section>
</div>