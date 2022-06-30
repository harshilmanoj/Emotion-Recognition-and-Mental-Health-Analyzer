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
        <h1 id="welcome">Welcome to a pre-counseller session where we interview you to assess your mental health</h1>
        <button id="welbtn">Next</button>
        <h1 id="choice">How would you like to answer the questions ?</h1>
        <form method="post" action="control.php">
        <button id="ch1" type="submit">Through text</button>
        <button id="ch2" typr="submit">Through speech</button>
        </form>
        <img id="paint" src="paint.jpg" width="100px" height="100px">
        <p id="question"></p>
        <input id="ans" type="text">
        <br>
        <br>
        <button id="nextq">Next question</button>
        <button id="finish">Finish</button>
        <h1 id="thank">Thank you for taking our test</h1>
        <p id="result"></p>
        <br>
        <br>
    </div>
</body>
<!--
<script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://requirejs.org/docs/release/2.3.5/minified/require.js"></script>
   <script>
        /*function facial(){
            $.ajax({
              url: "main.py",
            success:function(response){
                console.log(response);
            }
        })
    }*/
    const {spawn}=require(['child_process']);
    const v=[];
    const sensor =spawn ('python',['main.py']);
    sensor.stdout.on('data',function(data)
    {
        v.push(parseFloat(data));
        console.log(v);
    });
    </script>
-->

<script>
var i=0;
let x=0;
var res;
var happy=0,sad=0,anger=0;
    var ans=[];
    const ques=["How are you feeling?",
                    "How has you mood been in the past few weeks ?",
                    "What is your opinion about your elders/superiors?",
                    "What comes to your mind when you think about your job?",
                    "How do you discribe what the girl's doing in this picture?",
                    "How have your relations been with your significant one recently ?",
                    "What do you think about while showering ?"];
    let choice=null;
    $(document).ready(function(){
        $("#finish").hide();
        $("#thank").hide();
        $("#paint").hide();
        $("#question").hide();
        $("#nextq").hide();
        $("#ans").hide();
        $("#choice").hide();
        $("#ch1").hide();
        $("#ch2").hide();
        $("#welbtn").click(function(){
            $("#welcome").hide("slow");
            $("#welbtn").hide("slow");
            $("#choice").show("slow");
            $("#ch1").show("slow");
            $("#ch2").show("slow");
        });
        $("#ch1").click(function(){
            $("#choice").hide("slow");
            $("#ch1").hide("slow");
            $("#ch2").hide("slow");
            $("#ans").show();
            $("#nextq").show();
            i=1;
            showing1();
        });
        $("#ch2").click(function(){
            $("#choice").hide("slow");
            $("#ch1").hide("slow");
            $("#ch2").hide("slow");
            $("#nextq").show();
            showing2();
        });
    });
    $("#finish").click(function(){
                    face();
                    $("#finish").hide("slow");
                    $("#thank").show("slow");
                    $("#question").hide("slow");
                    $("#ans").hide("slow");
                    $('#result').html(res);
                    $('#result').show("slow");
                })
    let next = document.querySelector("#nextq");
    next.addEventListener("click",()=>{
        if(i==1)
        {
            $("#paint").hide();
            if(x==4)
            $("#paint").show();
            if(x==6)
            {
                $("#nextq").hide();
                $("#finish").show();
            }
                var n=1;
                var answer=document.querySelector("#ans").value;
                if(answer==null)
                {
                    alert("Answer is null");
                    n=0;
                }
                if(n==1)
                {
                    ans.push(answer);
                    console.log(ans[x-1])
                }
                $("#question").show();
                $("#question").html(ques[x]);
                x++;
        }
        else
        {
            $("#paint").hide();
            if(x==4)
            $("#paint").show();
            if(x==6)
            {
                $("#nextq").hide();
                $("#finish").show();
            }
            $("#question").show();
                $("#question").html(ques[x]);
                x++;
        }
        
            }
            )
    function showing1()
    {
        $(document).ready(function(){
            $("#question").show();
            $("#question").html(ques[x]);
            x++
        })
    }
    function showing2()
    {
        $(document).ready(function(){
            $("#question").show();
            $("#question").html(ques[x]);
            x++
        })
    }
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