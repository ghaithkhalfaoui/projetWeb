<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3D World Map</title>
    <link rel="stylesheet" href="../css.css">
    <style>
        :root {
            --bg: #0f1111;
            --accent: #6ff3d6;
            --glass: rgba(255, 255, 255, 0.03);
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }
        body {
            margin: 0;
            overflow: hidden;
            background: var(--bg);
            color: #e6f2f0;
        }
        .app-header {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            padding: 24px 40px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
            box-sizing: border-box;
            z-index: 1;
            pointer-events: none; /* Allow clicking through to map */
        }
        .btn-dashboard {
            pointer-events: auto;
            background: var(--accent);
            color: #062422;
            padding: 10px 18px;
            border-radius: 10px;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(111, 243, 214, 0.2);
            transition: transform 0.2s, box-shadow 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }
        .btn-dashboard:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(111, 243, 214, 0.3);
        }
        canvas.threejs {
            display: block;
            width: 100vw;
            height: 100vh;
        }
    </style>
</head>
<body>
    <div class="app-header">
        <a href="../view/dashboard.php" class="btn-dashboard">
            Go to Dashboard
        </a>
    </div>
    <canvas class="threejs"></canvas>
    <div id="marker-tooltip"></div>
    <script type="module" src="../main.js"></script>
</body>
</html>
