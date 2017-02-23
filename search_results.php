<?php 
	//if user is authenticated than we display table with results
    if(isset($_SESSION['name'])){
?>
		<table class="table table-responsive table-bordered">
			<tr>
				<th>Name</th>
				<th>Email</th>
			</tr>
<?php    	
    	$text = $_POST['search_term'];
    	$searchUsers = "SELECT * FROM users WHERE email LIKE '%$text%' OR name LIKE '%$text%'";
    	$searchUsersQuery = mysqli_query($connection, $searchUsers);
    	while ($searchUsersArray = mysqli_fetch_array($searchUsersQuery, MYSQLI_ASSOC)) {
?>
			<tr>
				<td><?php echo $searchUsersArray['name']; ?></td>
				<td><?php echo $searchUsersArray['email']; ?></td>
			</tr>
<?php
    	}
?>
		</table>
<?php 
	//if user is not authenticated than we display login form   	
    } else{
?>
	<div class="alert alert-warning">
	  <strong>Please Login</strong>
	</div>
<?php    	
    	include 'login.php';
    }
?>    