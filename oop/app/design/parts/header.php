<html>
<head>
    <title>Autopliusas</title>
    <link rel="stylesheet" href="<?php echo BASE_URL_WITHOUT_INDEX_PHP.'css/style.css'; ?>">
</head>
<body>
<header>
    <nav>
        <ul>
            <li>
                <a href="<?php echo BASE_URL ?>">Home Page</a>
            </li>
            <li>
                <a href="<?php echo BASE_URL ?>/catalog/all">All ads</a>
            </li>
            <?php if($this->isUserLoged()): ?>
                <li>
                    <a href="<?php echo BASE_URL ?>/catalog/add">Add New</a>
                </li>
                <li>
                    <a href="<?php echo BASE_URL ?>/user/logout">Logout</a>
                </li>
            <?php else: ?>
            <li>
                <a href="<?php echo BASE_URL ?>/user/login">Login</a>
            </li>
            <li>
                <a href="<?php echo BASE_URL ?>/user/register">Sign Up</a>
            </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
