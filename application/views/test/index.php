<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>FCM Push Notifications</title>
</head>
<body>
  <h1>Firebase Cloud Messaging</h1>
  <script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.14.6/firebase-messaging.js"></script>
<script>
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
  firebase.initializeApp(firebaseConfig);
    const messaging=firebase.messaging();

    function IntitalizeFireBaseMessaging() {
        messaging
            .requestPermission()
            .then(function () {
                console.log("Notification Permission");
                return messaging.getToken();
            })
            .then(function (token) {
                console.log("Token : "+token);

             //end code to save token into database
                //document.getElementById("token").innerHTML=token;
            })
            .catch(function (reason) {
                console.log(reason);
            });
    }

    messaging.onMessage(function (payload) {
        console.log(payload);
        const notificationOption={
            body:payload.notification.body,
            icon:payload.notification.icon
        };

        if(Notification.permission==="granted"){
            var notification=new Notification(payload.notification.title,notificationOption);

            notification.onclick=function (ev) {
                ev.preventDefault();
                window.open(payload.notification.click_action,'_blank');
                notification.close();
            }
        }

    });
    messaging.onTokenRefresh(function () {
        messaging.getToken()
            .then(function (newtoken) {
                console.log("New Token : "+ newtoken);
            })
            .catch(function (reason) {
                console.log(reason);
				//alert(reason);
            })
    })
    IntitalizeFireBaseMessaging();
</script>