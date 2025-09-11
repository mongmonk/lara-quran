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
            word-break: break-all;
            padding: 1em;
            text-align: center;
        }
    </style>
</head>
<body>
    <div id="status">
        <p>Please wait, initializing...</p>
    </div>
    <script>
        try {
            const tg = window.Telegram.WebApp;
            tg.ready();

            // Function to attempt redirect
            function attemptRedirect() {
                if (tg.initData) {
                    document.getElementById('status').innerHTML = '<p>Authentication data found. Redirecting...</p>';
                    const url = new URL('{{ $targetUrl }}');
                    url.searchParams.set('_auth', tg.initData);
                    window.location.replace(url.toString());
                } else {
                     // If it's still not available after a short delay, show an error.
                    document.getElementById('status').innerHTML = '<p>Error: Could not retrieve Telegram authentication data (initData is empty).</p>';
                }
            }

            // Wait a brief moment to ensure the initData is populated.
            setTimeout(attemptRedirect, 150);

        } catch (e) {
            document.getElementById('status').innerHTML = '<p>Fatal Error: Telegram WebApp script failed. ' + e.message + '</p>';
        }
    </script>
</body>
</html>