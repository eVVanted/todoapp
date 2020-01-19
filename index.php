<?php
require("functions.php");
include("header.php");
include("menu.php");
?>



    <main role="main" class="container">

        <?php if(isset($_COOKIE['is_logded_in']) && $_COOKIE['is_logded_in']):?>
            <div class="starter-template">
                <?php if($parent_id):?>
                    <h1>SubTasks of the task with id <?=$parent_id?> for <?= $_COOKIE['logged_in_user']?></h1>
                <?php else: ?>
                    <h1>Tasks for <?= $_COOKIE['logged_in_user']?></h1>
                <?php endif; ?>

            </div>
        <div class="add-task">
            <?php if($parent_id):?>
                <a href="/taskform.php?sub=<?=$parent_id?>" class="badge badge-primary">New SubTask</a>
            <?php else: ?>
                <a href="/taskform.php" class="badge badge-primary">New Task</a>
            <?php endif; ?>

        </div>
            <?php if($error):?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span id="message"><strong>Error!</strong> <?= $error_message ?></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif;?>
                <?php if($todos_array): ?>
                <?php foreach($todos_array as $todo): ?>
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1"><?= $todo['title']?></h5>
                                    <small><?= $todo['date']?></small>
                                </div>
                                <div class="d-flex">
                                    <p class="mb-1"><?= $todo['text']?></p>
                                    <span class="ml-auto">
                                        <?php if($todo['done']): ?>
                                        <img class="done_icon" src="assets/img/done.png" alt="already done">
                                        <?php else: ?>
                                            <form action="" method="post">
                                                <input type="hidden" name="action-done">
                                                <input type="hidden" name="id" value="<?=$todo['id']?>">
                                                <button type="submit" class="btn btn-primary btn-sm ">Done</button>
                                            </form>

                                        <?php endif; ?>
                                        <form action="" method="post">
                                            <input type="hidden" name="action-delete">
                                            <input type="hidden" name="id" value="<?=$todo['id']?>">
                                            <button type="submit" class="btn btn-danger btn-sm ">Delete</button>
                                        </form>

                                    </span>

                                </div>
                                <?php if(!$parent_id):?>
                                <small><a href="?sub=<?= $todo['id']?>">SubTasks</a></small>
                                <?php endif; ?>
                                <small><a href="/taskform.php?edit=<?=$todo['id']?>">Edit</a></small>
                            </div>
                        </div>
                <?php endforeach; ?>
                <?php else: ?>
                    <div class="starter-template">

                        <?php if($parent_id):?>
                            <h1>There is no SubTasks of the task with id <?=$parent_id?> for <?= $_COOKIE['logged_in_user']?></h1>
                        <?php else: ?>
                            <h1>There is no TODOs for <?= $_COOKIE['logged_in_user']?></h1>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

        <?php else: ?>
            <div class="starter-template">
                <h1>You need Login or Register</h1>
            </div>
        <?php endif; ?>

    </main><!-- /.container -->

<?php
include("footer.php");
?>

