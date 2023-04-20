<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>NOTIFICATIONS FOR USERS</h1>
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
                        <form role="form" class="my-5" method="post" action="<?php url('admin/send-notifications'); ?>" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- text input -->
                                    <div class="form-group">
                                        <label>Title</label>
                                        <input type="text" class="form-control" name="title" placeholder="Enter Title" value="<?php echo set_value('title') ?>">
                                        <?php echo form_error('title', '<div class="form-valid-error">', '</div>'); ?>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- textarea -->
                                    <div class="form-group">
                                        <label>Message</label>
                                        <textarea name="message" class="form-control" rows="3" placeholder="Enter Message"><?php echo set_value('message') ?></textarea>
                                        <?php echo form_error('message', '<div class="form-valid-error">', '</div>'); ?>
                                    </div>
                                </div>
                            </div>

                            <!-- input states -->

                            <div class="row">
                                <div class="col-sm-12">
                                    <!-- Select multiple-->
                                    <div class="form-group">
                                        <label>Selected Users</label>

                                        <label class="float-right" style="justify-content: flex-end;"><button type="button" id="selectAll" class="btn btn-sm buttton-btn-sub">Select All </button></label>

                                        <select multiple="" class="form-control" name="userid[]" id="config" name="config" oninvalid="alert('You must select at least one user!');" required>
                                            <option>Select Users From Table Below</option>
                                        </select>
                                        <?php //echo form_error('userid[]', '<div class="form-valid-error">', '</div>'); ?>
                                        <!-- oninvalid="alert('You must select at least one user!');" required -->
                                    </div>
                                </div>
                            </div>
                            <div class="container text-right float-right" >
                                <button type="submit" class="btn d-inline buttton-btn-sub">Send Message</button>
                            </div>
                        </form>


                        <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4 py-5">

                            <div class="row">
                                <div class="col-sm-12">
                                    <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>S.No</th>
                                                <th>User Name</th>
                                                <th>Email</th>
                                                <th>Age</th>
                                                <th>Gender</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $i = 1;
                                            foreach ($users_data as $key => $user_data) { ?>
                                                <tr>
                                                    <td><input class="check-box" type="checkbox" id="customCheckbox" value="<?php echo $user_data['email'] ?>"></td>
                                                    <td><?php echo $i++; ?></td>
                                                    <td><?php echo $user_data['first_name'] . " " . $user_data['last_name'] ?></td>
                                                    <td><?php echo $user_data['email'] ?></td>
                                                    <td><?php echo $user_data['age'] ?></td>
                                                    <td><?php echo $user_data['gender'] ?></td>

                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

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

<script>
    $(document).ready(function() {
        var oTable = $('#example1').dataTable({
            stateSave: true
        });

        var allPages = oTable.fnGetNodes();

        $('body').on('click', '#selectAll', function() {
            if ($(this).hasClass('allChecked')) {
                $('input[type="checkbox"]', allPages).prop('checked', false);
            } else {
                $('input[type="checkbox"]', allPages).prop('checked', true);
            }
            $(this).toggleClass('allChecked');



            let $config = $('#config');
            let $checkboxes = $('input[type="checkbox"]', allPages);

            $checkboxes.on('change', function() {
                $('option.dynamic').remove();
                let options = $checkboxes.filter(':checked').map((i, el) => `<option class="dynamic" selected value="${el.value}">${el.value}</option>`).get();
                $config.append(options);
            }).trigger('change');

        })

    });


    $(document).ready(function() {
        let $config = $('#config');
        let $checkboxes = $(':checkbox');

        $checkboxes.on('change', function() {
            $('option.dynamic').remove();
            let options = $checkboxes.filter(':checked').map((i, el) => `<option class="dynamic" selected value="${el.value}">${el.value}</option>`).get();
            $config.append(options);
        }).trigger('change');
    });
</script>