
<html>
<style>
body{
	background-color: #26C281 !important;
}
#main{
	position: relative;
	top: 40px;
}
button{
	border-radius: 0px;
	border:none;
  	margin:auto !important;
  	display:block !important;
  	background-color: #19B5FE;
  	font-weight: bold !important;
  	color: white !important;
}
h3{text-align: center;
	font-family: 'Signika Negative', sans-serif !important;
	font-weight: bold !important;
	font-size: 40px !important;
	color: white !important;}
#newClient{
	font-family: helvetica;
	font-size: 24px;
	color: #e9d460;
}
h4{text-align: center;}
#h4port{
	position: relative;
	right: 10px;
}
#port{
	position: relative;
	left: 22px;
}
#divider{
	display: inline-block;
	color: #95A5A6 !important;
	font-family: helvetica;
	font-weight: lighter !important;
	font-size: 35px;
}
h5{text-align: center;}
</style>

<head>
	<title>HaOS</title>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 <link href="https://fonts.googleapis.com/css?family=Signika+Negative" rel="stylesheet">
</head>


<script
  src="https://code.jquery.com/jquery-3.2.1.js"
  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
  crossorigin="anonymous"></script>
<div id="main">
<header>
<h3>HaOS<div id= "divider">|</div><small id="newClient">New Client</small></h3>
</header>
<body>

<h4>User Id: <input type='text' id='user_id'></h4>
<h4 id="h4port">Port: <input type='text' id='port'></h4>
<div><button onclick='connect()'>Connect</button></div>
<h5 style='color:red;display:none' id='error'>Connection Failed</h5>
<div>
</body>

</html>