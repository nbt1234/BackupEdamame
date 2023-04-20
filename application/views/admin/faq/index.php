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
            <li class="breadcrumb-item"><a href="<?php url('admin/dashboard')?>">Home</a></li>
            <li class="breadcrumb-item active">FAQ</li>
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
            <a href="<?php echo base_url('admin/faq-page') ?>"><button type="button" class="btn btn-primary">Add FAQ</button></a>
          </div>
          <div class="card-body">
            <table id="example2" class="table table-hover table-bordered table-striped el-table">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Question</th>
                  <!-- <th>Answer</th> -->
                  <th>Status</th>
                  <th>Action</th>
                  <th>
                </tr>
              </thead>
              <tbody>
                <?php $i = 1;foreach ($faqs_data as $key => $faq_data) {?>
                  <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo strip_tags($faq_data['question']) ?></td>
                    <!-- <td><?php echo $faq_data['answer'] ?></td> -->
                    <td><?php echo date('M d , Y', strtotime($faq_data['created_at'])); ?></td>
                    <td><?php if ($faq_data['status'] == 0) {?>
                      <a class="text-success" onclick="confirm_box_status('inactive','<?php echo $faq_data['ID'] ?>','admin/faq/change-faq-status',this,'FAQ')"><strong>Active</strong></a>
                    <?php }if ($faq_data['status'] == 1) {?>
                      <a class="text-danger" onclick="confirm_box_status('active','<?php echo $faq_data['ID'] ?>','admin/faq/change-faq-status',this,'FAQ')"><strong>Inactive</strong></a>
                      <?php }?></td>
                       <td>
                        <a href="<?php url('admin/edit-faq/' . $faq_data['ID'])?>"><button type="button" class="btn btn-block bg-gradient-primary btn-xs">Edit</button></a>
                        <a onclick="confirm_box_delete('<?php echo $faq_data['ID'] ?>','admin/delete-faq')"><button type="button" class="btn btn-block bg-gradient-danger btn-xs mt-1">Delete</button></a>
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