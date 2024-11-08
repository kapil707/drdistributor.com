<script type="module">
  // Import the functions you need from the SDKs you need
  import { initializeApp } from "https://www.gstatic.com/firebasejs/11.0.1/firebase-app.js";
  import { getAnalytics } from "https://www.gstatic.com/firebasejs/11.0.1/firebase-analytics.js";
  import { getMessaging, getToken, onMessage } from "https://www.gstatic.com/firebasejs/11.0.1/firebase-messaging.js";
  // TODO: Add SDKs for Firebase products that you want to use
  // https://firebase.google.com/docs/web/setup#available-libraries

  // Your web app's Firebase configuration
  // For Firebase JS SDK v7.20.0 and later, measurementId is optional
  const firebaseConfig = {
    apiKey: "AIzaSyBNjq5AvHOoF2FqzU8FJOwNxS_BHYbUoGk",
    authDomain: "drd-noti-fire-base.firebaseapp.com",
    databaseURL: "https://drd-noti-fire-base.firebaseio.com",
    projectId: "drd-noti-fire-base",
    storageBucket: "drd-noti-fire-base.firebasestorage.app",
    messagingSenderId: "504935735685",
    appId: "1:504935735685:web:ff5af385947c4cecf5e4ec",
    measurementId: "G-Z75WL6TX4Q"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);

  // Initialize Firebase Cloud Messaging
  const messaging = getMessaging(app);

  // Request permission for notifications
  Notification.requestPermission()
    .then((permission) => {
      if (permission === "granted") {
        console.log("Notification permission granted.");

        // Get FCM token
        getToken(messaging, { vapidKey: "YOUR_PUBLIC_VAPID_KEY" })
          .then((currentToken) => {
            if (currentToken) {
              console.log("Token received: ", currentToken);
              // Send this token to your server and save it to send notifications later
            } else {
              console.log("No registration token available. Request permission to generate one.");
            }
          })
          .catch((err) => {
            console.log("An error occurred while retrieving token. ", err);
          });
      } else {
        console.log("Notification permission denied.");
      }
    })
    .catch((error) => {
      console.error("Error requesting notification permission", error);
    });

  // Handle incoming messages
  onMessage(messaging, (payload) => {
    console.log("Message received. ", payload);
    // Show notification or update UI here
  });
</script>