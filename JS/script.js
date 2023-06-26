function openRegSite() {
    window.location.href = "registration.php";
}

function openLoginSite() {
    window.location.href = "login.php";
}
function openChangeEvent2Site() {
  window.location.href = "changeevent2.php";
}
function openUserEventsSite() {
  window.location.href = "userevents.php";
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

    return true;
}

function register() {
    const nameInput = form.querySelector('input[user_name="user_name"]');
    const passwordInput = form.querySelector('input[user_password="user_password"]');
    var user_email = document.getElementById("user_email").value;
    var user_phone = document.getElementById("user_phone").value;

    const form = document.querySelector('form');
    


    if(nameInput === "" || passwordInput === "" || user_email === "" || user_phone === ""){
        alert("Error: Please, fill all input!");
      if (nameInput === "") document.getElementById('user_name').style.border = "1px solid red";
      if (passwordInput === "") document.getElementById('user_password').style.border = "1px solid red";
      if (user_email === "") document.getElementById('user_email').style.border = "1px solid red";
      if (user_phone === "") document.getElementById('user_phone').style.border = "1px solid red";
      return false;
    }

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

    return true;
}

function createEvent() {
  const form = document.querySelector('form');
  const nameInput = form.querySelector('input[name="event_name"]');
  const dateInput = form.querySelector('input[name="event_date"]');
  const eventLocation = document.getElementById("event_location").value;
  const eventPrice = document.getElementById("event_price").value;

  if (nameInput.value === "" || dateInput.value === "" || eventLocation === "" || eventPrice === "") {
    alert("Error: Please fill all inputs!");
    if (nameInput.value === "") nameInput.style.border = "1px solid red";
    if (dateInput.value === "") dateInput.style.border = "1px solid red";
    if (eventLocation === "") document.getElementById('event_location').style.border = "1px solid red";
    if (eventPrice === "") document.getElementById('event_price').style.border = "1px solid red";
    return false;
  }

  return true;
}

document.addEventListener('DOMContentLoaded', function() {
  var menuToggle = document.querySelector('.menu-toggle');
  var dropdownMenu = document.querySelector('.dropdown-menu');

  menuToggle.addEventListener('click', function() {
    dropdownMenu.classList.toggle('active');
  });
});