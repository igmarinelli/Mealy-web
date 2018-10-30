<?php 

  switch($_COOKIE['reservationAmount'])
  {
    case 1:
      $button_id = 'A4REMAQEPW7XC';
      break;

    case 2:
      $button_id = 'H4C8L5K8YX6NQ';
      break;

    case 3:
      $button_id = 'QHKJQP79XTHUY';
      break;

    case 4:
      $button_id = 'MXS5FMSBZXZF6';
      break;

    case 5:
      $button_id = '2GBZHYB8C8EYL';
      break;
  }

?>
          <div style="flex: 8">
            <div class="container2">
            <div class="tab"></div>
            <div class="paid"><p>Receipt Paid successfully</p></div>
            <div class="receipt">
            <div class="paper">
              <div class="title">Review</div>
              <div class="date">Pick Up: Nov 13, 1:30pm</div>    
              <table>
                <tbody>
                  <tr><td id="amountMealsText">0 x Beef with Rice</td><td id="priceMealText" class="right">$7</td></tr>
                  <tr></tr>

                  <tr><td colspan="2" class="center"><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" onsubmit="payWithPayPal()">
                  <input type="hidden" name="cmd" value="_s-xclick">
                  <input type="hidden" name="hosted_button_id" value="<?php echo $button_id; ?>">
                  <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                  <img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
                  </form></td></tr>

                  <tr><td colspan="2" class="center"><a style="cursor:pointer" onclick="payWithCash()"><b><i class="fa fa"></i> Pay With Cash</b></a></td></tr>

                  <!--<tr><td colspan="2" class="center"><a><input style="background-image:url(https://i.imgur.com/kPbzDE1.png); background-color:#005587;"type="button" value="Pay Now With Credit Card" onclick="payWithPayPal()"/></a></td></tr>-->
                  <!--<tr><td colspan="2" class="center"><a><input type="button" value="Pay With Cash" onclick="payWithCash()"/></td></a></tr>-->

              </tbody>
              </table>
              <div class="sign center">
                <div class="thankyou">
                Daily Meals at Delicious Price
                </div>
              </div>
            </div>
          </div>
        </div>
    <script>
      function randomString(length, chars) {
        var result = '';
        for (var i = length; i > 0; --i) result += chars[Math.floor(Math.random() * chars.length)];
        return result;
      }

      function saveReservation(customerName, mealName, numberReservations, paymentMethod){
        var today = new Date();
        var day = (today.getDate() < 10) ? '0'+today.getDate() : today.getDate();
        var month = today.getMonth()+1;//(today.getMonth()+1 < 10) ? today.getMonth()+1 : toString(today.getMonth()+1);
        var year = today.getFullYear();
        today = month+'/'+day+'/'+year;
        var dateReservation = today;
        
        var reservationCode = randomString(6, '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');

        //Save JSON of string
        firebase.database().ref("Client Reservations/" + customerName+"/"+ mealName + "/").set({
          reservationCode,
          customerName,
          numberReservations,
          paymentMethod,
          dateReservation
        }).then((data) => {
          createCookie("reservationCode", reservationCode);
          document.location.href="./?ly=success";
        }).catch((error) => {
          console.log("error", error)
        })
      }

      function payWithPayPal() {
        //MUDAR AQUI DPS QUE O IGOR ADICIONAR O PAYPAL
        if(readCookie("userDisplayName") != null) {
          saveReservation(readCookie("userDisplayName"), readCookie("mealName"), parseInt(readCookie("reservationAmount")), "PayPal (paid)");
          //document.location.href="./receipt.html";
        }
        else {
          window.alert("An Error has occured. Please log in and try again.");
          document.location.href="./index.html";
        }  
      }

      function payWithCash() {
        if(readCookie("userDisplayName") != null) {
          saveReservation(readCookie("userDisplayName"), readCookie("mealName"), parseInt(readCookie("reservationAmount")), "Cash (collect)");
          //document.location.href="./receipt.html";
        }
        else {
          window.alert("An Error has occured. Please log in and try again.");
          document.location.href="./index.html";
        }
      }

      window.onload = function() {
        document.getElementById("amountMealsText").innerHTML=readCookie("reservationAmount") + " x " + readCookie("mealName");
        var totalPrice = parseInt(readCookie("mealPrice")) * parseInt(readCookie("reservationAmount"));
        document.getElementById("priceMealText").innerHTML="$" + totalPrice + ".00";
      };

    </script>
    <style type="text/css">
    .paid
    {
     display:none;
      width:300px;
      margin:0 auto;
        background-color:#fff;
      text-align:center;
      padding-top:25px;
      border-radius:0px 0px 10px 10px;
      padding-bottom:25px; 
      color:#00773D;
      line-height:30px;
    }
    .paid p
    {
      background-image:url("http://dc455.4shared.com/download/VILITso0/tsid20130720-183900-9216b81f/check.png");
      background-repeat:no-repeat;
      background-position:left center;
      padding-left:30px;
      width:190px;
      margin:0 auto;
    }
    .container2
    {
      width:350px;
      margin:50px auto;
    }
    .tab
    {
      width:350px;
      margin:0 auto;
      height:10px;
      background-color:#2B2929;
      border-radius:50px
    }
    .receipt
    {
       background-color:#FAFAF9;
      padding-top:20px;
        width:300px;
      height:300px;
      margin:-5px auto;
      border-radius:5px 5px 50px 50px;
      -moz-box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    -webkit-box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }
    .paper
    { 
      border-top:1px dashed #ccc;
      width:96%;
      margin:0 auto;
    }
    .title
    {
      color:#00773D;
      margin-top:20px;
      margin-left:10px;
      font-weight:bold;
      float:left;
      font-size:16px;
      line-height:30px;
    }
    .date
    {
      color:#00773D;
      margin-top:20px;
      margin-right:10px;
      font-weight:lighter;
      float:right;
      font-size:12px;
        line-height:30px;
    }
    table
    {
      clear:both;
      width:95%;
      margin:0 auto;
      color:#5B5B5B;
      font-size:12px;
      padding-top:10px;
      padding-bottom:20px;
      border-bottom:1px dashed #ccc;
    }
    .right
    {
      text-align:right;
    }
    .center
    {
      text-align:center;
      padding-top:20px;
    }
    input[type=button]
    {
      background-color:#00874C;
      outline:none;
      border:1px solid #ccc;
      padding:10px;
      border-radius:5px;
      font-weight:bold;
      color:#fff;
      padding-left:30px;
      background-image:url("https://i.imgur.com/bdjVlWo.png");
      background-repeat:no-repeat;
      background-position:5px center;
    }
    input[type=button]:hover
    {
      -moz-box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    -webkit-box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    box-shadow: 0 10px 30px rgba(0,0,0,0.3);
      cursor:pointer;
      color:#f0f0f0;
    }
    .sign
    {
    text-align:center;
    }
    .thankyou
    {
      line-height:14px;
      font-size:10px;
      margin-top:5px;
      color:#5B5B5B;
      width:100%;
    }

    </style>