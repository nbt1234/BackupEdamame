<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>SERVICES</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php url('admin/dashboard')?>">Home</a></li>
                        <li class="breadcrumb-item active">Add Services</li>
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
                            <h3 class="card-title">Add Services</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" method="post" action="<?php url('admin/pages/add-home-page-services');?>"
                            enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <h4>Section 1</h4>
                                    <label for="heading1">Heading</label>
                                    <input type="text" name="heading1" class="form-control" id="heading1"
                                        placeholder="Enter heading" value="<?php echo $service_data[0]['heading'] ?>">
                                    <?php echo form_error('heading1', '<div class="form-valid-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="content1">Content</label>
                                    <input type="text" name="content1" class="form-control" id="content1"
                                        placeholder="Enter content" value="<?php echo $service_data[0]['content'] ?>">
                                    <?php echo form_error('content1', '<div class="form-valid-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <h4>Section 2</h4>
                                    <label for="heading2">Heading</label>
                                    <input type="text" name="heading2" class="form-control" id="heading2"
                                        placeholder="Enter heading" value="<?php echo  $service_data[1]['heading'] ?>">
                                    <?php echo form_error('heading2', '<div class="form-valid-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="content2">Content</label>
                                    <input type="text" name="content2" class="form-control" id="content2"
                                        placeholder="Enter content" value="<?php echo  $service_data[1]['content'] ?>">
                                    <?php echo form_error('content2', '<div class="form-valid-error">', '</div>'); ?>
                                </div>


                                <div class="form-group">
                                    <h4>Section 3</h4>
                                    <label for="heading3">Heading</label>
                                    <input type="text" name="heading3" class="form-control" id="heading3"
                                        placeholder="Enter heading" value="<?php echo  $service_data[2]['heading'] ?>">
                                    <?php echo form_error('heading3', '<div class="form-valid-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="content3">Content</label>
                                    <input type="text" name="content3" class="form-control" id="content3"
                                        placeholder="Enter content" value="<?php echo  $service_data[2]['content'] ?>">
                                    <?php echo form_error('content3', '<div class="form-valid-error">', '</div>'); ?>
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