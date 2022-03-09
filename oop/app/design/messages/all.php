<div class="wrapper">
    <?php foreach ($this->data['chat'] as $chat): ?>
        <div class="message-box">
            <div class="chat-header">
                <?= $chat['chat_friend']->getName() ?>
                <?= $chat['message']->getDate() ?>
            </div>
            <div class="last-message-body">
                <?= $chat['message']->getMessage() ?>
            </div>
            <div class="read-more">
                <a href="<?= $this->url('message/chat/' . $chat['chat_friend']->getId()) ?>">
                    Chat with <?= $chat['chat_friend']->getName() ?>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

