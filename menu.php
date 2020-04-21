<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="<?= \MyApp\classes\PagesHelper::HOME?>">ToDo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item <?= \MyApp\classes\PagesHelper::currentPage() === \MyApp\classes\PagesHelper::HOME ? 'active' : ''?>">
                <a class="nav-link" href="<?= \MyApp\classes\PagesHelper::HOME?>">Home</a>
            </li>
            <?php if(!$auth->isGuest()): ?>
                <li class="nav-item">
                    <form action="" method="post" id="form_logout">
                        <input type="hidden" name="action-logout">
                    </form>

                    <a class="nav-link" href="" onClick="document.getElementById('form_logout').submit(); return false;">Logout(<?= $auth->currentUser()->email?>)</a>
                </li>
            <?php else: ?>
                <li class="nav-item <?= \MyApp\classes\PagesHelper::currentPage() === \MyApp\classes\PagesHelper::LOGIN  ? 'active' : ''?>">
                    <a class="nav-link" href="<?= \MyApp\classes\PagesHelper::LOGIN?>">Login</a>
                </li>
                <li class="nav-item <?= \MyApp\classes\PagesHelper::currentPage() === \MyApp\classes\PagesHelper::REGISTER  ? 'active' : ''?>"">
                <a class="nav-link" href="<?= \MyApp\classes\PagesHelper::REGISTER?>">Register</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
