<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  </head>
  <body class="bg-info">
    <div class="row justify-content-center">
        <div class="col-md-4 my-5 text-center bg-light rounded py-3">
            <h1>LOGIN</h1>
            <div class="card-body my-4">
                <script async src="https://telegram.org/js/telegram-widget.js?2" data-telegram-login="MasjidMyQuranBot" data-size="large" data-auth-url="{{ url('welcome/authorization') }}"></script>
            </div>
            <div class="card-footer">
                <div class="small  text-info">Tunggu sampai muncul tombol Masuk dengan Telegram muncul. Waktu pertama kali buka akan sedikit agak lama, harap bersabar ini ujian 🙏🏻. Untuk yang berikutnya akan tampil normal.<br><a href="https://www.youtube.com/embed/p3XUO7Hd2Ww" target="_blank" class="text-warning">Bingung cara login?</a></div> 
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
  </body>
</html>