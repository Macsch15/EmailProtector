<?php
require __DIR__.'/../vendor/autoload.php';

use EmailProtector\EmailProtector;

$protector = new EmailProtector();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Example of Email Protector by Maciej Schmidt (Macsch15)</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
      html,
      body {
        height: 100%;
      }

      body {
        display: flex;
        justify-content: center;
        padding-top: 40px;
        padding-bottom: 40px;
        background-color: #f5f5f5;
      }
    </style>
  </head>
<body class="text-center">
  <div class="jumbotron">
    <h1 class="display-4">Encrypted E-mail</h1>
    <p class="lead">
      <code><?= $protector->outputHtml() ?></code>

      <div class="form-group">
        <label for="output"><h3>Copy and paste</h3></label>
        <input class="form-control" type="text" id="output" value="<?= $protector->outputHtml() ?>">
        <label for="output">jQuery Version</label>
        <input class="form-control" type="text" id="output" value="<?= $protector->outputJquery('exampleElement') ?>">
        <label for="output">Raw</label>
        <input class="form-control" type="text" id="output" value="<?= $protector->getEncrypted() ?>">
      </div>

      Result: <?= $protector->outputHtmlRaw() ?>
    </p>
    <p class="mt-5 mb-3 text-muted">&copy; 2018 <a href="https://github.com/Macsch15">Maciej Schmidt</a></p>
  </div>
</body>
