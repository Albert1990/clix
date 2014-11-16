<html>
<head>
    <title>Nasbat User registration</title>
</head>
<body>
<form action="<?= site_url('User/register') ?>" method="post">
    <table>
        <tr>
            <td>userName:</td>
            <td><input type="text" name="userName"></td>
        </tr>
        <tr>
            <td>email</td>
            <td><input type="email" name="email"></td>
        </tr>
        <tr>
            <td>password</td>
            <td><input type="password" name="password"></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" value="register"></td>
        </tr>
    </table>
</form>
</body>
</html>