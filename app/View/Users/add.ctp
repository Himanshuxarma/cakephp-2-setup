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
        <div class="card-body table-responsive p-0">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add New User</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <?php 
                echo $this->Session->flash('auth');
                echo $this->Form->create('User', ['name'=>'createUser', 'novalidate'=>true]); 
                ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 form-group">
                                <label for="userFirstName">First Name</label>
                                <?php echo $this->Form->input('first_name', ['id'=>'userFirstName', 'class'=>'form-control', 'placeholder'=>'Enter first name', 'label'=>false]);?>
                            </div>
                            <div class="col-6 form-group">
                                <label for="userLastName">First Name</label>
                                <?php echo $this->Form->input('last_name', ['id'=>'userLastName', 'class'=>'form-control', 'placeholder'=>'Enter last name', 'label'=>false]);?>
                            </div>
                            <div class="col-6 form-group">
                                <label for="userContactNumber">Contact Number</label>
                                <?php echo $this->Form->input('contact_number', ['type'=>'digits', 'minlength'=>10, 'maxlength'=>10, 'id'=>'userContactNumber', 'class'=>'form-control', 'placeholder'=>'Enter contact number', 'label'=>false]);?>
                            </div>
                            <div class="col-6 form-group">
                                <label for="userEmail">Email</label>
                                <?php echo $this->Form->input('email', ['id'=>'userEmail', 'class'=>'form-control', 'placeholder'=>'Enter email', 'label'=>false]);?>
                            </div>
                            <div class="col-6 form-group">
                                <label for="userPassword">Password</label>
                                <?php echo $this->Form->input('password', ['id'=>'userPassword', 'class'=>'form-control', 'placeholder'=>'Enter password', 'label'=>false]);?>
                            </div>
                            <div class="col-6 form-group">
                                <label for="userAddress">Address</label>
                                <?php echo $this->Form->textarea('address', ['id'=>'userAddress', 'class'=>'form-control', 'placeholder'=>'Enter Address', 'label'=>false]);?>
                            </div>
                            <div class="col-6 form-group">
                                <label for="userState">State</label>
                                <?php echo $this->Form->select('state', $stateList, ['class'=>"form-control", 'empty'=>"Select State", 'label'=>false]); ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 form-check">
                                <?php 
                                echo $this->Form->checkbox('is_admin', [0, 1], ['id'=>'userIsAdmin', 'class'=>"form-control"]); ?>
                                <label class="form-check-label" for="userIsAdmin">Is Admin</label>
                            </div>
                            <div class="col-6 form-check">
                                <?php 
                                $statusList = ['0'=>'Inactive', '1'=>'Active'];
                                echo $this->Form->checkbox('status', $statusList, ['id'=>'userStatus', 'class'=>"form-control"]); ?>
                                <label class="form-check-label" for="userStatus">Status</label>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                <?php echo $this->Form->end(); ?>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>
<?php $this->append('script'); ?>
    <script type="text/javascript">
        /**
     * Himanshu Sharma 
     * Code to handle create user form validations and submit it if everything works well 
     * */
    jQuery("form[name='createUser']").validate({
        // Specify validation rules
        rules: {
        first_name: "required",
        last_name: "required",
        contact_number: {
            required: true,
            number: true,
            min: 10,
            max: 10
        },
        email: {
            required: true,
            email: true
        },
        password: {
            required: true,
            minlength: 6
        },
        address: "required",
        state: "required",
        },
        // Specify validation error messages
        messages: {
        firstname: "Please enter your firstname",
        lastname: "Please enter your lastname",
        contact_number: "Please enter your contact number",
        email: "Please enter a valid email address",
        password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 6 digits long",
            maxlength: "Your password must be under 20 digits"
        },
        address: "Please enter your address",
        state: "Please select your state",
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function(form) {
            var data = $("form[name='createUser']").serialize();
            $.post(siteUrl+'/users/add', data, function(response){ 
                if(response){
                    const responseData = JSON.parse(response);
                    if(responseData.status){
                        let listpage = siteUrl+'/users/';
                        window.location.replace(listpage); 
                    } else {
                        if(responseData.errors.email){
                            jQuery('#userEmail').parent().append('<label id="userEmail-error" class="error" for="userEmail">This email is already exists.</label>')
                        }
                    }
                }
            });
        }
    });
    </script>
<?php $this->end(); ?>