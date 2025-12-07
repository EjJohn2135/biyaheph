
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Under Maintenance - BiyahePH</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        .maintenance-container {
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 600px;
            width: 100%;
            margin: 1rem;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .maintenance-header {
            background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            color: white;
            padding: 3rem 2rem;
            text-align: center;
        }

        .maintenance-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

        .maintenance-header h1 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .maintenance-header p {
            opacity: 0.95;
            margin: 0;
            font-size: 1rem;
        }

        .maintenance-body {
            padding: 2.5rem;
            text-align: center;
        }

        .maintenance-message {
            font-size: 1.1rem;
            color: #4b5563;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .status-indicator {
            display: inline-block;
            width: 12px;
            height: 12px;
            background: #ef4444;
            border-radius: 50%;
            margin-right: 0.5rem;
            animation: blink 1s infinite;
        }

        @keyframes blink {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }

        .maintenance-footer {
            background: #f8fafc;
            padding: 1.5rem 2rem;
            text-align: center;
            border-top: 1px solid #e5e7eb;
        }

        .maintenance-footer p {
            color: #9ca3af;
            font-size: 0.9rem;
            margin: 0;
        }

        .maintenance-footer i {
            color: #f59e0b;
            margin-right: 0.5rem;
        }

        @media (max-width: 480px) {
            .maintenance-header {
                padding: 2rem 1.5rem;
            }

            .maintenance-header h1 {
                font-size: 1.5rem;
            }

            .maintenance-icon {
                font-size: 3rem;
            }

            .maintenance-body {
                padding: 1.5rem;
            }

            .maintenance-message {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="maintenance-container">
        <div class="maintenance-header">
            <div class="maintenance-icon">
                <i class="fas fa-tools"></i>
            </div>
            <h1>Under Maintenance</h1>
            <p>We'll be back soon!</p>
        </div>

        <div class="maintenance-body">
            <p class="maintenance-message">
                <?= esc($message ?? 'We are currently under maintenance. Please check back soon!') ?>
            </p>
        </div>

        <div class="maintenance-footer">
            <p>
                <span class="status-indicator"></span>
                System Status: <strong>Maintenance Mode Active</strong>
            </p>
        </div>
    </div>
</body>
</html>