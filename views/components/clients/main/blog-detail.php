<?php 
    if(isset($_GET["id"]) && !empty($_GET["id"])) {
        $id = $_GET["id"];
        $blog = App::get("db")->raw("SELECT * FROM posts WHERE id=$id")->getOne();
    }
?>

<!-- Post Content-->
<article class="mb-4">
    <div class="container px-4 px-lg-5">
        <div class="row gx-4 gx-lg-5 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-7">
                <h2 class="section-heading"><?= $blog->title ?></h2>
                <p><?= $blog->content ?></p>
                <a href="#!"><img class="img-fluid" src="/views/img/<?= $blog->image ?>" alt="..." /></a>
                <!-- <span class="caption text-muted">To go places and do things that have never been done before – that’s what living is all about.</span>
                <p>Space, the final frontier. These are the voyages of the Starship Enterprise. Its five-year mission: to explore strange new worlds, to seek out new life and new civilizations, to boldly go where no man has gone before.</p>
                <p>As I stand out here in the wonders of the unknown at Hadley, I sort of realize there’s a fundamental truth to our nature, Man must explore, and this is exploration at its greatest.</p> -->
                <p>
                    Placeholder text by
                    <a href="http://spaceipsum.com/">Space Ipsum</a>
                    &middot; Images by
                    <a href="https://www.flickr.com/photos/nasacommons/">NASA on The Commons</a>
                </p>
            </div>
        </div>
    </div>
</article>