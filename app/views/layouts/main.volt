<!--  All partials are located under ~/app/views/partials -->   

<!--  Partial for for the top navigation bar -->
{{ partial("partials/top-nav-full")}}
  
<!--  Look at http://docs.phalconphp.com/en/latest/reference/views.html to see what I did.
      In short, I moved the basic layout for all pages in general to common.volt   NOTE: Change was made to ControllerBase.php
      Assuming I can, I should be able to make a layout specifically for the admin page and set it under its controller
-->
<div id="content" class="container">
      
  <!-- Partial for for the banner -->
  {{ partial("partials/banner")}}
    
    
  <div id="divider"></div>
  <?php $this->flashSession->output(); ?>
  <center><h3><b>THIS SITE IS UNDER CONSTRUCTION (and does not work!)</b></h3></center>
  
  <?php
  		//set time zone
  		date_default_timezone_set('America/New_York');
  ?>
  <div id="page">{{ content() }}</div>
  
</div>