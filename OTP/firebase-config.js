import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.3/firebase-app.js";
import { getAuth } from "https://www.gstatic.com/firebasejs/10.12.3/firebase-auth.js";

const firebaseConfig = {
    apiKey: "AIzaSyDtvy1YRa9jA7eKf7FQ_dtsZ1fxxBPc-bk",
  authDomain: "zenithzone-24.firebaseapp.com",
  projectId: "zenithzone-24",
  storageBucket: "zenithzone-24.firebasestorage.app",
  messagingSenderId: "672203507403",
  appId: "1:672203507403:web:217600a001d0596eb4fd4e",
  measurementId: "G-TKSS20J1MF"
};

const app = initializeApp(firebaseConfig);
const auth = getAuth(app);
export { auth };
