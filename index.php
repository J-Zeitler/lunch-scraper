<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <title>Veckans lunch på C</title>
  <link rel="stylesheet" href="styles.css" />
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="moment.js"></script>
</head>
<body>
  <?php
    require("err-report.php");
    require("db.php");
    $scrape = getScrape('C');
  ?>

  <div class="container">
    <h1>Visualiseringscenter C</h1>
    <h4>Lunchmeny vecka <?php echo $scrape['week']; ?></h4>
    <p id="sync">synkad <span id="sync-time"><?php echo $scrape['updated_at']; ?></span></p>
    <?php echo $scrape['html']; ?>
  </div>

  <script src="main.js"></script>
</body>
</html>