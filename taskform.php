<?php
require("functions.php");
include("header.php");
include("menu.php");

//if(isset($_COOKIE['is_logded_in']) && $_COOKIE['is_logded_in']){
//    header('Location: /');
//}

?>

    <div class="container">
        <form id="task-form" class="login-form" action="" method="post">
            <input type="hidden" name="action-task-form">
            <?php if($parent_id):?>
                <input type="hidden" name="parent_id" value="<?=$parent_id?>">
            <?php endif; ?>
            <?php if($edit_todo && isset($edit_todo['id'])):?>
                <input type="hidden" name="id" value="<?=$edit_todo['id']?>">
            <?php endif; ?>
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter title" value="<?= $edit_todo && isset($edit_todo['title']) && $edit_todo['title'] ? $edit_todo['title']: ''?>">
            </div>
            <div class="form-group">
                    <label for="text">Example textarea</label>
                    <textarea class="form-control" id="text" name="text" rows="3" placeholder="Enter text" ><?= $edit_todo && isset($edit_todo['text']) && $edit_todo['text'] ? $edit_todo['text']: ''?></textarea>

            </div>
            <div class="form-group">
                <label for="datepicker">Date and Time</label>
                <input type="text" id="datepicker" width="276" name="datetime" value="<?= $edit_todo && isset($edit_todo['date']) && $edit_todo['date'] ? substr($edit_todo['date'], 0, -3): ''?>"/>
            </div>

            <div  id="message-block">
                <?php if($form_invalid):?>
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