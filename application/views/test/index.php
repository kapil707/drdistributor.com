<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>FCM Push Notifications</title>
</head>
<body>
  <h1>Firebase Cloud Messaging</h1>
  <script type="module">
    // Import scripts
importScripts('https://www.gstatic.com/firebasejs/11.0.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/11.0.1/firebase-messaging.js');
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
firebase.initializeApp(firebaseConfig);

// Initialize Firebase Messaging
const messaging = firebase.messaging();

// Background message handler
messaging.onBackgroundMessage((payload) => {
  console.log("Received background message ", payload);

  // Customize notification
  const notificationTitle = payload.notification.title;
  const notificationOptions = {
    body: payload.notification.body,
    icon: "/firebase-logo.png" // Customize this with your icon
  };

  self.registration.showNotification(notificationTitle, notificationOptions);
});
</script>
</body>
</html>