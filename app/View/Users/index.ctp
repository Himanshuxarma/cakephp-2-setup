<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Users</h1>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<div class="row">
    <div class="col-12">
        <?php echo $this->Session->flash(); ?>
        <div class="card">
            <div class="card-header">
                <?php echo $this->Html->link('<i class="fas fa-plus"></i>Add New User', 'add', ['escape'=>false, 'class'=>'btn btn-primary'] );?>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>SL.No</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Contact Number</th>
                            <th class="text-end">Email</th>
                            <th>Role</th>
                            <th>Address</th>
                            <th>State</th>
                            <?php if(AuthComponent::user('is_admin') == 1){ ?>
                                <th>Action</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody id="user_table_data"></tbody>
                    </table>
            </div>
            <!-- /.card-body -->
        </div>
        <div id="pagination" class="all-pagination mt-4 mb-2 float-right"></div>
        <!-- /.card -->
    </div>
</div>
<?php $this->append('script'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.4/jquery.simplePagination.min.js"></script>
<script type="text/javascript">
    var context = {};
    context.userOptions = '';
    var umt = new user_manager(context);
    umt.processLocalStorage();
</script>
<?php $this->end(); ?>
