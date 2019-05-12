
self.addEventListener('push', function(event) {
    console.log('Push Notification received', event.data.text());
  
    var data = {};

    if (event.data) {
      data = JSON.parse(event.data.text());
    }

  
    var options = {
      body: data.notification.body,
      icon: data.notification.icon,
      badge: data.notification.icon
    };
    console.log("options data:",options);
  
    event.waitUntil(
      self.registration.showNotification(data.notification.title, options)
    );
});

var CACHE_STATIC_NAME = 'static-v8';
var CACHE_DYNAMIC_NAME = 'dynamic-v8';

var STATIC_FILES = [
    'http://localhost:8000/manifest.json',
    'http://localhost:8000/assets/logo/SIM_1.png'
];

var DYNAMIC_FILES_NOT_SAFE = [
  'https://ucarecdn.com',
  'https://upload.uploadcare.com',
  'https://simolasocket-nodejs.herokuapp.com',
  'https://www.dropbox.com',
  'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',

];

var DYNAMIC_NOT_SAFE = [ // link save data
  'http://localhost:8000/index.php/User/getViewDashboard',
  'http://localhost:8000/index.php/User/dashboard',
  'http://localhost:8000/index.php/User/getViewDropbox',
  'http://localhost:8000/index.php/User/getViewEditProfil',
  'http://localhost:8000/index.php/User/logout',
  'http://localhost:8000/index.php/DataUser/saveEditProfil',
  'http://localhost:8000/index.php/DataUser/getDevice',
  'http://localhost:8000/index.php/DataUser/offDevice',
  'http://localhost:8000/index.php/DataUser/deleteUser',
  'http://localhost:8000/index.php/DataUser/getDataEditUser',
  'http://localhost:8000/index.php/DataUser/saveEditUser',
  'http://localhost:8000/index.php/DataUser/inputUser',
  'http://localhost:8000/index.php/DataUser/saveEditUser',
  'http://localhost:8000/index.php/DataUser/removeATDevice',
  'http://localhost:8000/index.php/DataUser/editFingerPrint',
  'http://localhost:8000/index.php/DataUser/addFingerPrint',
  'http://localhost:8000/index.php/DataUser/submitUserLogin',
  'http://localhost:8000/index.php/user/getViewDashboard',
  'http://localhost:8000/index.php/user/getViewUser',
  'http://localhost:8000/index.php/user/getViewEditProfil',
  'http://localhost:8000/index.php/user/getViewDropbox',
  'http://localhost:8000/index.php/user/logout',
  'http://localhost:8000/index.php/DataUser/removeFingerPrint'
];

self.addEventListener('install', function (event) {
  console.log('[Service Worker] Installing Service Worker ...', event);
  event.waitUntil(
    caches.open(CACHE_STATIC_NAME)
      .then(function (cache) {
        console.log('[Service Worker] Precaching App Shell');
        cache.addAll(STATIC_FILES);
      })
  )
});

self.addEventListener('activate', function (event) {
  console.log('[Service Worker] Activating Service Worker ....', event);
  event.waitUntil(
    caches.keys()
      .then(function (keyList) {
        return Promise.all(keyList.map(function (key) {
          if (key !== CACHE_STATIC_NAME && key !== CACHE_DYNAMIC_NAME) {
            console.log('[Service Worker] Removing old cache.', key);
            return caches.delete(key);
          }
        }));
      })
  );
  return self.clients.claim();
});

function isInArray(string, array) {
  var cachePath;
  if (string.indexOf(self.origin) === 0) { // request targets domain where we serve the page from (i.e. NOT a CDN)
    console.log('matched ', string);
    cachePath = string.substring(self.origin.length); // take the part of the URL AFTER the domain (e.g. after localhost:8080)
  } else {
    cachePath = string; // store the full request (for CDNs)
  }
  return array.indexOf(cachePath) > -1;
}

function isDynamicArraySave(string, array) {
  return array.indexOf(string) > -1;
}

function isDynamicArray(string,array){
  var pat = /^(https?:\/\/)?(?:www\.)?([^\/]+)/;
  if (pat.test(string)){
    var match = string.match(pat);
    console.log("isDynamicArray: ",match);
    return array.indexOf(match[0]) > -1;
  } else{
    console.log("validation failed");
    return false;
  }
}

self.addEventListener('fetch', function (event) {

  var url = 'https://pwagram-99adf.firebaseio.com/posts';
  if (event.request.url.indexOf(url) > -1) {
    event.respondWith(fetch(event.request)
      .then(function (res) {
        var clonedRes = res.clone();
        clearAllData('posts')
          .then(function () {
            return clonedRes.json();
          })
          .then(function (data) {
            for (var key in data) {
              writeData('posts', data[key])
            }
          });
        return res;
      })
    );
  } else if (isInArray(event.request.url, STATIC_FILES)) {
    event.respondWith(
      caches.match(event.request)
    );
  } else if(isDynamicArray(event.request.url, DYNAMIC_FILES_NOT_SAFE) || isDynamicArraySave(event.request.url, DYNAMIC_NOT_SAFE)){

  } else {
    event.respondWith(
      caches.match(event.request)
        .then(function (response) {
          if (response) {
            return response;
          } else {
            return fetch(event.request)
              .then(function (res) {
                return caches.open(CACHE_DYNAMIC_NAME)
                  .then(function (cache) {
                    // trimCache(CACHE_DYNAMIC_NAME, 3);
                    cache.put(event.request.url, res.clone());
                    return res;
                  })
              })
              .catch(function (err) {
                return caches.open(CACHE_STATIC_NAME)
                  .then(function (cache) {
                    if (event.request.headers.get('accept').includes('text/html')) {
                      return cache.match('/offline.html');
                    }
                  });
              });
          }
        })
    );
  }
});