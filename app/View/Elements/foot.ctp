<!-- jQuery UI 1.11.4 -->
<?php echo $this->Html->script('jquery-ui.min.js'); ?>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    var siteUrl = "http://localhost/cakephp";
    $.widget.bridge('uibutton', $.ui.button)
</script>
<?php 
    echo $this->Html->script(array(
        'bootstrap.bundle.min.js',
        'jquery.overlayScrollbars.min.js',
        'adminlte.min.js',
        'jquery.validate.min',
        'https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js',
        'user.js',
        )
    );
    echo $this->fetch('script');
?>