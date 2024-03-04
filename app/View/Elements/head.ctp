<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AdminLTE 3 | Dashboard</title>
    <?php 
    echo $this->Html->css(array(
        'fontawesome-free/all.min.css',
        'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback',
        'tempusdominus-bootstrap-4.min',
        'icheck-bootstrap/icheck-bootstrap.min.css',
        'jqvmap.min.css',
        'adminlte.min.css',
        'OverlayScrollbars.min.css',
        'custom.css',
        )
    );
    echo $this->Html->script(array(
        'jquery.min.js'
        )
    );
    ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplePagination.js/1.4/simplePagination.min.css" />
    <style>
        .error{
            color: red;
        }
    </style>
</head>