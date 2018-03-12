<!-- Set Header, Footer, CSS file and Java Script time code. -->
<?php
	class FullScreenLayout
	{
		private $path = '';
		function __construct($newPathString){
			$this->path = $newPathString;
		}

		public function setHeader(){
			$header = '
				<!DOCTYPE html>
				<html lang="en">
					<head>
					    <meta charset="utf-8">
					    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
					    <meta http-equiv="x-ua-compatible" content="ie=edge">

					    <title>Xadapter Assignment</title>

					    <!-- Font Awesome -->
					    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
					    <!-- Bootstrap core CSS -->
					    <link href="'.$this->path.'css/bootstrap.min.css" rel="stylesheet">
					    <!-- Material Design Bootstrap -->
					    <link href="'.$this->path.'css/mdb.min.css" rel="stylesheet">
					    <!-- Your custom styles (optional) -->
					    <link href="'.$this->path.'css/style.css" rel="stylesheet">
					</head>

					<body>

						<!--  top nav bar Just an image -->
						<nav class="navbar navbar-dark" style="background-color: #000; color: #fff;">
						    <a class="navbar-brand" href="index.php">
						        <img src="https://mdbootstrap.com/img/logo/mdb-transparent.png" height="30" alt="">
						    </a>
							<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
							        aria-label="Toggle navigation">
							    <span class="navbar-toggler-icon"></span>
							</button>
						    <div class="collapse navbar-collapse" id="navbarNav">
						        <ul class="navbar-nav">
						            <li class="nav-item active">
						                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
						            </li>
						            <li class="nav-item">
						                <a class="nav-link" href="#">Features</a>
						            </li>
						            <li class="nav-item">
						                <a class="nav-link" href="#">Pricing</a>
						            </li>
						            <li class="nav-item">
						                <a class="nav-link disabled" href="#">Disabled</a>
						            </li>
						        </ul>
						    </div>						    
						</nav>
                
					    <!-- Start your project here-->
					    <div style="height: 100vh; padding-bottom: 1rem;">';

			return $header;
		}


		public function setFooter(){
			$footer = '
					    </div>
					    <!-- /Start your project here-->

					    <!-- SCRIPTS -->
					    <!-- JQuery -->
					    <script type="text/javascript" src="'.$this->path.'js/jquery-3.2.1.min.js"></script>
					    <!-- Bootstrap tooltips -->
					    <script type="text/javascript" src="'.$this->path.'js/popper.min.js"></script>
					    <!-- Bootstrap core JavaScript -->
					    <script type="text/javascript" src="'.$this->path.'js/bootstrap.min.js"></script>
					    <!-- MDB core JavaScript -->
					    <script type="text/javascript" src="'.$this->path.'js/mdb.min.js"></script>
					    <!-- Custom javascript -->
					    <script type="text/javascript" src="'.$this->path.'js/custom_javascript.js"></script>
					</body>
				</html>';

			return $footer;
		}
	}
?>