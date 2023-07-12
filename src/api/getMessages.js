let lastData = []; // Variable to store the last received messages
let firstLoad = true;
function getMessages(scroll = false) {
    const messageContainer = document.getElementById("message-container");
    function displayMessages(data) {
        // Clear the message container
        messageContainer.innerHTML = "";
        data.forEach(function (value) {
            var messageHtml = `
            <div class="flex items-start mb-5">
                <img src="${value.profile_image}" alt="Profile Image" class="w-8 text-sm font-bold rounded-full">
                <div class="ml-4 flex-1 ">
                    <div class="w-fit text-sm mt-[-3px] font-bold rounded">${value.username}</div>
                    <p class="w-full pr-1 text-xs rounded overflow-hidden [overflow-wrap:anywhere] break-keep">
                        ${value.message}
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
        .then(data => {
            if (JSON.stringify(data) === JSON.stringify(lastData)) {
                console.log("Same messages, skipping DOM update");
            } else {
                console.log("New messages, updating DOM");
                lastData = data;
                displayMessages(data)
            }
        })
        .catch(error => {
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
                }, 1000);
            }
        });
}
document.addEventListener("DOMContentLoaded", getMessages);