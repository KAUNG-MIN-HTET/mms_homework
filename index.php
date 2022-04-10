<?php require_once "main/head.php" ?>
<?php require_once "core/base.php" ?>
<?php require_once "core/functions.php" ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 d-flex justify-content-between">
                <h2 class="fw-bolder">Contact List</h2>
                <a href="upload.php" class="btn btn-success">+Contact</a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Control</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php foreach(contacts() as $c) { ?>
                            <tr style="vertical-align: middle;">
                            <td><?php echo $c['id'] ?></td>
                            <td><img src="store/<?php echo $c['profile'] ?>" class="w-full" alt="<?php echo $c['profile'] ?>"></td>
                            <td><?php echo $c['name'] ?></td>
                            <td><?php echo $c['email'] ?></td>
                            <td><?php echo $c['phone'] ?></td>
                            <td>
                                <a href="update.php?id=<?php echo $c['id'] ?>&name=<?php echo $c['name'] ?>&email=<?php echo $c['email'] ?>&phone=<?php echo $c['phone'] ?>" class="btn btn-warning px-2 py-1"><i class="fas fa-edit"></i></a>
                                <a href="delete.php?id=<?php echo $c['id'] ?>&name=<?php echo $c['profile'] ?>" class="btn btn-danger px-2 py-1"><i class="fas fa-trash-alt"></i></a>
                            </td>
                            <td><?php echo $c['created_at'] ?></td>
                        </tr>
                        <?php } ?>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
<?php require_once "main/foot.php" ?>