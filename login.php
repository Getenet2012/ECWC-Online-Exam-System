<?php 
    include('config/apply.php');
    include('box/header.php');

?>
<!--Body Starts Here-->
        <div class="main">
            <div class="login">
			<hr>
       <div class="screen">
		<div class="screen__content">
		 <form method="post" action="">
                    <?php 
                        if(isset($_SESSION['validation']))
                        {
                            echo $_SESSION['validation'];
                            unset($_SESSION['vaidation']);
                        }
                        if(isset($_SESSION['fail']))
                        {
                            echo $_SESSION['fail'];
                            unset($_SESSION['fail']);
                        }
                        if(isset($_SESSION['xss']))
                        {
                            echo $_SESSION['xss'];
                            unset($_SESSION['xss']);
                        }
                    ?>
             
				<div class="login__field">
					<i class="login__icon fas fa-user"></i>
					<input type="text" name="username" required="true" class="login__input" placeholder="User name / Email">
				</div>
				<div class="login__field">
					<i class="login__icon fas fa-lock"></i>
					<input type="password" name="password" required="true" class="login__input" placeholder="Password">
				</div>
				  <input type="submit" name="submit" value="Login" class="btn-go" />
					<i class="button__icon fas fa-chevron-right"></i>
			</form>
		</div>
		<div class="screen__background">
			<span class="screen__background__shape screen__background__shape4"></span>
			<span class="screen__background__shape screen__background__shape3"></span>		
			<span class="screen__background__shape screen__background__shape2"></span>
			<span class="screen__background__shape screen__background__shape1"></span>
		</div>		
	</div>
				
				
                <?php 
                    if(isset($_POST['submit']))
                    {
                        //echo "Clicked";
                        $username=$obj->sanitize($conn,$_POST['username']);
                        $password_db=md5($obj->sanitize($conn,$_POST['password']));
                        
                        if(($username=="")or($password=""))
                        {
                            $_SESSION['validation']="<div class='error'>Username or Password is Empty</div>";
                            header('location:'.SITEURL.'admin/login.php');
                        }
                        $tbl_name="tbl_admin";
                        $where="username='$username' AND password='$password_db'";
                        $query=$obj->select_data($tbl_name,$where);
                        $res=$obj->execute_query($conn,$query);
                        $count_rows=$obj->num_rows($res);
                        if($count_rows==1)
                        {
                            $_SESSION['user']=$username;
                            $_SESSION['success']="<div class='success'>Login Successful. Welcome ".$username." to dashboard.</div>";
                            header('location:'.SITEURL.'admin/index.php');
                        }
                        else
                        {
                            $_SESSION['fail']="<div class='error'>Username or Password is invalid. Please try again.</div>";
                            header('location:'.SITEURL.'admin/login.php');
                        }
                    }
                ?>
            </div>
        </div>
        <!--Body Ends Here-->

<?php
    include('box/footer.php');
?>