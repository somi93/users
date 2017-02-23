<?php 

    if(isset($_SESSION['name'])){
        header('location:index.php');
    } else { 
        if(isset($_POST['login-submit'])) {

            $email = mysqli_real_escape_string($connection, trim($_POST['email']));
            $password = trim($_POST['password']);
            
            $errors = 0;

            if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) {
                $email_error = "Invalid Email";
                $email_border = "border:1px solid#cc5555;";
                $errors++;
            } else {
                $email_error = "";
                $email_border = "border:1px solid#ddd;";
            }

            if(strlen($password)<6) {
                $password_error = "Password too short. At least 6 characters.";
                $password_border = "border:1px solid#cc5555;";
                $errors++;
            } else {
                $password_error = "";
                $password_border = "border:1px solid#ddd;";
            }

            if($errors==0) {
                $password = crypt($password, '$6$rounds=5000$saltystring$'); 
                $user = new User();
                $user->setEmail($email);
                $user->setPassword($password);
                $login = $user->login();
            }
        }
?>
<div class="panel panel-login">
    <div class="panel-heading">
        <div class="row">
            <div class="col-xs-12">
                <a href="#" class="active" id="login-form-link">Login</a>
            </div>
        </div>
        <hr>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <form id="login-form" name="login-form" action="#" method="post" role="form">
                    <div class="form-group">
                        <input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" 
                               style="<?php if(isset($email_border)){ echo $email_border; } ?>">
                        <label id="email-error"><?php if(isset($email_error)){ echo $email_error; } ?></label>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" style="<?php if(isset($password_border)){ echo $password_border; } ?>">
                        <label id="password-error"><?php if(isset($password_error)){ echo $password_error; } ?></label>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row form-error">
                            <label id="login-error"><?php if(isset($login)){ echo $login; } ?></label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php } ?>