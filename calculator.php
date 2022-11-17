<html>
	<head>
		<link href='https://fonts.googleapis.com/css?family=Inter' rel='stylesheet'>

		<style>

        * {
        	margin: 0;
        	padding: 0;
        	box-sizing: border-box;
        }
        body
        {
        	display: flex;
        	flex-direction: column;
        	position: relative;
        	justify-content: center;
        	align-items: center;
        	min-height: 100vh;
        	background: mediumslateblue;
        	font-family: "Inter", Helvetica, Arial, sans-serif;
        }
        .main-window
        {
        	position: relative;
        	display: flex;
        	flex-direction: column;
        	padding: 50px;
        	background-color:white;
        	width: 500px;  
        	border-radius: 3px;      	
        	box-shadow: 0px 25px 50px rgba(0,0,0,0.1);
        	
        }
        .main-window h2{
        	font-weight: 550;
        	margin-bottom: 12px;
        	border-left: 16px solid mediumslateblue;
        	line-height: 1em;
        	padding-left: 15px;
        	transition: border-left 1s;
        	color: #333;
        }
        .main-window h2:hover{
        	border-left: 160px solid mediumslateblue;

        }
        .main-window .area input
        {
        	position: relative;
        	padding: 12px 15px;
        	margin: 12px 0px;
        	width: 100%;
        	outline: none;
        	box-sizing: border-box;
        	border: 2px solid #555;
        	border-radius: 3px;
        	
        	
        }
        .main-window .area input#btn
        {
        	border: none;
        	cursor: pointer;
        	background: mediumslateblue;
        	color: white;
        	transition: 1s;
        	font-size: 1.1em;
        	font-weight: 500;
        }
        .text
        {
        	position: absolute;
        	color: black;
        	font-size:25px;
        	right:740px;
        	bottom:200px;
        	padding:0px 18px 5px;
        	transition: 2s;
        }
        .text2{
        	position: absolute;
        	left:720px;
        	bottom:200px;
        	font-size: 18px;
        }
        .text:hover{
        	color:mediumslateblue;
        }
        .PHP
        {
        	display:flex;
        	flex-direction: row;
        	justify-content: center;
        	position: relative;
        	top: 30px;
        	width:800px;
        	word-break: keep-all;
        	font-size:25px;
        }
		</style>
			<title>Kalkulator</title>
	</head>
	<body>
    <div class="main-window">    	
    <form action="index.php" method="post">   
    <h2>Wpisz</h2>
    <!--Numer operacji: <input type="text" name="numboper"> <br> <br>-->
    <div class="area">
    <input type="text" name="oper" placeholder="Operacja">
    </div>
    <div class="area">
	<input type="text" name="name" placeholder="Pierwsza liczba">
    </div>
    <div class="area">
	<input type="text" name="email" placeholder="Druga liczba">
    </div>

    <div class="area">
	<input type="submit" value="Check" id="btn">
    </div>

	</form> 
    </div>

    <!-------- php code part -------->
    <div class="PHP">

    
	<div class="text">
	<p> 1. plus; <br> 2. minus;<br>3.&nbspmnozenie;<br> 4.&nbspdzielienie; <br> 5. stopien; <br></p>
    </div>

    <div class="text2">
    	<p id="txt">zeby&nbspdostac&nbspwynik&nbsppotrzebujesz
    	zapisac&nbspw&nbsppierwszej formie numer operacji albo jej nazwe, w drugiej formie ma byc zapisana pierwsza liczba, ktora chcesz policzyc i w trzeciej formie druga liczba, jaka bedzie miedzy operacja i wynikiem, po wszystkiemu nacisnij "Check" i juz masz!</p>
    </div>

	<?php
    $a=$_REQUEST['name'];
    $b=$_REQUEST['email'];
    //$way=$_REQUEST['numboper'];
    $way=$_REQUEST['oper'];

	function plus($a, $b)
	{
	$c=$a+$b;
	echo "$a dodac $b = $c"."<br>";
	}

	function minus($a,$b)
	{
	$c=$a-$b;
	echo "$a odjac $b = $c"."<br>";
	}

	function mul($a,$b)
	{
	$c=$a*$b;
	if($b==1||$b==-1||$b%101==0||$b%201==0||$b%301==0||$b%401==0)
	{
		echo "$a pomnozyc o $b raz = $c"."<br>";
	}
	else
	{
		echo "$a pomnozyc o $b razy = $c"."<br>";
	}
	
	}

	function div($a,$b)
	{
	$c=$a/$b;
	if($b==1||$b==-1||$b%101==0||$b%201==0||$b%301==0||$b%401==0)
	{		echo "$a podzielic o $b raz = $c"."<br>";		}
	else {	echo "$a podzielic o $b razy = $c"."<br>";		}

	}

	function st($a,$b){
	$c=$a**$b;
		echo "$a w stopniu $b = $c"."<br>";
	}	

	function calculator($a, $b, $way)
	{	
		switch($way)
		{
		case "plus":
		case "PLUS":
		case "pLUS":
		case "Plus":
		case 1:
			plus($a,$b);
		break;

		case "minus":
		case "MINUS":
		case "mINUS":
		case "Minus":
		case 2:
	    	minus($a,$b);
	    break;

	    case "mnozenie":
	    case "MNOZENIE":
	    case "mNOZENIE":
	    case "Mnozenie":
	    case 3:
	    	mul($a,$b);
	    break;

	    case "dzielienie":
	    case "DZIELIENIE":
	    case "dZIELIENIE":
	    case "Dzielienie":
	    case 4:
	    	div($a,$b);
	    break;

	    case "stopien":
	    case "STOPIEN":
	    case "sTOPIEN":
	    case "Stopien":
	    case 5:
	    	st($a,$b);
	    break;

	    case "math":
	    echo "Yeah, I also like math, you have found an easter egg";
	    break;

	    default:
	    echo "You didn't choose any option or option is not responsing";		
		}
		
	}

	echo "<br>";
	calculator($a,$b,$way);
	echo "<br>";
    ?>
    </div>
    </div>
    <p style="position: relative; top: 60px;"> Made by David Krikovtsov </p>
	</body>
</html>
