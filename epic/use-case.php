<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=], initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" type="text/css" href="./style.css"/>
		<link rel="stylesheet" type="text/css"
				href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css"
				href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link href="https://fonts.googleapis.com/css?family=Proza+Libre|Work+Sans" rel="stylesheet">
		<title>Use Case</title>

	</head>
	<body>

		<nav class="navbar navbar-inverse navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-nav-demo"
							  aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a href="#" class="navbar-brand"><span class="fa fa-database"></span> Data Design</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-nav-demo">
					<ul class="nav navbar-nav">
						<li><a href="index.php">Home</a></li>
						<li><a href="jackDeer.php">Persona</a></li>
					</ul>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="use-case.php">Use Case</a></li>
						<li><a href="conceptual-model.php">Conceptual Model</a></li>
					</ul>
				</div>
			</div>
		</nav>

		<div class="container">
			<div class="jumbotron">
				<div class="container">
					<div class="col-xs-12 col-md-12 col-lg-12">
						<h1><i class="fa fa-user"></i></span> <u>Use Case & Interaction-Flow</u></h1>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-12 col-lg-12">
				<h1><u>Frustrations</u></h1>
				<div class="well">
					<div class="container">
						<ul>
							<li>Sharing posts on various platforms is too involved of a process.</li>
							<li>Inability to passively share content on Medium with followers.</li>
							<li>Showing your support or liking content should be seamless.</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-12 col-lg-12">
				<h1><u>Use Case</u></h1>
				<div class="well">
					<p>Jack opens Twitter on his phone and happens to see a hilarious trending meme being posted everywhere
						and sees a friend tweeted a Medium article on the origin of the meme and sources. After reading the
						in-depth article, Jack was so impressed he felt like applauding the author’s extensive internet
						journalism and recommend the article to his own following on Medium. Jack, would really like it if
						Medium had a way of communicating his appreciation for the article in a digital manner without having
						to switch to another app or platform. </p>
				</div>
			</div>
			<div class="col-xs-12 col-md-12 col-lg-12">
				<h1><u>Interaction-Flow</u></h1>
				<div class="well">
					<div class="container">
						<ol>
							<li>Jack clicks the link to the Medium article from Twitter.</li>
							<li>The link directs him to the Medium article.</li>
							<li>Jack begins reading the article.</li>
							<li>After scrolling for 6 minutes, Jack finishes reading the article.</li>
							<li>Jack shows his appreciation and support of the article by holding down the clap button for 10
								claps.
							</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</body>
</html>