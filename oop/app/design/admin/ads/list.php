
<div class="wrapper">
    <table>
        <tr>
            <td>#</td>
            <td>ID</td>
            <td>Title</td>
            <td>Views</td>
            <td>Link</td>
            <td>Author</td>
            <td>Price</td>
            <td>action</td>
        </tr>
        <?php
        /**
         * @var \Model\Ad $ad
         */
        foreach($this->data['ads'] as $ad): ?>
        <tr>
            <td><input type="checkbox"></td>
            <td><?= $ad->getId()?></td>
            <td><?= $ad->getTitle()?></td>
            <td><?= $ad->getViews()?></td>
            <td><?= $ad->getSlug()?></td>
            <td><?= $ad->getUserId()?></td>
            <td><?= $ad->getPrice()?></td>
            <td>
                <a href="<?= $this->url('admin/adedit', $ad->getId())?>">
                    edit
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>