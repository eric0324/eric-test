<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <link rel="manifest" href="/manifest.json">
    <title>Laravel FCM sample</title>
</head>
<body>
    <!-- The core Firebase JS SDK is always required and must be listed first -->
    <script src="https://www.gstatic.com/firebasejs/6.0.4/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.0.4/firebase-messaging.js"></script>

    <script>
        // Your web app's Firebase configuration
        var firebaseConfig = {

        };

        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);

        const messaging = firebase.messaging();

        messaging.requestPermission().then(function() {
            console.log('Notification permission granted.');
        }).catch(function(err) {
            console.log('Unable to get permission to notify.', err);
        });

        messaging.getToken().then(function(currentToken) {
            if (currentToken) {
                console.log(currentToken);
            } else {
                console.log('No Instance ID token available. Request permission to generate one.');
            }
        }).catch(function(err) {
            console.log('An error occurred while retrieving token. ', err);
        });

        messaging.onMessage(function(payload) {
            console.log('Message received. ', payload);
        });
    </script>
</body>
</html>
