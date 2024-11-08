// Firebase Messaging Service Worker

self.addEventListener("push", (event) => {

    const notif = event.data.json().notification;

    console.log(notif.title);

    // Main thread ko message send karna
    self.clients.matchAll({ type: "window" }).then(clients => {
        clients.forEach(client => client.postMessage({ action: "openModal", title: notif.title }));
    });

    event.waitUntil(self.registration.showNotification(notif.title , {
        body: notif.body,
        icon: notif.image,
        data: {
            url: notif.click_action
        }
    }));

});

// Notification par click par URL open karna
self.addEventListener("notificationclick", (event) => {
    event.notification.close();
    const url = event.notification.data.url;
    event.waitUntil(
        clients.openWindow(url)
    );
});