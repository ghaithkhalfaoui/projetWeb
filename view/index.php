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
        .search-container {
            margin-right: 20px;
            pointer-events: auto;
        }
        #country-search {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            padding: 10px 15px;
            color: #e6f2f0;
            font-family: inherit;
            outline: none;
            backdrop-filter: blur(5px);
            transition: all 0.2s;
            width: 200px;
        }
        #country-search:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: var(--accent);
            box-shadow: 0 0 10px rgba(111, 243, 214, 0.2);
        }
        #country-search::placeholder {
            color: rgba(230, 242, 240, 0.6);
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
        <div class="search-container">
            <input type="text" id="country-search" placeholder="Search country...">
        </div>
        <a href="../view/dashboard.php" class="btn-dashboard">
            Go to Dashboard
        </a>
    </div>
    <canvas class="threejs"></canvas>
    <div id="marker-tooltip"></div>
    <script type="module" src="../main.js"></script>
</body>
</html>
