<?php
error_reporting(E_ALL&~E_NOTICE);
session_start();
if(!($_SESSION['haslogin']=='Y'))
    header('location: mylogin.php?from=pageone.php');
?>
<!DOCTYPE html>
<html>
    <head>

    </head>
    <body>
        <p>This is page one</p>
        <form>
            <button type="button" onclick="window.location='pagetwo.php'">Press this to go to page two</button>
        </form>
    </body>
</html>