<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=], initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" type="text/css"
				href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css"
				integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Oswald|Space+Mono" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/style.css"/>
		<title>Conceptual-Model</title>

	</head>
	<body class="background-gradient">
		<nav class="navbar navbar-inverse navbar-fixed-top">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
								  data-target="#bs-nav-demo"
								  aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a href="index.php" class="navbar-brand"><span class="fa fa-database"></span> Data Design</a>
					</div>
					<div class="collapse navbar-collapse nav navbar-nav navbar-right" id="bs-nav-demo">
						<ul class="nav navbar-nav">
							<li><a href="index.php">Home</a></li>
							<li><a href="jackDeer.php">Persona</a></li>
							<li><a href="use-case.php">Use Case</a></li>
							<li><a href="conceptual-model.php">Conceptual Model</a></li>
						</ul>
					</div>
				</div>
		</nav>

		<div class="container">
			<div class="jumbotron col-xs-12 col-md-12 col-lg-12 box-shadow text-center">
				<h1><i class="fas fa-code-branch"></i></span> <u>Conceptual Model</u></h1>
			</div>
			<div class="well col-xs-12 col-md-12 col-lg-12 box-shadow">
				<div class="persona-content">
					<h1>Entities & Attributes</h1>
					<hr/>
					<h3><strong>Profile</strong></h3>
					<ul>
						<li>profileId (primary key)</li>
						<li>profileActivationToken (for account verification)</li>
						<li>profileFirstName</li>
						<li>profileLastName</li>
						<li>profileEmail</li>
						<li>profileHash (for account password)</li>
					</ul>

					<h3><strong>Article</strong></h3>
					<ul>
						<li>articleId (primary key)</li>
						<li>articleProfileId (foreign key)</li>
						<li>articleContent</li>
						<li>articleDate</li>
					</ul>

					<h3><strong>Clap</strong></h3>
					<ul>
						<li>clapId (primary key)</li>
						<li>clapProfileId (foreign key)</li>
						<li>clapArticleId (foreign key)</li>
						<li>clapDate</li>
						<li>clapNumber</li>
					</ul>

					<h3>Relations</h3>
					<ul>
						<li>One <strong>Profile</strong> can write many <strong>Articles</strong> - <strong><em>(1 to
									<var>n</var>)</em></strong></li>

						<li>Many <strong>Articles</strong> can be applauded by many <strong>Profiles</strong> -
							<strong><em>(<var>m</var> to <var>n</var>)</em></strong></li>
					</ul>
				</div>
			</div>

			<div class="well col-xs-12 col-md-12 col-lg-12 box-shadow">
				<div>
					<h1>Entity Relationship Diagram</h1>
					<hr/>
					<img class="img-responsive" src="images/mediumClapErd.svg"
						  alt="Entity Relationship Diagram of Medium Clap"/>
				</div>
			</div>
		</div>


		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</body>
</html>