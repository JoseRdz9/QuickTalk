// Script para login
const loginForm = document.querySelector(".login form"),
loginContinueBtn = loginForm.querySelector("#signin"),
loginErrorText = loginForm.querySelector(".error-text");

loginForm.onsubmit = (e)=>{
    e.preventDefault();
}

loginContinueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/login.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data === "success"){
                    location.href = "QuickTalk.php";
                }else{
                    loginErrorText.style.display = "block";
                    loginErrorText.textContent = data;
                }
            }
        }
    }
    let loginFormData = new FormData(loginForm);
    xhr.send(loginFormData);
}

// Script para signup
const signupForm = document.querySelector(".signup form"),
signupContinueBtn = signupForm.querySelector("#signup"),
signupErrorText = signupForm.querySelector(".error-text");

signupForm.onsubmit = (e)=>{
    e.preventDefault();
}

signupContinueBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/signup.php", true);
    xhr.onload = ()=>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data === "success"){
                    location.href="QuickTalk.php";
                }else{
                    signupErrorText.style.display = "block";
                    signupErrorText.textContent = data;
                }
            }
        }
    }
    let formData = new FormData(signupForm);
    xhr.send(formData);
}
