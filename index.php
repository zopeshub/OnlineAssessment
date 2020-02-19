<?php
    include 'connect.php';
    
    $error_msg = "";
    $expiry= time()+3600;
    session_start();
    if(isset($_SESSION['login']))
    {    
        if($_SESSION['login']=='1')
            header ("location:quiz.php");
    }
    if(!empty($_POST)){
        $username = $con->escape_string(trim($_POST['username']));
        $password = $con->escape_string(trim($_POST['password']));
        $adm = 'r';
        if(empty($username)){
            $error_msg="Username Required";
        }
        else if(empty($password)){
            $error_msg="Password Required";
        }
        else if(!isset($adm)){
            $error_msg="Admission Type Required";
        }
        else
        {
            $sql = "SELECT * FROM `result` WHERE `roll`='$username'";
            $fetch = mysqli_query($con,$sql);
            $count = mysqli_num_rows($fetch);
            $student = mysqli_fetch_object($fetch);
            if( $count==1 && $password=='user@1234' && $student->attempt==0)
            {
                $_SESSION['login']='1';
                $_SESSION['roll']=$username;
                if($adm=="p")
                {
                    $sql = "UPDATE `result` SET `adm`='p', `type1`= NULL,`type2`=NULL,`type3`=NULL,`start_time`=CURTIME() WHERE `roll`='$username'";
                }
                else
                {
                    $sql = "UPDATE `result` SET `type1`= NULL,`type2`=NULL,`type3`=NULL,`start_time`=CURTIME() WHERE `roll`='$username'";
                }
                    
                $res=mysqli_query($con,$sql) or die($sql);
                setcookie("student", ucwords($student->name), $expiry);
                setcookie("roll_no", $username, $expiry);
                header("location: quiz.php");
            }
            else if($student->attempt==1)
                $error_msg="Your Test Has Ended!";
        }
        
        if($error_msg!="") {
        }  
        else
        { $error_msg="Invalid Login"; }
        
       
    }
    ?>
    
<!DOCTYPE html>
<html>
    <head>
        <title>Aptitude Test</title>
       
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="Stylesheet/styles.css" />
        <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css" />
        
        <script src="Bootstrap/jquery/jquery-2.1.1.min.js"></script>
        <script src="Bootstrap/js/bootstrap.min.js"></script>
        <script>
            function checkLogin()
            {
		localStorage.setItem("timer",3600);
                document.getElementById("loginForm").submit();
            }
        </script>
        <style>
            @font-face {
                font-family: myFont;
                src: url(Fonts/JosefinSans.ttf);
            }
            
            @font-face {
                font-family: myFontBold;
                src: url(Fonts/Expressway.ttf);
            }
            
            @font-face {
                font-family: myFontTitle;
                src: url(Fonts/Accidental.ttf);
            }
            
            @font-face {
                font-family: myFontSpecs;
                src: url(Fonts/Abel.ttf);
            }
        </style>

    </head>
    
    <body>
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand">Aptitude Test</a>
            
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav">
            
            </ul>
            
            <ul class="nav navbar-nav navbar-right">
                <li>
                    <p class="navbar-brand">Login Page</p>
                </li>
                
            </ul>

        </div>
      </div>
    </div>


    <div class="container">
        <div class="page-header" id="banner">
            
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <br>
            <div class="bs-component">
                <div class="jumbotron">
                    <div class="row">
                        <p>Mock Aptitude Test</p>
                    <div class="input-group col-lg-6">
                
                    <form action="index.php" method="POST" enctype="multipart/form-data" id="loginForm">
                        <table style="margin: auto">
                        <tr>
                            <td>Username: &nbsp;&nbsp;</td>
                            <td><input type="text" name="username"></td>
                            <!--<td><input type="radio" name="adm" value="r" style="margin-left: 1em">Regular
                                <input type="radio" name="adm" value="p" style="margin-left: 1em">Provisional</td> -->
                        </tr>
                
                        <tr>
                            <td><br>Password: &nbsp;&nbsp;</td>
                            <td><br><input type="password" name="password"></td>
                            <td>
                                <div style="margin-left: 4em;">
                                    <input type="submit" id="login_button" name="sub" class="btn btn-m btn-primary" value="Login" onclick="checkLogin()">
                            </div>  
                            </td>
                            
                        </tr>
                        
                        </table>
						<br>
                        <div class="col-lg-6" style="float: right">
                        <p class="error"><?php echo $error_msg ?></p>
                    </div>
                    </form>
                    </div>
                    
                    
                    </div>
                    
                    </div>
                    
                </div>

            </div>
            
            </div>
        </div>

    </body>
</html>