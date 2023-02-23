<div class="content-wrapper">
    <div>
        <h1 class="fs-3">Dashboard</h1>
    </div>
    <div class="row"> 
        <div class="col-12 ">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Users Management</h4>
                    <p class="card-description">
                        Administrators
                        <!-- <code>.table-hover</code> -->
                    </p>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Admin Name</th>
                                <th>Email</th>
                                <th>Created At</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($adminInfo as $admin) : ?>
                                <tr>
                                    <td>
                                        <?= $admin->name ?>
                                    </td>
                                    <td>
                                        <?= $admin->email ?>
                                    </td>
                                    <td class="text-danger">
                                        <?= $admin->created_at ?>
                                    </td>
                                    <td>
                                        <label class="badge badge-danger">Pending</label>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>