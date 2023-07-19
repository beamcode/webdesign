function getHighscores() {
	let lastData = [];
	fetch("models/highscores.php", {
		method: "GET",
		headers: {
			"Content-Type": "application/json",
		},
	})
		.then(async response => {
			if (response.ok) {
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
				displayHighscores(data)
			}
		})
		.catch(error => {
			console.error("An error occurred: ", error);
		})
}

function displayHighscores(data) {
	const highscoreContainer = document.getElementById('highscoreContainer');
	highscoreContainer.innerHTML = '';
	data.forEach((value) => {
		const highscoreHtml = `
    <div class="highscore">
        <a href="/profile/${value.username}">
            <img class="profile-picture" src="${value.profile_image}" alt="">
        </a>
        <div class="message-header">
            <a href="/profile/${value.username}" class="username">${value.username}</a>
            <span class="date-time">${value.description}</span>
        </div>
        <div class="score">Score | ${value.highscore}</div>
    </div>
			`;
		highscoreContainer.insertAdjacentHTML('beforeend', highscoreHtml);
	});
}

getHighscores();
