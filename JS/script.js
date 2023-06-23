
function showLoginPopup() {
    document.getElementById("loginPopup").style.display = "block";
}

function hideLoginPopup() {
    document.getElementById("loginPopup").style.display = "none";
}

function showRegistrationPopup() {
    document.getElementById("registrationPopup").style.display = "block";
}

function hideRegistrationPopup() {
    document.getElementById("registrationPopup").style.display = "none";
}

function showAdminPopup() {
    document.getElementById("adminPopup").style.display = "block";
}

function hideAdminPopup() {
    document.getElementById("adminPopup").style.display = "none";
}

function openRegSite() {
    window.location.href = "registration.php";
}

function openLoginSite() {
    window.location.href = "login.php";
}
function goBack() {
    window.location.href = document.referrer;
  }
function login() {
    var user_name = document.getElementById("user_name").value;
    var user_password = document.getElementById("user_password").value;

    if(user_name === "" || user_password === ""){
        alert("Error: Please, fill all input!");
      if (user_name === "") document.getElementById('user_name').style.border = "1px solid red";
      if (user_password === "") document.getElementById('user_password').style.border = "1px solid red";
      return false;
    }

    hideLoginPopup();
    return true;
}

function register() {
    var user_name = document.getElementById("user_name").value;
    var user_password = document.getElementById("user_password").value;
    var user_email = document.getElementById("user_email").value;
    var user_phone = document.getElementById("user_phone").value;

    const form = document.querySelector('form');
    const nameInput = form.querySelector('input[user_name="user_name"]');
    const passwordInput = form.querySelector('input[user_password="user_password"]');


    if(nameInput === "" || passwordInput === "" || user_email === "" || user_phone === ""){
        alert("Error: Please, fill all input!");
      if (nameInput === "") document.getElementById('user_name').style.border = "1px solid red";
      if (passwordInput === "") document.getElementById('user_password').style.border = "1px solid red";
      if (user_email === "") document.getElementById('user_email').style.border = "1px solid red";
      if (user_phone === "") document.getElementById('user_phone').style.border = "1px solid red";
      return false;
    }

    hideRegistrationPopup();
    return true;

    
    
}

function admin() {
    var admin_name = document.getElementById("admin_name").value;
    var admin_password = document.getElementById("admin_password").value;

    if(admin_name === "" || admin_password === ""){
        alert("Error: Please, fill all input!");
      if (admin_name === "") document.getElementById('admin_name').style.border = "1px solid red";
      if (admin_password === "") document.getElementById('admin_password').style.border = "1px solid red";
      return false;
    }

    hideAdminPopup();
    return true;
}

document.addEventListener('DOMContentLoaded', function() {
    var menuToggle = document.querySelector('.menu-toggle');
    var dropdownMenu = document.querySelector('.dropdown-menu');
  
    menuToggle.addEventListener('click', function() {
      dropdownMenu.classList.toggle('active');
    });
  });
  