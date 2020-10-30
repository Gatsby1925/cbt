<?php
    include 'conn.php';

    if(isset($_POST['register'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $check_exists_q = mysqli_query($conn, "select * from users where email='$email'");

        if(mysqli_num_rows($check_exists_q) > 0){
            header("location: register.php?error=1");
        }else{
            $reg_q = mysqli_query($conn, "insert into users values(NULL, '$fname','$lname','$email','$password')");
            if($reg_q){
                session_start();
                $get_user_q = mysqli_query($conn, "select * from users where email='$email' and password='$password'
                    order by id desc limit 1");
                $user = mysqli_fetch_assoc($get_user_q);
                $_SESSION['userid'] = $user['id'];
                header('Location: index.php');
            }else{
                header("location: register.php?error=0");
            }
        }
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="styles/styles.css?cache=1" />
        <title>Register</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" src="js/cbt-main.js"></script>
    </head>
    <body>
        <!--ERRORS-->
        <?php if(isset($_GET['error'])){ 
            $error = $_GET['error'];
            switch ($error) {
                case 0:
                    $error_message = "Something went wrong.";
                    break;
                case 1:
                    $error_message = "User already exists.";
                    break;
                default:
                    $error_message = "No errors.";
                    break;
            }
        ?>
            <div class="err_message">
                <span class="err_message_text"><?php echo $error_message; ?></span>
                <button class="dismiss_message">Dismiss</button>
            </div>
        <?php }else{ ?>
            <div class="err_message" style="display: none;">
                <span class="err_message_text">Error message here!</span>
                <button class="dismiss_message">Dismiss</button>
            </div>
        <?php } ?>

        <div class="vertical_centered_box" align="center">
            <h2 class="title">Convenient Business Tools</h2>
            <br/>
                <div class="form_container" align="center">
                    <form method="post" id="register">
                        <h1 style="margin:0;">REGISTER</h1><br/>
                        <table style="width: 90%;" cellpadding="5" align="center">
                            <tr>
                                <td style="padding-left: 0px;"><input type="text" placeholder="First Name" name="fname" /></td>
                                <td><input type="text" placeholder="Last Name" name="lname" /></td>
                            </tr>
                        </table>
                        <p><input type="text" placeholder="Email" name="email" /></p>
                        <p><input type="password" placeholder="Password" name="password" /></p>
                        <p><input type="password" placeholder="Confirm Password" name="cpassword" /></p>
                        <table style="width: 100%;" cellspacing="10" align="center">
                            <tr>
                                <td>
                                    <input type="checkbox" name="agree" />
                                </td>
                                <td>By signing up, you agree to our terms and conditions.</td>
                            </tr>
                        </table>
                        <input type="submit" class="submit" name="register" value="Register" />
                    </form>
                </div>
            <br/><br/>
            <div id="two">
                Already a member? <a href="login.php">Login.</a>
            </div>
            <br/>
        </div>
    </body>
</html>