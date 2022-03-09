<div class="wrapper">
<?php foreach ($this->data['messages'] as $message): ?>
<?php  $class = $message->getSenderId() == $_SESSION['user_id'] ? 'my' :   'him'; ?>
<div class="message-box <?= $class ?>" >
    <div class="message">
        <?= $message->getMessage() ?>
    </div>
    <div class="date">
        <?= $message->getDate() ?>
    </div>
</div>
<?php endforeach; ?>
</div>


