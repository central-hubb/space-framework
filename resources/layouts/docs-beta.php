<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<link rel="shortcut icon" href="assets/images/favicon.png">

	<title>Space MVC</title>
	<link rel="stylesheet" href="/assets/docs/material/css/application.css">
	<link rel="stylesheet" href="/assets/docs/material/css/application-palette.css">
	<meta name="theme-color" content="#2196f3">

    <script src="/assets/docs/material/js/modernizr.js"></script>

    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,400i,700|Roboto+Mono">
	<style>body,input{font-family:"Roboto","Helvetica Neue",Helvetica,Arial,sans-serif}code,kbd,pre{font-family:"Roboto Mono","Courier New",Courier,monospace}</style>
    <link rel="stylesheet" href="/assets/docs/material/css/material-icons.css">

</head>

<body dir="ltr" data-md-color-primary="blue" data-md-color-accent="purple">

<svg class="md-svg">
	<defs>
		<svg xmlns="http://www.w3.org/2000/svg" width="416" height="448"
		     viewBox="0 0 416 448" id="__github">
			<path fill="currentColor" d="M160 304q0 10-3.125 20.5t-10.75 19-18.125
        8.5-18.125-8.5-10.75-19-3.125-20.5 3.125-20.5 10.75-19 18.125-8.5
        18.125 8.5 10.75 19 3.125 20.5zM320 304q0 10-3.125 20.5t-10.75
        19-18.125 8.5-18.125-8.5-10.75-19-3.125-20.5 3.125-20.5 10.75-19
        18.125-8.5 18.125 8.5 10.75 19 3.125 20.5zM360
        304q0-30-17.25-51t-46.75-21q-10.25 0-48.75 5.25-17.75 2.75-39.25
        2.75t-39.25-2.75q-38-5.25-48.75-5.25-29.5 0-46.75 21t-17.25 51q0 22 8
        38.375t20.25 25.75 30.5 15 35 7.375 37.25 1.75h42q20.5 0
        37.25-1.75t35-7.375 30.5-15 20.25-25.75 8-38.375zM416 260q0 51.75-15.25
        82.75-9.5 19.25-26.375 33.25t-35.25 21.5-42.5 11.875-42.875 5.5-41.75
        1.125q-19.5 0-35.5-0.75t-36.875-3.125-38.125-7.5-34.25-12.875-30.25-20.25-21.5-28.75q-15.5-30.75-15.5-82.75
        0-59.25 34-99-6.75-20.5-6.75-42.5 0-29 12.75-54.5 27 0 47.5 9.875t47.25
        30.875q36.75-8.75 77.25-8.75 37 0 70 8 26.25-20.5
        46.75-30.25t47.25-9.75q12.75 25.5 12.75 54.5 0 21.75-6.75 42 34 40 34
        99.5z" />
		</svg>
	</defs>
</svg>
<input class="md-toggle" data-md-toggle="drawer" type="checkbox" id="__drawer" autocomplete="off">
<input class="md-toggle" data-md-toggle="search" type="checkbox" id="__search" autocomplete="off">
<label class="md-overlay" data-md-component="overlay" for="__drawer"></label>

<a href="#vapor-documentation" tabindex="1" class="md-skip">
	Skip to content
</a>


