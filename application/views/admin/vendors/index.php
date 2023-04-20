<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>VENDORS</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Vendors</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <?php if (flash_get('error')) { ?>
      <p class="admin-toastr" onclick="toastr_danger('<?php echo flash_get('error') ?>')"></p>
  <?php }if (flash_get('success')) {?>
      <p class="admin-toastr" onclick="toastr_success('<?php echo flash_get('success') ?>')"></p>
  <?php } ?>
  <!-- Main content -->
  <section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                  <a href="<?php echo base_url('admin/vendor-page') ?>"><button type="button" class="btn btn-primary">Add Vendor</button></a>
              </div>
              <div class="card-body">
                <table id="example2" class="table table-hover table-bordered table-striped el-table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Tag Name</th>
                            <th>Tag Color</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1; foreach ($vendors_data as $key => $vendor_data) { ?>
                        <tr>
                            <td><?php echo $i++; ?></td>

                            <td><?php echo $vendor_data['vendor_name'] ?></td>
                            <td><?php echo $vendor_data['tag_name'] ?></td>
                            <td><?php echo $vendor_data['tag_color'] ?></td>
                            <td><img src="<?php url('assets/img/vendors/'.$vendor_data['vendor_image']) ?>" class="sm-img"> </td>
                            <td><?php if($vendor_data['status'] == 0){?>
                                <a class="text-success" onclick="confirm_box_status('inactive','<?php echo $vendor_data['ID'] ?>','admin/change-vendor-status',this,'Vendor')"><strong>Active</strong></a>
                            <?php }
                            if($vendor_data['status'] == 1){ ?>
                                <a class="text-danger" onclick="confirm_box_status('active','<?php echo $vendor_data['ID'] ?>','admin/change-vendor-status',this,'Vendor')"><strong>Inactive</strong></a>
                                <?php } ?></td>
                                <td>
                                    <a href="<?php url('admin/edit-vendor/'.$vendor_data['ID']) ?>"><button type="button" class="btn btn-block bg-gradient-primary btn-xs">Edit</button></a>
                                    <a onclick="confirm_box_delete('<?php echo $vendor_data['ID'] ?>','admin/delete-vendor')"><button type="button" class="btn btn-block bg-gradient-danger btn-xs mt-1">Delete</button></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper