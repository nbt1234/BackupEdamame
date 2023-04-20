<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>REPORTED USERS</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php url('admin/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">User</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <?php if (flash_get('error')) { ?>
        <p class="admin-toastr" onclick="toastr_danger('<?php echo flash_get('error') ?>')"></p>
    <?php }
    if (flash_get('success')) { ?>
        <p class="admin-toastr" onclick="toastr_success('<?php echo flash_get('success') ?>')"></p>
    <?php } ?>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <table id="example1" class="table table-hover table-bordered table-striped el-table">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                     <th>Email</th>
                                    <th>Username</th>
                                    <th>Reported By</th>
                                    <th>Block Status</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                               
                                    <?php $i = 1;
                                    
                                    if(!empty($users_data)){    
                                    foreach ($users_data as $key => $user_data) { ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo $user_data['email'] ?></td>
                                            <td><?php echo $user_data['name'] ?></td>
                                            <td><?php echo $user_data['reported_by'] ?></td>
                                            <td><?php if ($user_data['user_block_status'] == 0) { ?>
                                                    <a class="text-success" onclick="confirm_box_status('inactive','<?php echo $user_data['userid'] ?>','admin/change-user-status',this,'User')"><strong>Block</strong></a>
                                                <?php }
                                                if ($user_data['user_block_status'] == 1) { ?>
                                                    <a class="text-danger" onclick="confirm_box_status('active','<?php echo $user_data['userid'] ?>','admin/change-user-status',this,'User')"><strong>Unblock</strong></a>
                                                <?php } ?>
                                            </td>
                                            <!-- <td>
                                        <a href="<?php url('admin/edit-user/' . $user_data['id']) ?>"><button type="button" class="btn btn-block bg-gradient-primary btn-xs">Edit</button></a>
                                        <a onclick="confirm_box_delete('<?php echo $user_data['id'] ?>','admin/delete-user')"><button type="button" class="btn btn-block bg-gradient-danger btn-xs mt-1">Delete</button></a>
                                    </td> -->
                                        </tr>
                                <?php } } ?>
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