<?php
session_start();

?>

<html>
    <head>
        <title>
            My Kickass Form
        </title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/javascript" src="sexy-form.js"></script>
    </head>
    <body>
        <div id="container">
            <h1>
                Let's get to work shall we?
            </h1>
            <div class="seperator"></div>
            <h2>
                Choose your account type
            </h2>
            <div id="accounts">
                <img class="or-absolute" src="images/or.png" width="41" height="30" alt="or">
                <div class="account">
                    <a class="sky-ninja" href="#LinkURL">Sky Ninja</a>
                </div>
                <div class="account">
                    <a class="kill-yourself" href="#LinkURL">Kill Yourself</a>
                </div>
                <div style="clear:both;"></div>
            </div>
            <div class="support">
                <a href="#LinkURL">Not sure what to choose? Take a guess...</a>
            </div>
            <div id="form">
                <input class="info-bg" type="text" name="email" placeholder="Email"> <input class="info-bg" type="password" name="password" placeholder="Password">
            </div><a class="sign-in" href="logout.php">Logout</a>
        </div>
    </body>
</html>