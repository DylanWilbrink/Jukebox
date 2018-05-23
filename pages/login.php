<html>
<head>
    <?php require_once '../functions/functions.php'; ?>
    <link rel="stylesheet" href="../style/loginStyle.css">
</head>
<body>
<div id="background">
    <div id="middle">
        <div id="loginDiv">
            <form action="../php/userlogin.php" method="post">
                <table id="loginTable">
                    <tr>
                        <td id="titleRow">
                            <?php
                            //Set error if exists
                            if (isset($_SESSION['loginError'])) {
                                echo $_SESSION['loginError'];
                            } else {
                                echo 'Log in before entering the site.';
                            } ?>
                        </td>
                    </tr>
                    <tr>
                        <td class="textCell">
                            Username: <br>
                            <input class="text" type="text" name="username"><br>
                        </td>
                    </tr>
                    <tr>
                        <td class="textCell">
                            Password: <br>
                            <input class="text" type="password" name="password"><br>
                        </td>
                    </tr>
                    <tr>
                        <td id="submitRow">
                            <input id="submit" class="submit" type="submit" name="submit" value="Log in">
                        </td>
                    </tr>
                    <tr>
                        <td id="footerRow">
                            Don't have an account yet? Register <a href="register.php">here</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
</body>
</html>