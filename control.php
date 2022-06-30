<?php
   /* $arg=0;
    $happy=0;
    $sad=0;
    $angry=0;
    exec('python ""C:\xampp\htdocs\main.py"" "'.$arg.'"', $output, $return_var);

// PYTHON OUTPUT
$len=sizeof($output);
for ($i=0;$i<$len;$i++) {
    if($output[$i]=="Happy")
    $happy++;
    else if($output[$i]=="Sad")
    $sad++;
    else if($output[$i]=="Angry")
    $angry++;
}
echo ("happy=".$happy." sad=".$sad." angry=".$angry);*/
    $arg=0;
    $happy=0;
    $sad=0;
    $angry=0;
    exec('python ""C:\xampp\htdocs\main.py"" "'.$arg.'"', $output, $return_var);

// PYTHON OUTPUT
$len=sizeof($output);
for ($i=0;$i<$len;$i++) {
    if($output[$i]=="Happy")
    $happy++;
    else if($output[$i]=="Sad")
    $sad++;
    else if($output[$i]=="Angry")
    $angry++;
}?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <title>AI PROJECT</title>
</head>
<body class="whole">
    <div class="content">
        <p id="question">What do you think about while showering ?</p>
        <input id="ans" type="text">
        <br>
        <br>
        <button id="finish">Finish</button>
        <h1 id="thank">Thank you for taking our test</h1>
        <p id="result"></p>
        <br>
        <br>
        <form method="post" action="index1.php">
        <button id="again">Take the test again</button>
        </form>
    </div>
</body>
<script>
var i=0;
let x=0;
var res;
var happy=0,sad=0,anger=0;
    var ans=[];
    let choice=null;
    $(document).ready(function(){
        $("#thank").hide();
        $("#again").hide();
    });
    $("#finish").click(function(){
                    face();
                    $("#finish").hide("slow");
                    $("#thank").show("slow");
                    $("#question").hide("slow");
                    $("#ans").hide("slow");
                    $('#result').html(res);
                    $('#result').show("slow");
                    $("#again").show("slow");
                })
    function result(happy,sad,anger)
    {
        console.log(happy+" "+sad+" "+anger);
        if(anger>(sad+happy))
        res="According to the resutls of interview, you are evaluated to be short tempered, and are adviced to attend anger management classes";
        else if(sad/happy>3)
        res="Based on the interview, You most probably suffer from depression, and are adviced to consult a counsellor as soon as possible";
        else if(happy>=sad)
        res="After evaluating the results from the interview, it can be concluded that you mental is fine =)";
        else
        res="Based on you results, you mental health appears to be below what is recommended. It is adviced that you take care of it by enjoying breaks from work and relaxing more often";
    }
    function face()
    {
//echo ("happy=".$happy." sad=".$sad." angry=".$angry);
 happy="<?php echo $happy?>"
 sad="<?php echo $sad?>"
 anger="<?php echo $angry ?>"
 result(happy,sad,anger);
}
</script>
<style>
    .whole{
        background-image:url("./bg5.jpg");
        background-repeat: no-repeat;
        background-size: 2000px;
        max-width: fit-content;
        max-height: fit-content;
    }
    .content{
        background-color: rgb(33, 186, 228);
        size-adjust:inherit;
        text-align: center;
        border: 5px solid #d2fdbe;
        text-align: center;
        color: aliceblue;
        margin-top: 25vh;
        margin-left: 550px;
        margin-right: 550px;
    }
    button{
        color:black;
        background-color:azure;
        padding: 8px 20px;
        font-size: large;
    }
    p{
        color: black;
        font-size: 30px;
        font-style:italic;
    }
</style>
</html>