<html>
<head>
    <title>Autopliusas</title>
    <link rel="stylesheet" href="<?php echo BASE_URL_WITHOUT_INDEX_PHP . 'css/style.css'; ?>">
</head>
<body>
<header>
    <div class="sliding-part">
        Autolauzynas 14% su kodu Valentino14.
    </div>
    <nav>
        <ul>
            <li>
                <a href="<?php echo $this->url(''); ?>">Home Page</a>
            </li>
            <li>
                <a href="<?php echo $this->url('catalog/all') ?>">All ads</a>
            </li>
            <?php if ($this->isUserLoged()): ?>
                <li>
                    <a href="<?php echo $this->url('catalog/add') ?>">Add New</a>
                </li>
                <li>
                    <a href="<?php echo $this->url('user/logout') ?>">Logout</a>
                </li>
            <?php else: ?>
                <li>
                    <a href="<?php echo $this->url('user/login') ?>">Login</a>
                </li>
                <li>
                    <a href="<?php echo $this->url('user/register') ?>">Sign Up</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
