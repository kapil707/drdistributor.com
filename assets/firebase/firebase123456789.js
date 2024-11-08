// Import the functions you need from the SDKs you need
import { initializeApp } from "https://www.gstatic.com/firebasejs/11.0.1/firebase-app.js";
import { getMessaging, getToken } from "https://www.gstatic.com/firebasejs/11.0.1/firebase-messaging.js";
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
const messaging = getMessaging(app);

// Register the service worker
if ('serviceWorker' in navigator) {
    navigator.serviceWorker.register("./assets/firebase/sw123456789.js").then(registration => {
        getToken(messaging, {
            serviceWorkerRegistration: registration,
            vapidKey: 'BMK6vJfyFd7fqTP-reghCOTCu4DIFcDzWth46bDnvBH0teZujhO9aFsGwpvzhbSriPyu6c9GDgiZeJtVSKiGMAM'}).then((currentToken) => {
            if (currentToken) {
                console.log("Token is: "+currentToken);
                // Send the token to your server and update the UI if necessary
                // ...
            } else {
                // Show permission request UI
                console.log('No registration token available. Request permission to generate one.');
                // ...
            }
        }).catch((err) => {
            console.log('An error occurred while retrieving token. ', err);
            // ...
        });
    });

    // Service worker se message receive karna
    navigator.serviceWorker.addEventListener("message", (event) => {
        if (event.data.action === "openModal") {
            // Modal open karna
            $('#myModal_broadcast').modal('show');
        }
    });
}