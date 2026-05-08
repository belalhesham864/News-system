<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>404 - Page Not Found</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="{{ asset($setting->favicon) }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
        body {
            background: #f8f9fa;
        }
        .error-container {
            height: 100vh;
        }
        .error-code {
            font-size: 120px;
            font-weight: bold;
            color: #0d6efd;
        }
        .error-text {
            font-size: 22px;
            color: #6c757d;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center error-container text-center">
    <div>
        <div class="error-code">404</div>
        <div class="error-text mb-3">Oops! Page Not Found</div>
        <p class="text-muted mb-4">
            The page you are looking for might have been removed or is temporarily unavailable.
        </p>

        <a href="{{ route('forntend.index') }}" class="btn btn-primary px-4" >
            Back to Home
        </a>
    </div>
</div>

</body>
</html>