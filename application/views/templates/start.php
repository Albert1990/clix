<!DOCTYPE html>
<html lang="en">
<?php
$this->view('templates/header');
?>
<body class="">
<?php
$this->view('templates/main');
?>

<script src="<?=URL.'lib/bootstrap/js/bootstrap.js'?>"></script>
<script type="text/javascript">
    $("[rel=tooltip]").tooltip();
    $(function() {
        $('.demo-cancel-click').click(function(){return false;});
    });
</script>

</body>
</html>