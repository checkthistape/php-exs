<?php
if(!isset($_SESSION)){
    session_start();
}


if(!isset($_SESSION['cart'])){    $_SESSION['cart']=array();    }
if(isset($_POST['buy'])){   $_SESSION['cart'][] = $_POST['buy'];    }

// if($_POST['buy'] and !isset($_SESSION) or $_SESSION['status']==0){throw new Exception("You are not logged in!");}

?>



<!DOCTYPE html>
<html lang="en-US">
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
        	width: 50%;  
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
        .exit input{
            position: absolute;
            right:3%;
            bottom:94%;
            border: none;
            cursor: pointer;
            background: white;
            color: #F5512E;
            transition: 1s;
            font-size: 1.1em;
            font-weight: 500;
            padding: 12px 15px;
            margin: 12px 0px;
            width: 10%;
            outline: none;
            box-sizing: border-box;
            border: 2px solid white;
            border-radius: 25px;
            box-shadow: 0px 25px 50px rgba(0,0,0,0.1);
        }
        .exit input:hover{
            background: #F5512E;
            color: white;
        }
        .exit #btn2{
            right: 12%;
        }
        .exit #btn2:hover{
            background: #F5512E;
            color: white;
        }
        .addtocart input{
            position: absolute;
            right:3%;
            bottom:94%;
            border: none;
            cursor: pointer;
            background: #F5512E;
            color: black;
            transition: 1s;
            font-size: 1.1em;
            font-weight: 500;
            padding: 12px 15px;
            margin: 12px 0px;
            width: 10%;
            outline: none;
            box-sizing: border-box;
            border: 2px solid white;
            border-radius: 25px;
            box-shadow: 0px 25px 50px rgba(0,0,0,0.1);
        }

		</style>
			<title>Sklepik</title>
	</head>

	<body>
        <?php
        function redirect($adress)
        {
            ob_start();
            header("Location: ".$adress);
            ob_end_flush();
        }

        
        ?>
        <div class="exit">
            <?php if($_SESSION['status']==1)
            {
                if(isset($_POST['exit'])){$_SESSION['status']=0; session_unset(); session_destroy(); redirect("session-pdo-signin.php"); } 
                echo '<form action="session-pdo-result.php" method="post"><input type="submit" name="exit" value="Left" id="btn"></form>';
            }
            if($_SESSION['status']==0) {echo '<a href="session-pdo-signin.php"><input type="button" name="signin" value="Sign in" id="btn"></a>'; $_SESSION['status']=0;}

            ?>
                
        <a href="session-pdo-cart.php"><input type="button" name="cart" value="Cart" id="btn2"></a>          
        </div>
        <br>
    <div class="main-window"> 


    <?php

    

    // connection to database
    $pdo = new PDO('mysql:host=localhost; dbname=database-technikum', 'root');
    $select=$pdo->query('SELECT * FROM products');

    if($pdo)
    {
    	if(isset($select))
    	{
    		foreach($select as $result)
    		{
                ?>

                    <!--<div class="exit">-->
                    <form method="post" action="session-pdo-result.php?action=add&id=<?php echo $result['id']; ?>">
                    <div style="border:1px solid #333; background-color:gray; border-radius:5px; padding:26px; margin: 15px;" align="center">
                        <img src="images/<?php echo $result["image"]; ?>" class="img-responsive" /><br />

                        <h4 class="text-info"><?php echo $result["name"]; ?></h4>

                        <h4 class="text-danger">$ <?php echo $result["price"]; ?></h4>

                        <input type="text" name="quantity" value="1" class="form-control" />

                        <input type="hidden" name="hidden_name" value="<?php echo $result["name"]; ?>" />

                        <input type="hidden" name="hidden_price" value="<?php echo $result["price"]; ?>" />

                        <input type="submit" name="buy" style="margin-top:5px;" class="addtocart" id="addtocart" value="Add to Cart" />

                    </div>
                    </form>
            <!--</div>-->
                <?php
    		}
    	}
    }
    

    if($_SESSION['status'] == 1){
        echo "<br><br>You are logged! Left<br><br>";
    }
    
    ?>	
    </div>

    <!-------- php code part -------->
    <div class="PHP">
            
    </div>        
    <br><br>
    <p style="position: relative; top: 60px;"> Made by David Krikovtsov <br><br><br></p>

	</body>
</html>
