  <!-- /.content-wrapper -->
  <footer class="main-footer mt-8">
  <nav class="navbar navbar-expand navbar-white navbar-light">
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
  </footer>