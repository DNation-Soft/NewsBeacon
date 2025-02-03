<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Post List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard') ?>">Home</a></li>
                        <li class="breadcrumb-item active">Post List</li>
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
                        <h3 class="card-title">Post List</h3>
                    </div>
                    <div class="col-md-4">
                        <a href="<?php echo base_url('admin/post_create') ?>" class="btn btn-primary btn-block btn-xs"><i class="fas fa-plus"></i> Create</a>
                    </div>
                    <div class="col-md-12" style="margin-top: 10px">
                        <?php if (session()->getFlashdata('message') !== NULL) : echo session()->getFlashdata('message'); endif; ?>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1; foreach ($posts as $val){ ?>
                        <tr>
                            <td width="40"><?php echo $i++;?></td>
                            <td><?php echo get_data_by_id('name','nb_users','user_id',$val->post_author);?></td>
                            <td><?php echo display_category_with_parent($val->news_cat_id);?></td>
                            <td><?php echo $val->post_title;?></td>
                            <td><?php echo image_view('uploads/post', $val->post_id, '50_' . $val->featured_image, '50_noimage.png', '');?></td>
                            <td><?php echo $val->post_status;?></td>
                            <td width="180">
                                <a href="<?php echo base_url('admin/post_update/'.$val->post_id);?>" class="btn btn-primary btn-xs"><i class="fas fa-edit"></i> Update</a>
                                <a href="<?php echo base_url('admin/post_delete/'.$val->post_id);?>" onclick="return confirm('Are you sure you want to Delete?')" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i> Delete</a>
                            </td>
                        </tr>
                    <?php } ?>

                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Sl</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                </table>
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