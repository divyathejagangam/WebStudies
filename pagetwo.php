<?php
error_reporting(E_ALL&~E_NOTICE);
session_start();
if(!($_SESSION['haslogin']=='Y'))
    header('location: mylogin.php?from=pagetwo.php');
?>
<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <p>This is page two</p>
        <form>
            <button type="button" onclick="window.location='pageone.php'">Press this to go to page one</button>
        </form>
    </body>
</html>