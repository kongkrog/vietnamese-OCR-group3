<html>
  <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <base href="<?= base_url()?>">
    <title>Vietnamese Handwriting Converter || Reset Password</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <meta http-equiv="refresh" content="3; url = user/signup" />
    <link href="https://fonts.cdnfonts.com/css/google-sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='assets/user/css/main.css'>
  </head>
  <body style="display: flex; align-items: center; justify-content: center; width: 100wh; height: 100vh;">
    <?php foreach($message as $err) :?>
    <h1 style="padding: 0; margin: 0;"> - <?= $err ?> </h1>
    <?php endforeach ?>
  </body>