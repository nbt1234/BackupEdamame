<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>SUBADMIN</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php url('admin/dashboard')?>">Home</a></li>
                        <li class="breadcrumb-item active">Add Subadmin</li>
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
                            <h3 class="card-title">Edit Vendor</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" method="post" action="<?php url('admin/update-subadmin/'.$subadmin_data['ID']);?>"
                            enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" id="username"
                                        placeholder="Enter subadmin username" value="<?php echo $subadmin_data['username'] ?>">
                                    <?php echo form_error('username', '<div class="form-valid-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" name="email" class="form-control" id="email"
                                        placeholder="Enter subadmin email" value="<?php echo $subadmin_data['email'] ?>">
                                    <?php echo form_error('email', '<div class="form-valid-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="email">Password</label>
                                    <input type="text" name="password" class="form-control" id="password"
                                        placeholder="Enter subadmin password">
                                    <?php echo form_error('password', '<div class="form-valid-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="mobile">mobile</label>
                                    <input type="text" name="mobile" class="form-control" id="mobile"
                                        placeholder="Enter subadmin mobile" value="<?php echo $subadmin_data['mobile'] ?>">
                                    <?php echo form_error('mobile', '<div class="form-valid-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="vendor-img">Avatar</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="avatar" class="custom-file-input"
                                                id="vendor-img">
                                            <label class="custom-file-label" for="vendor-img">Choose file</label>
                                        </div>
                                    </div>
                                    <img src="<?php url('site-assets/img/user-avatar/'.$subadmin_data['avatar']) ?>" class="sm-img">
                                    <?php echo form_error('avatar', '<div class="form-valid-error">', '</div>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="status">Block Status</label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" name="user_block_status" id="active_status" value="0" <?php if($subadmin_data['user_block_status'] == 0){echo 'checked';} ?>>
                                        <label for="active_status" class="custom-control-label">Active</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" name="user_block_status" id="inactive_status" value="1"  <?php if($subadmin_data['user_block_status'] == 1){echo 'checked';} ?>>
                                        <label for="inactive_status" class="custom-control-label">Inactive</label>
                                    </div>
                                    <?php echo form_error('user_block_status', '<div class="form-valid-error">', '</div>'); ?>
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