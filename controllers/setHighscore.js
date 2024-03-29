function setHighScore(highScore) {
    const formData = new FormData();

    // Append the high score to the FormData object
    formData.append('highScore', highScore.toString());

    // Send the form data to the PHP backend
    let status = fetch("models/highScoreUtils.php", {
        method: "POST",
        body: formData
    })
        .then(async response => {
            if (!response.ok) {
                // Display error message on failure
                const error = await response.json();
                throw new Error(error.message);
            }
            return response.json();
        })
        .then(data => {
            console.log(data)
        })
        .catch(error => {
            console.error("An error occurred: ", error);
        });
    return status;
};

export default setHighScore;