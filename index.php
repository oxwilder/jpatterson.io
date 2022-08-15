<?
require 'includes/apptop.php';
?>
<html lang="en">
<!--<![endif]-->
<!-- HEAD SECTION -->

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
	<title><?= MYNAME . ' | ' . POSITION; ?></title>
	<!--GOOGLE FONT -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<!--BOOTSTRAP MAIN STYLES -->
	<link href="assets/css/bootstrap.css" rel="stylesheet" />
	<!--FONTAWESOME MAIN STYLE -->
	<link href="assets/css/font-awesome.min.css" rel="stylesheet" />
	<!--CUSTOM STYLE -->
	<link href="assets/css/style.css" rel="stylesheet" />
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
	<style>
		.img-circle {
			height: 35%;
		}

		.bump {
			position: relative;
			left: -54%;
		}
		.accent {
			color: rgb(0,94,128);
		}
		.caps {
			text-transform: uppercase;
		}
		#email-btn {
			background-color: transparent;
			border-style: none;
		}
		#email-img {
			height: 2em;
		}
	</style>
</head>
<!--END HEAD SECTION -->

<body>
	<!-- NAV SECTION -->
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><?= MYNAME; ?></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-right">
					<li><a href="#header-section">HOME</a></li>
					<li><a href="#about-section">ABOUT</a></li>
					<li><a href="#products-section">MY WORK</a></li>
					<li><a href="#contact-section">HIRE ME</a></li>
					<li><a href="#contact-section">CONTACT</a></li>
					<li><a href="#resume">VIEW RESUME</a></li>

				</ul>
			</div>

		</div>
	</div>
	<!--END NAV SECTION -->
	<!-- HEADER SECTION -->
	<div id="header-section">
		<div class="container">
			<div class="row centered">
				<div class="col-md-8 col-md-offset-2">
					<h1><strong> <?= MYNAME; ?></strong>

					</h1>
					<br> <br> <br>
					<h2> <?= POSITION ?></h2>
					<br>
					<a href="#about-section"> <i class="fa fa-angle-double-down fa-5x down-icon"></i> </a>
				</div>
			</div>

		</div>

	</div>
	<!--END HEADER SECTION -->
	<!--ABOUT SECTION -->
	<div id="about-section">
		<div class="container">
			<div class="row main-top-margin text-center">
				<div class="col-md-8 col-md-offset-2 " data-scrollreveal="enter top and move 100px, wait 0.3s">
					<h1>Who Am I ?</h1>
					<h4>
						I'm a Full Stack Developer with a strong SQL background, years of experience in the automotive industry, and sense enough not to microwave fish in the breakroom microwave.
					</h4>
				</div>
			</div>
			<!-- ./ Main Heading-->
			<div class="row main-low-margin text-center">
				<div class="col-md-3 " data-scrollreveal="enter left and move 100px, wait 0.4s">
					<img class="img-circle" src="/img/jpatterson-circ.png" alt="">
					<h4><strong><?= MYNAME; ?></strong> </h4>
					<p>
						Love to put on a sweater and sit in front of a camera

					</p>
					<p>
						<a href="<?= LINKEDIN ?>"><i class="fa fa-linkedin-square fa-2x color-linkedin"></i></a>

					</p>

				</div>

				<div class="col-md-7 col-sm-7 col-md-offset-1  text-justify" data-scrollreveal="enter right and move 100px, wait 0.4s">
					<h3> Key Skills</h3>
					<p>
						PHP • JavaScript • jQuery • Python • VB • PowerShell • HTML5 • CSS3 • Bootstrap • JSON • XML • Microsoft SQL • MySQL • IBM DB2 • Docker • Google Cloud Platform • Agile (Jira, Azure DevOps) • Git • Photoshop
					</p>

				</div>
			</div>
			<!-- ./ Row Content-->
		</div>
	</div>
	<!-- END ABOUT SECTION -->
	<!-- Experience -->
	<div id="resume" class="container experience">
		<BR><BR>
	<? 
		$bullets = ['Create and document Google Cloud Functions in Python, frontend and backend solutions in PHP and JavaScript (HTML5 and CSS3), and design and manage data structures, functions, and stored procedures in MySQL.', 
		'Integrate Google Maps API for address verification in order to reduce lost or returned shipments. ',
		'Integrate EasyPost API and store JSON objects to facilitate shipping label creation, label refunds, and international shipping. Created executable installer to help new developers set up Node and Grunt.JS.',
		'Create dynamic XML file for Google Merchant Center product reviews.'
		];
		echo experience('Z1 Motorsports',POSITION,'AUG 2021','AUG 2022',$bullets);
		unset($bullets);
		$bullets = [
			'Developed multi-step procedure for determining delegation of authority for DocuSign recipients based on organizational hierarchy using Microsoft T-SQL and VBA scripting. (Contract position)'
		];
		echo experience('Asbury Automotive','SQL Developer','OCT 2019','NOV 2019',$bullets);
		unset($bullets);

		$bullets = [
			'Managed vehicle service contract rating application using DB2 for IBM iSeries/AS400, T-SQL, and SSIS packages, and VBA to manage data and ETL.',
			'Identified method to maximize vehicle database efficiency, eliminating gigabytes of redundant data and reducing execution time of dependent stored procedures.',
		];
		echo experience('Revolos','Rating Systems Analyst','APRIL 2018','APRIL 2019',$bullets);
		unset($bullets);

		$bullets = [
			'Created procedure to collate Motor data and replace industry-standard abbreviations with more accessible plain language for search engine optimization using Microsoft SQL Server.',
			'Developed SSIS packages to facilitate regular data import improving former manual method and reducing time spent by at least 90%.',
			'Created VB application to convert proprietary data files into flat files for faster and more reliable loading into database.
			',
		];
		echo experience('SimplePart','SQL Developer','APRIL 2016','APRIL 2018',$bullets);
		unset($bullets);
	?>
	</div>
	<div class="container education">

	</div>

	<!--WORK/PRODUCTS SECTION -->
	<div id="products-section">
		<div class="container">
			<div class="row main-top-margin text-center" data-scrollreveal="enter top and move 100px, wait 0.3s">
				<div class="col-md-8 col-md-offset-2 ">
					<h1>What I'm Working On</h1>
					<h4>
						An incomplete look at the sort of incomplete project I completely enjoy
					</h4>
				</div>
			</div>
			<!-- ./ Main Heading-->
			<hr />
			<div class="row main-low-margin">
				<div class="col-md-10  col-md-offset-1 ">
					<div class="col-md-6 col-sm-6" data-scrollreveal="enter left and move 100px, wait 0.8s">
						<img class="" src="/img/helloworldspeedo.jpg" alt="">
					</div>
					<div class="col-md-6 " data-scrollreveal="enter right and move 100px, wait 0.4s">
						<h4>
							<strong class="color-red">Can Bus hacking</strong>
						</h4>
						<p>
							I recently replaced the head unit in my 2016 Tundra with a post-facelift (read: fancier) model year stereo, and in my research found that in order for this to work I'd need to replace the factory amp with a later model. To avoid the cost, I looked into the reason the amp swap was necessary and found that they operate on different commands in the can bus.
						</p>
						<p>
							Each node in the can bus network has a built-in database of little packets that contain commands, and for two units to communicate they must have the same db. It's possible with a Raspberry Pi or Arduino equipped with the right serial interface and some specialized software to sniff out and intercept these commands, and rebroadcast different ones. It's like Google Translate for your car's components. It's not just useful for upgrading components, you might also decide to display custom information on your instrument cluster or change how fast your turn signal flashes or any number of customization.
						</p>

					</div>
				</div>

			</div>
			<!-- ./ Row Content-->

		</div>
	</div>
	<!--END WORK/PRODUCTS SECTION -->

	<!--CONTACT SECTION -->
	<div id="contact-section">
		<div class="container">
			<div class="row main-top-margin text-center">
				<div class="col-md-8 col-md-offset-2 " data-scrollreveal="enter top and move 100px, wait 0.3s">
					<h1>Contact / Hire Me</h1>
					<h4>
						Did you find this page from my resume? I'd love to hear from you! I'm interested in a full time position as a developer or data engineer.
					</h4>
				</div>
			</div>
			<!-- ./ Main Heading-->
			<div class="row">
				<div class="col-md-12  col-sm-12 ">
					<div class="col-md-6  " data-scrollreveal="enter left and move 100px, wait 0.4s">
						<h3> My Work Location</h3>
						<hr />
						<p>
							City: Atlanta, GA<br>
							<form action="email-me.php?action=email-link" method="post">
							Email: 	<button id="email-btn" type="submit">
  										<img id="email-img" src="img/email.png">
									</button>  <br>
							</form>
						</p>

					</div>
					<!-- <div class="col-md-6  " data-scrollreveal="enter right and move 100px, wait 0.4s">
						<h3>Drop Me a Line or Hire Me </h3>
						<hr />
						<form action="email-me.php" method="post">
							<div class="row">
								<div class="col-md-6 ">
									<div class="form-group">
										<input type="text" class="form-control" required="required" placeholder="Name" name="name">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<input type="text" class="form-control" required="required" placeholder="Email address" name="email">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-6 ">
									<div class="form-group">
										<input type="text" class="form-control" required="required" placeholder="Subject" name="subject">
									</div>
								</div>
								<div class="col-md-6 ">
									<div class="form-group">
										<input type="text" class="form-control" placeholder="Ref. (IF any)" name="ref">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12 ">
									<div class="form-group">
										<textarea name="message" name="message" required="required" class="form-control" rows="3" placeholder="Message"></textarea>
									</div>
									<div class="form-group">
										<button type="submit" class="btn btn-primary">Submit Request</button>
									</div>
								</div>
							</div>
						</form>
					</div> -->

				</div>
			</div>
			<!-- ./ Row Content-->
		</div>
	</div>
	<!--END CONTACT SECTION -->
	<!--FOOTER SECTION -->
	<div id="footer">
		<div class="container">
			<div class="row ">
				&copy; 2022 jpatterson.io | All Rights Reserved

			</div>

		</div>

	</div>
	<!--END FOOTER SECTION -->
	<!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
	<!-- CORE JQUERY LIBRARY -->
	<script src="assets/js/jquery.js"></script>
	<!-- CORE BOOTSTRAP LIBRARY -->
	<script src="assets/js/bootstrap.min.js"></script>
	<!-- SCROLL REVEL LIBRARY FOR SCROLLING ANIMATIONS-->
	<script src="assets/js/scrollReveal.js"></script>
	<!-- CUSTOM SCRIPT-->
	<script src="assets/js/custom.js"></script>
</body>

</html>