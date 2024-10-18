// Cache version
const CACHE_NAME = 'my-site-cache-v1';
const urlsToCache = [
    '/',
    '/assets/css/styles.css', 
    '/assets/vendors/bootstrap.min.css', 
    '/assets/vendors/iconsax.css', 
    '/assets/vendors/swiper-bundle.css', 
    '/assets/js/script.js',
    '/images/logo.png',
    '/offline.html', // Fallback offline page
];

// Install the Service Worker and cache the necessary files
self.addEventListener('install', (event) => {
    event.waitUntil(
        caches.open(CACHE_NAME).then((cache) => {
            console.log('Opened cache');
            return cache.addAll(urlsToCache);
        })
    );
});

// Activate the Service Worker and remove old caches
self.addEventListener('activate', (event) => {
    const cacheWhitelist = [CACHE_NAME];
    event.waitUntil(
        caches.keys().then((cacheNames) =>
            Promise.all(
                cacheNames.map((cacheName) => {
                    if (!cacheWhitelist.includes(cacheName)) {
                        return caches.delete(cacheName);
                    }
                })
            )
        )
    );
});

// Fetch from the network, falling back to cache if offline
self.addEventListener('fetch', (event) => {
    event.respondWith(
        fetch(event.request).catch(() =>
            caches.match(event.request).then((response) => {
                if (response) {
                    return response;
                }
                // Return a fallback page if resource is not in cache and offline
                return caches.match('/offline.html');
            })
        )
    );
});

// Listening for push notifications
self.addEventListener('push', (event) => {
    const data = event.data.json();
    const title = data.title || 'New Notification';
    const options = {
        body: data.body,
        icon: data.icon || '/assets/images/svg/notification.svg',
        data: {
            url: data.url, // URL to open when notification is clicked
        },
    };

    event.waitUntil(
        self.registration.showNotification(title, options)
    );
});

// Handle notification click
self.addEventListener('notificationclick', (event) => {
    event.notification.close();
    const urlToOpen = event.notification.data.url;

    event.waitUntil(
        clients.matchAll({ type: 'window' }).then((clientList) => {
            for (let i = 0; i < clientList.length; i++) {
                const client = clientList[i];
                if (client.url === urlToOpen && 'focus' in client) {
                    return client.focus();
                }
            }
            if (clients.openWindow) {
                return clients.openWindow(urlToOpen);
            }
        })
    );
});
