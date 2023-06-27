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

function deleteEvent(eventId) {
  if (confirm("Are you sure you want to delete this event?")) {
      var xhr = new XMLHttpRequest();
      xhr.open("GET", "deleteevent1.php?event_id=" + eventId, true);
      xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
              alert(xhr.responseText);
              location.reload(); // Az oldal frissítése a változtatások érvényesítéséhez
          }
      };
      xhr.send();
  }
}
function updateEvent(eventId) {
    // Gyűjtsük össze az esemény módosításához szükséges adatokat
    var eventName = prompt("Enter event name:");
    var eventDate = prompt("Enter event date:");
    var eventLocation = prompt("Enter event location:");
    var eventPrice = prompt("Enter event price:");

    // Ellenőrizzük, hogy az adatokat megadta-e a felhasználó
    if (eventName && eventDate && eventLocation && eventPrice) {
        // Létrehozunk egy XMLHttpRequest objektumot
        var xhttp = new XMLHttpRequest();

        // Definiáljuk a kérést és a választ kezelő függvényeket
        xhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {
                // A kérés sikeres volt, a választ megjelenítjük
                alert(this.responseText);
                // Frissítjük az oldalt, hogy látható legyen az esemény módosítása
                location.reload();
            }
        };

        // Elküldjük a kérést a `updateEvent.php` fájlnak
        xhttp.open("POST", "updateevent1.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("event_id=" + eventId + "&event_name=" + eventName + "&event_date=" + eventDate + "&event_location=" + eventLocation + "&event_price=" + eventPrice);
    } else {
        alert("Please provide all event details.");
    }
}
function deleteUser(userId) {
  if (confirm("Are you sure you want to delete this user?")) {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
          if (this.readyState === 4 && this.status === 200) {
              alert(this.responseText);
              location.reload();
          }
      };
      xhttp.open("POST", "deleteuser1.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("user_id=" + userId);
  }
}

function updateUser(userId) {
  var username = prompt("Enter the new username:");
  if (username !== null) {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
          if (this.readyState === 4 && this.status === 200) {
              alert(this.responseText);
              location.reload();
          }
      };
      xhttp.open("POST", "updateuser1.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("user_id=" + userId + "&username=" + username);
  }
}