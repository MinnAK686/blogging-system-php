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

$result = App::get("db")->raw("SELECT * FROM posts ORDER BY id DESC LIMIT $offset,$record_per_page")->get();


?>

<div class="content-wrapper">
    <div>
        <h1 class="fs-3">Table View</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body"> 
                    <h4 class="card-title">Blog Posts Management</h4>
                    <button class="btn btn-success mt-1 mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo" >Add Post</button>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Content</th>
                                    <th>Image</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; foreach($result as $post) : ?>
                                    <tr>
                                        <td>
                                            <?= $post->id ?>
                                        </td>
                                        <td>
                                            <?= $post->title ?>
                                        </td>
                                        <td class="text-muted">
                                            <?= substr($post->content,0,50) . "..." ?>
                                        </td>
                                        <td>
                                            <div>
                                                <img src="/views/img/<?= $post->image ?>" alt="">
                                            </div>
                                            <?php // echo $post->image ?>
                                        </td>
                                        <td>
                                            <?= $post->created_at ?>
                                        </td>
                                        <td>
                                            <a 
                                                href="/admin/edit/post?id=<?= $post->id ?>" 
                                                class="btn btn-warning"
                                            >
                                                Edit
                                            </a>
                                            <a 
                                                href="/admin/delete/post?id=<?= $post->id ?>" 
                                                class="btn btn-danger"
                                                onclick="return confirm('Are you sure want to delete?')"
                                            >
                                                Delete
                                            </a>
                                        </td>
                                    </tr>
                                <?php $i++; endforeach ?>
                            </tbody>
                            <tfoot>
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
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Post</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/admin/table-view" method="post" enctype="multipart/form-data">
            <div>
                <h5 class="text-danger">
                    <?php if($addPostError) : ?>
                        <?= $addPostError ?>
                    <?php endif ?>
                </h5>
            </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Title</label>
            <input type="text" class="form-control" id="recipient-name" name="title">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Content</label>
            <textarea class="form-control" id="message-text" name="content" ></textarea>
          </div>
          <div class="mb-3">
            <label for="image-name" class="col-form-label">Image</label>
            <input type="file" class="form-control" id="image-name" name="image">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            <input type="submit" class="btn btn-primary" value="Add">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>