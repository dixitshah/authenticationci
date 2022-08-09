<?php  
$this->load->view('header');
$this->load->view('navbar');
?>


<div class="wrapper fadeInDown">
  <div class="loginform">
    <div id="profilecontent">
      <!-- Tabs Titles -->

      <!-- Icon -->
      <div class="fadeIn first">
        <h2>USER PROFILE</h2>
      </div>

      <!-- Login Form -->
      <form id="registerform" method="post">
        <input type="text" id="registernumber" class="fadeIn second" name="phonenumber" placeholder="e.g. 7738116757">
        

        <select class="fadeIn second select" name="typeuser" id="typeuser">
            <option value=""> Select User Role </option>
            <option value="1"> Admin </option>
            <option value="0"> User </option>
        </select>
        <input type="button" class="fadeIn fourth" value="Update" id="btn_register">
      </form>

    </div>
  </div>
</div>

<?php  
$this->load->view('footer');
?>