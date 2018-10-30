var shouldShowReservationAlert = false;
// Initialize Firebase

function createCookie(name,value,days) {
  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 *1000));
    var expires = "; expires=" + date.toGMTString();
  } else {
    var expires = "";
  }
  document.cookie = name + "=" + value + expires + "; path=/";
}

function readCookie(name) {
  var nameEQ = name + "=";
  var ca = document.cookie.split(';');
  for(var i=0;i < ca.length;i++) {
    var c = ca[i];
    while (c.charAt(0)==' ') {
      c = c.substring(1,c.length);
    }
    if (c.indexOf(nameEQ) == 0) {
      return c.substring(nameEQ.length,c.length);
    }
  }
  return null;
}

function eraseCookie(name) {
  createCookie(name,"",-1);
}

firebase.auth().onAuthStateChanged(function(user) {
  //window.user = user; // user is undefined if no user signed in
  if(user) {
    createCookie("loggedIn", "true", 1);
    createCookie("userDisplayName", user.displayName, 1);
    createCookie("userEmail", user.email, 1);
    document.getElementById("signInOutButton").style.backgroundImage = "url("+user.photoURL+")";
    document.getElementById("signInStatusText").innerHTML = "Signed in as " + readCookie("userDisplayName")+".";
    document.getElementById("signInOutButton").innerHTML = "Sign Out";
    document.getElementById("signInOutButton").setAttribute("onClick", "signOutGoogle();");
    if(shouldShowReservationAlert) {
      var amountInput = prompt("Please enter number of reservations for "+readCookie("userDisplayName")+":", "e.g. 1");
      if(amountInput != null) {
        checkAmountInput(amountInput);
      }
    }
  }
  else {
    eraseCookie("loggedIn");
    eraseCookie("userDisplayName");
    eraseCookie("userEmail");
    document.getElementById("signInOutButton").style.backgroundImage = "url(img/change-user.png)";
    document.getElementById("signInStatusText").innerHTML = "Not Signed In.";
    document.getElementById("signInOutButton").innerHTML = "Sign In With Google";
    document.getElementById("signInOutButton").setAttribute("onClick", "javascript: signInGoogle(false);");

  }
});

function signOutGoogle() {
swal("Are you sure you want to Logout?", {
	  buttons: ["Cancel", "Logout"],
	})
	.then((signOut) => {
	  if (signOut) {
		  firebase.auth().signOut().then(function() {
		    swal("You signed out succesfully.", {
		      icon: "success",
        });
        eraseCookie("mealPrice");
        eraseCookie("reservationAmount");
        // Sign-out successful.
        changeReserveButton($("#reserveButton"), $("#cancelReservationButton"), false);  
        changeReserveButton($("#reserveButtonVegan"),$("#cancelReservationButtonVegan"), false);
		  }).catch(function(error) {
		    // An error happened.
		    var errorCode = error.code;
		    var errorMessage = error.message;
		    console.log(errorCode + ": "+errorMessage);
		  });
	  }
	});
}

function signInGoogle() {
  var provider = new firebase.auth.GoogleAuthProvider();
    provider.addScope('profile');
    provider.addScope('email');
    provider.addScope('https://www.googleapis.com/auth/plus.me');

  firebase.auth().signInWithPopup(provider).then(function(result) {
    var firstName = result.additionalUserInfo.profile.given_name;
    firebase.database().ref("Client Reservations/" + result.additionalUserInfo.profile.given_name + " " + result.additionalUserInfo.profile.family_name + "/Beef With Rice").once("value", function(snapshot) {
      if(snapshot.exists()) {
        changeReserveButton($("#reserveButton"), $("#cancelReservationButton"),true);
      }
    });
    firebase.database().ref("Client Reservations/" + result.additionalUserInfo.profile.given_name + " " + result.additionalUserInfo.profile.family_name + "/Falafel With Vegetables").once("value", function(snapshot) {
      if(snapshot.exists()) {
        changeReserveButton($("#reserveButtonVegan"), $("#cancelReservationButtonVegan"),true);
      }
    });
  }).catch(function(error) {
    var errorCode = error.code;
    var errorMessage = error.message;
    console.log(errorCode + ": "+errorMessage);
  });  
}

$(document).ready(function() {
  $('#toggle').on('click', function() {
   $(this).toggleClass('active');
   $('#overlay').toggleClass('open');
  });

  $('.swipes').flickity({
    cellAlign: 'center',
    draggable: true
  });
});