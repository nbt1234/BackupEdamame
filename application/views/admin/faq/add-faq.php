<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>FAQ</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php url('admin/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Add FAQ</li>
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
    <?php }
    if (flash_get('success')) { ?>
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
                            <h3 class="card-title">Add FAQ</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" method="post" action="<?php url('admin/add-faq'); ?>" enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="question">Question</label>
                                    <textarea class="textarea" name="question" placeholder="Question"><?php echo set_value('question') ?></textarea>
                                    <?php echo form_error('question', '<div class="form-valid-error">', '</div>'); ?>
                                </div>
                                <div class="form-group">
                                    <label for="answer">Answer</label>
                                    <textarea class="textarea" name="answer"
                                        placeholder="answer"><?php echo set_value('answer') ?></textarea>
                                    <?php echo form_error('answer', '<div class="form-valid-error">', '</div>'); ?>
                                </div>
                                <!-- <div class="form-group">
                                    <label for="FAQ_code">FAQ Code</label>
                                    <input type="text" name="FAQ_code" class="form-control" id="FAQ_code"
                                        placeholder="Enter FAQ code" value="<?php echo set_value('FAQ_code') ?>">
                                    <?php echo form_error('FAQ_code', '<div class="form-valid-error">', '</div>'); ?>
                                </div> -->

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" name="status" checked id="active_status" value="0">
                                        <label for="active_status" class="custom-control-label">Active</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" name="status" id="inactive_status" value="1">
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