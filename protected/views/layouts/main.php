<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo CHtml::encode(Yii::app()->name); ?></title>

    <link href="/assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="/css/main.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script src="/assets/jquery/dist/jquery.min.js"></script>
    <script src="/assets/wordcloud2.js/src/wordcloud2.js"></script>
  </head>

  <body>

    <div class="container">

      <?php echo $content; ?>

    </div> <!-- /container -->

  </body>
</html>
