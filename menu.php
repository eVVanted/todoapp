<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <a class="navbar-brand" href="/">ToDo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item <?= $uri === '/' ? 'active' : ''?>">
                <a class="nav-link" href="/">Home</a>
            </li>
            <?php if(isset($_COOKIE['is_logded_in']) && $_COOKIE['is_logded_in']): ?>
                <li class="nav-item">
                    <form action="" method="post" id="form_logout">
                        <input type="hidden" name="action-logout">
                    </form>

                    <a class="nav-link" href="" onClick="document.getElementById('form_logout').submit(); return false;">Logout(<?= $_COOKIE['logged_in_user']?>)</a>
                </li>
            <?php else: ?>
                <li class="nav-item <?= $uri === '/login.php' ? 'active' : ''?>">
                    <a class="nav-link" href="/login.php">Login</a>
                </li>
                <li class="nav-item <?= $uri === '/register.php' ? 'active' : ''?>"">
                <a class="nav-link" href="/register.php">Register</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
