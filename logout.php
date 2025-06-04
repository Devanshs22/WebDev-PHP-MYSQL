<?phpMore actions
session_start();
session_unset();
session_destroy();
header("Location: login.html");
exit();
?>

<!DOCTYPE html>
<html land="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Logout</title>
        <style>
            body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

            .logout h2{
            
                  font-size: 30px;
                  
            }
            h4{
                font-size: 20px;
            }
            a {
                text-decoration: none;
                color: black;
            }
            button{
                text-decoration: none;
                font-size: 15px;
                color: white;
                padding: 7px;
                margin: 12px;
                background-color: lightgreen;
                

            }


            </style>

</head>
<body>
    <div class="logout">
        <h2>Logout Successfull!</h2>
</div>
<div>
    <h4> For Login Again! </h4>
    <button>  <a href="login.html" class="lbtn">LOGIN</a> </button>
        </div>
        </body>
        </html>
