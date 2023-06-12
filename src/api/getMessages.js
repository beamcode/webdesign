let lastMessages = []; // Variable to store the last received messages
let firstLoad = true;

function getMessages(scroll = false) {
    if (firstLoad === true) {
        firstLoad = false;
        scroll = true;
    }
    const messageContainer = document.getElementById("message-container");

    if (scroll === true) {
        console.log("Scrolling to bottom");
    }

    function displayMessages(messages) {
        // Clear the message container
        messageContainer.innerHTML = "";

        messages.forEach(function (message) {
            var messageHtml = `
            <div class="flex items-start mb-4">
                <div class="w-10 h-10 bg-gray-700 rounded-full"></div>
                    <div class="ml-4 flex-1 ">
                        <div class="w-fit text-sm font-bold rounded">ID: ${message.user_id}</div>
                        <p class="w-full pr-1 rounded overflow-hidden [overflow-wrap:anywhere] break-keep">
                            ${message.message}
                        </p>
                    </div>
                </div>
            </div>
            `;

            messageContainer.insertAdjacentHTML("beforeend", messageHtml);
        });
    }

    fetch("../backend/message.php", {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
        },
    })
        .then(response => {
            if (response.ok) {
                // Reset input fields on success 
                return response.json();
            } else {
                // Throw an error if the response status is not OK
                return response.json().then(error => {
                    throw new Error(error.message);
                });
            }
        })
        .then(messages => {
            if (JSON.stringify(messages) === JSON.stringify(lastMessages)) {
                console.log("Same messages, skipping DOM update");
            } else {
                console.log("New messages, updating DOM");
                lastMessages = messages;
                displayMessages(messages)
            }
        })
        .then(() => {
            if (scroll === true)
                messageContainer.scrollTop = messageContainer.scrollHeight;
        })
        .catch(error => {
            console.error("An error occurred: ", error);
        })
        .finally(function () {
            // Fetch messages again after 300 milliseconds
            setTimeout(function () {
                getMessages(false);
            }, 300);
            if (scroll === true) scroll = false;
        });
}

document.addEventListener("DOMContentLoaded", getMessages);