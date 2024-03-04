<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $this->fetch('title'); ?></title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <?php 
    echo $this->Html->css(array(
        'fontawesome-free/css/all.min.css',
        'icheck-bootstrap/icheck-bootstrap.min.css',
        'adminlte.min.css',
        'custom.css',
        )
    );
    echo $this->Html->script(array(
        'jquery.min.js'
        )
    );
    ?>
    <style>
        .error{
            color: red;
        }
    </style>
</head>
<body class="hold-transition login-page">
    <?php echo $this->fetch('content'); ?>
<!-- /.login-box -->

<?php 
    echo $this->Html->script(array(
        'bootstrap.bundle.min.js',
        'adminlte.min.js',
        'jquery.validate.min',
        'https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js'
        )
    );
    echo $this->fetch('script');
?>
<script>
    var siteUrl = "http://localhost/cakephp";
</script>
</body>
</html>
