<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>BANNER</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php url('admin/dashboard')?>">Home</a></li>
                        <li class="breadcrumb-item active">Add Banner</li>
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
                            <h3 class="card-title">Add Banner</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" method="post" action="<?php url('admin/pages/add-home-page-banner');?>"
                            enctype="multipart/form-data">
                            <div class="card-body">
                            <div class="form-group">
                                    <label for="banner-img">Choose Banner (1920x1200)</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="img_name" class="custom-file-input"
                                                id="banner-img">
                                            <label class="custom-file-label" for="banner-img">Choose file</label>
                                        </div>
                                    </div>
                                    <?php echo form_error('img_name', '<div class="form-valid-error">', '</div>'); ?>
                                    <img src="<?php url('assets/img/pages/banner/'.$banner_data['img_name']) ?>" class="sm-img">
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