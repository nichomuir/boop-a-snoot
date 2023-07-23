let signInValidation = function() {
    
    let usernameOrEmail = document.getElementById("username-or-email").value;
    let req1 = document.getElementById("req1");
    if (usernameOrEmail.length < 1) {
        req1.innerHTML = "*";
        req1.style.color = "red";
        return false;
    }
    
    let password = document.getElementById("password").value;
    let req2 = document.getElementById("req2");
    if (password.length < 1) {
        req2.innerHTML = "*";
        req2.style.color = "red";
        return false;
    }
    
};

let createAccountValidation = function() {
    
    let email = document.getElementById("email").value;
    let req1 = document.getElementById("req1");
    if (email.length < 1) {
        req1.innerHTML = "*";
        req1.style.color = "red";
        return false;
    }
    
    let username = document.getElementById("username").value;
    let req2 = document.getElementById("req2");
    if (username.length < 1) {
        req2.innerHTML = "*";
        req2.style.color = "red";
        return false;
    }
    
    let password = document.getElementById("password").value;
    let req3 = document.getElementById("req3");
    if (password.length < 1) {
        req3.innerHTML = "*";
        req3.style.color = "red";
        return false;
    }
    
    let confirmPassword = document.getElementById("confirm-password").value;
    let req4 = document.getElementById("req4");
    if (password != confirmPassword) {
            req4.innerHTML = "*Passwords do not match.";
            req4.style.color = "red";
            return false;
    }
                
};