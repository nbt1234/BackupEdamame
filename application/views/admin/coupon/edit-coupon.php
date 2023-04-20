<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>FLAVOUR</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php url('admin/dashboard')?>">Home</a></li>
                        <li class="breadcrumb-item active">Edit Flavour</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- <button type="button" class=" admin-toastr btn btn-success toastrDefaultSuccess">
        Launch Success Toast
    </button> -->
    <?php if (flash_get('error')) { ?>
          <p class="admin-toastr" onclick="toastr_danger('<?php echo flash_get('error') ?>')"></p>
        <?php }if (flash_get('success')) {?>
          <p class="admin-toastr" onclick="toastr_success('<?php echo flash_get('success') ?>')"></p>
        <?php } ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Coupon</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" method="post" action="<?php url('admin/update-coupon/'.$coupon_info['ID']);?>"
                            enctype="multipart/form-data">
                            <div class="card-body">
                            <div class="form-group">
                                    <label for="coupon_name">Coupon Name</label>
                                    <input type="text" name="coupon_name" class="form-control" id="coupon_name"
                                        placeholder="Enter coupon name" value="<?php echo $coupon_info['coupon_name'] ?>">
                                    <?php echo form_error('coupon_name', '<div class="form-valid-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="discount">Discount</label>
                                    <input type="text" name="discount" class="form-control" id="discount"
                                        placeholder="Enter discount" value="<?php echo $coupon_info['discount'] ?>">
                                    <?php echo form_error('discount', '<div class="form-valid-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="no_of_users">Use Limit</label>
                                    <input type="text" name="no_of_users" class="form-control" id="no_of_users"
                                        placeholder="Enter user limit" value="<?php echo $coupon_info['no_of_users'] ?>">
                                    <?php echo form_error('no_of_users', '<div class="form-valid-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" name="status" checked
                                            id="active_status" value="0" <?php if($coupon_info['status'] == 0){echo 'checked';} ?>>
                                        <label for="active_status" class="custom-control-label">Active</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" name="status"
                                            id="inactive_status" value="1" <?php if($coupon_info['status'] == 1){echo 'checked';} ?>>
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