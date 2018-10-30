<div id="countdown" class="countdown">
  <h1><i>Reserve until Wednesday</i></h1>
  <ul>
    <li><span id="hours"></span>Hours</li>
    <li><span id="minutes"></span>Minutes</li>
    <li><span id="seconds"></span>Seconds</li>
  </ul>
</div>
<br>
  <div class="swipes">
    <div class="carousel-cell">
      <div style="flex: 2">
        <img style="width:300; margin-top:-30px; margin-bottom:-30px" src="./img/meal1.png" />
      </div>
      <div style="flex: 2">
        <div style="color: #fff; font-size: 40; text-align: center">Mealy Thursday Special<br><small style="position: relative; top: -5px;"><s>$12</s></small> $7.99</div>
        <div style="flex-direction: row; justify-content: center"><br>
          <div style="color: #fff; font-size: 20; text-align: center"><b>Pickup Day and Location:</b><br><a id="dateLocStand" href="https://www.google.com/maps/place/Lower+Sproul+Plaza/@37.8691297,-122.2605928,19.23z/data=!4m8!1m2!2m1!1ssproul+plaza!3m4!1s0x80857c26064003d7:0x103b6908aeacf56a!8m2!3d37.8691454!4d-122.2602313" target=_blank><i class="fa fa-map-marker"></i> Sproul Plaza, Nov 1st @ 12-2:00 p.m.</a></div><br>
        </div>
      </div>
      <div style="flex: 2">
        <a onclick="checkLogin()" id="reserveButton" class="bt1"><button>Reserve Now!</button></a>
            <div style="flex-direction: row; justify-content: center">
              <a ><button disabled class="astext" onclick="cancelReservation(false)" id="cancelReservationButton" style="margin-top:25; color: #00f; font-size: 15;">Cancel Reservation</button></a>
            </div>
      </div>
    </div>
    <div class="carousel-cell">
      <img style="width:300; margin-top:-30px; margin-bottom:-30px" src="./img/meal1.png" />

          <div style="flex: 2">
            <a><button onclick="checkLogin()" id="reserveButtonVegan" style="font-size: 25; font-family:'Times New Roman', Times, serif">Reserve Now! (Vegan)</button></a>
            <div style="flex-direction: row; justify-content: center">
              <a ><button disabled class="astext" onclick="cancelReservation(true)" id="cancelReservationButtonVegan" style="margin-top:25; color: #00f; font-size: 15;">Cancel Reservation</button></a>
            </div>
          </div>

    </div>
  </div>

  <script>

  const second = 1000,
        minute = second * 60,
        hour = minute * 60,
        day = hour * 24;

  let countDown = new Date('Oct 31, 2018 18:00:00').getTime(),
      x = setInterval(function() {

        let now = new Date().getTime(),
            distance = countDown - now;

          document.getElementById('hours').innerText = Math.floor(distance / (hour)),
          document.getElementById('minutes').innerText = Math.floor((distance % (hour)) / (minute)),
          document.getElementById('seconds').innerText = Math.floor((distance % (minute)) / second);
        
        //do something later when date is reached
        //if (distance < 0) {
        //  clearInterval(x);
        //  'IT'S MY BIRTHDAY!;
        //}

      }, second);

      reservationDate = "10/11";

      function callReservationPrompt(mealName) {
        swal({
          title: 'Please enter how many Meals:',
          content: {
            element: "input",
            attributes: {
              placeholder: "Type a number",
              type: "number",
              max: "5",
            },
          },
          icon: "success",
          button: {
            text: "Next",
          },
        })
        .then(amountInput => {
          if (!amountInput) throw null;
         
          if(amountInput != null) {
            checkAmountInput(amountInput, mealName);
          }
        })
      }

      function checkLogin() {
        if(readCookie("userDisplayName") == null) {
          eraseCookie("loggedIn");  
        }
        if(readCookie("loggedIn") == null || readCookie("loggedIn") == false) {
          signInGoogle();
        }
        else {
          var mealName = (window.event.target.id == "reserveButton") ? "Beef With Rice" : "Falafel With Vegetables";
          callReservationPrompt(mealName);
        }
      }

      function checkAmountInput(input, mealName) {
        if(!isNaN(parseInt(input)) && parseInt(input) > 0 && parseInt(input) <= 5) {
          //Redirect to Checkout Screen
          //Save to firebase!!!!
          createCookie("reservationAmount", input, 1);
          createCookie("mealPrice", 7, 1);
          createCookie("mealName", mealName, 1);
          document.location.href = "./?ly=checkout";
        }

        else {
          swal({text: "Please enter a valid number (MAXIMUM OF 5)", icon: "error"}).then(results => {callReservationPrompt(mealName)});
        }

      }
      window.onload = function() {
        //document.getElementById("dateLocStand").innerText = "Sproul Plaza, " + reservationDate + " @ 12:00 P.M " ;
        $("#cancelReservationButton").fadeOut('fast');
        $("#cancelReservationButtonVegan").fadeOut('fast');
        if(readCookie("loggedIn") == "true") {
          firebase.database().ref("Client Reservations/" + readCookie("userDisplayName") + "/Beef With Rice").once("value", function(snapshot) {
            if(snapshot.exists()) {
              changeReserveButton($("#reserveButton"), $("#cancelReservationButton"), true);
            }
          });
          firebase.database().ref("Client Reservations/" + readCookie("userDisplayName") + "/Falafel With Vegetables").once("value", function(snapshot) {
            if(snapshot.exists()) {
              changeReserveButton($("#reserveButtonVegan"), $("#cancelReservationButtonVegan"), true);
            }
          });
        }
      };

      function cancelReservation(isVegan) {
        var mealName = isVegan ? "Falafel With Vegetables" : "Beef With Rice";
        firebase.database().ref("Client Reservations/" + readCookie("userDisplayName") + "/" + mealName).once("value", function(snapshot) {
            if(snapshot.exists() && snapshot.val().paymentMethod == "Cash (collect)") {
              var confirm = window.confirm("Are you sure you want to cancel your current reservation?");
              if (confirm) {
                firebase.database().ref("Client Reservations/" + readCookie("userDisplayName") + "/" + mealName).remove();
                alert("Your reservation was cancelled.");
                if(mealName == "Beef With Rice") {
                  changeReserveButton($("#reserveButton"), $("#cancelReservationButton"), false);  
                }
                else {
                  changeReserveButton($("#reserveButtonVegan"), $("#cancelReservationButtonVegan"), false);  
                }
              }
            }
            else {
              alert("You chose PayPal as the payment method. Please contact us if you really wish to cancel your reservation.");
            }
          });
      }

      function changeReserveButton(reserveButton, cancelButton, changeToDetails) {
        if(changeToDetails) {
          reserveButton.fadeOut('fast');
          //$("#reserveButton").fadeOut('fast');
          cancelButton.fadeOut('fast');
          var firstName = readCookie("userDisplayName").split(' ')[0];
          reserveButton[0].innerHTML =  firstName+ "'s Reservation (click for details):<br/><small><i>Your reservation will be ready for pickup in 00:00:00" + "</i></small>";
          reserveButton[0].onclick = function() { displayDetails("Beef With Rice")};   
          cancelButton[0].disabled=false;

          wait(1000);
          reserveButton.fadeIn('fast');
          //$("#reserveButton").fadeIn('fast');
          cancelButton.fadeIn('fast');
          setTime(reserveButton);
        }
        else {
          reserveButton.fadeOut('fast');
          cancelButton.fadeOut('fast');
          reserveButton[0].innerHTML =  "Reserve Now!";
          reserveButton[0].onclick = checkLogin;  
          cancelButton[0].disabled=true;
          wait(1000);
          reserveButton.fadeIn('fast');
        }
      }

      function displayDetails(mealName) {
        firebase.database().ref("Client Reservations/" + readCookie("userDisplayName") +"/" + mealName).once("value", function(snapshot) {
            if(snapshot.exists()) {
              let dateReservation = snapshot.val().dateReservation;
              let reservationAmount = snapshot.val().numberReservations;
              let paymentMethod = snapshot.val().paymentMethod;
              window.alert("Reservation Details:\n\nDate of Reservation: " +  dateReservation+ "\nNumber of meals Requested: " + reservationAmount + "\nPayment Method: "+ paymentMethod)
            }
          });
      }

      function wait(ms){
        var start = new Date().getTime();
        var end = start;
        while(end < start + ms) {
          end = new Date().getTime();
        }
      }

      function setTime(reserveButton) {
        var today = new Date();
        var reservationDay = reservationDate.split('/')[0];
        var reservationMonth = reservationDate.split('/')[1];
        var h = today.getHours();
        var m = today.getMinutes();
        var s = today.getSeconds();
        m = checkTime(m);
        s = checkTime(s);
        var firstName = readCookie("userDisplayName").split(' ')[0];
        if(reserveButton[0].innerHTML!="Reserve Now!" && reserveButton[0].innerHTML!="Reserve Now! (Vegan)")
          reserveButton[0].innerHTML =  firstName+ "'s Reservation (click for details):<br/><small>Your reservation will be ready for pickup in " + h + ":" + m + ":" + s + "</small>";
        h + ":" + m + ":" + s;
        var t = setTimeout(function() {
          setTime(reserveButton);
        }, 500);
      }
      function checkTime(i) {
        if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
          return i;
      }

  </script>
