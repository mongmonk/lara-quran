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
        <p>Please wait, initializing Telegram WebApp...</p>
    </div>
    <script>
        try {
            const tg = window.Telegram.WebApp;
            tg.ready();

            let attempts = 0;
            const maxAttempts = 20; // Try for 2 seconds (20 * 100ms)
            const targetUrl = '{{ $targetUrl }}';

            const authenticator = setInterval(() => {
                attempts++;
                document.getElementById('status').innerHTML = `<p>Authenticating... (Attempt ${attempts}/${maxAttempts})</p>`;

                if (tg.initData) {
                    clearInterval(authenticator);
                    document.getElementById('status').innerHTML = '<p>Authentication data found. Redirecting...</p>';
                    const url = new URL(targetUrl);
                    url.searchParams.set('_auth', tg.initData);
                    window.location.replace(url.toString());
                } else if (attempts >= maxAttempts) {
                    clearInterval(authenticator);
                    document.getElementById('status').innerHTML = '<p>Error: Could not retrieve Telegram authentication data after several attempts. Please try closing and reopening this window.</p>';
                }
            }, 100);

        } catch (e) {
            document.getElementById('status').innerHTML = '<p>Fatal Error: Telegram WebApp script failed. ' + e.message + '</p>';
        }
    </script>
</body>
</html>