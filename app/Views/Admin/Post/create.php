<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Post create</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>">Home</a></li>
                        <li class="breadcrumb-item active">Post create</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-8">
                        <h3 class="card-title">Post create</h3>
                    </div>
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-12" style="margin-top: 10px">
                        <?php if (session()->getFlashdata('message') !== NULL) : echo session()->getFlashdata('message'); endif; ?>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="<?php echo base_url('admin/post_create_action')?>" method="post" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="post_title" class="form-control" placeholder="Post Title" required>
                            </div>

                            <div class="form-group">
                                <label>Category</label>
                                <select name="news_cat_id[]" class="form-control select2bs4" id="news_cat_id" multiple="multiple" required>
                                    <option value="">Please select</option>
                                    <?php foreach ($category as $cat) { ?>
                                        <option value="<?php echo $cat->news_cat_id ?>">
                                            <?php echo display_category_with_parent($cat->news_cat_id);?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="post_content" id="editor" rows="6" class="form-control" placeholder="Description" required></textarea>
                            </div>


                            <button class="btn btn-primary" >Add</button>
                            <a href="<?php echo base_url('admin/post')?>" class="btn btn-danger" >Back</a>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Featured Image</label>
                                <input type="file" class="form-control" accept="image/*"  name="image" required>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">

            </div>
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>