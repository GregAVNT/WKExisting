<?php include 'head.php';?>

<div class="container">

<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">Brand</a>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Link</a></li>
      <li><a href="#">Link</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li><a href="#">Separated link</a></li>
          <li><a href="#">One more separated link</a></li>
        </ul>
      </li>
    </ul>
    <form class="navbar-form navbar-left" role="search">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Search">
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
    </form>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#">Link</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="#">Action</a></li>
          <li><a href="#">Another action</a></li>
          <li><a href="#">Something else here</a></li>
          <li><a href="#">Separated link</a></li>
        </ul>
      </li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>



<div class="row">
	<div class="col-md-3 col-xs-6 first-column">
		Test Copy
	</div>
	<div class="col-md-3 col-xs-6">
		col 3
	</div>
	<div class="col-md-3 col-xs-6">
		col 3
	</div>
	<div class="col-md-3 col-xs-6">
		col 3
	</div>	
</div>

<div class="jumbotron">
	<img src="img/whoknocks.jpg" class="img-responsive img-thumbnail img-rounded"/>
</div>

<div class="row">
	<div class="col-lg-6 ">
		six col
		<h4><span class="glyphicon glyphicon-certificate"></span></h4>
	</div>
	<div class="col-lg-6">
		six col
		<h4><span class="glyphicon glyphicon-pushpin"></span></h4>
			<ul class="nav nav-tabs">
				<li class="active"><a href="#">Home</a></li>
				<li><a href="#">Profile</a></li>
				<li><a href="#">Messages</a></li>
			</ul>
	</div>
</div>

<div class="row">
	<aside class="col-md-4 col-sm-6">
		large-4
		<div class="progress progress-striped">
		  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 67%">
	    <span class="sr-only">40% Complete (success)</span>
  </div>
	</aside>
	<article class="col-md-7 col-md-offset-1 col-sm-5 col-sm-offset-1 ">
		<p>large-7 offset (with 1 col offset)</p>
	</article>
</div>

<div class="row">
	<div class="col-md-6 col-md-push-6">
		<p class="text-muted">pull right-top six col</p>
		<p><a href="#" class="btn btn-default">Button</a></p>
		<p><a href="#" class="btn btn-success btn-xs">Button success</a></p>
	</div>
	<div class="col-md-6 col-md-pull-6">
		<p class="text-muted">pull left-bot six col</p>
		<p><a href="#" class="btn btn-primary btn-lg btn-block">Button</a></p>
		<p><a href="#" class="btn btn-danger btn-lg">Button</a></p>
	</div>
</div>






</div><!-- close container -->
<?php include 'foot.php';?>