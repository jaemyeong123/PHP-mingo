importScripts('https://www.gstatic.com/firebasejs/4.8.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/4.8.1/firebase-messaging.js');

var firebaseConfig = {
  apiKey: "AAAAHkF0Xww:APA91bHRPxHCNrvy-D578fD7G7SYlPJeTov3O-DHHaytWYNQ57XCpoDotHTAi_LJ7bE3nyLdIHFi6CbRq_aHwG-ZkQStMjwpa4kVRH2kmdWqE-evmFX-fPM0eyyAP8yfL0wSHa8Wx-_J",
  authDomain: "php-mingo.firebaseapp.com",
  projectId: "php-mingo",
  storageBucket: "php-mingo.appspot.com",
  messagingSenderId: "129947164428",
  appId: "1:129947164428:web:47f4a4ebcaa1d2b13a3329",
  measurementId: "G-HKBTF5BGJL"
};

firebase.initializeApp(firebaseConfig);

const messaging = firebase.messaging()

messaging.setBackgroundMessageHandler(function (payload) {
  return self.registration.showNotification(payload)
})
