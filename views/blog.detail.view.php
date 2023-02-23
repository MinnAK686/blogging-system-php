<?php

if(isset($_GET["id"])) {
    if(empty($_GET["id"])) {
        require "views/404.php";
        die();
    }
    $blogsCount = count(App::get("db")->selectAll("posts")->get());
    if($_GET["id"] > $blogsCount) {
        require "views/404.php";
        die();
    }
}else {
    require "views/404.php";
    die();
}

?>
<?php include "views/partials/clients/header.php" ?>
<?php include "views/components/clients/blog-detail-header.php" ?>

<!-- Main Content -->
<?php include "views/components/clients/main/blog-detail.php" ?>


<?php include "views/partials/clients/footer.php" ?>