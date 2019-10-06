<?php
    session_start();

    if($_SESSION['mode'] == 'binary'){
        unset($_SESSION['mode']);
        header("Location:../views/binary.php");
    }
    else{
        unset($_SESSION['mode']);
        header("Location:../views/multiple.php");
    }
?>