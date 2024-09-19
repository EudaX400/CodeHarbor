<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Sign Up CodeHarbor</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel='stylesheet' type='text/css' media='screen' href='style.css'>

</head>

<body>
    <?php
    include("signupconect.php");
    ?>
    <img class="ImgBack" src="../PurpleLines.png" />
    <header class="header">
        <div class="menu-icon">
            <img src="../hamburgesa.png" id="hamburgesa" />
        </div>
        <div class="cont-menu active" id="menu">
            <ul>
                <li><img class="userImg" src="../user.png" alt="User Image"></li>
                <li><a class="Home" href="../home/home.html">Home</a></li>
                <li><a class="Preferences" href="#preferences">Preferences</a></li>
                <li><a class="Help" href="#help">Help</a></li>
                <li><a class="Information" href="#information">Information</a></li>
            </ul>
        </div>
        <img class="Image3" src="../user.png" alt="User Image">
    </header>
    <div>
        <img class="logoCH2" src="../logoCH.png" alt="logoCH Image">
    </div>
    <h1 class="CodeHarbor">CodeHarbor</h1>



    <form method="post" action="signupconect.php">
        <section id="signup-section">
            <div class="email-input">
                <h4>Enter your email:</h4>
                <input type="text" name="email" id="email" placeholder="Email" class="input-field">
            </div>
            <div class="user-input">
                <h4>Enter your username:</h4>
                <input type="text" name="user_name" id="username" placeholder="Username" class="input-field">
            </div>
            <div class="password-input">
                <h4>Enter your password:</h4>
                <input type="password" autocomplete="new-password" name="password" id="password" placeholder="Password" class="input-field">
            </div>
            <div class="passwordRep-input">
                <h4>Repeat your password:</h4>
                <input type="password" name="passwordRep" id="passwordRep" placeholder="Repeated password" class="input-field">
            </div>
        </section>

        <section>
            <div class="button-control">
                <button type="submit" name="signUp" id="Signup">Sign Up</button>
            </div>
        </section>
    </form>

    <?php
    session_start();
    if (isset($_SESSION['message'])) {
        echo '<p style="color: red; text-align: center;">' . $_SESSION['message'] . '</p>';
        unset($_SESSION['message']);
    }
    ?>

    <footer class="footer">
        <img class="footer-image" src="../logoCHS.png" alt="Code Harbor Solutions">
        <div class="footer-text">Code Harbor Solutions</div>
    </footer>
    <script src='script.js'></script>
</body>

</html>