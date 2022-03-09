<?php $ad = $this->data['ad']; ?>
<div class="wrapper">
    <div class="post-content">
        <h1><?= $ad->getTitle(); ?></h1>
        <div class="image-wrapper">
            <img src="<?= $ad->getImage() ?>">
        </div>
        <div id="price" class="price">
            <?= $ad->getPrice(); ?>
        </div>
        <div class="details">
            <p>
                <?= $ad->getDescription(); ?>
            </p>
        </div>
    </div>
        <?php if($this->isUserLoged()): ?>
        <a href="<?= $this->url('message/chat/'.$ad->getUserId()) ?>">
            Rasyti zinute savininkui
        </a>
        <?php endif; ?>
    <div class="comments-wrapper">

<!--   Cia turetu buti tikrinama ar useris prisijungias ir tada turetume rodyti sia forma     -->
        <?= $this->data['comment_form'] ?>
    </div>
</div>