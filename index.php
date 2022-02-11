<?php
// This file pertains to the following github issues:

// TODO: #3 check session logged in, redirect to login.php
// TODO: #4 render dashboard tiles dynamically
// TODO: #5 dashboard tiles actions trigger calls to ewelink-proxy.php
// TODO: #6 handle response from ewelink-proxy.php



 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <meta name="description" content="Sync Access">
  <title>Sync Access™</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>

<body>
  <h1>Welcome</h1>

  <div class="wrapper">
    <div class="dashboard">
      <div class="tile form">
        <form id="frmCallEwelinkProxy" class="" action="" method="post" onsubmit="return ewelinkProxy()">

          <div class="form-section">
            <div class="form-element">
              <div class="heading">
                eWeLink Credentials:
              </div>
            </div>
            <div class="form-element">
              <label for="email">Email:</label> <input type="text" name="email" value="" autocomplete="email">
            </div>
            <div class="form-element">
              <label for="password">Password:</label> <input type="password" name="password" value="" autocomplete="password">
            </div>
            <div class="form-element">
              <label for="region">Region:</label>
              <select class="" name="region">
                <option value="eu" selected>eu</option>
                <option value="us">us</option>
                <option value="cn">cn</option>
              </select>
            </div>
          </div>
          <div class="form-section">
            <div class="form-element">
              <div class="heading">
                Device:
              </div>
            </div>

            <div class="form-element">
              <label for="deviceId">Device ID:</label> <input type="text" name="deviceId" value="" autocomplete="">

            </div>
            <div class="form-element">
              <label for="action">Action:</label> <input type="text" name="action" value="" autocomplete="">
            </div>
          </div>
          <div class="form-element center">
            <button type="submit" name="button">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="wrapper">

    <div class="dashboard">
      <div class="tile button" onclick="btnOpenGate_onclick(this)">
        Open Gate 1
      </div>
    </div>

  </div>



  <!-- <button type="button" name="button" onclick="btnOpenGate_onclick();">Open Gate</button>-->
  <script type="text/javascript">
    function ewelinkProxy(email, password, region, deviceId, action) {
      fetch('ewelink-proxy.php', {
          method: 'POST',
          headers: {
            'Accept': 'application/json, text/plain, */*',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            "auth": {
              "email": document.querySelector("#frmCallEwelinkProxy [name='email']").value,
              "password": document.querySelector("#frmCallEwelinkProxy [name='password']").value,
              "region": document.querySelector("#frmCallEwelinkProxy [name='region']").value
            },
            "deviceId": document.querySelector("#frmCallEwelinkProxy [name='deviceId']").value,
            "action": document.querySelector("#frmCallEwelinkProxy [name='action']").value
          })
        })
        // .then(res => console.log(res));
        .then(res => res.json())
        .then(res => console.log(res));
      return false;
    }

    function btnOpenGate_onclick(e) {
      disable_button_await_response(e);
      let key = "nnD62omYXHK1So0xyZEEj73Y0HIiH7WbOItRNY_kIOe";
      let event = "open_gate";
      fetch('ewelink-proxy.php', {
          method: 'POST',
          headers: {
            'Accept': 'application/json, text/plain, */*',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            "event": event
          })
        })
        .then(res => res.json())
        .then(res => console.log(res))
        .finally(() => {
          enable_button_after_response(e);
        });
    }

    function disable_button_await_response(e) {
      e.classList.add("disabled");
    }

    function enable_button_after_response(e) {
      e.classList.remove("disabled");
    }
  </script>
</body>

</html>
