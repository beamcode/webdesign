function getHighScore() {
    let data = null;

    // Send the form data to the PHP backend
    data = fetch("models/highScoreSystem.php", {
        method: "GET",
        body: formData
    })
        .then(async response => {
            if (response.ok) {
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

    return data;
};