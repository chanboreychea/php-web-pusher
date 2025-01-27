<!DOCTYPE html>

<head>
    <title>Pusher Test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher("e5c334e47fb12f7c46ff", {
            cluster: "ap1",
        });

        var channel = pusher.subscribe("my-channel");
        channel.bind("my-event", function(data) {
            //alert(JSON.stringify(data));
            document.querySelector(".list-group").innerHTML += `<li class="list-group-item">${data.email}: ${data.message}</li>`;
            if ("Notification" in window) {
                // Request permission
                Notification.requestPermission().then(function(permission) {
                    if (permission === "granted") {
                        // Create a custom notification with title, body, and icon
                        let notificationOptions = {
                            body: data.message, // Replace with your message
                            icon: "https://example.com/icon.png", // Replace with your icon URL
                            tag: "message-notification", // You can use this to tag similar notifications
                            //vibrate: [200, 100, 200], // Optional vibration pattern for mobile devices
                            requireInteraction: true, // Makes the notification stay until the user interacts
                            renotify: true, // Allows multiple notifications to overwrite previous ones with the same tag
                        };

                        // Display the notification
                        let notification = new Notification(
                            "New Message!",
                            notificationOptions
                        );

                        // Optional: Add an event listener for when the notification is clicked
                        notification.onclick = function() {
                            window.open("https://brms.iauoffsa.us"); // Redirect when the user clicks the notification
                        };
                    } else {
                        console.log("Notification permission denied.");
                    }
                });
            } else {
                console.log("Notifications are not supported by this browser.");
            }
        });
    </script>
</head>

<body>
    <div class="container text-center mt-5">
        <h1 class="text-primary">My Notifications.</h1>
        <ul class="list-group"></ul>
    </div>


</body>