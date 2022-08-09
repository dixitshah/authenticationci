<?php 
$userobj = $this->session->userdata('userobj');
if(!isset($userobj) && empty($userobj)){
  return redirect('/');
}
  

 ?>
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="<?php echo base_url(); ?>home">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="<?php echo base_url(); ?>home">Home</a></li>
     
      <?php 

      $typeuser = $this->session->userdata("userobj");
      $typeuser = $typeuser[0]->typeuser;
     
      if($typeuser == 1){
       ?>
      <li><a href="<?php echo base_url(); ?>newregister">User Register</a></li>
    <?php } ?>
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><span class="glyphicon glyphicon-user"></span> <?php echo $this->session->userdata('phonenumber'); ?>    </a></li>
      <li class="logout"><a href="#" ><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>