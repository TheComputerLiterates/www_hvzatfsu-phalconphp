<div id="header" align="center">
  <!-- Replacing with Facebook logo next to HvZ logo
  <b>{{ link_to("https://www.facebook.com/groups/hvzatfsu/","FSU HvZ on Facebook") }}</b>
  -->

  {{ image("img/banner.png", "class":"img-responsive") }}
  <!--{{ link_to("user/reportKill",image("img/reportKillBtn.png","alt":"Report Kill",  "class":"img-responsive")) }}-->
  
  <b>
  <?php
    //display user id if logged in
    echo "Signed in as ";
    $auth = $this->session->get('auth');
    if($auth) {
      $str_id = User::userIdToString($auth['userId'],true);
      echo  $auth['username'];
      echo " -------- HVZID: " . $str_id;
      echo " -------- ROLE: " . $auth['role'];
    } else {
      echo "Guest"; 
    }
  ?>
  </b>
  
  
</div>