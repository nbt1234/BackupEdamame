<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>COUPON</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php url('admin/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Coupon</li>
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
                  <a href="<?php echo base_url('admin/coupon-page') ?>"><button type="button" class="btn btn-primary">Add Coupon</button></a>
              </div>
              <div class="card-body">
                <table id="example2" class="table table-hover table-bordered table-striped el-table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Coupon</th>
                            <th>Discount</th>
                            <th>Limit</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1; foreach ($coupons_data as $key => $coupons_data) { ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $coupons_data['coupon_name'] ?></td>
                            <td><?php echo $coupons_data['discount'].' %' ?></td>
                            <td><?php echo $coupons_data['no_of_users'] ?></td>
                            <td><?php echo date('d M, Y',strtotime($coupons_data['created_at'])) ?></td>
                            <td><?php if($coupons_data['status'] == 0){?>
                                <a class="text-success" onclick="confirm_box_status('inactive','<?php echo $coupons_data['ID'] ?>','admin/change-coupon-status',this,'Coupon')"><strong>Active</strong></a>
                            <?php }
                            if($coupons_data['status'] == 1){ ?>
                                <a class="text-danger" onclick="confirm_box_status('active','<?php echo $coupons_data['ID'] ?>','admin/change-coupon-status',this,'Coupon')"><strong>Inactive</strong></a>
                                <?php } ?></td>
                                <td>
                                    <a href="<?php url('admin/edit-coupon/'.$coupons_data['ID']) ?>"><button type="button" class="btn btn-block bg-gradient-primary btn-xs">Edit</button></a>
                                    <a onclick="confirm_box_delete('<?php echo $coupons_data['ID'] ?>','admin/delete-coupon')"><button type="button" class="btn btn-block bg-gradient-danger btn-xs mt-1">Delete</button></a>
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