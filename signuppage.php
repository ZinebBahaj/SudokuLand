<?php
include('cnnx.php');
if($_SERVER['REQUEST_METHOD']==='POST'){
    $nickname=$_POST['nickname'];
    $birthdate=$_POST['birthdate'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $confirm_password=$_POST['confirm_password'];
    $successmsg="";
    $emailmsg="";
    $passwdmsg="";
    $fillingmsg="";
    $maxcharmsg="";
    if(empty($nickname)||empty($birthdate)||empty($email)||empty($password)||empty($confirm_password)){
          $fillingmsg="Please make sure you filled every field !";
    }
    else{
        if(strlen($nickname)>15){
            $maxcharmsg="Nickname must not exceed 15 characters";
        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $emailmsg="Please enter a valid email";
        }
        if($confirm_password !== $password){
            $passwdmsg="Password confirmation failed";
        }
        $sql=$conn->prepare("SELECT id FROM users WHERE email=?");
        $sql->execute([$email]);
        $id=$sql->fetchColumn();
        if(!empty($id)){
            $fillingmsg="The Email $email is already registered";
        }
    }
    if(empty($fillingmsg)&&empty($emailmsg)&&empty($passwdmsg)&&empty($maxcharmsg)){
        $sql= "INSERT INTO users (nickname,birthdate,email,ppassword,pfp) VALUES ('$nickname','$birthdate','$email','$password','assets/pfp.jpeg')";
        $conn->exec($sql);
        $successmsg="Signed up successfully !";
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/svg+xml" href="assets/icon.png">
        <title>SudokuLand - SignUp</title>
        <style>
            @font-face{
                font-family: 'Gliker';
                src: url(assets/gliker-regular-expanded/gliker-regular-expanded.ttf) format('truetype');
            }
            body {
                background-image:url("assets/background.png");
                background-size:1530px 758px;
                background-repeat:no-repeat;
                background-attachment:scroll;
                background-color: #426f93;
                font-family: Arial, sans-serif;
                padding-top: 130px;
            }
            .header_button {
                margin-top: 20px;
                font-size: 16px;
                background-color: #3486b9;
                color: white;
                border: none;
                border-radius: 50px;
                cursor: pointer;
                font-family: gliker,cursive;
                padding: 10px;
                position: fixed;
                top: 10px;
                right: 20px;
            }
            .signup_button {
                margin-top: 20px;
                font-size: 16px;
                background-color: #3486b9;
                color: white;
                border: none;
                border-radius: 50px;
                cursor: pointer;
                font-family: gliker,cursive;
                padding: 10px;
            }
            .centerthings{
                display: flex;
                justify-content: center;
            }
            input{
                width: 50%;
                padding: 10px;
                margin: 10px;
                border: 2px ;
                border-radius: 10px;
                font-family: Arial, sans-serif;
                background-color: #426e936f;
            }
            label{
                font-family: gliker,cursive;
                color: black;
                font-weight:lighter;
            }
            .formdiv{
                width:50%;
                height: 50%; 
                margin: 0 auto; 
                text-align:center; 
                background-color: #ffffff00; 
                padding: 20px;
                border:solid #193c66;
                border-width:10%;
                border-radius: 20px;
                box-shadow:#426f93 6px 6px 12px;
            }
            button:hover{
                background-color: #193c66;
                color: #D6E3F1;
                box-shadow: #193c66 2px 2px 10px;
            }
            input:hover{
                background-color: #426e936f;
                box-shadow: #193c66 2px 2px 10px;
            }
            .menubars{
                cursor: pointer;
                position: fixed;
                top: 5px;
                left: 20px;
                font-size: 32px;
                z-index: 1001;
            }
            .menubars:hover{
                text-shadow: 2px 2px 10px #0c1117;
            }
            .menulinks a:hover{
                background-color: #193c66a6;
                color: #D6E3F1;
                box-shadow: #193c66 2px 2px 10px;
                backdrop-filter: blur(10px);
            }
            .sidebar{
                position: fixed;
                top: 0;
                left: -220px;
                height: 100%;
                width: 220px;
                background: rgba(66,110,147,0.75);
                backdrop-filter: blur(10px);
                box-shadow: 3px 0 10px rgba(0,0,0,0.2);
                padding-top: 80px;
                transition: left 0.3s ease;
                z-index: 1000;
            }
            .sidebar a{
                display:block;
                color:white;
                padding:20px;
                text-decoration:none;
                font-family:gliker,cursive;
            }
            .userinfo{
                display:flex;
                justify-content:center;
                align-items:center;
                height:80px;
            }
        </style>
    </head>
    <body>
        <div style="display:flex; position:fixed; top:10px; margin-left:4.2%;" id="logo">
            <img src="assets/logo1.png" alt="SudokuLand Logo" style="height:70px; width:auto;">
        </div>
        <div>
            <h1 class="menubars" onclick="openclosemenu()">☰</h1>
        </div>
        <div class="loginbutton">
            <a href="loginpage.php"><button class="header_button">Login</button></a>
        </div>
        <div class="sidebarcontainer">
            <div id="sidebar" class="sidebar">
            <div class="menulinks">
                <a href="index.php">✏️ Homepage</a>
                <a href="signuppage.php" id="gustsgn">✏️ Sign Up</a>
                <a href="loginpage.php" id="gustlgn">✏️ Login</a>
                <a href="gamepage.php">✏️ Play</a>
                <a href="solverpage.php">✏️ Solver</a>
                <a href="historypage.html">✏️ History</a>
                <a href="techniquespage.html">✏️ Techniques</a>
            </div>
        </div>
        <div class="formdiv">
            <h2 style="color:black; font-family:gliker,cursive;">Signup and start your journey!</h2>
            <form method="post" action="">
                <div>
                    <label for="nickname">Nickname:</label>
                    <input type="text" name="nickname" id="nickname" placeholder="Enter your Nickname" maxlength="15" required>
                    <p style="color: red; font-size: 10px;"><?php if(!empty($maxcharmsg)){echo "$maxcharmsg";} ?></p>
                </div>
                <div>
                    <label for="date">BirthDate:</label>
                    <input type="date" name="birthdate" id="date">
                </div>
                <div>
                    <label for="email">E-mail:</label> 
                    <input type="email" name="email" id="email" placeholder="XXXXXX@XXXXX.XXX">
                    <p style="color: red; font-size: 10px;"><?php if(!empty($emailmsg)){echo "$emailmsg";} ?></p>
                </div>
                <div>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" placeholder="Enter your Password" min="1" max="20">
                    <p style="color: red; font-size: 10px;"><?php if(!empty($passwdmsg)){echo "$passwdmsg";} ?></p>
                </div>
                <div>
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your Password" min="1" max="20">
                    <p style="color: red; font-size: 10px;"><?php if(!empty($passwdmsg)){echo "$passwdmsg";} ?></p>
                </div>
                <button type="submit" class="signup_button" name="submit">SignUp</button>
                <p style="color: green;"><?php if(!empty($successmsg)){echo "$successmsg";}?></p>
                <p style="color: red;"><?php if(!empty($fillingmsg)){echo "$fillingmsg";} ?></p>
            </form>
        </div>
        <script>
            function openclosemenu(){
                if(document.getElementById("sidebar").style.left === "0px"){
                    document.getElementById("sidebar").style.left = "-220px";
                    document.getElementById("logo").style.marginLeft = "4.2%";
                    document.getElementById("logo").style.transition = "margin-left 0.3s ease";
                } else {
                    document.getElementById("sidebar").style.left = "0px";
                    document.getElementById("logo").style.marginLeft = "220px";
                    document.getElementById("logo").style.transition = "margin-left 0.3s ease";
                }
            }
        </script>
    </body>
</html>