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
		<title>Conceptual-Model</title>

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
					<a href="index.php" class="navbar-brand"><span class="fa fa-database"></span> Data Design</a>
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
				<h1><i class="fas fa-code-branch"></i></span> <u>Conceptual Model</u></h1>
			</div>
			<div class="col-xs-12 col-md-12">
				<div class="well">
					<h2>Entities & Attributes</h2>
					<h3><strong>Profile</strong></h3>
					<ul>
						<li>profileId (primary key)</li>
						<li>profileActivationToken (for account verification)</li>
						<li>profileFirstName</li>
						<li>profileLastName</li>
						<li>profileEmail</li>
						<li>profileHash (for account password)</li>
						<li>profilePhone</li>
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
		</div>


		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</body>
</html>