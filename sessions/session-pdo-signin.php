<?php ?>
<!DOCTYPE html>
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
        	background: #F5512E;
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
        	border-left: 16px solid #F5512E;
        	line-height: 1em;
        	padding-left: 15px;
        	transition: border-left 1s;
        	color: #333;
        }
        .main-window h2:hover{
        	border-left: 160px solid #F5512E;

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
        	background: #F5512E;
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
        	left:750px;
        	bottom:200px;
        	font-size: 18px;
        }
        .text:hover{
        	color:#F5512E;
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
        .main-window .area p#signup {
        	text-color: white;
        	text-decoration: none;
        }
        .main-window .area a {
        	text-decoration: none;
        }
        .main-window .area a:hover {
        	text-decoration: none;
        	color: #F5512E;
        }

		</style>
			<title>Sklepik</title>
	</head>

	<body>
    <div class="main-window">    	
    <form action="session-pdo-signin.php" method="post">   
    <h2>Sign in</h2>

    <!--Numer operacji: <input type="text" name="numboper"> <br> <br>-->


    <div class="area">
    <input type="text" name="login" placeholder="Login / email">
    </div>

    <div class="area">
	<input type="password" name="password" placeholder="Password">
    </div>

    <div class="area">
	<input type="submit" name="submit" value="Check" id="btn">
	<p id="signup">Don't have an account? <a href="formularz-registration.php">Sign up</a></p>
    </div>

	</form> 
    </div>

    <!-------- php code part -------->
    <div class="PHP">

    <!--
    <div class="text2">
    	<p id="txt"><p> Laptop </p> <p> Computer </p> <p> Phone </p> <p> TV </p> <p> Monitor </p> <p> Printer </p> <p> Scanner </p> <p> Tablet </p> <p> Router </p> <p> Videocard </p>
    </div>-->
    
	<?php

	function redirect($adress)
	{
		ob_start();
		header("Location: ".$adress);
		ob_end_flush();
	}

	// Removing confirm submission on refresh	
	if (!isset($_SESSION)){
		session_start();
	}

	if($_SERVER['REQUEST_METHOD']=='POST'){
		$_SESSION['postdata']=$_POST;
		unset($_POST);
		header("Location: ".$_SERVER['REQUEST_URI']);
		exit;
	}	

	if (@$_SESSION['postdata']){
		$_POST=$_SESSION['postdata'];
		unset($_SESSION['postdata']);
	}

	if(!isset($_SESSION)){$_SESSION['status']=0;} // sign in or not	
	

	// Checking is it empty for send to the db
	// if(!empty($_POST)) setcookie("last_post", implode($_POST), time()+360);
	// if(!empty($_POST) and $_COOKIE["last_post"]==implode($_POST)) $_POST=[];

	// -- -- 
	try{

		$pdo = new PDO('mysql:host=localhost; dbname=database-technikum', 'root');

		if(isset($_POST['submit']))
		{
		
			$login=trim($_POST['login']); 	if(!isset($login)){throw new Exception("Login isnt a real");}
    		$password=trim($_POST['password']); 	if(!isset($login)){throw new Exception("Password isnt a real");}
    		$sesid=session_id();



    		if(($login == "" or $password=="") or (!isset($login) or !isset($password)))
    		{
				$pdo=null;
				if(($login=="" or !isset($login)) and isset($password) ){
					throw new Exception("You didn't write a login");
				}
				if(($password=="" or !isset($password)) and isset($password)){
					throw new Exception("You didn't write a password");
				}
				if($login=="" and $password=="") {
					throw new Exception("You didn't write login and password");
				}
			}

			// Requests to SQL
			if(isset($pdo)){
				//$insert = $pdo->exec("INSERT INTO signin (login, password, sessionid) VALUES ('$login', '$password', '$sesid')");
				$check = $pdo->query("SELECT * FROM signin WHERE login='$login' AND password='$password'");
				// $insert = $pdo->exec("INSERT INTO signin (login, password, sessionid) VALUES ('admin', 'password', 'session-id')");
				// $update = $pdo->exec("UPDATE signin SET login=$login, password=$password, sessionid=$sesid WHERE id=1");

				if($check==false){throw new Exception("Login or password is another, try again!");	}		
				var_dump(	$check); echo "<br>!<br><br>";
								if(isset($check) and $check==true)
				{
					$_SESSION['status']=1;
					if($_SESSION['status']==1){		/*redirect("session-pdo-result.php");*/		}
				}
				else { throw new Exception("Error while checking, please try again");}
				
			}
			else {
				throw new Exception("Errow while connection whith db");
			}
			    	
		}
		$pdo=null;
		
	}
	catch(Exception $ex){
		echo $ex->getMessage();
	}
	
    ?>
    </div>
    </div>
    <br><br>
    <p style="position: relative; top: 60px;"> Made by David Krikovtsov </p>

	</body>
</html>