<header class="md-header" data-md-component="header">
	<nav class="md-header-nav md-grid">
		<div class="md-flex">
			<div class="md-flex__cell md-flex__cell--shrink">
				<a href="https://docs.vapor.codes/3.0/" title="Vapor Docs" class="md-header-nav__button md-logo">

					<img src="https://docs.vapor.codes/3.0/images/droplet-white.svg" width="24" height="24">

				</a>
			</div>
			<div class="md-flex__cell md-flex__cell--shrink">
				<label class="md-icon md-icon--menu md-header-nav__button" for="__drawer"></label>
			</div>
			<div class="md-flex__cell md-flex__cell--stretch">
				<div class="md-flex__ellipsis md-header-nav__title" data-md-component="title">


              <span class="md-header-nav__topic">
                Vapor Docs
              </span>
					<span class="md-header-nav__topic">
                Overview
              </span>


				</div>
			</div>
			<div class="md-flex__cell md-flex__cell--shrink">


				<label class="md-icon md-icon--search md-header-nav__button" for="__search"></label>

				<div class="md-search" data-md-component="search" role="dialog">
					<label class="md-search__overlay" for="__search"></label>
					<div class="md-search__inner" role="search">
						<form class="md-search__form" name="search">
							<input type="text" class="md-search__input" name="query" placeholder="Search" autocapitalize="off" autocorrect="off" autocomplete="off" spellcheck="false" data-md-component="query" data-md-state="active">
							<label class="md-icon md-search__icon" for="__search"></label>
							<button type="reset" class="md-icon md-search__icon" data-md-component="reset" tabindex="-1">
								&#xE5CD;
							</button>
						</form>
						<div class="md-search__output">
							<div class="md-search__scrollwrap" data-md-scrollfix>
								<div class="md-search-result" data-md-component="result">
									<div class="md-search-result__meta">
										Type to start searching
									</div>
									<ol class="md-search-result__list"></ol>
								</div>
							</div>
						</div>
					</div>
				</div>


			</div>

			<div class="md-flex__cell md-flex__cell--shrink">
				<div class="md-header-nav__source">

					<a href="http://github.com/vapor/vapor/" title="Go to repository" class="md-source" data-md-source="github">

						<div class="md-source__icon">
							<svg viewBox="0 0 24 24" width="24" height="24">
								<use xlink:href="#__github" width="24" height="24"></use>
							</svg>
						</div>

						<div class="md-source__repository">
							GitHub
						</div>
					</a>

				</div>
			</div>

		</div>
	</nav>
</header>

