<?php $ad = $this->data['ad']; ?>
<div class="wrapper">
    <div class="post-content">
        <h1><?= $ad->getTitle(); ?></h1>
        <?php if ($this->isUserLoged()): ?>
            <form action="<?= $this->url('catalog/favorite') ?>" method="POST">
                <?php $label = $this->data['saved_ad'] == null ? 'Isiminti' : 'Pamirsti'; ?>
                <input type="hidden" value="<?= $ad->getId(); ?>" name="ad_id">
                <input type="submit" value="<?= $label ?>" name="save">
            </form>
        <?php endif; ?>
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
    <span>Skelbimo ivertinimas(<?= $this->data['rating_count'] ?>):</span>
    <?= $this->data['ad_rating'] ?>
    <?php if ($this->isUserLoged()): ?>
        <a href="<?= $this->url('message/chat/' . $ad->getUserId()) ?>">
            Rasyti zinute savininkui
        </a>
        <form action="<?= $this->url('catalog/rate') ?>" method="POST">
            <input type="hidden" name="ad_id" value="<?= $ad->getId(); ?>">
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <input type="radio"
                    <?php if ($this->data['rated'] && $this->data['user_rate'] == $i): ?>
                        checked
                    <?php endif; ?>
                       value="<?= $i ?>" name="rate">
            <?php endfor; ?>
            <br>
            <input type="submit" value="Ragte this garbage!" name="rate_submit">
        </form>
        <div class="comments-wrapper">

            <!--   Cia turetu buti tikrinama ar useris prisijungias ir tada turetume rodyti sia forma     -->
            <?= $this->data['comment_form'] ?>
        </div>
    <?php endif; ?>

</div>