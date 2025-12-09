<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flux Dashboard</title>
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
    .nav a{color:var(--muted);text-decoration:none;padding:8px;border-radius:8px;display:flex;gap:10px;align-items:center;cursor:pointer;}
    .nav a.active{background:rgba(255,255,255,0.02);color:var(--accent)}
    .nav a:hover{background:rgba(255,255,255,0.01)}
    .version{margin-top:auto;color:#7b8585;font-size:12px}

    /* Main area */
    .main{flex:1;padding:32px 40px}
    .header{display:flex;align-items:center;gap:20px;justify-content:space-between}
    .title{font-size:22px;font-weight:700;color:#e9f9f3; display: flex; align-items: center; gap: 12px;}
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
    
    .hidden { display: none; }
  </style>

  <div class="app">
    <aside class="sidebar">
      <div class="logo"><span class="bolt"></span>Flux</div>
      <nav class="nav">
        <a id="nav-country" class="active" onclick="switchTab('country')">Update Country List</a>
        <a id="nav-module" onclick="switchTab('module')">Update Module List</a>
      </nav>
      <div class="version">v4.8.8</div>
    </aside>

    <main class="main">
      
      <!-- ==================== COUNTRY VIEW ==================== -->
      <div id="view-country">
          <div class="header">
            <div>
              <div class="title">
                <a href="index.php" class="icon-btn" style="text-decoration:none;color:var(--accent);width:32px;height:32px;margin-right:10px" title="Back to Map">
                  <svg viewBox="0 0 24 24" width="20" height="20" fill="currentColor"><path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/></svg>
                </a>
                Manage Countries
              </div>
            </div>
          </div>

          <!-- form for adding a country-->  
          <form action="ajoutc.php" method="post" onsubmit="return ManageCountryAdd()">
            <div class="section-title">Add country</div> 
              <div class="controls">
                <div class="search"><input type="text" placeholder="Input name" name='country' id="nameA"/></div>
                <div class="search"><input type="text" placeholder="Input LocationX" name='locationX' id="lxCA"/></div>
                <div class="search"><input type="text" placeholder="Input LocationY" name='loactionY' id="lyCA"/></div>
                <div class="search"><input type="text" placeholder="Input LocationZ" name='locationZ' id="lzCA"/></div>
                <div class="search"><input type="text" placeholder="Input idpost" name='idpost' id="idpA"/></div>
                <input class="btn" type="submit" value="Add">
            </div>
          </form>

          <!-- form for modifying any country-->  
          <form action="modifyc.php" method="post" onsubmit="return ManageCountryModify()">
            <div class="section-title">Modify Country</div> 
              <div class="controls">
                <div class="search"><input type="text" placeholder="Input country name for which u want to modify" name='cond' id="condM"/></div>
                <div class="search"><input type="text" placeholder="Input name" name='country' id="nameM"/></div>
                <div class="search"><input type="text" placeholder="Input LocationX" name='locationX' id="lxCM"/></div>
                <div class="search"><input type="text" placeholder="Input LocationY" name='loactionY' id="lyCM"/></div>
                <div class="search"><input type="text" placeholder="Input LocationZ" name='locationZ' id="lzCM"/></div>
                <div class="search"><input type="text" placeholder="Input idpost" name='idpost' id="idpM"/></div>
                <input class="btn" type="submit" value="Modify">
            </div>
          </form>

          <!-- form for Deleting any country-->  
          <form action="deletec.php" method="post" onsubmit="return ManageCountryDelete()">
            <div class="section-title">Delete Country</div> 
              <div class="controls">
                <div class="search"><input type="text" placeholder="Input name" name='country' id="nameCD"/></div>
                <input class="btn" type="submit" value="Delete">
            </div>
          </form>

          <!-- PHP List for Countries -->
          <div style="margin-top:20px;">
              <?php 
                include '../config.php' ;
                try {
                    $db = config::getConnexion();  
                    $req = $db->query("SELECT * FROM `country`");
                    foreach ($req as $m) {
                        echo "path: <span class='namelist'>" . $m['countryName'] . "</span>|";
                        echo "locationX: " . $m['locationX'] . "|";
                        echo "locationY: " . $m['locationY'] . "|";
                        echo "locationZ: " . $m['locationZ'] . "|";
                        echo "IdPost: " . $m['idPost'] . "<br><hr>";
                    }
                } catch (Exception $e){
                    die('error:' .$e->getMessage());
                }
              ?>
          </div>
      </div>

      <!-- ==================== MODULE VIEW ==================== -->
      <div id="view-module" class="hidden">
          <div class="header">
            <div>
              <div class="title">Manage Modules</div>
            </div>
          </div>

          <!-- form for adding a module -->  
          <form action="ajout.php" method="post" onsubmit="return ManageModuleAdd()">
            <div class="section-title">Add Modules</div> 
              <div class="controls">
                <div class="search"><input type="text" placeholder="Input Path" name='path' id="pathA"/></div>
                <div class="search"><input type="text" placeholder="Input LocationX" name='locationX' id="lxA"/></div>
                <div class="search"><input type="text" placeholder="Input LocationY" name='loactionY' id="lyA"/></div>
                <div class="search"><input type="text" placeholder="Input LocationZ" name='locationZ' id="lzA"/></div>
                <input class="btn" type="submit" value="Add">
            </div>
          </form>

          <!-- form for modifying any module -->  
          <form action="modify.php" method="post" onsubmit="return ManageModuleModify()">
            <div class="section-title">Modify Modules</div> 
              <div class="controls">
                <div class="search"><input type="text" placeholder="Input Path for which u want to modify" name='cond' id="cond"/></div>
                <div class="search"><input type="text" placeholder="Input Path" name='path' id="pathM"/></div>
                <div class="search"><input type="text" placeholder="Input LocationX" name='locationX' id="lxM"/></div>
                <div class="search"><input type="text" placeholder="Input LocationY" name='loactionY'id="lyM"/></div>
                <div class="search"><input type="text" placeholder="Input LocationZ" name='locationZ'id="lzM"/></div>
                <input class="btn" type="submit" value="Modify">
            </div>
          </form>

          <!-- form for Deleting any module -->  
          <form action="delete.php" method="post" onsubmit="return ManageModuleDelete()">
            <div class="section-title">Delete Modules</div> 
              <div class="controls">
                <div class="search"><input type="text" placeholder="Input Path" name='path' id="pathD"/></div>
                <input class="btn" type="submit" value="Delete">
            </div>
          </form>

          <!-- PHP List for Modules -->
          <div style="margin-top:20px;">
              <?php 
                try {
                // Config already included in top section, but if switching views reloading page might be needed for separate PHP scopes if they were separate files. 
                // But here it's one file. DB connection is already established or can be reused.
                // Note: config::getConnexion() usually returns a singleton or new connection.
                if(!isset($db)) $db = config::getConnexion();  
                $req = $db->query("SELECT * FROM `module`");
                foreach ($req as $m) {
                    echo "path: <span class='pathlist'>" . $m['ModleDesign'] . "</span>|";
                    echo "locationX: " . $m['locationX'] . "|";
                    echo "locationY: " . $m['locationY'] . "|";
                    echo "locationZ: " . ($m['locationZ'] ?? '') . "<br><hr>";
                }
                } catch (Exception $e){
                    die('error:' .$e->getMessage());
                }
              ?>
          </div>
      </div>

    </main>
  </div>

<script src="control.js"></script>
<script>
    function switchTab(tab) {
        const viewCountry = document.getElementById('view-country');
        const viewModule = document.getElementById('view-module');
        const navCountry = document.getElementById('nav-country');
        const navModule = document.getElementById('nav-module');

        if(tab === 'country') {
            viewCountry.classList.remove('hidden');
            viewModule.classList.add('hidden');
            navCountry.classList.add('active');
            navModule.classList.remove('active');
        } else {
            viewCountry.classList.add('hidden');
            viewModule.classList.remove('hidden');
            navCountry.classList.remove('active');
            navModule.classList.add('active');
        }
    }
</script>

</body>
</html>
