<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loading...</title>
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #212121;
            color: #fff;
            font-family: sans-serif;
        }
    </style>
</head>
<body>
    <p>Please wait, authenticating...</p>
    <script>
        window.onload = function() {
            const tg = window.Telegram.WebApp;
            tg.ready();

            if (tg.initData) {
                const url = new URL('{{ $targetUrl }}');
                url.searchParams.set('_auth', tg.initData);
                window.location.replace(url.toString());
            } else {
                document.body.innerHTML = '<p>Forbidden: Could not retrieve Telegram authentication data.</p>';
            }
        };
    </script>
</body>
</html>