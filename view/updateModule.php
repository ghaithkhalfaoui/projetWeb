<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
    :root{
      --bg:#0f1111; --panel:#151717; --muted:#9aa3a3; --accent:#6ff3d6; --danger:#ff6b6b; --warn:#ffd29a; --card:#1b1d1d; --glass:rgba(255,255,255,0.03);
      --radius:10px; --pad:18px; --gap:18px;
      font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }
    *{box-sizing:border-box}
    html,body{height:100%;margin:0;background:linear-gradient(#0b0c0c,#0e0f0f);color:#e6f2f0}
    .app{display:flex;min-height:100vh}

    /* Sidebar */
    .sidebar{width:160px;background:linear-gradient(180deg,var(--panel),#0f1111);padding:28px 18px;display:flex;flex-direction:column;gap:18px}
    .logo{display:flex;align-items:center;gap:10px;font-weight:700;color:var(--accent)}
    .logo .bolt{width:28px;height:28px;border-radius:6px;background:linear-gradient(180deg,#2ef2c7,#0ab29a);display:inline-block}
    .nav{margin-top:24px;display:flex;flex-direction:column;gap:12px}
    .nav a{color:var(--muted);text-decoration:none;padding:8px;border-radius:8px;display:flex;gap:10px;align-items:center}
    .nav a.active{background:rgba(255,255,255,0.02);color:var(--accent)}
    .nav a:hover{background:rgba(255,255,255,0.01)}
    .version{margin-top:auto;color:#7b8585;font-size:12px}

    /* Main area */
    .main{flex:1;padding:32px 40px}
    .header{display:flex;align-items:center;gap:20px;justify-content:space-between}
    .title{font-size:22px;font-weight:700;color:#e9f9f3}
    .controls{display:flex;gap:12px;align-items:center}
    .search{background:var(--card);padding:8px 12px;border-radius:12px;min-width:360px;display:flex;align-items:center;gap:10px}
    .search input{background:transparent;border:0;outline:none;color:#cfe9e3;width:100%}
    .btn{background:var(--accent);color:#062422;padding:8px 12px;border-radius:8px;font-weight:600}

    .pills{display:flex;gap:8px;margin:18px 0}
    .pill{background:rgba(255,255,255,0.03);padding:6px 10px;border-radius:999px;font-size:13px;color:var(--muted)}

    .alert{background:linear-gradient(90deg,#f8e9cf,#fff0d6);color:#3a240b;padding:14px;border-radius:10px;margin:12px 0;box-shadow:0 2px 0 rgba(0,0,0,0.5)}

    .section-title{font-size:13px;color:var(--muted);margin:18px 0 8px}

    /* Featured carousel */
    .carousel{display:flex;gap:12px;overflow:auto;padding-bottom:10px}
    .card{min-width:220px;background:linear-gradient(180deg,rgba(255,255,255,0.02),rgba(255,255,255,0.01));padding:14px;border-radius:12px;border:1px solid rgba(255,255,255,0.03)}
    .card h4{margin:0 0 8px;font-size:14px}
    .meta{font-size:12px;color:var(--muted)}

    /* Grid */
    .grid{display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:14px;margin-top:16px}
    .service{background:var(--card);padding:14px;border-radius:12px;border:1px solid rgba(255,255,255,0.03);position:relative}
    .service h5{margin:0 0 8px;font-size:14px}
    .service p{margin:0 0 12px;color:var(--muted);font-size:13px}
    .badge{display:inline-block;padding:6px 8px;border-radius:999px;font-size:12px}
    .badge.active{background:rgba(107,224,187,0.12);color:#8ef1d7;border:1px solid rgba(107,224,187,0.08)}
    .badge.pending{background:rgba(255,210,120,0.08);color:var(--warn);border:1px solid rgba(255,210,120,0.06)}
    .badge.error{background:rgba(255,100,100,0.06);color:var(--danger);border:1px solid rgba(255,100,100,0.06)}
    .service .actions{position:absolute;right:12px;bottom:12px;display:flex;gap:8px}
    .icon-btn{width:36px;height:36px;border-radius:8px;background:var(--glass);display:inline-flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,0.02)}

    /* small responsive tweaks */
    @media (max-width:900px){.sidebar{display:none}.main{padding:20px}}

    /* add subtle scrollbar style */
    .carousel::-webkit-scrollbar{height:8px}
    .carousel::-webkit-scrollbar-thumb{background:rgba(255,255,255,0.05);border-radius:20px}
  </style>

  <div class="app">
    <aside class="sidebar">
      <div class="logo"><span class="bolt"></span>Flux</div>
      <nav class="nav">
        <a class="active">Dashboard</a>
        <a>Analytics</a>
        <a>Files</a>
        <a>Settings</a>
      </nav>
      <div class="version">v4.8.8</div>
    </aside>

    <main class="main">
      <div class="header">
        <div>
          <div class="title">Manage Modules</div>
        </div>
      </div>

      
      <!--from for adding a country modle path-->  
      <form action="ajout.php" method="post" onsubmit="return ManageModuleAdd()">
        <div class="section-title">Add Modules</div> 
          <div class="controls">
            <div class="search"><input type="text" placeholder="Input Path" name='path' id="pathA"/></div>
            <div class="search"><input type="text" placeholder="Input LocationX" name='locationX' id="lxA"/></div>
            <div class="search"><input type="text" placeholder="Input LocationY" name='loactionY' id="lyA"/></div>
            <input class="btn" type="submit" value="Add">
        </div>
      </form>



      <!--from for modifying any country-->  
      <form action="modify.php" method="post" onsubmit="return ManageModuleModify()">
        <div class="section-title">Modify Modules</div> 
          <div class="controls">
            <div class="search"><input type="text" placeholder="Input Path for which u want to modify" name='cond' id="cond"/></div>
            <div class="search"><input type="text" placeholder="Input Path" name='path' id="pathM"/></div>
            <div class="search"><input type="text" placeholder="Input LocationX" name='locationX' id="lxM"/></div>
            <div class="search"><input type="text" placeholder="Input LocationY" name='loactionY'id="lyM"/></div>
            <input class="btn" type="submit" value="Modify">
        </div>
      </form>

      <!--from for Deleting any country-->  
      <form action="delete.php" method="post" onsubmit="return ManageModuleDelete()">
        <div class="section-title">Delete Modules</div> 
          <div class="controls">
            <div class="search"><input type="text" placeholder="Input Path" name='path' id="pathD"/></div>
            <input class="btn" type="submit" value="Delete">
            
        </div>
      </form>


      <?PHP 
    include '../config.php' ;
    try {
    $db = config::getConnexion();  
    $req = $db->query("SELECT * FROM `module`");
    foreach ($req as $m) {
    echo "path: <span class='pathlist'>" . $m['ModleDesign'] . "</span>|";
    echo "locationX: " . $m['locationX'] . "|";
    echo "locationY: " . $m['locationY'] . "<br><hr>";
}
} 
 catch (Exeption $e){
        die('error:' .$e->getMessage());
    }
    ?>
      





        </div>
      </div>
    </main>
  </div>

<script src="control.js"></script>

























<!-- <h1>add</h1>
  <form action="ajout.php" method="POST"  onsubmit="return isValidPath">
        <input type="text" name='path' placeholder="entrer votre path" class="path">
        <input type="number" name='locationX' placeholder="entrer votre locx">
        <input type="number" name='loactionY' placeholder="entrer votre locy">
        <input type="submit" value="add">
    </form>
    <h1>update</h1>
  <form action="modify.php" method="POST" onsubmit="return isValidPath">
        <input type="text" name='cond' placeholder="path de module a changer" class="path">
        <input type="text" name='path' placeholder="entrer votre path" class="path">
        <input type="number" name='locationX' placeholder="entrer votre locx">
        <input type="number" name='loactionY' placeholder="entrer votre locy">
        <input type="submit" value="save">
    </form>
    <h1>delete</h1>
  <form action="delete.php" method="POST" onsubmit="return isValidPath">
        <input type="text" name='path' placeholder="entrer votre path" class="path">
        <input type="submit" value="delete">
    </form> -->



  
    
</body>
</html>