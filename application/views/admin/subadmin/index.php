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
                        <li class="breadcrumb-item active">Subadmin</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <?php if (flash_get('error')) {?>
      <p class="admin-toastr" onclick="toastr_danger('<?php echo flash_get('error') ?>')"></p>
  <?php }if (flash_get('success')) {?>
      <p class="admin-toastr" onclick="toastr_success('<?php echo flash_get('success') ?>')"></p>
  <?php }?>
  <!-- Main content -->
  <section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
            <div class="card-header">
                  <a href="<?php echo base_url('admin/subadmin-page') ?>"><button type="button" class="btn btn-primary">Add Subadmin</button></a>
              </div>
              <div class="card-body">
                <table id="example2" class="table table-hover table-bordered table-striped el-table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>mobile</th>
                            <th>Avatar</th>
                            <th>Block Status</th>
                            <th>Permissions</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                      <?php $i = 1;foreach ($subadmins_data as $key => $subadmin_data) {?>
                        <tr>
                            <td><?php echo $i++; ?></td>

                            <td><?php echo $subadmin_data['username'] ?></td>
                            <td><?php echo $subadmin_data['email'] ?></td>
                            <td><?php echo $subadmin_data['mobile'] ?></td>
                            <td><img src="<?php url('site-assets/img/user-avatar/'.$subadmin_data['avatar']) ?>" class="sm-img"> </td>
                            <td><?php if ($subadmin_data['user_block_status'] == 0) {?>
                                <a class="text-success" onclick="confirm_box_status('inactive','<?php echo $subadmin_data['ID'] ?>','admin/change-subadmin-status',this,'Subadmin')"><strong>Active</strong></a>
                            <?php }if ($subadmin_data['user_block_status'] == 1) {?>
                                <a class="text-danger" onclick="confirm_box_status('active','<?php echo $subadmin_data['ID'] ?>','admin/change-subadmin-status',this,'Subadmin')"><strong>Inactive</strong></a>
                                <?php }?></td>
                                <td>
                                <a target="_blank" class="text-info" href="<?php echo base_url('admin/subadmin-access/'.$subadmin_data['ID']) ?>"><strong>Access</strong></a>
                                </td>
                                <td>
                                    <a href="<?php url('admin/edit-subadmin/' . $subadmin_data['ID'])?>"><button type="button" class="btn btn-block bg-gradient-primary btn-xs">Edit</button></a>
                                    <a onclick="confirm_box_delete('<?php echo $subadmin_data['ID'] ?>','admin/delete-user')"><button type="button" class="btn btn-block bg-gradient-danger btn-xs mt-1">Delete</button></a>
                                </td>
                            </tr>
                        <?php }?>
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