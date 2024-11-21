<!DOCTYPE html>
<html lang="en">

<head>
    <script>
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.13.1/firebase-app.js";
        import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.13.1/firebase-analytics.js";
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
</head>

<body>
    <form action="" id="resetForm">
        <label for="email">Email</label>
        <input type="email" id="email">
        <br>
        <input type="submit">
        <p id="message"></p>
    </form>
</body>
<script>
    var config = {
    apiKey: "AIzaSyC7owCYLnl7u3WqvqG4ZaHa4R1HUtC9yLs",
    authDomain: "mega-store.com.tr",
    projectId: "msistore-d0d7a",
    storageBucket: "msistore-d0d7a.appspot.com",
    messagingSenderId: "563556686354",
    appId: "1:563556686354:web:d35f64145fa556493556cb",
    email: "info@mega-store.com.tr",
    username: "megastorecom_ameer@mega-store.com.tr",
    password: "em633aUQcdaJQFJ",
    incomingServer: "mega-store.com.tr",
    port: "993",
    outgoingServer: "mega-store.com.tr"
}

    const resetpasswordfrom = document.getElementById("resetForm");
    const message  = document.getElementById("message");

    resetpasswordfrom.addEventListener("submit", function(event){
        event.preventDefault;

        const email=document.getElementById("email").value;
        firebase.auth().sendPasswordResetEmail(email).then(function(){
            message.textContent="A Password reset email has been sent";

        })
        .catch(function(error){
            message.textContent= "error" + error.message;
        });
           
        
    });
    var admin = require("firebase-admin");

var serviceAccount = require("path/to/serviceAccountKey.json");

admin.initializeApp({
  credential: admin.credential.cert(serviceAccount)
});

</script>
</html>