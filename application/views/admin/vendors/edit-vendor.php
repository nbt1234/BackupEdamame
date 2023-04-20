<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>VENDOR</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php url('admin/dashboard')?>">Home</a></li>
                        <li class="breadcrumb-item active">Add Vendor</li>
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
                        <form role="form" method="post" action="<?php url('admin/update-vendor/'.$vendor_info['ID']);?>"
                            enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Vendor Name</label>
                                    <input type="text" name="vendor_name" class="form-control" id="name"
                                        placeholder="Enter vendor name" value="<?php echo $vendor_info['vendor_name'] ?>">
                                    <?php echo form_error('vendor_name', '<div class="form-valid-error">', '</div>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="tag_name">Tag Name</label>
                                    <input type="text" name="tag_name" class="form-control" id="tag_name"
                                        placeholder="Enter tag name" value="<?php echo $vendor_info['tag_name'] ?>">
                                    <?php echo form_error('tag_name', '<div class="form-valid-error">', '</div>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="tag_color">Tag Color</label>
                                    <input type="text" name="tag_color" class="form-control" id="tag_color"
                                        placeholder="Enter tag color" value="<?php echo $vendor_info['tag_color'] ?>">
                                    <?php echo form_error('tag_color', '<div class="form-valid-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="vendor-img">File input</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="vendor_image" class="custom-file-input"
                                                id="vendor-img">
                                            <label class="custom-file-label" for="vendor-img">Choose file</label>
                                        </div>
                                    </div>
                                    <img src="<?php url('assets/img/vendors/'.$vendor_info['vendor_image']) ?>" class="sm-img">
                                    <?php echo form_error('vendor_image', '<div class="form-valid-error">', '</div>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" name="status" id="active_status" value="0" <?php if($vendor_info['status'] == 0){echo 'checked';} ?>>
                                        <label for="active_status" class="custom-control-label">Active</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" name="status" id="inactive_status" value="1"  <?php if($vendor_info['status'] == 1){echo 'checked';} ?>>
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