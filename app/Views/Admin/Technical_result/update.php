<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Technical Result update</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url('admin/dashboard')?>">Home</a></li>
                        <li class="breadcrumb-item active">Technical Result update</li>
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
                        <h3 class="card-title">Technical Result update</h3>
                    </div>
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-12" style="margin-top: 10px">
                        <?php if (session()->getFlashdata('message') !== NULL) : echo session()->getFlashdata('message'); endif; ?>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="<?php echo base_url('admin/technical_result_update_action')?>" method="post" enctype="multipart/form-data">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Page Description</label>
                                <textarea name="description" id="editor" rows="6" class="form-control" placeholder="Description" ><?php echo $result->description;?></textarea>
                            </div>


                            <button class="btn btn-primary" >update</button>
                            <input type="hidden" name="technical_result_id" value="<?php echo $result->technical_result_id;?>">
                            <a href="<?php echo base_url('admin/technical_result')?>" class="btn btn-danger" >Back</a>

                        </div>
                        <div class="col-md-6">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>PDF</label>
                                    <input type="file" class="form-control" accept="application/pdf" name="pdf">
                                    <br>
                                    <a href="<?php echo base_url('uploads/technical_result/'.$result->technical_result_id.'/'.$result->pdf) ?>" target="_blank" download"><?php echo !empty($result->pdf)?'View':'';?></a>
                                </div>

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