function sendMessage(event) {
    event.preventDefault();
    const form = event.target;
    const formData = new FormData(event.target);
    // Send the form data to the PHP backend
    fetch("models/messageSystem.php", {
        method: "POST",
        body: formData
    })
        .then(async response => {
            if (response.ok) {
                // Reset input fields on success 
                form.reset();
                getMessages(true);
                return response.json();
            } else {
                // Display error message on failure
                const error = await response.json();
                throw new Error(error.message);
            }
        })
        .then(data => {
            console.log(data)
        })
        .catch(error => {
            console.error("An error occurred: ", error);
        });
};