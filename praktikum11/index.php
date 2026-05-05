<?php 

    session_start();

    if(!isset($_SESSION['current_login'])) {
        header("Location: login.php?message=". urlencode("Mengakses fitur harus login dulu."));
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Russo+One&display=swap");

        svg {
            font-family: "Russo One", sans-serif;
            width: 100%;
            height: 100%;
        }

        svg text {
            animation: stroke 5s infinite alternate;
            stroke-width: 2;
            stroke: #365FA0;
            font-size: 117px;
        }

        @keyframes stroke {
            0% {
                fill: rgba(72,138,204,0);
                stroke: rgba(54,95,160,1);
                stroke-dashoffset: 25%;
                stroke-dasharray: 0 50%;
                stroke-width: 2;
            }
            70% {
                fill: rgba(72,138,204,0);
                stroke: rgba(54,95,160,1);
            }
            80% {
                fill: rgba(72,138,204,0);
                stroke: rgba(54,95,160,1);
                stroke-width: 3;
            }
            100% {
                fill: rgba(72,138,204,1);
                stroke: rgba(54,95,160,0);
                stroke-dashoffset: -25%;
                stroke-dasharray: 50% 0;
                stroke-width: 0;
            }
        }

        .wrapper {
            background-color: #FFFFFF;
        }
    </style>
    <title>Document</title>
</head>
<body>
    <div class="wrapper">
    <svg>
        <text x="50%" y="50%" dy=".35em" text-anchor="middle">
            YOU KACANG
        </text>
    </svg>
</div>
</body>
</html>