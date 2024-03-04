<div class="login-box">
    <div class="login-logo">
        <a href="javascript:void(0);"><b>Interview</b>Assignment</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
        <?php if($this->Session->flash('auth') != "") { ?>
            <div class="alert alert-success" role="alert">
                <?php echo $this->Session->flash('auth'); ?>
            </div>
        <?php }
            echo $this->Form->create('User', ['name'=>'front_login', 'id'=>"loginForm", 'novalidate'=>true]);
        ?>
            <div class="mb-3">
                <?php echo $this->Form->input('email', array('class'=>"form-control", 'placeholder'=>"Email", 'label'=>false)); ?>
            </div>
            <div class="mb-3">
                <?php echo $this->Form->input('password', array('class'=>"form-control", 'placeholder'=>"Password", 'label'=>false)); ?>
            </div>
            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <?php echo $this->Form->checkbox('remember_me', array('hiddenField' => false, 'value' => '1', 'id'=>"remember")); ?>
                        <label for="remember">
                            Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <?php echo $this->Form->submit('Sign In', array('class' => 'btn btn-primary btn-block',  'title' => 'Click here to add the user')); ?>
                </div>
                <!-- /.col -->
            </div>
        <?php echo $this->Form->end(); ?>
        <p class="mb-0">
            <?php echo $this->Html->link(__('Register a new membership'), ['controller' => 'users','action' => 'register'], ['class' => 'text-center']);?>
        </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<?php $this->append('script'); ?>
<script>
    /**
     * Himanshu Sharma 
     * Code to handle Login validation and login submit
     * */
    jQuery("#loginForm").validate({
        // Specify validation rules
        rules: {
        email: {
            required: true,
            email: true
        },
        password: {
            required: true,
            minlength: 6
        }
        },
        // Specify validation error messages
        messages: {
        email: "Please enter a valid email address",
        password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 6 digits long"
        }
        },
        submitHandler: function(form) {
            var data = jQuery("#loginForm").serialize();
            $.post('login', data, function(response){ 
                if(response){
                    const responseData = JSON.parse(response);
                    // console.log(responseData); return false;
                    window.location.href = responseData.redirect;
                }
            });
        }
    });
</script>
<?php $this->end(); ?>