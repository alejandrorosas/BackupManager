<?
$vars['page_name'] = "Backup Manager";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <title><? echo $vars['page_name'] ?></title>
    
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/navbar-fixed-top.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="./"><? echo $vars['page_name'] ?></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#" web="home">Home</a></li>
            <li><a href="#about" web="about">About</a></li>
            <li><a href="#contact" web="contact">Contact</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">&copy; Alejandro Rosas</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container" id="base-container">      
      <? include("ajax/home.php"); ?>
    </div> <!-- /container -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
      $("a[web]").click(function() {
        var obj = $( this );
        obj.parent().parent().parent().attr('style', 'background: url(images/loading.gif) no-repeat center center;');
        $.ajax({
          type: "POST",
          url: "ajax/"+obj.attr("web")+".php",
          data: { name: "John", location: "Boston" }
        }).done(function( msg ) {
            $('#base-container').html(msg);
          	$('.active').removeClass("active");
          	obj.parent().addClass("active");
          obj.parent().parent().parent().removeAttr("style");
          });
      });
    </script>
  </body>
</html>
