<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Clixs, your mobile delivered to you</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url('css/bootstrap.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('css/style.css')?>" rel="stylesheet"/>

    <!-- Custom styles for this template -->
    <link href="<?=base_url('navbar.css')?>" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url('css/modified.css')?>">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?=base_url('https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js')?>"></script>
    <script src="<?=base_url('https://oss.maxcdn.com/respond/1.4.2/respond.min.js')?>"></script>
    <![endif]-->
    <script type="text/template" id="devicePropertiesOverviewTemplate">
        <table id="deviceOverview">
            <%
            for(var i=0;i<props.length;i++)
            {
                %>

            <tr>
                <td><%=props[i].name%></td>
                <td><%=props[i].value%><%=props[i].unitName%></td>
            </tr>
            <%
            }
            %>
        </table>
    </script>
</head>