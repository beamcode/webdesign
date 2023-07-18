<div class="messages-area" id="message-container">
    <!-- word-wrap: break-word;
    overflow-wrap: break-word;
    word-break: break-word;

    /* Simulating break-keep behavior */
    hyphens: auto; -->

    <!-- <div class="message">
        <img class="profile-picture" src="https://i.pinimg.com/236x/bb/d4/4b/bbd44b37f18e40a01543b8b4721b1cce.jpg" alt="">
        <div class="message-content">
            <div class="message-header">
                <span class="username">Didier</span>
                <span class="date-time">18/07/2023 02:37</span>
            </div>
            <div class="message-body">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus fermentum dui eu quam molestie mattis. Nulla in erat et dolor pharetra sit.
            </div>
        </div>
    </div> -->
    <!-- <div class="message"></div>
    <div class="message"></div>
    <div class="message"></div>
    <div class="message"></div>
    <div class="message"></div>
    <div class="message"></div>
    <div class="message"></div>
    <div class="message"></div>
    <div class="message"></div>
    <div class="message"></div>
    <div class="message"></div>
    <div class="message"></div>
    <div class="message"></div>
    <div class="message"></div> -->
    <!-- <script src="controllers/getMessages.js"></script> -->
</div>
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