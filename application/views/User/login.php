<html>
<head>
    <title>Nasbat Login</title>
</head>
<body>
<?= !is_null($msg) ? $msg:''?>
<form action="<?=site_url('/User/signin')?>" method="post">
    <table>
        <tr>
            <td>Email:</td>
            <td><input type="email" name="email"></td>
        </tr>
        <tr>
            <td>password</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="Login"></td>
        </tr>
    </table>
</form>
</body>
</html>