<form style="width: 100%; margin: 10px 0 20px 0; display: flex; justify-content: center; align-items: center; gap: 10px;" method="POST" onsubmit="setYouTubeLink(event)">
  <h1 style="font-size: 20px; white-space: nowrap;">Shared Youtube Player</h1>
  <input name="youtubeLink" id="searchBar" autocomplete="off" required type="text" style="width: calc(100% - 70px); height: 40px; border-radius: 8px; border: 1px solid #ccc; padding: 5px;">
  <input name="message" id="idkanymore" autocomplete="off" type="text" style="display: none;" value="">
  <button id="playButton" type='text' placeholder="Paste a youtube link..." style="margin-left: 10px; height: 40px; border-radius: 8px; background-color: #4CAF50; color: white; border: none; padding: 0 20px;">Play</button>
</form>
<iframe id="videoFrame" width="100%" height="80%" style="border-radius: 8px;" src="" frameborder="0" allowfullscreen></iframe>

<script>
  function setYouTubeLink(event) {
    event.preventDefault(); // Prevent the default form submission behavior
    document.getElementById("idkanymore").value = "UPDATED VIDEO TO: ㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤㅤ" + document.getElementById("searchBar").value;
    const formData = new FormData(event.target);

    fetch("models/youtubeLink.php", {
        method: "POST",
        body: formData
      })
      .then(response => {
        if (!response.ok) {
          throw new Error("Error setting YouTube link");
        }
        sendMessage(event);
        return response.json();
      })
      .then(data => {
        if (data.status !== "success")
          console.log(data.message);
      })
      .catch(error => {
        console.error('Error setting YouTube link:', error);
      });
  }

  function checkYouTubeLink() {
    fetch("models/youtubeLink.php")
      .then(response => {
        if (!response.ok) {
          throw new Error("Error retrieving YouTube link");
        }
        return response.json();
      })
      .then(data => {
        if (data.status === "success" || data.youtubeLink !== "") {
          if (("https://www.youtube.com/embed/" + data.youtubeLink + "?&autoplay=1&mute=1") !== document.getElementById("videoFrame").src)
            document.getElementById("videoFrame").src = "https://www.youtube.com/embed/" + data.youtubeLink + "?&autoplay=1&mute=1";
        }
      })
      .catch(error => {
        console.error('Error retrieving YouTube link:', error);
      });
  }
  // Function to unmute the video without user interaction

  checkYouTubeLink(); // Check the YouTube link initially

  setInterval(checkYouTubeLink, 1000); // Check the YouTube link every second
</script>
<script src="controllers/sendMessage.js"></script>