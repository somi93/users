<?php 

class User{

	private $name;
	private $email;
	private $password;

	public function getName()
	{
		return $this->name;
	}
	public function setName($name)
	{
		$this->name = $name;
	}

	public function getEmail()
	{
		return $this->email;
	}
	public function setEmail($email)
	{
		$this->email = $email;
	}

	public function getPassword()
	{
		return $this->password;
	}
	public function setPassword($password)
	{
		$this->password = $password;
	}

	public function register()
	{
		include 'connection.php';
		$response ="";
		$errors = 0;
		$selectUsers = "SELECT * FROM users";
		$selectUsersQuery = mysqli_query($connection, $selectUsers);
		while ($selectUsersArray = mysqli_fetch_array($selectUsersQuery, MYSQLI_ASSOC)) {
			if($selectUsersArray['email']==$this->email){
				$errors++;
				$response = 'Email already exists.';
			}
		}
		if($errors==0) {
			$insert = "INSERT INTO users(name, email, password) VALUES ('$this->name', '$this->email' , '$this->password')";
			$insert_query = mysqli_query($connection, $insert);
			if($insert_query) { $response = "Successfully registered."; }
		}
		return $response;
	}

	public function login()
	{
		include 'connection.php';
		$response ="";
		$selectUser = "SELECT * FROM users WHERE email='$this->email' AND password='$this->password'";
		$selectUserQuery = mysqli_query($connection, $selectUser);
		$userNumber = mysqli_num_rows($selectUserQuery);
		$userArray = mysqli_fetch_array($selectUserQuery, MYSQLI_ASSOC);
		$name = $userArray['name'];
		if($userNumber == 0) {
			$response = "Invalid credentials.";
		} else {
			$response = "Welcome $name";
			$_SESSION['name'] = $name;
			$_SESSION['email'] = $this->email;
		}
		return $response;
	}

	public function logout()
	{
		unset($_SESSION['name']);
		unset($_SESSION['email']);
		@session_destroy();
		return header('location:index.php');
	}

}