<?php
	$error = "";
    $success = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $username = sanitize_input($_POST['username']);
        $password = sanitize_input($_POST['password']);
        
        $exists = check_if_exist($username);
        if($exists == 1)
        {
            $success = "Successfully registered and logged in. You will be redirected to the homepage shortly.";
            
            $userdata = login($username, $password);
            $_SESSION['username'] = $userdata[0]['username'];
            $_SESSION['role'] = $userdata[0]['role'];
            header( "refresh:2;url=?page=home" );
        }else{
            $error = "Username doesn't exist.";
        }
    }


?>
	<div class="box">
		<div class="boxtitle">
        <?php if(empty($error)): ?>
			<h2>Logged in!</h2>
        <?php else: ?>
            <h2>Error found!</h2>
        <?php endif; ?>
		</div>
		<div class="boxcontent">
            <?php 
            if(empty($error))
            {
                echo $success;
            }else{
                echo $error;
            }
            ?>

		</div>
	</div><br>
<br>