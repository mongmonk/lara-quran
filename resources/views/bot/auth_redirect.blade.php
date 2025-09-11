<!DOCTYPE html>
<html>
<head>
    <title>Authenticating...</title>
    <script src="https://telegram.org/js/telegram-web-app.js"></script>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; background-color: #212121; color: #fff; }
        .container { text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <p>Please wait, authenticating...</p>
    </div>
    <script>
        window.onload = function() {
            const tg = window.Telegram.WebApp;
            tg.ready();

            if (tg.initData) {
                // Redirect to the validation route with the initData
                const validationUrl = "{{ route('bot.jadwalsholat.validate') }}";
                window.location.href = validationUrl + '?_auth=' + encodeURIComponent(tg.initData);
            } else {
                document.body.innerHTML = '<div class="container"><p>Authentication failed: Telegram initData not found.</p></div>';
            }
        };
    </script>
</body>
</html>