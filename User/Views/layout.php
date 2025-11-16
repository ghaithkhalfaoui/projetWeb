<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Gestion Users' ?></title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rowdies:wght@300;400;700&display=swap');
        *{margin:0;padding:0;box-sizing:border-box;font-family:'Rowdies',sans-serif;}
        body{background:#C6D3F3;min-height:100vh;display:flex;justify-content:center;align-items:center;padding:20px;}
        main{background:white;padding:40px;border-radius:15px;box-shadow:0 10px 30px rgba(0,0,0,0.2);width:90%;max-width:1000px;}
        h1{text-align:center;margin-bottom:30px;color:#2c3e50;}
        .link{background:#6F7BD9;color:white;padding:12px 25px;border-radius:8px;text-decoration:none;display:inline-block;}
        table{width:100%;border-collapse:collapse;margin-top:20px;background:white;border-radius:10px;overflow:hidden;}
        th{background:#6F7BD9;color:white;padding:15px;}
        td{padding:15px;text-align:center;border-bottom:1px solid #eee;}
        form{max-width:500px;margin:0 auto;background:white;padding:30px;border-radius:10px;}
        input[type=text],input[type=email]{width:100%;padding:15px;margin:10px 0;border:1px solid #ccc;border-radius:5px;}
        input[type=submit],button{background:#6F7BD9;color:white;border:none;padding:15px;border-radius:5px;cursor:pointer;width:100%;margin-top:10px;}
        .msg{padding:15px;margin:15px 0;border-radius:8px;text-align:center;}
        .success{background:#d4edda;color:#155724;}
    </style>
</head>
<body>
<main><?= $content ?? '' ?></main>
</body>
</html>