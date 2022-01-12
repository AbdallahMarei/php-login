console.log("test")
let registerBtn = document.getElementById("register-btn");

let registerEmail = document.getElementById("register-email");
let registerPassword = document.getElementById("register-pswd");
let confirmPassword = document.getElementById("confirm-pswd");


registerEmail.addEventListener("change", function(e){
    console.log("byw")
    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(e.target.value)){
        console.log("hello");
    } else {
        console.log("hiii")
    }
})
