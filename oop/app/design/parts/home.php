<h2>Populiarus sklebimai</h2>
<div class="pop-skelbimas-wrap">
    <?php foreach ($this->data['populars'] as $popAd): ?>
        <div class="box">
            <img width="300" src="<?= $popAd->getImage(); ?>">
            <?= $popAd->getTitle() ?>
            <div class="price">
                <?= $popAd->getPrice(); ?>
            </div>

        </div>
    <?php endforeach; ?>
</div>
<h2>Naujausi sklebimai</h2>
<div class="pop-skelbimas-wrap">
    <?php foreach ($this->data['latest'] as $popAd): ?>
        <div class="box">
            <?= $popAd->getTitle() ?>
        </div>
    <?php endforeach; ?>
</div>
