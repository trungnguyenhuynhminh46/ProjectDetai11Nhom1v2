<?php
function getHeader($mod=""){
    if(empty($mod)){
        $path = "inc/header.php";
    }
    else{
        $path = "inc/header-{$mod}.php";
    }
    require $path;
}

function getFooter($mod=""){
    if(empty($mod)){
        $path = "inc/footer.php";
    }
    else{
        $path = "inc/footer-{$mod}.php";
    }
    require $path;
}

function getSidebar($mod=""){
    if(empty($mod)){
        $path = "inc/sidebar.php";
    }
    else{
        $path = "inc/sidebar-{$mod}.php";
    }
    require $path;
}

?>