function sendMessage(event) {
    event.preventDefault();

    const form = event.target;
    const formData = new FormData(event.target);

    // Send the form data to the PHP backend
    fetch("../backend/message.php", {
        method: "POST",
        body: formData
    })
        .then(response => {
            if (response.ok) {
                // Reset input fields on success 
                form.reset();
                getMessages(true);
            } else {
                // Display error message on failure
                return response.json().then(error => {
                    throw new Error(error.message);
                });
            }
        })
        .catch(error => {
            console.error("An error occurred: ", error);
        });
};