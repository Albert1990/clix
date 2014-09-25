<?
$this->load->view('templates/navbar');
$this->load->view('templates/sidebar');
?>
<div class="content">

    <div class="header">

        <h1 class="page-title">Users</h1>
    </div>

    <ul class="breadcrumb">
        <li><a href="index.html">Home</a> <span class="divider">/</span></li>
        <li class="active">Users</li>
    </ul>
<?
$this->load->view($viewName) ;
$this->view('templates/footer');
?>

</div>
</div>
</div>