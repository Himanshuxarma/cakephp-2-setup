<div class="register-box">
    <div class="register-logo">
        <a href="javascript:void(0);"><b>Interview</b>Assignment</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body register-card-body">
        <p class="register-box-msg">Register a new membership</p>
        <?php if($this->Session->flash('auth')) { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $this->Session->flash('auth'); ?>
            </div>
        <?php } 
            echo $this->Form->create('User', ['name'=>'registration', 'novalidate'=>true]);
        ?>
        <div class="row">
            <div class="col-6 mb-3">
                <?php echo $this->Form->input('first_name', array('class'=>"form-control", 'placeholder'=>"First Name", 'label'=>false)); ?>
            </div>
            <div class="col-6 mb-3">
                <?php echo $this->Form->input('last_name', array('class'=>"form-control", 'placeholder'=>"Last Name", 'label'=>false)); ?>
            </div>
            <div class="col-6 mb-3">
                <?php echo $this->Form->input('contact_number', array('type'=>'digits', 'minlength'=>10, 'maxlength'=>10, 'class'=>"form-control", 'placeholder'=>"Contact Number", 'label'=>false)); ?>
            </div>
            <div class="col-6 mb-3">
                <?php echo $this->Form->input('email', array('class'=>"form-control", 'placeholder'=>"Email", 'label'=>false)); ?>
            </div>
            <div class="col-6 mb-3">
                <?php echo $this->Form->input('password', array('class'=>"form-control", 'placeholder'=>"Password", 'id'=>"UserPassword", 'label'=>false)); ?>
            </div>
            <div class="col-6 mb-3">
                <?php echo $this->Form->input('confirm_password', array('type'=>"password", 'class'=>"form-control", 'placeholder'=>"Confirm Password", 'equalTo'=>"#UserPassword",  'label'=>false)); ?>
            </div>
            <div class="col-6 mb-3">
                <?php echo $this->Form->textarea('address', array('class'=>"form-control", 'placeholder'=>"Address", 'label'=>false)); ?>
            </div>
            <div class="col-6 mb-3">
                <?php echo $this->Form->select('state', $stateList, array('class'=>"form-control", 'empty'=>"Select State", 'label'=>false)); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-8">
                <div class="icheck-primary">
                    <?php echo $this->Form->checkbox('agreement', array('hiddenField' => false, 'value' => '1', 'id'=>"remember")); ?>
                    <label for="remember">
                        I agree to the terms
                    </label>
                </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
        </div>
        <?php echo $this->Form->end(); ?>
        <p class="mb-0">
            <?php echo $this->Html->link(__('I already have a membership'), ['controller' => 'users','action' => 'login'], ['class' => 'text-center']);?>
        </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<?php $this->append('script'); ?>
<script>
    /**
     * Himanshu Sharma 
     * Code to handle registration form validations and submit it if everything works well 
     * */
    jQuery("form[name='registration']").validate({
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
            confirm_password: {
                required: true,
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
            confirm_password: {
                required: "Please provide a password",
                equalTo: "Confirm password must be same as password"
            },
            address: "Please enter your address",
            state: "Please select your state",
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function(form) {
            var data = $("form[name='registration']").serialize();
            $.post('register', data, function(response){ 
                if(response){
                    const responseData = JSON.parse(response);
                    console.log(responseData)
                    if(responseData.status){
                        let listpage = siteUrl+responseData.redirect;
                        window.location.replace(listpage); 
                        // window.location.replace('/'+responseData.redirect); 
                    } else {
                        if(responseData.errors.email){
                            jQuery('#UserEmail').parent().append('<label id="userEmail-error" class="error" for="userEmail">This email is already exists.</label>')
                        }
                    }
                }
            });
        }
    });
</script>
<?php $this->end(); ?>