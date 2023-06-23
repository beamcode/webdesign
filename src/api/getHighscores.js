function InsertHighscores() {
	let lastData = [];
	fetch("../backend/highscores.php", {
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
		// <img src="${value.profile_image}" alt="Profile Image" class="w-10 text-sm font-bold rounded-full">
		const highscoreHtml = `
			<h3>${value.username} - ${value.highscore}</h3>
			`;
		highscoreContainer.insertAdjacentHTML('beforeend', highscoreHtml);
	});
}


InsertHighscores();
