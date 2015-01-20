<!-- No reason to keep this
<h2>Pages</h2>
<ul>
	<li> <?php echo $this->tag->linkTo(array('session', 'Login')); ?> </li>
	<li> <?php echo $this->tag->linkTo(array('register', 'Register')); ?>  </li>
</ul>


<br><br>
-->

<h2>Database Display Test</h2>
<p>

<?php
	echo "<p><b>RETURNED ".count($result)." RESULT(S)</b></p>";
	foreach ($result as $role) {
		echo $role['role_id'] . " ";
		echo $role['name'] . "<br>";
	}
	echo '<pre>';
	print_r($result);
	echo '</pre>';
	
	echo '<pre>';
	print_r($resultData);
	echo '</pre>';
	
	$str_id = User::userIdToString(124);
	echo $str_id."<br>";
	$str_id = User::userIdToString(124567);
	echo $str_id."<br>";
	$str_id = User::userIdToString(12456789);
	echo $str_id."<br>";
	$str_id = User::userIdToString(0);
	echo $str_id."<br>";
	$str_id = User::userIdToString(124,true);
	echo $str_id."<br>";
	$str_id = User::userIdToString(124567,true);
	echo $str_id."<br>";
	$str_id = User::userIdToString(12456789,true);
	echo $str_id."<br>";
	$str_id = User::userIdToString(0,true);
	echo $str_id."<br>";
?>



<?php echo $resultData['info'] ?>

</p>

