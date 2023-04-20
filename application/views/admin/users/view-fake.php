<?php
// pre($user_img_data);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>USER VIEW</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php url('admin/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">User View</li>
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
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="<?php url('site-assets/img/user-avatar/' . $user_data['avatar']) ?>" alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?php echo $user_data['username'] ?></h3>

                            <!-- <p class="text-muted text-center">Software Engineer</p> -->

                            <!-- <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Followers</b> <a class="float-right">1,322</a>
                            </li>
                            <li class="list-group-item">
                                <b>Following</b> <a class="float-right">543</a>
                            </li>
                            <li class="list-group-item">
                                <b>Friends</b> <a class="float-right">13,287</a>
                            </li>
                            </ul> -->

                            <a href="<?php url('admin/edit-user/' . $user_data['ID']) ?>" class="btn btn-primary btn-block"><b>Edit</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About User</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-mobile mr-1"></i> mobile</strong>

                            <p class="text-muted">
                                <?php echo $user_data['mobile'] ?>
                            </p>

                            <hr>

                            <strong><i class="fas fa-envelope mr-1"></i> Email</strong>

                            <p class="text-muted">
                                <?php echo $user_data['email'] ?>
                            </p>
                            <!-- <p class="text-muted">Malibu, California</p> -->

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Country</strong>

                            <p class="text-muted">
                                <?php echo $user_data['country'] ?>
                            </p>
                            <!-- <p class="text-muted">
                            <span class="tag tag-danger">UI Design</span>
                            <span class="tag tag-success">Coding</span>
                            <span class="tag tag-info">Javascript</span>
                            <span class="tag tag-warning">PHP</span>
                            <span class="tag tag-primary">Node.js</span>
                            </p> -->

                            <hr>

                            <strong><i class="fas fa-toggle-on mr-1"></i>User Status</strong>
                            <p>
                                <?php if ($user_data['user_block_status'] == 0) { ?>
                                    <a class="text-success" onclick="confirm_box_status('inactive','<?php echo $user_data['ID'] ?>','admin/change-user-status',this,'User')"><strong>Active</strong></a>
                                <?php } ?>
                                <?php if ($user_data['user_block_status'] == 1) { ?>
                                    <a class="text-danger" onclick="confirm_box_status('active','<?php echo $user_data['ID'] ?>','admin/change-user-status',this,'User')"><strong>Inactive</strong></a>
                                <?php } ?>
                            </p>

                            <hr>

                            <strong><i class="fas fa-toggle-on mr-1"></i>Token Status</strong>
                            <p>
                                <?php if ($user_data['token_status'] == 0) { ?>
                                    <a class="text-success" href=""><strong>Approved</strong></a>
                                <?php } ?>
                                <?php if ($user_data['token_status'] == 1) { ?>
                                    <a class="text-danger"  href=""><strong>Disapproved</strong></a>
                                <?php } ?>
                            </p>
                            <!-- <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p> -->
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Profile</a></li>
                                <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Images</a></li>
                                <!-- <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Timeline</a></li> -->
                            </ul>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="settings">
                                    <form role="form" method="post" action="<?php url('admin/update-user/' . $user_data['ID']); ?>" enctype="multipart/form-data">
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label for="username">User Name</label>
                                                <input type="text" name="username" class="form-control" id="username" placeholder="Enter user name" value="<?php echo $user_data['username'] ?>">
                                                <?php echo form_error('username', '<div class="form-valid-error">', '</div>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" name="email" class="form-control" id="email" placeholder="Enter user code" value="<?php echo $user_data['email'] ?>">
                                                <?php echo form_error('email', '<div class="form-valid-error">', '</div>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="mobile">mobile</label>
                                                <input type="text" name="mobile" class="form-control" id="mobile" placeholder="Enter user code" value="<?php echo $user_data['mobile'] ?>">
                                                <?php echo form_error('mobile', '<div class="form-valid-error">', '</div>'); ?>
                                            </div>
                                            <div class="form-group">
                                                <label for="avatar">Image</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" name="avatar" class="custom-file-input" id="avatar">
                                                        <label class="custom-file-label" for="avatar">Choose file</label>
                                                    </div>
                                                </div>
                                                <?php echo form_error('avatar', '<div class="form-valid-error">', '</div>'); ?>
                                                <img src="<?php url('./site-assets/img/user-avatar/' . $user_data['avatar']) ?>" class="sm-img">
                                            </div>

                                            <div class="form-group">
                                                <label for="bio">Bio</label>
                                                <textarea class="form-control" rows="5" name="bio" placeholder="User Bio"><?php echo $user_data['bio'] ?></textarea>
                                                <?php echo form_error('bio', '<div class="form-valid-error">', '</div>'); ?>
                                            </div>
                                            <!-- 
                                            <div class="form-group">
                                                <label for="status">Status</label>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" name="status" checked id="active_status" value="0" <?php if ($user_data['user_block_status'] == 0) {
                                                                                                                                                            echo 'checked';
                                                                                                                                                        } ?>>
                                                    <label for="active_status" class="custom-control-label">Active</label>
                                                </div>
                                                <div class="custom-control custom-radio">
                                                    <input class="custom-control-input" type="radio" name="status" id="inactive_status" value="1" <?php if ($user_data['user_block_status'] == 1) {
                                                                                                                                                        echo 'checked';
                                                                                                                                                    } ?>>
                                                    <label for="inactive_status" class="custom-control-label">Inactive</label>
                                                </div>
                                                <?php echo form_error('status', '<div class="form-valid-error">', '</div>'); ?>
                                            </div> -->
                                        </div>

                                        <!-- <div class="card-footer">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div> -->
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="activity">
                                    <!-- Post -->
                                    <div class="post">
                                        <div class="user-block">
                                            <!-- <img class="img-circle img-bordered-sm" src="../../dist/img/user6-128x128.jpg" alt="User Image"> -->
                                            <span class="username">
                                                <a href="#">Image 1</a>
                                                <!-- <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a> -->
                                            </span>
                                            <!-- <span class="description">Posted 5 photos - 5 days ago</span> -->
                                        </div>
                                        <!-- /.user-block -->
                                        <div class="row mb-3">
                                            <div class="col-sm-6">
                                                <img class="img-fluid" src="<?php url('assets/img/users/' .'1016-638-'. $user_img_data['image1']) ?>" alt="Photo">
                                            </div>
                                            <!-- /.col -->

                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.post -->
                                    <!-- Post -->
                                    <div class="post">
                                        <div class="user-block">
                                            <!-- <img class="img-circle img-bordered-sm" src="../../dist/img/user6-128x128.jpg" alt="User Image"> -->
                                            <span class="username">
                                                <a href="#">Image 2</a>
                                                <!-- <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a> -->
                                            </span>
                                            <!-- <span class="description">Posted 5 photos - 5 days ago</span> -->
                                        </div>
                                        <!-- /.user-block -->
                                        <div class="row mb-3">
                                            <div class="col-sm-6">
                                                <img class="img-fluid" src="<?php url('assets/img/users/' .'1016-638-'.$user_img_data['image2']) ?>" alt="Photo">
                                            </div>
                                            <!-- /.col -->

                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->
                                    </div>
                                    <!-- /.post -->
                                    <!-- Post -->
                                    <div class="post">
                                        <div class="user-block">
                                            <!-- <img class="img-circle img-bordered-sm" src="../../dist/img/user6-128x128.jpg" alt="User Image"> -->
                                            <span class="username">
                                                <a href="#">Image 3</a>
                                                <!-- <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a> -->
                                            </span>
                                            <!-- <span class="description">Posted 5 photos - 5 days ago</span> -->
                                        </div>
                                        <!-- /.user-block -->
                                        <div class="row mb-3">
                                            <div class="col-sm-6">
                                                <img class="img-fluid" src="<?php url('assets/img/users/' .'1016-638-'.$user_img_data['image3']) ?>" alt="Photo">
                                            </div>
                                            <!-- /.col -->

                                            <!-- /.col -->
                                        </div>
                                        <!-- /.row -->


                                    </div>
                                    <!-- /.post -->
                                    <div class="card-footer">
                                        <a href="<?php url('admin/token-approve/' . $user_data['ID']); ?>">
                                            <p class="btn btn-success mr-3">Approve</p>
                                            <!-- <button class="btn btn-success mr-3">Approve</button> -->
                                        </a>
                                        <a href="<?php url('admin/token-disapprove/' . $user_data['ID']); ?>">
                                            <p class="btn btn-danger">Disapprove</p>
                                            <!-- <button class="btn btn-success mr-3">Approve</button> -->
                                        </a>
                                        <!-- <button type="submit" class="btn btn-danger">Disapprove</button> -->
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    <!-- /.content -->
</div>
<!-- /.content-wrapper-->