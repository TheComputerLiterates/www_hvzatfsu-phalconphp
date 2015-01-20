<!-- NOTE: 
		This is unfinished. I will work on it when I wake up. I am trying to 
		convert the table to use dataTable.
 -->
<script>
$(document).ready(function() {
    $('#example').dataTable( {
        "paging":   false,
        "ordering": false,
        "info":     false
    } );
} );
</script>



<h1>Moderator Tools - Users</h1>
<p><b>For editing/viewing user information</b></p><br><br>

<!-- Table Content  NOTE: this could be converted into an element-->
<center>
<table id="example" class="display">
	<caption><h3>Users</h3></caption>
	<thread>
		<tr>
			<th>Role</th>
			<th>HVZID</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Username</th>
			<th>Email</th>
			<th>Created At</th>
			<th>Kills</th>
			<th>Active</th>
		</tr>
	</thread>
	<tbody>
	<?php
		//generate each row
		foreach($userList as $user) {
			echo "<tr>";
			echo "<td style=\"padding: 2px\">".	$user['role']			."</td>";
			echo "<td style=\"padding: 2px\">";
				echo User::userIdToString($user['id'], true);
				echo "</td>";
			echo "<td style=\"padding: 2px\">".	$user['first_name']	."</td>";
			echo "<td style=\"padding: 2px\">".	$user['last_name']	."</td>";
			echo "<td style=\"padding: 2px\">".	$user['username']	."</td>";
			echo "<td style=\"padding: 2px\">".	$user['email']			."</td>";
			echo "<td style=\"padding: 2px\">";
				//sql returns one like 2014-11-07 15:17:29
				$date = date_create_from_format('Y-m-d i:s:u',$user['created_at'],
										new DateTimeZone('America/New_York'));
			
				echo date_format($date,'n/j/y');
				echo "</td>";
			echo "<td style=\"padding: 2px\">".	$user['kills']			."</td>";
			echo "<td style=\"padding: 2px\">";
				echo ($user['active'] ? "yes" : "no");
				echo "</td>";
			
			echo "</tr>";
		}
	?>
	</tbody>
</table>
</center>

