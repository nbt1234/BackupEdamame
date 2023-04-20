<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>SUBADMIN ACCESS</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php url('admin/dashboard')?>">Home</a></li>
                        <li class="breadcrumb-item active">Add Subadmin Access</li>
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
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add Subadmin Access</h3>
                        </div>
                        <!-- form start -->
                        <?php if (count($subadmin_data) != 0) {

$subadmin_info = json_decode($subadmin_data['access_fields'], true);
?>
                        <form role="form" method="post" action="<?php url('admin/subadmin-insert-access/'.$id);?>"
                            enctype="multipart/form-data">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="vendor" name="fields[]"
                                                    value="vendor_section" <?php if (isset($subadmin_info) && in_array('vendor_section', $subadmin_info)) {
                      echo 'checked';
                    }?>>
                                                <label for="vendor">
                                                    Vendor
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="flavour" name="fields[]"
                                                    value="flavour_section" <?php if (isset($subadmin_info) && in_array('flavour_section', $subadmin_info)) {
                      echo 'checked';
                    }?>>
                                                <label for="flavour">
                                                    Flavour
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="users" name="fields[]" value="users_section" <?php if (isset($subadmin_info) && in_array('users_section', $subadmin_info)) {
                      echo 'checked';
                    }?>>
                                                <label for="users">
                                                    Users
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <div class="icheck-success d-inline">
                                                <input type="checkbox" id="subadmin" name="fields[]" value="subadmin_section" <?php if (isset($subadmin_info) && in_array('subadmin_section', $subadmin_info)) {
                      echo 'checked';
                    }?>>
                                                <label for="subadmin">
                                                Subadmin
                                                </label>
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                        <?php } else {?>
                        <p class="alert alert-danger site-errors">No Sudadmin found</p>
                        <?php }?>
                    </div>


                </div>
            </div>
        </div>
    </section>
</div>