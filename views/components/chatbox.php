<div class="messages-area" id="message-container"></div>

<form id="ChatForm" method="POST" onsubmit="sendMessage(event);">
    <div class="send-box">
        <?php
        Input(
            name: "message",
            id: "message",
            type: 'text',
            required: true,
            autoComplete: "off",
            placeholder: "Send a message...",
            icon: 'views/icons/send-icon.php',
            buttonType: 'submit'
        )
        ?>
    </div>
</form>

<script src="../../controllers/sendMessage.js"></script>
<script src="../../controllers/getMessages.js"></script>