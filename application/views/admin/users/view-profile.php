
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>USER PROFILE</h1>
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
        <div class="container">
            <div class="main-body">
                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card" style=" width:327px; ">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                     <?php if(!empty($user_data['image1'])){ ?>
                                        <img src="<?php echo base_url('site-assets/img/user-avatar/') . $user_data['image1']; ?>" class="rounded-circle" width="300" height="250px"; alt="User Image">
                                    <?php  } else { ?>
                                        <img src="<?php echo base_url('site-assets/img/user-avatar/user-default.png')?>" class="rounded-circle" width="300" height="250px"; alt="User Image">
                                    <?php   } ?>
                                </div>
                            </div>
                        </div>
                    </div>
              
                    <div class="col-md-8" style="max-width: 692px !important;">
                        <div class="card mb-3" >
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                      <h6 class="mb-0">Full Name</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                      <?php echo $user_data['first_name'] . " " . $user_data['last_name'] ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                      <h6 class="mb-0">Email</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                      <?php echo $user_data['email'] ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                      <h6 class="mb-0">Gender</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                      <?php echo $user_data['gender'] ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                      <h6 class="mb-0">Age</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                      <?php echo $user_data['age'] ?>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                      <h6 class="mb-0">Date Of Birth</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                      <?php echo $user_data['birthday'] ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="col-md-8" style="float:left; width:50%">
                    <div class="card mb-3 cardmb3" >
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                  <h6 class="mb-0">Height</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                  <?php echo $user_data['height']." " ?>Cemi
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                  <h6 class="mb-0">Education</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                  <?php echo $user_data['educations'] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                  <h6 class="mb-0">Relationship</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                  <?php echo $user_data['relationship_type'] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                  <h6 class="mb-0">Religion</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                  <?php echo $user_data['religion'] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                  <h6 class="mb-0">Position</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                  <?php echo $user_data['positions'] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                  <h6 class="mb-0">Political View</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                  <?php echo $user_data['political_view'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8"  style="float:right; width:50%">
                    <div class="card mb-3 cardmb3" >
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                  <h6 class="mb-0">Star sign</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                  <?php echo $user_data['star_sign'] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                  <h6 class="mb-0">Drinking</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                  <?php echo $user_data['drinking'] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                  <h6 class="mb-0">Smoking</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                  <?php echo $user_data['smoking'] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                  <h6 class="mb-0">Exercise</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                  <?php echo $user_data['exercise'] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                  <h6 class="mb-0">Summary</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                  <?php echo $user_data['summary'] ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                  <h6 class="mb-0">MBTI</h6>
                                </div>
                                <div class="col-sm-9 text-secondary">
                                  <?php echo $user_data['mbti'] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- /.content -->
</div>
<!-- /.content-wrapper-->

<style>
    body{
    color: #1a202c;
    text-align: left;
    background-color: #e2e8f0;    
}
.main-body {
    padding: 15px;
}
.card {
    box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
}

.card {
    position: relative;
    display: flex;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #fff;
    background-clip: border-box;
    border: 0 solid rgba(0,0,0,.125);
    border-radius: .25rem;
}

.card-body {
    flex: 1 1 auto;
    min-height: 1px;
    padding: 1rem;
}

.gutters-sm {
    margin-right: -8px;
    margin-left: -8px;
}

.gutters-sm>.col, .gutters-sm>[class*=col-] {
    padding-right: 8px;
    padding-left: 8px;
}
.mb-3, .my-3 {
    margin-bottom: 1rem!important;
}

.bg-gray-300 {
    background-color: #e2e8f0;
}
.h-100 {
    height: 100%!important;
}
.shadow-none {
    box-shadow: none!important;
}
.card1{
     width: 1100px !important;
    }
 .container {
    max-width: 1100px !important;
 }  

 .cardmb3 {
      width: 500px  !important;
}
</style>

