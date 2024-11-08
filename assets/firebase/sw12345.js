// Firebase Messaging Service Worker

self.addEventListener("push", (event) => {

    const notif = event.data.json().notification;

    console.log(notif.title);

    // Send message to main thread
    self.clients.matchAll({ type: "window" }).then(clients => {
        clients.forEach(client => client.postMessage({ action: "broadcast", title: notif.title }));
    });

    event.waitUntil(self.registration.showNotification(notif.title , {
        body: notif.body,
        icon: notif.image,
        data: {
            url: notif.click_action
        }
    }));

});

self.addEventListener("notificationclick", (event) => {

    event.waitUntil(clients.openWindow(event.notification.data.url));

});