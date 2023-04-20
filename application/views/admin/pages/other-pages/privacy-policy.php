<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>PRIVACY POLICY</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php url('admin/dashboard')?>">Home</a></li>
                        <li class="breadcrumb-item active">Add Privacy policy</li>
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
                        <h3 class="card-title">Add Privacy policy</h3>
                    </div>
                    <!-- form start -->
                    <form role="form" method="post" action="<?php url('admin/other-pages/add-privacy-policy');?>"
                        enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="heading1">Heading</label>
                                <input type="text" name="heading1" class="form-control" id="heading1"
                                placeholder="Enter heading" value="<?php echo $data['heading'] ?>">
                                <?php echo form_error('heading1', '<div class="form-valid-error">', '</div>'); ?>
                            </div>

                            <div class="form-group">
                                    <label for="newsletter-data">Content</label>
                                    <textarea class="textarea" name="newsletter-data"
                                        placeholder="Place some text here"><?php echo $data['content'] ?></textarea>
                                    <?php echo form_error('newsletter-data', '<div class="form-valid-error">', '</div>'); ?>
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