<?php
session_start();
include('cnnx.php');
if(isset($_SESSION['email'])){
    $sql=$conn->prepare("SELECT nickname,birthdate,pfp,current_chart,progress,mistakes FROM users LEFT JOIN filling_process ON users.id = filling_process.users_id LEFT JOIN charts ON filling_process.charts_id = charts.id WHERE email = ?");
    $sql->execute(array($_SESSION["email"]));
    $row=$sql->fetchAll();
    echo "<script>
                function checklogin(){
                    return true;
                }
          </script>";
}
else{
    echo "<script>
                function checklogin(){
                    return false;
                }
          </script>";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>SudokuLand</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" type="image/svg+xml" href="assets/icon.png">
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
                padding-top: 112px;
            }
            .logo{
                width:60%;
                height:auto;
                display: block; 
                margin: 0 auto;
            }
            button {
                margin-top: 20px;
                font-size: 16px;
                background-color: #3486b9;
                color: white;
                border: none;
                border-radius: 50px;
                cursor: pointer;
                font-family: gliker,cursive;
            }
            .centerthings{
                display: flex;
                justify-content: center;
            }
            p,h1{
                text-align: center;
                margin-left: 0px;
                font-family:gliker,cursive;
            }
            .menubars{
                cursor: pointer;
                position: fixed;
                top: 5px;
                left: 20px;
                font-size: 32px;
            }
            .menubars:hover{
                text-shadow: 2px 2px 10px #0c1117;
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
            button:hover{
                background-color: #193c66;
                color: #D6E3F1;
                box-shadow: #193c66 2px 2px 10px;
            }
            .menulinks a:hover{
                background-color: #193c66a6;
                color: #D6E3F1;
                box-shadow: #193c66 2px 2px 10px;
                backdrop-filter: blur(10px);
            }
            .progressbar{
                width: 45%;
                height: 30px;
                background-color: #193c6668;
                border-radius: 20px;
                margin: auto;
                margin-top: 50px;
            }
            .progress{
                height: 100%;
                width: 40%;
                background-color: #193c66;
                border-radius: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                font-family: gliker, cursive;
                transition: width 0.3s ease;
            }
            .pourcentage{
                margin-left: 70%;
                color: white;
                font-family: gliker,cursive;
            }
        </style>
    </head>
    <body>
        <div class="sidebarcontainer">
            <div id="sidebar" class="sidebar">
                <div class="userinfo" id="userinfo">
                   <h1 id="username"></h1>
                </div>
                <div class="userinfo" id="pfp">
                    <img src="assets/Pfp.jpeg"style="height:70px; width:auto; border-radius:50%; border: 2px solid #193c66;">
                </div>
            <div class="menulinks">
                <a href="index.php">✏️ Homepage</a>
                <a href="signuppage.php" id="gustsgn">✏️ Sign Up</a>
                <a href="loginpage.php" id="gustlgn">✏️ Login</a>
                <a href="gamepage.php">✏️ Play</a>
                <a href="solverpage.php">✏️ Solver</a>
                <a href="historypage.html">✏️ History</a>
                <a href="techniquespage.html">✏️ Techniques</a>
                <a href="logout.php" id="gustlgt">✏️ Logout</a>
            </div>
        </div>
        <div>
            <h1 class="menubars" onclick="openclosemenu()">☰</h1>
        </div>
        <div style="display:flex; position:fixed; right:20px; top:10px; gap:10px;" id="buttons">
            <a href="signuppage.php"><button style="padding:10px">Sign Up</button></a> <a href="loginpage.php"> <button style="padding:10px">Login</button></a>
        </div>
        <img src="assets/logo1.png" alt="SudokuLand Logo" class="logo">
        <div>
            <div id="guest">
                <p>Hello! Sign up and start your Sudoku journey!</p>
            </div>
            <div id="user">
                <p id="hometext"></p>
                <div class="progressbar">
                    <div class="progress">
                         <p class="pourcentage" id="PBtext">40%</p>
                    </div>
                </div>    
            </div>
        </div>
        <div style="margin-top: 50px;" class="centerthings">
            <a href="gamepage.php"><button style="padding:30px 40px; margin-right: 10px;" type="submit">Play Sudoku</button></a> <a href="solverpage.php"><button style="padding:30px 40px; margin-left: 10px;" type="submit">Sudoku Solver</button></a>
        </div>
        <footer>
            <ul style="font-family:consolas,cursive; font-weight: lighter; margin-left:220px; margin-top: 197px;"> contact info:
                <li>📧 <a href="https://mail.google.com/mail/?view=cm&to=zinebbahaj24434@gmail.com" target="_blank">zinebbahaj24434@gmail.com</a></li>
                <li>📞 <a href="https://wa.me/212635573323" target="_blank">+212 635-573323</a></li>
            </ul>
        <p class="centerthings" style="font-family:consolas; font-weight: lighter;">© 2026 SudokuLand — Developed by Zineb Bahaj</p>
        </footer>
        <script>
            function fituserguestname(){
                document.getElementById("username").style.fontSize = "32px";
                while(document.getElementById("username").scrollWidth >= document.getElementById("userinfo").clientWidth){
                    document.getElementById("username").style.fontSize = (parseInt(document.getElementById("username").style.fontSize) - 1) + "px";
                }
                document.getElementById("username").style.fontSize = (parseInt(document.getElementById("username").style.fontSize) - 11) + "px";
            }
            function showuser(username,progress){
                document.getElementById("guest").style.display = "none";
                document.getElementById("user").style.display = "block";
                document.getElementById("hometext").innerHTML ="Welcome back dear "+username+" ! Your current progress is at "+progress+"% , keep it up !";
                document.getElementById("PBtext").innerHTML = progress+"%";
                document.querySelector(".progress").style.width = progress+"%";
                document.getElementById("buttons").style.display = "none";
                document.getElementById("username").innerText = username;
                document.getElementById("gustsgn").style.display = "none";
                document.getElementById("gustlgn").style.display = "none";
                document.getElementsByTagName("footer")[0].style.marginTop = "200px";
                fituserguestname();
            }
            function showguest(){
                document.getElementById("guest").style.display = "block";
                document.getElementById("user").style.display = "none";
                document.getElementById("pfp").style.display = "none";
                document.getElementsByTagName("footer")[0].style.marginTop = "277px";
                document.getElementById("username").innerText = "Guest";
                document.getElementById("gustlgt").style.display="none";
                fituserguestname();
            }
            function openclosemenu(){
                if(document.getElementById("sidebar").style.left === "0px"){
                    document.getElementById("sidebar").style.left = "-220px";
                } else {
                    document.getElementById("sidebar").style.left = "0px";
                }
            }
            <?php if(isset($_SESSION['email'])){ ?>
                const username = "<?php echo $row[0]['nickname']; ?>";
                const progress = "<?php echo $row[0]['progress']; ?>";
                showuser(username, progress);
            <?php } else { ?>
                showguest();
            <?php } ?>
        </script>
    </body> 
</html>