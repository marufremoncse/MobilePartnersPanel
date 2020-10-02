<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <title>404 Not Found</title>

    <style>

        body, html {
            background: #00035d;
            position: relative;
            margin: 0;
            width: 100%;
            height: 100%;
        }

        #mainC {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: #fff;
            font-family: sans-serif;
            max-width: 340px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -o-user-select: none;
            user-select: none;
        }

        .message {
            font-size: 16px;
            text-align: center;
        }

        h1 {
            color: red;
            margin: 0;
            padding: 0;
            font-size: 11em;
            transform: skewY(-5deg);
            transition: 0.4s ease-in-out all;
        }

    </style>


</head>

<body>

<div id="mainC">
    <div class="message">
        <h1>404</h1>
        <h3>the page you seek does not exist</h3>
    </div>
</div>

</body>

</html>
