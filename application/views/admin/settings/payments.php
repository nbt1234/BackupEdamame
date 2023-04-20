<?php
    $paypal_data = json_decode($paypal_mode['details'],true);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Payment setting</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php url('admin/dashboard')?>">Home</a></li>
                        <li class="breadcrumb-item active">Email</li>
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
                            <h3 class="card-title">Paypal Settings</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" method="post" action="<?php url('admin/settings/paypal-payment-mode');?>"
                            enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form_group">
                                    <label for="paypal_mode" class="d-block">Paypal Mode (Live)</label>
                                    <input type="checkbox" class="form-control" id="paypal_mode" name="paypal_mode" <?php if (!$paypal_mode['status']) {echo 'checked';}?>
                                        data-bootstrap-switch data-off-color="danger">
                                </div>
            
                                <div class="form-group">
                                    <label for="paypal_client_id">Client ID</label>
                                    <input type="text" name="paypal_client_id" class="form-control" id="paypal_client_id"
                                        placeholder="Enter client id" value="<?php echo $paypal_data['paypal_client_id'] ?>">
                                    <?php echo form_error('paypal_client_id', '<div class="form-valid-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="paypal_secret_id">Secret ID</label>
                                    <input type="text" name="paypal_secret_id" class="form-control" id="paypal_secret_id"
                                        placeholder="Enter secret id" value="<?php echo $paypal_data['paypal_secret_id'] ?>">
                                    <?php echo form_error('paypal_secret_id', '<div class="form-valid-error">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Revolut Settings</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" method="post" action="<?php url('admin/settings/payment-mode');?>"
                            enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form_group">
                                    <label for="paypal_mode" class="d-block">Revolut Mode (Live)</label>
                                    <input type="checkbox" class="form-control" id="paypal_mode" name="paypal_mode" <?php if (!$paypal_mode['status']) {echo 'checked';}?>
                                        data-bootstrap-switch data-off-color="danger">
                                </div>

                                <div class="form-group">
                                    <label for="client_id">Client ID</label>
                                    <input type="text" name="client_id" class="form-control" id="client_id"
                                        placeholder="Enter client id">
                                    <?php echo form_error('client_id', '<div class="form-valid-error">', '</div>'); ?>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Payment Status</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" method="post" action="<?php url('admin/settings/payment-status');?>"
                            enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form_group">
                                    <label for="paypal_status" class="d-block">Paypal Status</label>
                                    <input type="checkbox" class="form-control" id="paypal_status" name="paypal_status" <?php if (!$paypal_status['status']) {echo 'checked';}?>
                                        data-bootstrap-switch data-off-color="danger">
                                </div>

                                <div class="form_group">
                                    <label for="revolut_status" class="d-block">Revolut Status</label>
                                    <input type="checkbox" class="form-control" id="revolut_status" name="revolut_status"
                                    <?php if (!$revolut_status['status']) {echo 'checked';}?>
                                        data-bootstrap-switch data-off-color="danger">
                                </div>
                               
                                <!-- <div class="form-group">
                                    <label for="smtp_name">Name</label>
                                    <input type="text" name="smtp_name" class="form-control" id="smtp_name"
                                        placeholder="Enter name">
                                    <?php echo form_error('smtp_name', '<div class="form-valid-error">', '</div>'); ?>
                                </div> -->
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
    </section>
</div>