<div class="md-container">




	<main class="md-main">
		<div class="md-main__inner md-grid" data-md-component="container">


			<div class="md-sidebar md-sidebar--primary" data-md-component="navigation">
				<div class="md-sidebar__scrollwrap">
					<div class="md-sidebar__inner">
						<nav class="md-nav md-nav--primary" data-md-level="0">
							<label class="md-nav__title md-nav__title--site" for="__drawer">
								<a href="https://docs.vapor.codes/3.0/" title="Vapor Docs" class="md-nav__button md-logo">

									<img src="images/droplet-white.svg" width="48" height="48">

								</a>
								Vapor Docs
							</label>

							<div class="md-nav__source">






								<a href="http://github.com/vapor/vapor/" title="Go to repository" class="md-source" data-md-source="github">

									<div class="md-source__icon">
										<svg viewBox="0 0 24 24" width="24" height="24">
											<use xlink:href="#__github" width="24" height="24"></use>
										</svg>
									</div>

									<div class="md-source__repository">
										GitHub
									</div>
								</a>

							</div>

							<ul class="md-nav__list" data-md-scrollfix>








								<li class="md-nav__item md-nav__item--active">

									<input class="md-toggle md-nav__toggle" data-md-toggle="toc" type="checkbox" id="__toc">




									<label class="md-nav__link md-nav__link--active" for="__toc">
										Overview
									</label>

									<a href="." title="Overview" class="md-nav__link md-nav__link--active">
										Overview
									</a>


									<nav class="md-nav md-nav--secondary">





										<label class="md-nav__title" for="__toc">Table of contents</label>
										<ul class="md-nav__list" data-md-scrollfix>

											<li class="md-nav__item">
												<a href="#getting-started" title="Getting Started" class="md-nav__link">
													Getting Started
												</a>

											</li>

											<li class="md-nav__item">
												<a href="#like-vapor" title="Like Vapor?" class="md-nav__link">
													Like Vapor?
												</a>

											</li>

											<li class="md-nav__item">
												<a href="#other-sources" title="Other Sources" class="md-nav__link">
													Other Sources
												</a>

											</li>

											<li class="md-nav__item">
												<a href="#service-providers" title="Service Providers" class="md-nav__link">
													Service Providers
												</a>

											</li>

											<li class="md-nav__item">
												<a href="#authors" title="Authors" class="md-nav__link">
													Authors
												</a>

											</li>





										</ul>

									</nav>

								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-2" type="checkbox" id="nav-2">

									<label class="md-nav__link" for="nav-2">
										Install
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-2">
											Install
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="install/macos/" title="macOS" class="md-nav__link">
													macOS
												</a>
											</li>







											<li class="md-nav__item">
												<a href="install/ubuntu/" title="Ubuntu" class="md-nav__link">
													Ubuntu
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-3" type="checkbox" id="nav-3">

									<label class="md-nav__link" for="nav-3">
										Getting Started
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-3">
											Getting Started
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="getting-started/hello-world/" title="Hello, world" class="md-nav__link">
													Hello, world
												</a>
											</li>







											<li class="md-nav__item">
												<a href="getting-started/toolbox/" title="Toolbox" class="md-nav__link">
													Toolbox
												</a>
											</li>







											<li class="md-nav__item">
												<a href="getting-started/spm/" title="SPM" class="md-nav__link">
													SPM
												</a>
											</li>







											<li class="md-nav__item">
												<a href="getting-started/xcode/" title="Xcode" class="md-nav__link">
													Xcode
												</a>
											</li>







											<li class="md-nav__item">
												<a href="getting-started/structure/" title="Folder Structure" class="md-nav__link">
													Folder Structure
												</a>
											</li>







											<li class="md-nav__item">
												<a href="getting-started/application/" title="Application" class="md-nav__link">
													Application
												</a>
											</li>







											<li class="md-nav__item">
												<a href="getting-started/controllers/" title="Controllers" class="md-nav__link">
													Controllers
												</a>
											</li>







											<li class="md-nav__item">
												<a href="getting-started/routing/" title="Routing" class="md-nav__link">
													Routing
												</a>
											</li>







											<li class="md-nav__item">
												<a href="getting-started/content/" title="Content" class="md-nav__link">
													Content
												</a>
											</li>







											<li class="md-nav__item">
												<a href="getting-started/async/" title="Async" class="md-nav__link">
													Async
												</a>
											</li>







											<li class="md-nav__item">
												<a href="getting-started/services/" title="Services" class="md-nav__link">
													Services
												</a>
											</li>







											<li class="md-nav__item">
												<a href="getting-started/cloud/" title="Deployment" class="md-nav__link">
													Deployment
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-4" type="checkbox" id="nav-4">

									<label class="md-nav__link" for="nav-4">
										Async
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-4">
											Async
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="async/getting-started/" title="Getting Started" class="md-nav__link">
													Getting Started
												</a>
											</li>







											<li class="md-nav__item">
												<a href="async/overview/" title="Overview" class="md-nav__link">
													Overview
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-5" type="checkbox" id="nav-5">

									<label class="md-nav__link" for="nav-5">
										Auth
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-5">
											Auth
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="auth/getting-started/" title="Getting Started" class="md-nav__link">
													Getting Started
												</a>
											</li>







											<li class="md-nav__item">
												<a href="auth/api/" title="Stateless (API)" class="md-nav__link">
													Stateless (API)
												</a>
											</li>







											<li class="md-nav__item">
												<a href="auth/web/" title="Sessions (Web)" class="md-nav__link">
													Sessions (Web)
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-6" type="checkbox" id="nav-6">

									<label class="md-nav__link" for="nav-6">
										Console
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-6">
											Console
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="console/getting-started/" title="Getting Started" class="md-nav__link">
													Getting Started
												</a>
											</li>







											<li class="md-nav__item">
												<a href="console/overview/" title="Overview" class="md-nav__link">
													Overview
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-7" type="checkbox" id="nav-7">

									<label class="md-nav__link" for="nav-7">
										Command
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-7">
											Command
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="command/getting-started/" title="Getting Started" class="md-nav__link">
													Getting Started
												</a>
											</li>







											<li class="md-nav__item">
												<a href="command/overview/" title="Overview" class="md-nav__link">
													Overview
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-8" type="checkbox" id="nav-8">

									<label class="md-nav__link" for="nav-8">
										Crypto
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-8">
											Crypto
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="crypto/getting-started/" title="Getting Started" class="md-nav__link">
													Getting Started
												</a>
											</li>







											<li class="md-nav__item">
												<a href="crypto/digests/" title="Digests" class="md-nav__link">
													Digests
												</a>
											</li>







											<li class="md-nav__item">
												<a href="crypto/ciphers/" title="Ciphers" class="md-nav__link">
													Ciphers
												</a>
											</li>







											<li class="md-nav__item">
												<a href="crypto/asymmetric/" title="Asymmetric" class="md-nav__link">
													Asymmetric
												</a>
											</li>







											<li class="md-nav__item">
												<a href="crypto/random/" title="Random" class="md-nav__link">
													Random
												</a>
											</li>







											<li class="md-nav__item">
												<a href="crypto/otp/" title="TOTP & HOTP" class="md-nav__link">
													TOTP & HOTP
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-9" type="checkbox" id="nav-9">

									<label class="md-nav__link" for="nav-9">
										Database Kit
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-9">
											Database Kit
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="database-kit/getting-started/" title="Getting Started" class="md-nav__link">
													Getting Started
												</a>
											</li>







											<li class="md-nav__item">
												<a href="database-kit/overview/" title="Overview" class="md-nav__link">
													Overview
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-10" type="checkbox" id="nav-10">

									<label class="md-nav__link" for="nav-10">
										Fluent
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-10">
											Fluent
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="fluent/getting-started/" title="Getting Started" class="md-nav__link">
													Getting Started
												</a>
											</li>







											<li class="md-nav__item">
												<a href="fluent/models/" title="Models" class="md-nav__link">
													Models
												</a>
											</li>







											<li class="md-nav__item">
												<a href="fluent/querying/" title="Querying" class="md-nav__link">
													Querying
												</a>
											</li>







											<li class="md-nav__item">
												<a href="fluent/migrations/" title="Migrations" class="md-nav__link">
													Migrations
												</a>
											</li>







											<li class="md-nav__item">
												<a href="fluent/relations/" title="Relations" class="md-nav__link">
													Relations
												</a>
											</li>







											<li class="md-nav__item">
												<a href="fluent/transaction/" title="Transaction" class="md-nav__link">
													Transaction
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-11" type="checkbox" id="nav-11">

									<label class="md-nav__link" for="nav-11">
										HTTP
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-11">
											HTTP
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="http/getting-started/" title="Getting Started" class="md-nav__link">
													Getting Started
												</a>
											</li>







											<li class="md-nav__item">
												<a href="http/client/" title="Client" class="md-nav__link">
													Client
												</a>
											</li>







											<li class="md-nav__item">
												<a href="http/server/" title="Server" class="md-nav__link">
													Server
												</a>
											</li>







											<li class="md-nav__item">
												<a href="http/message/" title="Message" class="md-nav__link">
													Message
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-12" type="checkbox" id="nav-12">

									<label class="md-nav__link" for="nav-12">
										JWT
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-12">
											JWT
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="jwt/getting-started/" title="Getting Started" class="md-nav__link">
													Getting Started
												</a>
											</li>







											<li class="md-nav__item">
												<a href="jwt/overview/" title="Overview" class="md-nav__link">
													Overview
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-13" type="checkbox" id="nav-13">

									<label class="md-nav__link" for="nav-13">
										Leaf
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-13">
											Leaf
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="leaf/getting-started/" title="Getting Started" class="md-nav__link">
													Getting Started
												</a>
											</li>







											<li class="md-nav__item">
												<a href="leaf/overview/" title="Overview" class="md-nav__link">
													Overview
												</a>
											</li>







											<li class="md-nav__item">
												<a href="leaf/custom-tags/" title="Custom tags" class="md-nav__link">
													Custom tags
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-14" type="checkbox" id="nav-14">

									<label class="md-nav__link" for="nav-14">
										Logging
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-14">
											Logging
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="logging/getting-started/" title="Getting Started" class="md-nav__link">
													Getting Started
												</a>
											</li>







											<li class="md-nav__item">
												<a href="logging/overview/" title="Overview" class="md-nav__link">
													Overview
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-15" type="checkbox" id="nav-15">

									<label class="md-nav__link" for="nav-15">
										Multipart
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-15">
											Multipart
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="multipart/getting-started/" title="Getting Started" class="md-nav__link">
													Getting Started
												</a>
											</li>







											<li class="md-nav__item">
												<a href="multipart/overview/" title="Overview" class="md-nav__link">
													Overview
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-16" type="checkbox" id="nav-16">

									<label class="md-nav__link" for="nav-16">
										MySQL
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-16">
											MySQL
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="mysql/getting-started/" title="Getting Started" class="md-nav__link">
													Getting Started
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-17" type="checkbox" id="nav-17">

									<label class="md-nav__link" for="nav-17">
										PostgreSQL
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-17">
											PostgreSQL
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="postgresql/getting-started/" title="Getting Started" class="md-nav__link">
													Getting Started
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-18" type="checkbox" id="nav-18">

									<label class="md-nav__link" for="nav-18">
										Redis
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-18">
											Redis
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="redis/getting-started/" title="Getting Started" class="md-nav__link">
													Getting Started
												</a>
											</li>







											<li class="md-nav__item">
												<a href="redis/overview/" title="Overview" class="md-nav__link">
													Overview
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-19" type="checkbox" id="nav-19">

									<label class="md-nav__link" for="nav-19">
										Routing
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-19">
											Routing
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="routing/getting-started/" title="Getting Started" class="md-nav__link">
													Getting Started
												</a>
											</li>







											<li class="md-nav__item">
												<a href="routing/overview/" title="Overview" class="md-nav__link">
													Overview
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-20" type="checkbox" id="nav-20">

									<label class="md-nav__link" for="nav-20">
										Service
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-20">
											Service
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="service/getting-started/" title="Getting Started" class="md-nav__link">
													Getting Started
												</a>
											</li>







											<li class="md-nav__item">
												<a href="service/services/" title="Services" class="md-nav__link">
													Services
												</a>
											</li>







											<li class="md-nav__item">
												<a href="service/provider/" title="Provider" class="md-nav__link">
													Provider
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-21" type="checkbox" id="nav-21">

									<label class="md-nav__link" for="nav-21">
										SQL
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-21">
											SQL
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="sql/getting-started/" title="Getting Started" class="md-nav__link">
													Getting Started
												</a>
											</li>







											<li class="md-nav__item">
												<a href="sql/overview/" title="Overview" class="md-nav__link">
													Overview
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-22" type="checkbox" id="nav-22">

									<label class="md-nav__link" for="nav-22">
										SQLite
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-22">
											SQLite
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="sqlite/getting-started/" title="Getting Started" class="md-nav__link">
													Getting Started
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-23" type="checkbox" id="nav-23">

									<label class="md-nav__link" for="nav-23">
										Template Kit
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-23">
											Template Kit
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="template-kit/getting-started/" title="Getting Started" class="md-nav__link">
													Getting Started
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-24" type="checkbox" id="nav-24">

									<label class="md-nav__link" for="nav-24">
										Testing
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-24">
											Testing
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="testing/getting-started/" title="Getting Started" class="md-nav__link">
													Getting Started
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-25" type="checkbox" id="nav-25">

									<label class="md-nav__link" for="nav-25">
										URL-Encoded Form
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-25">
											URL-Encoded Form
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="url-encoded-form/getting-started/" title="Getting Started" class="md-nav__link">
													Getting Started
												</a>
											</li>







											<li class="md-nav__item">
												<a href="url-encoded-form/overview/" title="Overview" class="md-nav__link">
													Overview
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-26" type="checkbox" id="nav-26">

									<label class="md-nav__link" for="nav-26">
										Validation
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-26">
											Validation
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="validation/getting-started/" title="Getting Started" class="md-nav__link">
													Getting Started
												</a>
											</li>







											<li class="md-nav__item">
												<a href="validation/overview/" title="Overview" class="md-nav__link">
													Overview
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-27" type="checkbox" id="nav-27">

									<label class="md-nav__link" for="nav-27">
										Vapor
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-27">
											Vapor
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="vapor/getting-started/" title="Getting Started" class="md-nav__link">
													Getting Started
												</a>
											</li>







											<li class="md-nav__item">
												<a href="vapor/client/" title="Client" class="md-nav__link">
													Client
												</a>
											</li>







											<li class="md-nav__item">
												<a href="vapor/content/" title="Content" class="md-nav__link">
													Content
												</a>
											</li>







											<li class="md-nav__item">
												<a href="vapor/sessions/" title="Sessions" class="md-nav__link">
													Sessions
												</a>
											</li>







											<li class="md-nav__item">
												<a href="vapor/websocket/" title="WebSocket" class="md-nav__link">
													WebSocket
												</a>
											</li>







											<li class="md-nav__item">
												<a href="vapor/middleware/" title="Middleware" class="md-nav__link">
													Middleware
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-28" type="checkbox" id="nav-28">

									<label class="md-nav__link" for="nav-28">
										WebSocket
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-28">
											WebSocket
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="websocket/getting-started/" title="Getting Started" class="md-nav__link">
													Getting Started
												</a>
											</li>







											<li class="md-nav__item">
												<a href="websocket/overview/" title="Overview" class="md-nav__link">
													Overview
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-29" type="checkbox" id="nav-29">

									<label class="md-nav__link" for="nav-29">
										Extras
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-29">
											Extras
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="extras/style-guide/" title="Style Guide" class="md-nav__link">
													Style Guide
												</a>
											</li>







											<li class="md-nav__item">
												<a href="extras/yeoman/" title="Yeoman" class="md-nav__link">
													Yeoman
												</a>
											</li>


										</ul>
									</nav>
								</li>







								<li class="md-nav__item md-nav__item--nested">

									<input class="md-toggle md-nav__toggle" data-md-toggle="nav-30" type="checkbox" id="nav-30">

									<label class="md-nav__link" for="nav-30">
										Version (3.0)
									</label>
									<nav class="md-nav" data-md-component="collapsible" data-md-level="1">
										<label class="md-nav__title" for="nav-30">
											Version (3.0)
										</label>
										<ul class="md-nav__list" data-md-scrollfix>







											<li class="md-nav__item">
												<a href="version/1_5/" title="1.5" class="md-nav__link">
													1.5
												</a>
											</li>







											<li class="md-nav__item">
												<a href="version/2_0/" title="2.0" class="md-nav__link">
													2.0
												</a>
											</li>







											<li class="md-nav__item">
												<a href="version/3_0/" title="3.0" class="md-nav__link">
													3.0
												</a>
											</li>







											<li class="md-nav__item">
												<a href="version/upgrading/" title="Upgrading" class="md-nav__link">
													Upgrading
												</a>
											</li>







											<li class="md-nav__item">
												<a href="version/support/" title="Support" class="md-nav__link">
													Support
												</a>
											</li>


										</ul>
									</nav>
								</li>


							</ul>
						</nav>
					</div>
				</div>
			</div>


			<div class="md-sidebar md-sidebar--secondary" data-md-component="toc">
				<div class="md-sidebar__scrollwrap">
					<div class="md-sidebar__inner">

						<nav class="md-nav md-nav--secondary">





							<label class="md-nav__title" for="__toc">Table of contents</label>
							<ul class="md-nav__list" data-md-scrollfix>

								<li class="md-nav__item">
									<a href="#getting-started" title="Getting Started" class="md-nav__link">
										Getting Started
									</a>

								</li>

								<li class="md-nav__item">
									<a href="#like-vapor" title="Like Vapor?" class="md-nav__link">
										Like Vapor?
									</a>

								</li>

								<li class="md-nav__item">
									<a href="#other-sources" title="Other Sources" class="md-nav__link">
										Other Sources
									</a>

								</li>

								<li class="md-nav__item">
									<a href="#service-providers" title="Service Providers" class="md-nav__link">
										Service Providers
									</a>

								</li>

								<li class="md-nav__item">
									<a href="#authors" title="Authors" class="md-nav__link">
										Authors
									</a>

								</li>





							</ul>

						</nav>
					</div>
				</div>
			</div>


			<div class="md-content">
				<article class="md-content__inner md-typeset">


					<a href="https://github.com/vapor/documentation/edit/master/3.0/docs/index.md" title="Edit this page" class="md-icon md-content__icon">&#xE3C9;</a>


					<h1 id="vapor-documentation">Server Requirements</h1>

                    <article>

                        <h3>Server Requirements</h3>

                        <p>The Space MVC framework has a few system requirements:</p>

                        <div class="content-list">
                            <ul>
                                <li>PHP &gt;= 7.0.0</li>
                                <li>PDO PHP Extension</li>
                                <li>PHP Memcached</li>
                                <li>Mysql Database</li>
                            </ul>
                        </div>

                        <h3>Installing Framework</h3>

                        <p>You can install Space CRM quite easily using github and composer.</p>

                        <pre class="language-php rainbow-show" data-trimmed="true"><code class="language-php rainbow rainbow-show">git clone https:<span class="comment">//github.com/space-mvc/space-mvc.git</span></code><div class="preloader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></pre>	<pre class="language-php rainbow-show" data-trimmed="true"><code class="language-php rainbow rainbow-show">composer install</code><div class="preloader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></pre>
                        <h2>Web Server Configuration</h2>

                        <h4>Apache</h4>
                        <p>
                            Space MVC includes a public/.htaccess file that is used to provide URLs without the index.php front
                            controller in the path. Before serving Space MVC with Apache, be sure to enable the mod_rewrite module
                            so the .htaccess file will be honored by the server.
                        </p>

                        <p>If the .htaccess file that ships with
                            Space MVC does not work with your Apache installation, try this alternative:
                        </p>

                        <pre class="language-php rainbow-show" data-trimmed="true"><code class="language-php rainbow rainbow-show">Options <span class="keyword operator">+</span>FollowSymLinks <span class="keyword operator">-</span>Indexes
    RewriteEngine On

    RewriteCond %{<span class="constant">HTTP</span>:Authorization} <span class="keyword dot">.</span>
    RewriteRule <span class="keyword dot">.</span><span class="keyword operator">*</span> <span class="keyword operator">-</span> [E<span class="keyword operator">=</span><span class="constant">HTTP_AUTHORIZATION</span>:%{<span class="constant">HTTP</span>:Authorization}]

    RewriteCond %{<span class="constant">REQUEST_FILENAME</span>} <span class="keyword operator">!</span><span class="keyword operator">-</span>d
    RewriteCond %{<span class="constant">REQUEST_FILENAME</span>} <span class="keyword operator">!</span><span class="keyword operator">-</span>f
    RewriteRule ^ index<span class="keyword dot">.</span>php [L]</code><div class="preloader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></pre>
                        <h4>Nginx</h4>
                        <p>
                            If you are using Nginx, the following directive in your site configuration will direct all requests
                            to the index.php front controller:
                        </p>

                        <pre class="language-php rainbow-show" data-trimmed="true"><code class="language-php rainbow rainbow-show">location / {
    try_files <span class="variable dollar-sign">$</span><span class="variable">uri</span> <span class="variable dollar-sign">$</span><span class="variable">uri</span>/ /index<span class="keyword dot">.</span>php?<span class="variable dollar-sign">$</span><span class="variable">query_string</span>;
}</code><div class="preloader"><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></pre></article>






                    
					<p>This is the documentation for Vapor, a Web Framework for Swift that works on macOS and Ubuntu, and all of the packages that Vapor offers.</p>
					<p>Vapor is the most used web framework for Swift. It provides a beautifully expressive and easy to use foundation for your next website or API.</p>
					<h2 id="getting-started">Getting Started<a class="headerlink" href="#getting-started" title="Permanent link">&para;</a></h2>
					<p>If this is your first time using Vapor, head to the <a href="install/macos/">Install &rarr; macOS</a> section to install Swift and Vapor.</p>
					<p>Once you have Vapor installed, check out <a href="getting-started/hello-world/">Getting Started &rarr; Hello, world</a> to create your first Vapor app!</p>
					<h2 id="like-vapor">Like Vapor?<a class="headerlink" href="#like-vapor" title="Permanent link">&para;</a></h2>
					<p>Our small team works hard to make Vapor awesome (and free). Support the framework by <a href="https://github.com/vapor/vapor">starring Vapor on GitHub</a>
						or <a href="https://opencollective.com/vapor">donating $1 monthly</a>&mdash;it helps us a lot. Thanks!</p>
					<h2 id="other-sources">Other Sources<a class="headerlink" href="#other-sources" title="Permanent link">&para;</a></h2>










					<p>Here are some other great places to find information about Vapor.</p>
					<table>
						<thead>
						<tr>
							<th>name</th>
							<th>description</th>
							<th>link</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td>Vapor Discord</td>
							<td>Chat with thousands of Vapor developers.</td>
							<td><a href="http://vapor.team">visit &rarr;</a></td>
						</tr>
						<tr>
							<td>API docs</td>
							<td>Auto-generated documentation from code comments.</td>
							<td><a href="http://api.vapor.codes">visit &rarr;</a></td>
						</tr>
						<tr>
							<td>Stack Overflow</td>
							<td>Ask and answer questions with the <code>vapor</code> tag.</td>
							<td><a href="http://stackoverflow.com/questions/tagged/vapor">visit &rarr;</a></td>
						</tr>
						<tr>
							<td>Swift Forums</td>
							<td>Post in Vapor's section of the Swift.org forums.</td>
							<td><a href="https://forums.swift.org/c/related-projects/vapor">visit &rarr;</a></td>
						</tr>
						<tr>
							<td>Source Code</td>
							<td>Learn how Vapor works under the hood.</td>
							<td><a href="https://github.com/vapor/vapor">visit &rarr;</a></td>
						</tr>
						<tr>
							<td>GitHub Issues</td>
							<td>Report bugs or request features on GitHub.</td>
							<td><a href="https://github.com/vapor/vapor/issues">visit &rarr;</a></td>
						</tr>
						</tbody>
					</table>
					<h2 id="service-providers">Service Providers<a class="headerlink" href="#service-providers" title="Permanent link">&para;</a></h2>
					<p>Vapor providers are a convenient way to add functionality to your Vapor projects.
						For a full list of providers, check out the <a href="https://github.com/search?utf8=✓&amp;q=topic%3Avapor-service&amp;type=Repositories"><code>vapor-service</code></a> tag on GitHub.</p>
					<h2 id="authors">Authors<a class="headerlink" href="#authors" title="Permanent link">&para;</a></h2>
					<p><a href="mailto:tanner@vapor.codes">Tanner Nelson</a>, <a href="mailto:logan@vapor.codes">Logan Wright</a>, and the hundreds of members of Vapor.</p>









				</article>
			</div>
		</div>
	</main>


	<footer class="md-footer">

		<div class="md-footer-nav">
			<nav class="md-footer-nav__inner md-grid">


				<a href="install/macos/" title="macOS" class="md-flex md-footer-nav__link md-footer-nav__link--next" rel="next">
					<div class="md-flex__cell md-flex__cell--stretch md-footer-nav__title">
              <span class="md-flex__ellipsis">
                <span class="md-footer-nav__direction">
                  Next
                </span>
                macOS
              </span>
					</div>
					<div class="md-flex__cell md-flex__cell--shrink">
						<i class="md-icon md-icon--arrow-forward md-footer-nav__button"></i>
					</div>
				</a>

			</nav>
		</div>

		<div class="md-footer-meta md-typeset">
			<div class="md-footer-meta__inner md-grid">
				<div class="md-footer-copyright">

					<div class="md-footer-copyright__highlight">
						Copyright &copy; 2018 Qutheory, LLC
					</div>

					powered by
					<a href="https://www.mkdocs.org">MkDocs</a>
					and
					<a href="https://squidfunk.github.io/mkdocs-material/">
						Material for MkDocs</a>
				</div>


				<div class="md-footer-social">
					<link rel="stylesheet" href="assets/fonts/font-awesome.css">

					<a href="https://twitter.com/@codevapor" class="md-footer-social__link fa fa-twitter"></a>

					<a href="http://vapor.team/" class="md-footer-social__link fa fa-slack"></a>

					<a href="https://github.com/vapor" class="md-footer-social__link fa fa-github"></a>

				</div>


			</div>
		</div>
	</footer>

</div>

<script src="/assets/docs/material/js/application.js"></script>

<script>app.initialize({version:"1.0.4",url:{base:"."}})</script>




<script>!function(e,a,t,n,o,c,i){e.GoogleAnalyticsObject=o,e.ga=e.ga||function(){(e.ga.q=e.ga.q||[]).push(arguments)},e.ga.l=1*new Date,c=a.createElement(t),i=a.getElementsByTagName(t)[0],c.async=1,c.src="https://www.google-analytics.com/analytics.js",i.parentNode.insertBefore(c,i)}(window,document,"script",0,"ga"),ga("create","UA-76177358-4","auto"),ga("set","anonymizeIp",!0),ga("send","pageview");var links=document.getElementsByTagName("a");if(Array.prototype.map.call(links,function(e){e.host!=document.location.host&&e.addEventListener("click",function(){var a=e.getAttribute("data-md-action")||"follow";ga("send","event","outbound",a,e.href)})}),document.forms.search){var query=document.forms.search.query;query.addEventListener("blur",function(){if(this.value){var e=document.location.pathname;ga("send","pageview",e+"?q="+this.value)}})}</script>


</body>
</html>