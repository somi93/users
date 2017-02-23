<?php 

    if(isset($_SESSION['name'])){
        header('location:index.php');
    } else {
        if(isset($_POST['register-submit'])) {

            $name = trim($_POST['name']);
            $email = mysqli_real_escape_string($connection, trim($_POST['email']));
            $password = trim($_POST['password']);
            $confirm_password = trim($_POST['confirm-password']);  

            $errors = 0;

            if(!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email)) {
                $email_error = "Invalid Email";
                $email_border = "border:1px solid#cc5555;";
                $errors++;
            } else {
                $email_error = "";
                $email_border = "border:1px solid#ddd;";
            }

            if(!preg_match("/^[A-Z\Č\Ć\Š\Đ\Ž]{1}[a-z\č\ć\š\đ\ž]{2,22}$/", $name)) {
                $name_error = "Invalid Name";
                $name_border = "border:1px solid#cc5555;";
                $errors++;
            } else {
                $name_error = "";
                $name_border = "border:1px solid#ddd;";
            }

            if(strlen($password)<6) {
                $password_error = "Password too short. At least 6 characters.";
                $password_border = "border:1px solid#cc5555;";
                $errors++;
            } else {
                $password_error = "";
                $password_border = "border:1px solid#ddd;";
            }

            if($password != $confirm_password) {
                $confirm_password_error = "Passwords do not match";
                $confirm_password_border = "border:1px solid#cc5555;";
                $errors++;
            } else {
                $confirm_password_error = "";
                $confirm_password_border = "border:1px solid#ddd;";
            }

            if($errors==0) {
                $password = crypt($password, '$6$rounds=5000$saltystring$'); 
                $user = new User();
                $user->setEmail($email);
                $user->setPassword($password);
                $user->setName($name);
                $register = $user->register();
            }
        }
?>
<div class="panel panel-login">
    <div class="panel-heading">
        <div class="row">
            <div class="col-xs-12">
                <a href="#" class="active" id="register-form-link">Register</a>
            </div>
        </div>
        <hr>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <form id="register-form" action="#" method="post" role="form">
                    <div class="form-group">
                        <input type="text" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" 
                               style="<?php if(isset($email_border)){ echo $email_border; } ?>">
                        <label><?php if(isset($email_error)){ echo $email_error; } ?></label>
                    </div>
                    <div class="form-group">
                        <input type="text" name="name" id="name" tabindex="1" class="form-control" placeholder="Name"
                               style="<?php if(isset($name_border)){ echo $name_border; } ?>">
                        <label><?php if(isset($name_error)){ echo $name_error; } ?></label>
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" style="<?php if(isset($password_border)){ echo $password_border; } ?>">
                        <label><?php if(isset($password_error)){ echo $password_error; } ?></label>
                    </div>
                    <div class="form-group">
                        <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control"       placeholder="Confirm Password" 
                               style="<?php if(isset($confirm_password_border)){ echo $confirm_password_border; } ?>">
                        <label><?php if(isset($confirm_password_error)){ echo $confirm_password_error; } ?></label>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6 col-sm-offset-3">
                                <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row form-error">
                            <label id="register-error"><?php if(isset($register)){ echo $register; } ?></label>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php } ?>