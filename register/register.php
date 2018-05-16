<html>
<head>
    <?php
    include '../functions/functions.php'; ?>
    <link rel="stylesheet" href="registerStyle.css">
</head>
<body>
<div id="content">
    <form action="registering.php" method="post">
        <table class="registerTable">
            <tr>
                <td colspan="4" id="registerTitle"><?php if (isset($_SESSION['error'])) {
                        echo $_SESSION['error'];
                    } else {
                        echo 'Register before entering the site';
                    } ?></td>
            </tr>
            <tr>
                <td class="inputCell">
                    Username: <br>
                    <input class="text" type="text" name="username">
                </td>
            </tr>
            <tr>
                <td class="inputCell">
                    Password: <br>
                    <input class="text" type="password" name="password">
                </td>
            </tr>
            <tr>
                <td class="inputCell">
                    E-mail: <br>
                    <input class="text" type="text" name="email"><br>
                </td>
            </tr>
            <tr>
                <td class="inputCell">
                    First name: <br>
                    <input class="text" type="text" name="first_name">
                </td>
            </tr>
            <tr>
                <td class="inputCell">
                    Surname: <br>
                    <input class="text" type="text" name="surname">
                </td>
            </tr>
            <tr>
                <td class="inputCell">
                    Phone number: <br>
                    <input class="text" type="text" name="phone_number">
                </td>
            </tr>
            <tr>
                <td class="inputCell">
                    Newsletter: <br>
                    <select name="newsletter" class="text">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="inputCell">
                    Rank: <br>
                    <select name="rank" class="text">
                        <option value="0">User</option>
                        <option value="1">Artist</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="inputCell">
                    <input id="submit" class="submit" type="submit" value="Register" name="submit">
                </td>
            </tr>
            <tr>
                <td>
                    <br>
                </td>
            </tr>
            <tr>
                <td class="footerCell">
                    Already got an account? Click <a href="../login/login.php">here</a>
                </td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>