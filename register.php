<?php
require_once("functions.php");
require_once("header.php");
require_once("menu.php");

?>

    <div class="container">
        <form id="register-form" class="login-form" action="" method="post">
            <input type="hidden" name="action-register">
            <div class="form-group">
                <label for="email">Email address</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
            </div>
            <div class="form-group">
                <label for="password2">Repeat your Password</label>
                <input type="password" class="form-control" id="password2" name="password2" placeholder="Repeat your Password" required>
            </div>
            <div  id="message-block">
                <?php if($error_message):?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span id="message"><strong>Error!</strong> <?= $error_message ?></span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif;?>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

<?php
require_once("footer.php");
?>