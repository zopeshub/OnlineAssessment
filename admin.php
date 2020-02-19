<?php
    include 'connect.php';
    
    $error_msg = "";
    if(!empty($_POST)){
        $username = $con->escape_string(trim($_POST['username']));
        $password = $con->escape_string(trim($_POST['password']));

        if(empty($username)){
            $error_msg="Username Required";
        }
        else if(empty($password)){
            $error_msg="Password Required";
        }
        
        if( $username=='admin' && $password=='admin@1234')
        {
            $error_msg = "";
            header("location:set.php"); 
            
        }
        else
        {
            if($error_msg=="Username Required" || $error_msg=="Password Required") {
                }  
            else
            { $error_msg="Invalid Login"; }
        }
       
    }
    ?>
    
<!DOCTYPE html>
<html>
    <head>
        <title>Admin Login</title>
       
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="Stylesheet/styles.css" />
        <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css" />
        
        <script src="Bootstrap/jquery/jquery-2.1.1.min.js"></script>
        <script src="Bootstrap/js/bootstrap.min.js"></script>
        
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
            <a class="navbar-brand">Mock Test Admin</a>
            
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
                    <p class="navbar-brand">Admin Login Page</p>
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
                
                    <form action="admin.php" method="POST" enctype="multipart/form-data" id="loginForm">
                        <table style="margin: auto">
                        <tr>
                            <td>Username: &nbsp;&nbsp;</td>
                            <td><input type="text" name="username"></td>
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
                        <div style="font-size: 0.7em"><br></div>
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