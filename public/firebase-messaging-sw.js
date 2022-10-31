importScripts("https://www.gstatic.com/firebasejs/6.0.4/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/6.0.4/firebase-messaging.js");

// Your web app's Firebase configuration
var firebaseConfig = {

};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging();

messaging.setBackgroundMessageHandler(function(payload) {
    console.log('[firebase-messaging-sw.js] Received background message ', payload);
});
