<?php ?>

<?php include "views/partials/admin/header.php" ?>

<div class="container-fluid" >
    <div class="row justify-content-center align-items-center" style="height: 100vh">
        <div class="col-12 col-sm-8 col-md-6 col-lg-5 grid-margin stretch-card">
            <div class="card border">
                <div class="card-body">
                    <h4 class="card-title mt-1 mb-4 text-center">Login to Admin</h4>
                    <div class="my-3">
                        <!-- <h5 class="text-danger"> -->
                            <?php 
                                if($errorMsg) {
                                    echo "<h5 class='text-danger'>$errorMsg</h5>";
                                }
                            ?>
                        <!-- </h5> -->
                    </div>
                    <form action="login" method="POST" class="form-inline">
                        <label class="sr-only" for="inlineFormInputName2">Email Address</label>
                        <input type="text"
                               class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" 
                               placeholder="user@gmail.com"
                               name="email"
                               value="<?php echo $_POST['email'] ?? ''; ?>"
                        >
                        
                        <label class="sr-only" for="inlineFormInputGroupUsername2">Password</label>
                        <input type="password" 
                               class="form-control" id="inlineFormInputGroupUsername2" 
                               placeholder="******"
                               name="password" 
                               value="<?php echo $_POST['password'] ?? ''; ?>"
                        >
                        
                        <button type="submit" class="btn btn-primary mt-4 mb-2">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include "views/partials/admin/footer.php" ?>