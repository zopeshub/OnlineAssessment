<head>
    <title>Aptitude Test</title>
       
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
    <div class="title">
        Mock Aptitude Test 
    </div>
    
    <div class="login">
        <?php
            include 'connect.php';
            
            session_start();
            if(!isset($_SESSION['login']))
                header ("location:index.php");
            else if($_SESSION['login']==0)
                header ("location:reject.php");
            else
            {
                $_SESSION['login']=0;
                $roll = $_COOKIE['roll_no'];
                $retrieve = mysqli_query($con,"SELECT * FROM `result` WHERE `roll`='$roll'");
                $fetch = mysqli_fetch_object($retrieve);
                $q=$fetch->quant;
                $v=$fetch->verbal;
                $l=$fetch->logical;
                $corr=$q+$v+$l;
                $i=$fetch->incorrect;
                $a=$corr+$i;
                $un=60-$a;
                
                echo '<div class="panel panel-default">';
                echo '<div class="panel-heading">'.ucwords($fetch->name).'&nbsp;&nbsp;&nbsp;&nbsp;'.$fetch->roll.'&nbsp;&nbsp;&nbsp;&nbsp;'.$fetch->branch.'</div>';
                echo '<table class="table" style="width: 40%; margin:auto; font-size: 0.69em">';
                echo '<tr style="color: green">'
                        . '<td></td>'
                        . '<td>Quant Score &nbsp;(Total Correct)</td>'
                        . '<td>'.$q.'</td>'
                        . '<td>'.($q*5).'%</td>'
                        . '</tr>';
                echo '<tr style="color: green">'
                        . '<td></td>'
                        . '<td>Verbal Score &nbsp;(Total Correct)</td>'
                        . '<td>'.$v.'</td>'
                        . '<td>'.($v*5).'%</td>'
                        . '</tr>';
                echo '<tr style="color: green">'
                        . '<td></td>'
                        . '<td>Logical Score (Total Correct)</td>'
                        . '<td>'.$l.'</td>'
                        . '<td>'.($l*5).'%</td>'
                        . '</tr>';
                echo '<tr>'
                        . '<td></td>'
                        . '<td>Total Answered</td>'
                        . '<td>'.$a.'</td>'
                        . '<td></td>'
                        . '</tr>';
                echo '<tr>'
                        . '<td></td>'
                        . '<td>Total Unanswered</td>'
                        . '<td>'.$un.'</td>'
                        . '<td></td>'
                        . '</tr>';
                echo '<tr style="color: red">'
                        . '<td></td>'
                        . '<td>Total Incorrect Answered</td>'
                        . '<td>'.$i.'</td>'
                        . '<td></td>'
                        . '</tr>';
                echo '<tr><td>&nbsp<td></tr>';
                echo '<tr style="font-weight: bold">'
                        . '<td></td>'
                        . '<td>Final Score</td>'
                        . '<td>'.$fetch->final_score.'</td>'
                        . '<td>'.round((($fetch->final_score)*5/3),2).'%</td>'
                        . '<td></td>'
                        . '</tr>';
                echo '</table></div>';  
            }
                
        ?>
        Thank You! <a href="destroy.php">Home Page</a>
    </div>
</body>