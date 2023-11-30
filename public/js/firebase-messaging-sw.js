/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************************!*\
  !*** ./public/firebase-messaging-sw.js ***!
  \*****************************************/
importScripts("https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js");
importScripts("https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js");
var firebaseConfig = {
  apiKey: "AIzaSyDAklL5MqFiqfVhmW9KkQjfke4qwOZCAV4",
  authDomain: "laravel-eb094.firebaseapp.com",
  projectId: "laravel-eb094",
  storageBucket: "laravel-eb094.appspot.com",
  messagingSenderId: "803826287274",
  appId: "1:803826287274:web:f1890d9ff2e36e8149c6d3"
};
firebase.initializeApp(firebaseConfig);
var messaging = firebase.messaging();
messaging.setBackgroundMessageHandler(function (payload) {
  var notificationTitle = "Notificação em segundo plano";
  var notificationOptions = {
    body: payload.notification.body
  };
  return self.registration.showNotification(notificationTitle, notificationOptions);
});
/******/ })()
;