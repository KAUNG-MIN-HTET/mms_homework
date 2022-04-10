<?php require_once "main/head.php" ?>
<?php require_once "core/base.php" ?>
<?php require_once "core/functions.php" ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 col-md-6 mx-auto">
                <h2 class="text-center">Fill Contact</h2>
                <form action="" method="post" enctype="multipart/form-data">

                    <?php if(isset($_POST['submit'])) {
                        if(upload()) {
                            if(uploaddb()) {
                                header("location: index.php");
                            }
                        }
                    } ?>

                    <div class="mb-1">
                        <label for="name">Name : </label>
                        <input type="text" name="name" id="name" value="<?php echo old("name") ?>" class="form-control">
                    </div>

                    <?php if(showError("name")) { ?>
                    <div>
                        <small class="text-danger"><?php echo showError("name") ?></small>
                    </div>
                    <?php } ?>

                    <div class="mb-1">
                        <label for="email">Email : </label>
                        <input type="email" name="email" value="<?php echo old("email") ?>" id="email" class="form-control">
                    </div>

                    <?php if(showError("email")) { ?>
                    <div>
                        <small class="text-danger"><?php echo showError("email") ?></small>
                    </div>
                    <?php } ?>

                    <div class="mb-1">
                        <label for="phone">Phone : </label>
                        <input type="text" name="phone" value="<?php echo old("phone") ?>" id="phone" class="form-control">
                    </div>

                    <?php if(showError("phone")) { ?>
                    <div>
                        <small class="text-danger"><?php echo showError("phone") ?></small>
                    </div>
                    <?php } ?>

                    <div class="mb-1">
                        <label for="photo">Photo : </label>
                        <input type="file" name="photo" id="photo" class="form-control">
                    </div>

                    <?php if(showError("photo")) { ?>
                    <div>
                        <small class="text-danger"><?php echo showError("photo") ?></small>
                    </div>
                    <?php } ?>
                    
                    <div class="d-flex justify-content-between mt-2">
                        <a href="index.php" class="btn btn-primary">
                            Go to contacts
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <button class="btn btn-success ms-auto d-block" name="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php require_once "main/foot.php" ?>