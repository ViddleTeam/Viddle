<html>
<head>
    <script async src="https://arc.io/widget.min.js#oxtrzHwy"></script>
    <link rel="stylesheet" href="style.css" />
    <title>Usuń film z Viddle</title>
    <style>
    input[type=text] {
        width: 225px;
        padding: 12px 20px;
        margin: 8px 0;
        box-sizing: border-box;
    }
    input[type=submit] {
        outline: none;
        margin: 10px;
        height: 50px;
        width: 225px;
    }
    </style>
</head>
<body>
    <center>
    <form action="deletevidsecret.php" method="post">
    <h2>Kod filmu: <input type="text" id="kodf" name="kodf" /></h2>
    <h2>Token zabezpieczający: <input type="text" id="token" name="token" /></h2>
    <input type="submit" value="Usuń film" />
    </form>
    </center>
</body>
</html>
