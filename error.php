<html>

<head>
    <title>Server Maintenance</title>
    <style>
        #mainContent {
            display: flex;
            flex-direction: column;
            justify-content: center;
            justify-items: center;
            align-items: center;
        }

        #vidContainer {
            display: flex;
            justify-content: center;
            background-color: rgb(255, 166, 0);
            width: 100%;
        }

        #msgHeading {
            font-family: 'Alfa Slab One', cursive;
            font-size: 3em;
        }

        #msgMain {
            font-family: 'Kanit', cursive;
            font-size: 1.5em;
        }

        .maint {
            margin: 3%;
            width: 30%;
        }

        .vert {
            width: 15%;
        }

        #footer {
            display: flex;
            position: relative;
            bottom: -100px;
            justify-content: center;
            font-size: .6em;
            font-family: Arial, Helvetica, sans-serif;
        }
        .flipH {
            transform: scale(-1, 1);
            -moz-transform: scale(-1, 1);
            -webkit-transform: scale(-1, 1);
            -o-transform: scale(-1, 1);
            -ms-transform: scale(-1, 1);
            transform: scale(-1, 1);
            }
    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Kanit&display=swap" rel="stylesheet">
</head>
<?
$status = $_SERVER['REDIRECT_STATUS'];
$codes = array(
    403 => array('403 Forbidden', 'The server has refused to fulfill your request.'),
    404 => array('404 Not Found', 'The document/file requested was not found on this server.'),
    405 => array('405 Method Not Allowed', 'The method specified in the Request-Line is not allowed for the specified resource.'),
    408 => array('408 Request Timeout', 'Your browser failed to send a request in the time allowed by the server.'),
    500 => array('500 Internal Server Error', 'The request was unsuccessful due to an unexpected condition encountered by the server.'),
    502 => array('502 Bad Gateway', 'The server received an invalid response from the upstream server while trying to fulfill the request.'),
    504 => array('504 Gateway Timeout', 'The upstream server failed to send a request in the time allowed by the server.'),
);

$title = $codes[$status][0];
$message = $codes[$status][1];
if ($title == false || strlen($status) != 3) {
    $message = 'Please supply a valid status code.';
}

?>

<body>
    <div id="mainContent">
        <div class="ctr" id="vidContainer">

        </div>
        <div class="ctr" id="msgHeading">

        </div>
        <div class="ctr" id="msgMain">

        </div>
    </div>
    <div id="footer">
        <div class="ctr" id="time">
            <?
            echo '<h1>' . $title . '</h1>
<p>' . $message . '</p>';
            ?>
        </div>
    </div>
    <script>
        window.addEventListener('load', (e) => {
            let mc = document.querySelector('#vidContainer')
            let msgHd = document.querySelector('#msgHeading')
            let msgMain = document.querySelector('#msgMain')
            let d = new Date()
            let time = d.getTime()
            switch (time % 2) {
                case 0:
                    mc.innerHTML = `<img class="maint ctr" width="80%" src="img/serverMaintenance.gif">`
                    msgHd.innerHTML = `<h2>Server Maintenance</h2>`
                    msgMain.innerHTML = `We'll be back up shortly`
                    break;
                case 1:
                    mc.innerHTML = `<img class="maint vert" src="img/teamwork.png">`
                    msgHd.innerHTML = `<h2>Something happened</h2>`
                    msgMain.innerHTML = `But we've got our best people on it`
                    break;
                default:
                    mc.innerHTML = `<img src="img/onstrike.jpg">`
                    msgHd.innerHTML = `<h2>The electrons are on strike</h2>`
                    msgMain.innerHTML = `<p class="flipH">But we got some antielectrons to fill in</P>`

            }
            let timeslot = document.querySelector("#time")
            timeslot.innerHTML = d
        })
    </script>

</body>

</html>