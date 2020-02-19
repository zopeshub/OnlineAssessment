<?php
    include 'connect.php';
    $score = 0;
    session_start();
    if(!isset($_SESSION['login']))
           header ("location:index.php");
    else if($_SESSION['login']=='0')
            header ("location:reject.php");
    $name = $_COOKIE['student'];
    $roll =$_COOKIE['roll_no'];
    if(!empty($_POST)){
        $correct=0;
        $incorrect_ans=0;
        $unattempted=0;
        $type=mysqli_query($con,"SELECT `type1`,`type2`,`type3` from `result` where roll='$roll'") or die("Database Error");
        $type=mysqli_fetch_object($type);
        $type= $type->type1.$type->type2.$type->type3;
        $type=mysqli_query($con,"SELECT `id`,`correct_choice`,`type` from `question_1` where `id` in(".$type.")") or die("Database Error");
       
        $quant=0;
        $verbal=0;
        $logical=0;
        while($x=mysqli_fetch_object($type)) 
        {
            if(isset($_POST[$x->id]))
            {
                $b=$_POST[$x->id];
                
                if($b==$x->correct_choice)
                {
                    if($x->type==1)
                        $quant++;
                    else if($x->type==2)
                        $verbal++;
                    else $logical++;
                    $correct++;
                }
                else $incorrect_ans++;
            }
            else $unattempted++;
        }   
        $negative=$incorrect_ans*0.25;
        $final=$correct-$negative;
        $a1= mysqli_query($con,"SELECT TIMEDIFF(CURTIME(),(select `start_time` from `result` where `roll`='$roll' ))AS `time_s` from `result` where `roll`='$roll'") or die("Database Error");
        $a2=  mysqli_fetch_object($a1);
        $a3=$a2->time_s;
        $a=  mysqli_query($con,"UPDATE `result` set `attempt`=1,`quant`=$quant,`verbal`=$verbal,`logical`=$logical,`incorrect`=$incorrect_ans,`final_score`=$final,`time_taken`='$a3' where `roll`='$roll'") or die("Database Error");
        
        header("location: report.php");
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

        
    <style>
.hidden{
    display:none;
}

.unhidden{
    display:block;
}
</style>
        
    <script type="text/javascript">
        function unhide(divu, divh, divhh) {
        var item = document.getElementById(divu);
        if (item) {
                item.className='unhidden';
            }
            document.getElementById(divh).className = 'hidden';
            document.getElementById(divhh).className = 'hidden';
        }
    </script>
    <script>
        s="This Action Will Reset All Questions!";
        var myVar = setInterval(function() {myTimer();},1000);
        var d= localStorage.getItem("timer");
        
        function myTimer() 
        {
            if(d>0)
            {
                a=Math.floor(d/60);
                b=d%60;
                t="";
                if(a<10)
                    t= "0"+a;
                else t = a;
                t=t+":";
                if(b<10)
                    t = t+"0"+b;
                else t =t + b;
                document.getElementById("timerSet").innerHTML=t;
                d--;
                localStorage.setItem("timer", d);
            }
            else 
            {
                clearTimeout(myVar);
                s=null;
                document.getElementById("QuestionForm").submit();
            }
        }
        function subForm()
        {
            if(d===0)
                s=null;
            else s="Confirm Submit?";
            document.getElementById("QuestionForm").submit();
        }
        function warning()
        {
            return s;
        }
        function resetButton(x)
        {
            document.getElementById(x+"a").checked=false;
            document.getElementById(x+"b").checked=false;
            document.getElementById(x+"c").checked=false;
            document.getElementById(x+"d").checked=false;
        }
    </script>      
    </head>
    
    <body onload="unhide('quant', 'verbal', 'logical')" onbeforeunload="return warning()">
         <div id="top"></div>
        <div class="navbar navbar-default navbar-fixed-top" >
        <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand">Aptitude Test&nbsp;&nbsp;|&nbsp;&nbsp;Time Remaining : <span id="timerSet" style="color: red"></span></a>
           
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
                        if(isset($_COOKIE['student']) && isset($_COOKIE['roll_no'])){
                            echo "Name: ".$_COOKIE['student']." &nbsp;&nbsp|&nbsp;&nbsp Roll No: ".$_COOKIE['roll_no']."";
                        }
                    ?></p>
                </li>
                
            </ul>

        </div>
      </div>
    </div>


        <div class="container" >
        <div class="page-header" id="banner" >
            <div class="row" > <br>
                <div class="col-lg-7 col-md-7 col-sm-6">
                    <center><div class="where_it_starts" style="padding-top: 0.4em">Mock Aptitude Test</div></center>
                </div>
                
                <div class="col-lg-5 col-md-5 col-sm-6">
                    <div class="lead">Total 60 Questions Over Three Sections<br>
                                      +1 For Correct, -0.25 For Wrong Answer</div>
                    <div class="lead"></b></div>
                </div>
            </div>
            
            
            <ul class="nav nav-tabs nav-justified">
               
        <li role="presentation" class="btn btn-default btn-m" style="font-size:1.24em;"><a href="javascript: unhide('quant', 'verbal', 'logical')">Quant</a></li>
        <li role="presentation" class="btn btn-default btn-m" style="font-size:1.24em;"><a href="javascript: unhide('verbal', 'quant', 'logical')">Verbal</a></li>
        <li role="presentation" class="btn btn-default btn-m" style="font-size:1.24em;"><a href="javascript: unhide('logical', 'quant', 'verbal')">Logical</a></li>
  <br>
</ul>
        </div>
        
        <div class="row">
            <div class="col-lg-12">
                <div class="bs-component">
                <div class="jumbotron">
                
                    <form action="quiz.php" method="POST" enctype="multipart/form-data" id="QuestionForm" name="n">
                    <?php
                       
                        $check=mysqli_query($con,"SELECT `type1`,`type2`,`type3` FROM `result` WHERE roll='$roll'") or die("Database Error");
                        $count = mysqli_num_rows($check);
                        $quant_randomize=NULL;
                        $verbal_randomize=NULL;
                        $logical_randomize=NULL;
                        $q=mysqli_fetch_object($check);
                        if($q->type1==NULL)
                        {
                            
                            $quant_randomize = mysqli_query($con,"SELECT * FROM(SELECT * FROM `question_1` WHERE `type`=1 ORDER BY RAND() LIMIT 20)AS `a` ORDER BY `id`") or die("Database Error");
                            $verbal_randomize = mysqli_query($con,"SELECT * FROM(SELECT * FROM `question_1` WHERE `type`=2 ORDER BY RAND() LIMIT 20)AS `a` ORDER BY `id`") or die("Database Error");
                            $logical_randomize = mysqli_query($con,"SELECT * FROM(SELECT * FROM `question_1` WHERE `type`=3 ORDER BY RAND() LIMIT 20)AS `a` ORDER BY `id`") or die("Database Error");
                        }
                        else
                        {
                            $quant_randomize = mysqli_query($con,"SELECT * FROM `question_1` where id in(".$q->type1.")") or die("Database Error");
                            $verbal_randomize = mysqli_query($con,"SELECT * FROM `question_1` where id in(".$q->type2.")") or die("Database Error");
                            $logical_randomize = mysqli_query($con,"SELECT * FROM `question_1` where id in(".$q->type3.")") or die("Database Error");
                        }
                        echo '<div id="quant" style="font-family: myFontSpecs; font-size: 1.4em">';
                        echo '<p class="philosophical_fact">';
                        echo '<h2 style="font-family:myFontSpecs; font-size: 1.8em;"><b>Quant Section</b></h2><br>';
                        
                        $number = 1;
                        $type1q="";
                        $ans1a="";
                        while($retrieve = mysqli_fetch_object($quant_randomize)) {
                            echo 'Q'.$number.'. '.$retrieve->question.'<br>';
                            echo '<input type="radio" name="'.$retrieve->id.'" id="'.$retrieve->id.'a'.'"value="a" style="margin-left: 2em"> '.$retrieve->choice_1.'<br>';
                            echo '<input type="radio" name="'.$retrieve->id.'" id="'.$retrieve->id.'b'.'" value="b" style="margin-left: 2em"> '.$retrieve->choice_2.'<br>';
                            echo '<input type="radio" name="'.$retrieve->id.'" id="'.$retrieve->id.'c'.'" value="c" style="margin-left: 2em"> '.$retrieve->choice_3.'<br>';
                            echo '<input type="radio" name="'.$retrieve->id.'" id="'.$retrieve->id.'d'.'" value="d" style="margin-left: 2em"> '.$retrieve->choice_4.'<br>';
                            echo '<a name="'.$retrieve->id.'Button" onclick="resetButton('.$retrieve->id.')" style="cursor: pointer;">Reset Selection <span class="glyphicon glyphicon-repeat" style="font-size: 0.64em"></span></a>';
                            echo '<br><hr>';
                            $number = $number + 1;
                            $type1q.=$retrieve->id.',';
                        }
                        $type1q.='0';
                        echo '</p><a href='."#top".'>Back To Top &uarr;</a>';
                        echo '</p></div>';
                        
                        
                        
                        echo '<div id="verbal" style="font-family: myFontSpecs; font-size: 1.4em">';
                        echo '<p class="philosophical_fact">';
                        echo '<h2 style="font-family:myFontSpecs; font-size: 1.8em;"><b>Verbal Section</b></h2><br>';
                        $number = 1;
                        $type2q="";
                        $ans2a="";
                        while($retrieve = mysqli_fetch_object($verbal_randomize)) {
                            echo 'Q'.$number.'. '.$retrieve->question.'<br>';
                            echo '<input type="radio" name="'.$retrieve->id.'" id="'.$retrieve->id.'a'.'" value="a" style="margin-left: 2em"> '.$retrieve->choice_1.'<br>';
                            echo '<input type="radio" name="'.$retrieve->id.'" id="'.$retrieve->id.'b'.'" value="b" style="margin-left: 2em"> '.$retrieve->choice_2.'<br>';
                            echo '<input type="radio" name="'.$retrieve->id.'" id="'.$retrieve->id.'c'.'" value="c" style="margin-left: 2em"> '.$retrieve->choice_3.'<br>';
                            echo '<input type="radio" name="'.$retrieve->id.'" id="'.$retrieve->id.'d'.'" value="d" style="margin-left: 2em"> '.$retrieve->choice_4.'<br>';
                            echo '<a name="'.$retrieve->id.'Button" onclick="resetButton('.$retrieve->id.')" style="cursor: pointer;">Reset Selection <span class="glyphicon glyphicon-repeat" style="font-size: 0.64em"></span></a>';
                            echo '<br><hr>';
                            $number = $number + 1;
                            $type2q.=$retrieve->id.',';
                        }
                        $type2q.='0';
                        
                        echo '</p><a href='."#top".'>Back To Top &uarr;</a>';
                        echo '</p></div>';
                        
                        
                        echo '<div id="logical" style="font-family: myFontSpecs; font-size: 1.4em">';
                        echo '<p class="philosophical_fact">';
                        echo '<h2 style="font-family:myFontSpecs; font-size: 1.8em;"><b>Logical Section</b></h2><br>';
                        $number = 1;
                        $type3q="";
                        $ans3a="";
                        while($retrieve = mysqli_fetch_object($logical_randomize)) {
                            echo 'Q'.$number.'. '.$retrieve->question.'<br>';
                            echo '<input type="radio" name="'.$retrieve->id.'" id="'.$retrieve->id.'a'.'" value="a" style="margin-left: 2em"> '.$retrieve->choice_1.'<br>';
                            echo '<input type="radio" name="'.$retrieve->id.'" id="'.$retrieve->id.'b'.'" value="b" style="margin-left: 2em"> '.$retrieve->choice_2.'<br>';
                            echo '<input type="radio" name="'.$retrieve->id.'" id="'.$retrieve->id.'c'.'" value="c" style="margin-left: 2em"> '.$retrieve->choice_3.'<br>';
                            echo '<input type="radio" name="'.$retrieve->id.'" id="'.$retrieve->id.'d'.'" value="d" style="margin-left: 2em"> '.$retrieve->choice_4.'<br>';
                            echo '<a name="'.$retrieve->id.'Button" onclick="resetButton('.$retrieve->id.')" style="cursor: pointer;">Reset Selection <span class="glyphicon glyphicon-repeat" style="font-size: 0.64em"></span></a>';
                            echo '<br><hr>';
                            $number = $number + 1;
                            $type3q.=$retrieve->id.',';
                        }
                        $type3q.='0';
                        mysqli_query($con,"UPDATE `result` set `type1`='$type1q',`type2`='$type2q',`type3`='$type3q' where `roll`='$roll'") or die("Database Error");
                        echo '</p><p style="color: #158CBA;">Please Check That You Have Attempted All 3 Sections!</p><a href="#top">Back To Top &uarr;</a>';
                        echo '</p><input type="button" name="sub" value="Submit Answers" class="btn btn-m btn-primary" onclick="subForm()" style="float:right; display: inline;"></div>';
                       
                    ?>
		
                        <input type="text" name="a" value="" style="border-width: 0px; opacity: 0; height: 0px; width: 0px;" >
                        
                    
                    </form>
          
                    </div>
                    
                </div>
                
            </div>
            
            </div>
        </div>

    </body>
</html>
        