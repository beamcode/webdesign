<form class="form-youtube" method="POST" onsubmit="setYouTubeLink(event)">
  <?php
    Input(
        name: "youtubeLink",
        id: "searchBar",
        autoComplete: "off",
        type: 'text',
        required: true,
        placeholder: "Paste a youtube link...",
    );
    Input(
      class: "youtube-link-hidden",
      name: "message",
      id: "idkanymore",
      autoComplete: "off",
      type: 'text',
    );
    Button(
      id: "playButton",
      text: "Play",
    );
  ?>
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