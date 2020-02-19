<?php
    include 'connect.php';
    
    $score = 0;
    
    $name = 'Admin';
	if(isset($_POST['submit'])){
		$ans1 = $con->escape_string(trim($_POST['quant']));
        $ans2 = $con->escape_string(trim($_POST['verbal']));
		$ans3 = $con->escape_string(trim($_POST['logical']));
		$ans4 = $con->escape_string(trim($_POST['timer']));
		$ans4=$ans4*60;
		mysqli_query($con,"UPDATE `admin` SET `quant` = '$ans1', `verbal` = '$ans2', `logical` = '$ans3', `timer` = '$ans4' WHERE `admin`.`no` = 1");
		
		$x = mysqli_query($con,"select * from admin where `admin`.`no`=1 ");
		while($row=mysqli_fetch_object($x))
		{
			echo $row->quant;
			echo $row->verbal;
			echo $row->logical;
			echo $row->timer;
		}
		//$x=mysql_query('select quant from admin where no=1');
		//$sql = "SELECT * FROM `admin` WHERE `no`='1'";
         
		//echo "<h1>$x*10</h1>";
		
		header("Refresh: 15; url='/aptitude/set.php'");
	}
    
	
    
        //$student = mysql_query("UPDATE `info` SET `marks`='$score', `attempt`=1 WHERE `name`='$name'");
        //header("location: reportcheck.php"); 
    ?>
    
<!DOCTYPE html>
<html>
    <head>
        <title>Admin</title>
       
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
           <a class="navbar-brand">RAIT</a>
           
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
                    <p class="navbar-brand"><?php
                        
                            echo '<a href="index.php">Log Out</a>';
                        
                    ?></p>
                </li>
                
            </ul>

        </div>
      </div>
    </div>


    <div class="container">
        <div class="page-header" id="banner">
            <div class="row"> <br>
                <div class="col-lg-7 col-md-7 col-sm-6">
                    <center><div class="where_it_starts" style="padding-top: 0.4em">Admin Panel</div></center>
                </div>
                
                <div class="col-lg-5 col-md-5 col-sm-6">
                    <div class="lead"></div>
                    <div class="lead"></b></div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
            
            <div class="bs-component">
                <div class="jumbotron">
                    
                        <center>
						<div class="form-group">
                    <form action="set.php" method="POST" enctype="multipart/form-data">
					<table style="margin: auto">
					
					<tr>
					<p><td>No. of Quant questions:</td>
					   <td><input type="text" class="form-control" name="quant"></td>
					</tr><br><br>
					
					<tr>
					   <td>No. of Verbal questions:</td>
					<td><input type="text" class="form-control" name="verbal"></td></tr><br><br>
					   
					   <tr><td>No. of Logical questions:</td>
					<td><input type="text" class="form-control" name="logical"></td> </tr>
					
					<tr>
					   <td>Timer:</td>
					<td><input type="text" class="form-control" name="timer"></td></tr>
					
                     </table>   <br>
                    <input type="submit" name="submit" value="Set Values" class="btn btn-default">
                    </form>
					</div>
					<br><br><br>
					<a href="xml.php">Generate Report</a>
                     </center>
                    </div>
                    
                </div>
                
            </div>
            
            </div>
        </div>

    </body>
</html>
        