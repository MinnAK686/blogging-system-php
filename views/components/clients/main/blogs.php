<?php 

if(!empty($_GET["pageno"])) {
    $pageno = $_GET["pageno"];
}else{
    $pageno = 1;
}

$rawResults = App::get("db")->selectAll("posts")->get();
$totalRecords = count($rawResults);
$record_per_page = 5;
$offset = ($pageno - 1) * $record_per_page;
$total_page = ceil($totalRecords / $record_per_page);

$blogs = App::get("db")->raw("SELECT * FROM posts ORDER BY id DESC LIMIT $offset,$record_per_page")->get();

// $blogs = App::get("db")->raw("SELECT * FROM posts ORDER BY id DESC")->get();


?>

<!-- Main Content-->
<div class="container px-4 px-lg-5">
    <div class="row gx-4 gx-lg-5 justify-content-center">
        <div class="col-md-10 col-lg-8 col-xl-7">
            <?php foreach($blogs as $blog) : ?>
                <!-- Post preview-->
                <div class="post-preview">
                    <a href="/blog-detail?id=<?= $blog->id ?>">
                        <h2 class="post-title"><?= $blog->title ?></h2>
                        <h3 class="post-subtitle"><?= $blog->content ?></h3>
                    </a>
                    <p class="post-meta">
                        Posted by
                        <a href="#!">Admin</a>
                        <?= $blog->created_at ?>
                    </p>
                </div>
                <!-- Divider-->
                <hr class="my-4" />
            <?php endforeach ?>

            <!-- Pagination-->
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-end">
                    <li class="page-item <?php if($pageno <= 1) { echo 'disabled'; } ?>" >
                        <a class="page-link" href="?pageno=<?php if($pageno <= 1) { echo '#'; } else { echo $pageno-1; } ?>" >Previous</a>
                    </li>
                    <?php for($i = 1; $i <= $total_page; $i++) : ?>
                        <li class="page-item">
                            <a class="page-link" href="?pageno=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor ?>
                    <li class="page-item <?php if($pageno >= $total_page ) { echo 'disabled'; } ?>">
                        <a class="page-link" href="?pageno=<?php if($pageno >= $total_page) { echo '#'; } else { echo $pageno+1; } ?>">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>