<?php
require("functions.php");
include("header.php");
include("menu.php");
?>

    <div class="container">
        <form id="task-form" class="login-form" action="" method="post">
            <input type="hidden" name="action-task-form">

            <input type="hidden" name="parent_id" value="<?=$todoForm->parent_id?>">
            <input type="hidden" name="user_id" value="<?=$user->id?>">

            <?php if($todoForm->id):?>
                <input type="hidden" name="id" value="<?=$todoForm->id?>">
            <?php endif; ?>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="<?= $todoForm->title?>">
            </div>
            <div class="form-group">
                    <label for="text">Text</label>
                    <textarea class="form-control" id="text" name="text" rows="3" placeholder="Enter text" ><?= $todoForm->text?></textarea>

            </div>
            <div class="form-group">
                <label for="datepicker">Date and Time</label>
                <input type="text" id="datepicker" width="276" name="date" value="<?= $todoForm->date?>"/>
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
include("footer.php");
?>