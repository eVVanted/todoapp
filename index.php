<?php
require_once("functions.php");
require_once("header.php");
require_once("menu.php");
?>



    <main role="main" class="container">

        <?php if(!$auth->isGuest()):?>
            <div class="starter-template">
                <?php if($todoParentId):?>
                    <h1>SubTODOs of the TODO with id <?=$todoParentId?> for <?= $user->email?></h1>
                <?php else: ?>
                    <h1>TODOs for <?= $user->email?></h1>
                <?php endif; ?>

            </div>
        <div class="add-task">
            <?php if($todoParentId):?>
                <a href="<?= \MyApp\classes\PagesHelper::TODO_FORM?>?sub=<?=$todoParentId?>" class="badge badge-primary">New SubTODO</a>
            <?php else: ?>
                <a href="<?= \MyApp\classes\PagesHelper::TODO_FORM?>" class="badge badge-primary">New Task</a>
            <?php endif; ?>

        </div>
            <?php if($error_message):?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span id="message"><strong>Error!</strong> <?= $error_message ?></span>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif;?>
                <?php if($todos): ?>
                <?php foreach($todos as $todo): ?>
                        <div class="list-group">
                            <div class="list-group-item list-group-item-action flex-column align-items-start">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1"><?= $todo->title?></h5>
                                    <small><?= $todo->date?></small>
                                </div>
                                <div class="d-flex">
                                    <p class="mb-1"><?= $todo->text?></p>
                                    <span class="ml-auto">
                                        <?php if($todo->is_done): ?>
                                        <img class="done_icon" src="assets/img/done.png" alt="already done">
                                        <?php else: ?>
                                            <form action="" method="post">
                                                <input type="hidden" name="action-done">
                                                <input type="hidden" name="id" value="<?=$todo->id?>">
                                                <button type="submit" class="btn btn-primary btn-sm ">Done</button>
                                            </form>

                                        <?php endif; ?>
                                        <form action="" method="post">
                                            <input type="hidden" name="action-delete">
                                            <input type="hidden" name="id" value="<?=$todo->id?>">
                                            <button type="submit" class="btn btn-danger btn-sm ">Delete</button>
                                        </form>

                                    </span>

                                </div>
                                <?php if(!$todoParentId):?>
                                <small><a href="?sub=<?= $todo->id?>">SubTODOs</a></small>
                                <?php endif; ?>
                                <small><a href="<?= \MyApp\classes\PagesHelper::TODO_FORM?>?edit=<?=$todo->id?>">Edit</a></small>
                            </div>
                        </div>
                <?php endforeach; ?>
                <?php else: ?>
                    <div class="starter-template">

                        <?php if($todoParentId):?>
                            <h1>There is no SubTODOs of the task with id <?=$todoParentId?> for <?= $user->email?></h1>
                        <?php else: ?>
                            <h1>There is no TODOs for <?= $user->email?></h1>
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
require_once("footer.php");
?>

