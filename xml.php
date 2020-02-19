<?php
include 'connect.php';
header( "Content-Type: application/vnd.ms-excel" );
header( "Content-disposition: attachment; filename=Mock Test Report.xls" );

echo    'Roll No' . "\t"
        .'Name' . "\t"
        . 'Branch' . "\t"
        . 'Answered' . "\t"
        . 'Unanswered' . "\t"
        . 'Quant Score'."\t"
        . 'Quant Percentage'."\t"
        . 'Verbal Score'."\t"
        . 'Verbal Percentage'."\t"
        . 'Logical Score'."\t"
        . 'Logical Percentage'."\t"
        . 'Incorrect Answers'."\t"
        . 'Negative Marks' . "\t"
        . 'Total Score' . "\t"
        . 'Maximum Score' . "\t"
        . 'Percentage'."\t"
        . 'Spent Time' . "\n";
        
$max=60;

$result = mysqli_query($con,"SELECT * from `result` where `attempt`=1") or die("Database Error");
while($retrive =  mysqli_fetch_object($result))
{
    $q=$retrive->quant;
    $v=$retrive->verbal;
    $l=$retrive->logical;
    $i=$retrive->incorrect;
    $an=$q+$v+$l+$i;
    $u=60-$an;
    if($retrive->time_taken > '60:00:00')
        $a='60:00:00';
    else $a=$retrive->time_taken;
    echo  $retrive->roll . "\t"
        .ucwords($retrive->name) . "\t" 
        . $retrive->branch . "\t"
        . $an . "\t"
        . $u . "\t"
        . $q . "\t"
        . $q*5 . "%\t"
        . $v . "\t"
        . $v*5 . "%\t"
        . $l . "\t"
        . $l*5 . "%\t"
        . $i . "\t"
        . $i*0.25 . "\t"
        . $retrive->final_score . "\t"
        . $max . "\t"
        . round(($retrive->final_score)*5/3,2) . "\t"
        . $a . "\n";
}
?>
