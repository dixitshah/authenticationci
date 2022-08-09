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
      <form id="profilefrom" method="post">
        <input type="file" id="profilefromimg" class="fadeIn second" name="phonenumber" placeholder="e.g. 7738116757">
        
        <input type="button" class="fadeIn fourth" value="Update" id="btn_profile">
      </form>

    </div>
  </div>
<?php

if(isset($filelist) && !empty($filelist)){

?>
<div class="container">
  <div class="col-sm-12">
          <table class="table" id="table_id">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">FileImage</th>
                
              </tr>
            </thead>
            <tbody>
              <?php 
                $i = 1;
                foreach ($filelist as $key => $value) {
                $name = json_decode($value->name);
                $small_img = $name->small;
               ?>  

              <tr>
                <th scope="row"><?php echo $i; ?></th>
                <td>
                  <?php if(isset($small_img)){?>

                      <img src="<?php echo $small_img; ?>">
                   <?php } ?>   

                </td>
                
              </tr>
              <?php $i++; } ?>
            </tbody>
          </table>    
  </div>
</div>


<?php }?> 
 <?php  
$this->load->view('footer');
?>
