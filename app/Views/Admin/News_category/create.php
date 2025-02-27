<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>News Category create</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">News Category create</li>
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
                        <h3 class="card-title">News Category create</h3>
                    </div>
                    <div class="col-md-4">
                    </div>
                    <div class="col-md-12" style="margin-top: 10px">
                        <?php if (session()->getFlashdata('message') !== NULL) : echo session()->getFlashdata('message');
                        endif; ?>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="<?php echo base_url('admin/news_category_create_action') ?>" method="post"
                      enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="category_name" class="form-control" placeholder="Category name" oninput="slug_create(this.value)" required>
                            </div>

                            <div class="form-group">
                                <label>Slug</label>
                                <input type="text" name="slug" class="form-control" id="slug" placeholder="Slug" required>
                            </div>

                            <div class="form-group">
                                <label>Main Category</label>
                                <select name="parent_id" class="form-control text-capitalize select2bs4">
                                    <option value="">Please select</option>
                                    <?php foreach ($category as $cat) { ?>
                                        <option value="<?php echo $cat->news_cat_id ?>">
                                            <?php echo display_category_with_parent($cat->news_cat_id);?>
                                        </option>
                                    <?php } ?>
                                </select>

                            </div>

                            <div class="form-group">
                                <label>Image</label>
                                <input type="file" name="image" class="form-control" placeholder="image">
                            </div>



                            <button class="btn btn-primary">Create</button>
                            <a href="<?php echo base_url('admin/news_category') ?>" class="btn btn-danger">Back</a>
                        </div>
                        <div class="col-md-6"></div>
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