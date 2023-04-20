<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>CATEGORY</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php url('admin/dashboard')?>">Home</a></li>
                        <li class="breadcrumb-item active">Add Category</li>
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
                        <h3 class="card-title">Add Category</h3>
                    </div>
                    <!-- form start -->
                    <form role="form" method="post" action="<?php url('admin/pages/add-home-page-category');?>"
                        enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="heading1">Heading</label>
                                <input type="text" name="heading1" class="form-control" id="heading1"
                                placeholder="Enter heading" value="<?php echo $category_data[0]['data'] ?>">
                                <?php echo form_error('heading1', '<div class="form-valid-error">', '</div>'); ?>
                            </div>

                            <div class="form-group">
                                <label for="content1">Content</label>
                                <input type="text" name="content1" class="form-control" id="content1"
                                placeholder="Enter content" value="<?php echo $category_data[1]['data'] ?>">
                                <?php echo form_error('content1', '<div class="form-valid-error">', '</div>'); ?>
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