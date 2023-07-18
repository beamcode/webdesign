let lastData = []; // Variable to store the last received messages
let firstLoad = true;
function getMessages(scroll = false) {
    const messageContainer = document.getElementById("message-container");
    function displayMessages(data) {
        // Clear the message container
        messageContainer.innerHTML = "";
        data.forEach(function (value) {
            var messageHtml = `
                <div class="message">
                    <img class="profile-picture" src="${value.profile_image}" alt="">
                    <div class="message-content">
                        <div class="message-header">
                            <span class="username">${value.username}</span>
                            <span class="date-time">${value.timestamp}</span>
                        </div>
                        <div class="message-body">
                            <p>${value.message}</p>
                        </div>
                    </div>
                </div>`;
            messageContainer.insertAdjacentHTML("beforeend", messageHtml);
        });
    }

    // Fetch messages from the PHP backend
    fetch("../models/messageSystem.php", {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        },
    })
        .then(async response => {
            if (response.ok) {
                // Reset input fields on success 
                return response.json();
            } else {
                // Throw an error if the response status is not OK
                const error = await response.json();
                throw new Error(error.message);
            }
        })
        .then(data => {
            if (JSON.stringify(data) === JSON.stringify(lastData)) {
                console.log("Same messages, skipping DOM update");
            } else {
                console.log("New messages, updating DOM");
                lastData = data;
                displayMessages(data)
            }
        })
        .catch((error, data) => {
            console.error("An error occurred: ", error);
        })
        .finally(function () {
            // Fetch messages again after 500 milliseconds
            if (firstLoad === true) {
                messageContainer.scrollTop = messageContainer.scrollHeight;
                firstLoad = false;
            }
            if (scroll === true) {
                messageContainer.scrollTop = messageContainer.scrollHeight;
                scroll = false;
                return
            } else {
                setTimeout(function () {
                    getMessages(false);
                }, 1500);
            }
        });
}
document.addEventListener("DOMContentLoaded", getMessages);