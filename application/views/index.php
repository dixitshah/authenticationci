<?php  
$this->load->view('header');
?>
<div class="wrapper fadeInDown">
  <div class="loginform">
    <div id="formContent">
      <!-- Tabs Titles -->

      <!-- Icon -->
      <div class="fadeIn first">
        <h2>USER LOGIN</h2>
      </div>

      <!-- Login Form -->
      <form id="loginfrom" method="post">
        <input type="text" id="login" class="fadeIn second" name="phonenumber" placeholder="e.g. 7738116757">
        
        <input type="button" class="fadeIn fourth" value="Log In" id="btn_login">
      </form>

    </div>
  </div>
  <div class="otpform">
    <div id="formContentone ">
      <!-- Tabs Titles -->

      <!-- Icon -->
      <div class="fadeIn first">
        <h2>USER OTP</h2>
      </div>

      <!-- Login Form -->
      <form id="otpfrom" method="post">
        <input type="text" id="otp" class="fadeIn second" name="otp" placeholder="e.g. 123456">
        
        <input type="button" class="fadeIn fourth" value="Submit" id="btn_otp">
      </form>

    </div>
  </div>
</div>
<?php  
$this->load->view('footer');
?>