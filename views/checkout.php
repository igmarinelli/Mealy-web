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
              <div class="title">Your Meal</div>
              <div class="date">Pick Up: Nov 1st, 12-2pm</div>    
              <table>
                <tbody>
                  <tr><td id="amountMealsText">1 x Meal</td><td id="priceMealText" class="right">$7.99</td></tr>
                  <tr></tr>

                  <tr><td colspan="2" class="center"><form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" onsubmit="return payWithPayPal();">
                  <input type="hidden" name="cmd" value="_s-xclick">
                  <input type="hidden" name="hosted_button_id" value="<?php echo $button_id; ?>">
                  <input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
                  </form></td></tr>
                  <tr><td colspan="2" class="center"><!--<a style="cursor:pointer; color:#00874C" onclick="return payWithCash();"><b><img src=" https://i.imgur.com/Wf5gRuS.png" width="16" align="top"> Pay With Cash</b></a></td>--></tr>

                  <!--<tr><td colspan="2" class="center"><a><input style="background-image:url(https://i.imgur.com/kPbzDE1.png); background-color:#005587;"type="button" value="Pay Now With Credit Card" onclick="payWithPayPal()"/></a></td></tr>-->
                  <!--<tr><td colspan="2" class="center"><a><input type="button" value="Pay With Cash" onclick="payWithCash()"/></td></a></tr>-->

              </tbody>
              </table>
              <div class="sign center">
                <div class="thankyou">
                Your Meal Will Be Confirmed After Payment
                </div>
              </div>
            </div>
          </div>
        </div>
    <script>

      function payWithPayPal() {
        if(readCookie("userDisplayName") != null) {
          createCookie("paymentMethod", "PayPal (paid)", 1);
          return true;
        }
        else {
          swall("An Error has occured.", "Please login and try again.", "error");
          return false;
        }  
      }

      function payWithCash() {
        if(readCookie("userDisplayName") != null) {
          createCookie("paymentMethod", "Cash (collect)", 1);
          document.location.href="./?ly=success";
          return true;
        }
        else {
          swall("An Error has occured.", "Please login and try again.", "error");
          return false;
        }
      }

      window.onload = function() {
        document.getElementById("amountMealsText").innerHTML=readCookie("reservationAmount") + " x " + readCookie("mealName");
        var totalPrice = parseFloat(readCookie("mealPrice")) * parseInt(readCookie("reservationAmount"));
        document.getElementById("priceMealText").innerHTML="$" + totalPrice;
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
      color:#D45954;
      margin-top:20px;
      margin-left:10px;
      font-weight:bold;
      float:left;
      font-size:16px;
      line-height:30px;
    }
    .date
    {
      color:#D45954;
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