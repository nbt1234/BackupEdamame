<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>FOOTER</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php url('admin/dashboard')?>">Home</a></li>
                        <li class="breadcrumb-item active">Add Footer</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <!-- <button type="button" class=" admin-toastr btn btn-success toastrDefaultSuccess">
        Launch Success Toast
    </button> -->
    <?php if (flash_get('error')) { ?>
    <p class="admin-toastr" onclick="toastr_danger('<?php echo flash_get('error') ?>')"></p>
    <?php }if (flash_get('success')) {?>
    <p class="admin-toastr" onclick="toastr_success('<?php echo flash_get('success') ?>')"></p>
    <?php } ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add Contact</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" method="post" action="<?php url('admin/pages/add-home-page-contact');?>"
                            enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="contact-heading">Heading</label>
                                    <input type="text" name="contact-heading" class="form-control" id="contact-heading"
                                        placeholder="Enter heading" value="<?php echo $contact_data['heading'] ?>">
                                    <?php echo form_error('contact-heading', '<div class="form-valid-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="contact-data">Content</label>
                                    <textarea class="textarea" name="contact-data"
                                        placeholder="Place some text here"><?php echo $contact_data['content'] ?></textarea>
                                    <?php echo form_error('contact-data', '<div class="form-valid-error">', '</div>'); ?>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add Newsletter</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" method="post" action="<?php url('admin/pages/add-home-page-newsletter');?>"
                            enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="newsletter-heading">Heading</label>
                                    <input type="text" name="newsletter-heading" class="form-control"
                                        id="newsletter-heading" placeholder="Enter heading"
                                        value="<?php echo $newsletter_data['heading'] ?>">
                                    <?php echo form_error('newsletter-heading', '<div class="form-valid-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="newsletter-data">Content</label>
                                    <textarea class="textarea" name="newsletter-data"
                                        placeholder="Place some text here"><?php echo $newsletter_data['content'] ?></textarea>
                                    <?php echo form_error('newsletter-data', '<div class="form-valid-error">', '</div>'); ?>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>


                </div>

                <div class="col-md-6">
                    <!-- general form elements -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add Links</h3>
                        </div>
                        <!-- form start -->
                        <form role="form" method="post" action="<?php url('admin/pages/add-home-page-links');?>"
                            enctype="multipart/form-data">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="fb">Facebook</label>
                                    <input type="text" name="fb" class="form-control" id="fb" placeholder="Enter link"
                                        value="<?php echo $links_data[0]['link'] ?>">
                                    <?php echo form_error('fb', '<div class="form-valid-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="insta">Insta</label>
                                    <input type="text" name="insta" class="form-control" id="insta"
                                        placeholder="Enter link" value="<?php echo $links_data[1]['link'] ?>">
                                    <?php echo form_error('insta', '<div class="form-valid-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="linkedin">Linkedin</label>
                                    <input type="text" name="linkedin" class="form-control" id="linkedin"
                                        placeholder="Enter link" value="<?php echo $links_data[2]['link'] ?>">
                                    <?php echo form_error('linkedin', '<div class="form-valid-error">', '</div>'); ?>
                                </div>

                                <div class="form-group">
                                    <label for="twitter">Twitter</label>
                                    <input type="text" name="twitter" class="form-control" id="twitter"
                                        placeholder="Enter link" value="<?php echo $links_data[3]['link'] ?>">
                                    <?php echo form_error('twitter', '<div class="form-valid-error">', '</div>'); ?>
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </section>
</div>