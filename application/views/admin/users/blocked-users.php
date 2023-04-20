<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>BLOCKED USERS</h1>
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
            <div class="col-12 my-3">

                <div class="card">

                    <!-- /.card-header -->
                    <div class="card-body">
                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                            <div class="row">
                                <div class="col-sm-12 col-md-6">

                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Email</th>
                                                <th>Username</th>
                                                <th>Age</th>
                                                <th>Gender</th>
                                                <!-- <th>Purchase</th> -->
                                                <th>Block Status</th>
                                                <th>View Profile</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            foreach ($users_data as $key => $user_data) { ?>
                                                <tr>
                                                    <td><?php echo $i++; ?></td>
                                                     <td><?php echo $user_data['email'] ?></td>
                                                    <td><?php echo $user_data['first_name'] . " " . $user_data['last_name'] ?></td>
                                                    <td><?php echo $user_data['age'] ?></td>
                                                    <td><?php echo $user_data['gender'] ?></td>
                                                    <!-- <td><?php echo $user_data['purchased'] ?></td> -->
                                                    <td><?php if ($user_data['block'] == 0) { ?>
                                                        <a class="text-success" onclick="confirm_box_status('inactive','<?php echo $user_data['userid'] ?>','admin/change-user-status',this,'User')"><strong>Active</strong></a>
                                                            <?php }
                                                                if ($user_data['block'] == 1) { ?>
                                                        <a class="text-danger" onclick="confirm_box_status('active','<?php echo $user_data['userid'] ?>','admin/change-user-status',this,'User')"><strong>Inactive</strong></a>
                                                            <?php } ?>
                                                    </td>
                                                    <th style="text-align: left;">
                                                        <a href="<?php echo base_url()."admin/viewprofile/".$user_data['userid'] ?>">
                                                           <button type="button" class="btn btn-sm buttton-btn-sub">View Profile</button>
                                                        </a>   

                                                    </th>
                                                    <!-- <td>
                                                    <a href="<?php url('admin/edit-user/' . $user_data['userid']) ?>"><button type="button" class="btn btn-block  btn-xs" style="color: #fff;background: linear-gradient(to right, #ff5e62, #ff9966);">View</button></a> 
                                                    <a onclick="confirm_box_delete('<?php echo $user_data['userid'] ?>','admin/delete-user')"><button type="button" class="btn btn-block bg-gradient-danger btn-xs mt-1">Delete</button></a> -->
                                                    <!--</td> -->
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-5">

                                </div>
                                <div class="col-sm-12 col-md-7">
                                    <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>


            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper-->


