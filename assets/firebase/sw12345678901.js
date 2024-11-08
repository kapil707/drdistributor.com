// Firebase Messaging Service Worker
self.addEventListener("push", (event) => {
    const notif = event.data.json().notification;
    console.log("Push notification received:", notif.title);
    
    // Clients ko match karne ki koshish karna
    event.waitUntil(
        self.clients.matchAll({ type: "window", includeUncontrolled: true }).then(clients => {
            if (clients && clients.length > 0) {
                clients.forEach(client => {
                    console.log("Sending message to client to open modal");
                    client.postMessage({ action: "openModal", title: notif.title });
                });
            } else {
                // Agar koi client available nahi hai toh notification show karna
                self.registration.showNotification(notif.title, {
                    body: notif.body,
                    icon: notif.image,
                    data: {
                        url: notif.click_action
                    }
                });
            }
        })
    );
});

// Notification click event to open the URL
self.addEventListener("notificationclick", (event) => {
    event.notification.close();
    const url = event.notification.data.url;
    event.waitUntil(
        clients.openWindow(url)
    );
});
