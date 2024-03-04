<!DOCTYPE html>
<html lang="en">
<?php echo $this->element('head'); ?>
<body class="sidebar-collapse">
<div class="wrapper">

  	<!-- Preloader -->
  	<div class="preloader flex-column justify-content-center align-items-center">
    	<img class="animation__shake" src="img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  	</div>

  	<!-- Navbar -->
  	<nav class="main-header navbar navbar-expand navbar-white navbar-light">
		<!-- Left navbar links -->
		<ul class="navbar-nav ml-auto">
			<?php if (AuthComponent::user('id')){ ?>
				<li class="nav-item d-none d-sm-inline-block">
					<?php echo $this->Html->link('<p>Users</p>', '/users', array('escape'=>false, 'class'=>"nav-link")); ?>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<?php echo $this->Html->link('Logout', '/logout', array('class'=>"nav-link")); ?>
				</li>
			<?php 
			} else {
			?>
				<li class="nav-item d-none d-sm-inline-block">
					<?php echo $this->Html->link('Sign Up', '/register', array('class'=>"nav-link")); ?>
				</li>
				<li class="nav-item d-none d-sm-inline-block">
					<?php echo $this->Html->link('Sign In', '/login', array('class'=>"nav-link")); ?>
				</li>
			<?php	
			}
			?>
		</ul>
  	</nav>
  	<!-- /.navbar -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php echo $this->fetch('content'); ?>
  </div>
  <!-- /.content-wrapper -->
  	<?php echo $this->element('footer'); ?>
</div>
<!-- ./wrapper -->
<?php echo $this->element('foot'); ?>

</body>
</html>
