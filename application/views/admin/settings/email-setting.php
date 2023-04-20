<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>E-mail setting</h1>
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
                            <h3 class="card-title">SMTP</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" method="post" action="<?php url('admin/settings/email-smtp');?>"
                            enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form_group">
                                    <label for="status" class="d-block"> Status</label>
                                    <input type="checkbox" class="form-control" id="status" name="smtp-status"
                                        <?php if (!$smtp['status']) {echo 'checked';}?> data-bootstrap-switch data-off-color="danger">
                                </div>
                                <div class="form-group mt-2">
                                    <label for="smtp_host">Host</label>
                                    <input type="text" name="smtp_host" class="form-control" id="smtp_host"
                                        placeholder="Enter smtp host" value="<?php echo $smtp['smtp_host'] ?>">
                                    <?php echo form_error('smtp_host', '<div class="form-valid-error">', '</div>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="smtp_host">Port</label>
                                    <input type="text" name="smtp_port" class="form-control" id="smtp_host"
                                        placeholder="Enter smtp port" value="<?php echo $smtp['smtp_port'] ?>">
                                    <?php echo form_error('smtp_port', '<div class="form-valid-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="smtp_user">Username</label>
                                    <input type="text" name="smtp_user" class="form-control" id="smtp_user"
                                        placeholder="Enter smtp user" value="<?php echo $smtp['smtp_user'] ?>">
                                    <?php echo form_error('smtp_user', '<div class="form-valid-error">', '</div>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="smtp_pass">Password</label>
                                    <input type="password" name="smtp_pass" class="form-control" id="smtp_pass"
                                        placeholder="Enter smtp password" value="<?php echo $smtp['smtp_pass'] ?>">
                                    <?php echo form_error('smtp_pass', '<div class="form-valid-error">', '</div>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="smtp_name">Name</label>
                                    <input type="text" name="smtp_name" class="form-control" id="smtp_name"
                                        placeholder="Enter name" value="<?php echo $smtp['name'] ?>">
                                    <?php echo form_error('smtp_name', '<div class="form-valid-error">', '</div>'); ?>
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
                            <h3 class="card-title">Server</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" method="post" action="<?php url('admin/settings/email-server');?>"
                            enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control" id="email"
                                        placeholder="Enter Email" value="<?php echo $server['email'] ?>">
                                    <?php echo form_error('email', '<div class="form-valid-error">', '</div>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="username">Name</label>
                                    <input type="text" name="username" class="form-control" id="username"
                                        placeholder="Enter username" value="<?php echo $server['name'] ?>">
                                    <?php echo form_error('username', '<div class="form-valid-error">', '</div>'); ?>
                                </div>
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