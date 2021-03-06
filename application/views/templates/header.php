<head>
    <meta charset="utf-8">
    <title>Bootstrap Admin</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="<?=base_url('lib/bootstrap/css/bootstrap.css')?>">

    <link rel="stylesheet" type="text/css" href="<?=base_url('stylesheets/theme.css')?>">
<!--    <link rel="stylesheet" href="--><?//= base_url('lib/font-awesome/css/font-awesome.css')?><!--">-->


    <script src="<?=base_url('js/jquery-1.8.2.min.js')?>" type="text/javascript"></script>
<!--    <script type="text/javascript" src="--><?//=base_url('js/main.js')?><!--"></script>-->

    <script type="text/javascript" src="<?=base_url('tinymce/js/tinymce/tinymce.min.js')?>"></script>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea"
        });
    </script>


    <!-- Demo page code -->

    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <!--<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>-->
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">

    <!--my scripts and styles-->
    <link rel="stylesheet" href="<?=base_url('css/myStyle.css')?>">
    <script type="text/javascript" src="<?=base_url('js/userCartManager.js')?>"></script>
</head>