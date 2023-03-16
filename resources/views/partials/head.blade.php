<!doctype html>
<html lang="<?= $preferredLanguage ?>">
<head>
  <meta charset='utf-8'>
  <meta name='viewport' content='width=device-width, initial-scale=1'>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ $chat_name }} - Chatbot</title>
  <link href='/assets/style.css' rel='stylesheet'>
  <link rel="manifest" href="manifest.json">

  <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' rel='stylesheet'>
  <link rel="stylesheet" type="text/css" href="/assets/fonts/css/fontawesome-all.min.css">  
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  
</head>