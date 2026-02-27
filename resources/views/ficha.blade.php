<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>ITGallery - Artwork detail</title>

  <style>
    :root{
      --sidebar:#0b0b0b;
      --sidebarText:#cfcfcf;
      --sidebarActive:#ffffff;

      --page:#ffffff;
      --ink:#0f0f0f;
      --muted:#6e6e6e;

      --line:#1a1a1a;
      --softline:#e7e7e7;

      --tab:#e9e9e9;
      --tabActive:#ffffff;

      --orange:#d84812;
      --orange2:#c43f10;

      --btnDark:#111111;
      --btnDark2:#000000;
    }

    *{ box-sizing:border-box; }
    body{ margin:0; font-family: Arial, Helvetica, sans-serif; background: var(--page); color: var(--ink); }

    .app{ display:flex; min-height:100vh; }

    .sidebar{
      width:230px; flex:0 0 230px;
      background:var(--sidebar);
      color:var(--sidebarText);
      padding:14px 0;
    }
    .brand{
      display:flex; align-items:center; gap:8px;
      padding:0 14px 12px;
      border-bottom:1px solid #1f1f1f;
      margin-bottom:8px;
    }
    .brand .badge{
      background:#fff; color:#000;
      font-weight:900; font-size:14px;
      padding:2px 6px; border-radius:2px;
      letter-spacing:.2px;
    }
    .brand .name{
      font-weight:900; color:#fff;
      font-size:16px;
    }

    .nav{ padding:8px 0; }
    .nav a, .nav button{
      width:100%;
      display:flex; align-items:center; justify-content:space-between;
      padding:10px 14px;
      background:transparent;
      border:0;
      color:var(--sidebarText);
      cursor:pointer;
      font-size:13px;
      text-align:left;
    }
    .nav a:hover, .nav button:hover{ color:#fff; background:#141414; }
    .nav a.active{ color:var(--sidebarActive); font-weight:700; }
    .nav .left{
      display:flex; align-items:center; gap:8px;
    }
    .chev{ color:#9a9a9a; font-weight:900; }
    .submenu{
      padding:4px 0 6px;
    }
    .submenu a{
      padding:8px 14px 8px 32px;
      font-size:12px;
      color:#bdbdbd;
    }

    .main{ flex:1; display:flex; flex-direction:column; }
    .topbar{
      display:flex; align-items:center; justify-content:space-between;
      padding:14px 16px 8px;
      border-bottom:2px solid var(--line);
      background:#fff;
    }
    .topLeft .gname{ font-weight:800; font-size:20px; margin:0; }
    .topLeft .subtitle{ margin:4px 0 0; color:var(--muted); font-size:13px; }

    .topRight{ display:flex; align-items:center; gap:0; }
    .qwrap{
      display:flex; align-items:center;
      border:2px solid var(--line);
      height:30px;
      background:#fff;
    }
    .qwrap input{
      width:220px;
      border:0; outline:none;
      padding:0 10px;
      font-size:12px;
      background:#fff;
    }
    .qwrap .qicon{
      width:34px; height:30px;
      border-left:2px solid var(--line);
      display:flex; align-items:center; justify-content:center;
      font-weight:900;
    }
    .ticon{
      width:32px; height:30px;
      border:2px solid var(--line);
      border-left:0;
      display:flex; align-items:center; justify-content:center;
      font-size:12px;
      background:#fff;
    }

    .crumbRow{
      display:flex; align-items:center; justify-content:space-between;
      padding:8px 16px 10px;
      border-bottom:2px solid var(--line);
      background:#fff;
    }
    .crumb{
      color:#9a9a9a;
      font-size:11px;
      letter-spacing:.2px;
    }
    .date{
      color:#9a9a9a;
      font-size:11px;
      white-space:nowrap;
    }

    .tabs{
      display:flex; gap:6px;
      padding:10px 16px 0;
      background:#fff;
    }
    .tab{
      border:2px solid var(--line);
      background:var(--tab);
      padding:6px 12px;
      font-size:12px;
      cursor:pointer;
    }
    .tab.active{
      background:var(--tabActive);
      border-bottom-color:#fff;
      font-weight:700;
    }

    .panel{
      margin:0 16px 18px;
      border:2px solid var(--line);
      background:#fff;
      padding:18px;
    }

    /* CLAVE: sin gap entre columnas para que “toque” la imagen */
    .summary{
      display:grid;
      grid-template-columns: 420px 1fr;
      gap:0;
      align-items:stretch; /* estira la columna derecha para poder pegar la botonera abajo */
    }
    @media (max-width: 980px){
      .summary{ grid-template-columns:1fr; }
    }

    .artBox{
      border:2px solid var(--line);
      padding:10px;
      background:#fff;
    }
    .artBox img{ width:100%; height:auto; display:block; }

    /* Columna derecha: contenido arriba y botonera al fondo */
    .infoCol{
      display:flex;
      flex-direction:column;
      min-height:100%;
    }
    .infoContent{
      padding-left:22px; /* “gap” solo para el contenido, no para la botonera */
    }

    .titleRow{
      display:flex; align-items:flex-start; justify-content:space-between; gap:12px;
    }
    .titleRow h1{
      margin:0;
      font-size:44px;
      line-height:1.02;
      font-weight:900;
    }
    .navArrows{
      display:flex;
      border:2px solid var(--line);
      height:32px;
      margin-left:12px;
    }
    .navArrows a{
      width:34px;
      display:flex; align-items:center; justify-content:center;
      border-left:2px solid var(--line);
      font-weight:900;
      text-decoration:none;
      color:inherit;
    }
    .navArrows a:first-child{ border-left:0; }

    .series{ margin-top:8px; color:#9a9a9a; font-size:12px; }
    .artist{ margin-top:10px; font-size:13px; }
    .artist b{ color: var(--orange); }

    .flags{ margin-top:10px; display:flex; gap:18px; color:#444; font-size:12px; }
    .flag{ display:flex; align-items:center; gap:6px; }
    .dot{ width:8px; height:8px; border-radius:50%; background:#bbb; display:inline-block; }
    .dot.res{ background:#f0c04a; }
    .dot.av{ background:#22b36b; }

    .meta{
      margin-top:14px;
      display:flex;
      flex-direction:column;
      gap:10px;
      font-size:14px;
    }
    .meta .inv{ font-weight:700; }
    .meta .price{ color:#222; }

    /* BOTONERA: al lado de la imagen, abajo, pegada al borde */
    .exportRow{
      margin-top:auto;          /* la empuja al fondo de la columna derecha */
      display:flex;
      align-items:stretch;
      height:34px;
      width:fit-content;
      background:#fff;

      border:2px solid var(--line);
      border-left:0;            /* evita doble borde junto al marco de la imagen */
    }

    .pencil{
      width:44px; height:34px;
      display:flex; align-items:center; justify-content:center;
      border-right:2px solid var(--line);
      font-weight:900;
      text-decoration:none;
      color:#000;
      background:#fff;
      flex:0 0 44px;
    }

    .exBtn{
      height:34px;
      display:flex; align-items:center; justify-content:center;
      padding:0 18px;
      font-size:12px;
      font-weight:800;
      border-right:2px solid var(--line);
      user-select:none;
      text-decoration:none;
      white-space:nowrap;
    }
    .exBtn.orange{ background:var(--orange); color:#fff; }
    .exBtn.orange:hover{ background:var(--orange2); }
    .exBtn.dark{ background:var(--btnDark); color:#fff; border-right:0; }
    .exBtn.dark:hover{ background:var(--btnDark2); }

    .edHeader{
      margin:18px 0 10px;
      padding:10px 0;
      border-top:2px solid var(--line);
      border-bottom:2px solid var(--line);
      font-size:22px;
      font-weight:900;
    }
    .edTools{
      display:flex; align-items:center; gap:10px; flex-wrap:wrap;
      padding:10px 0;
      border-bottom:2px solid var(--softline);
    }
    .newEdition{
      background:var(--orange);
      color:#fff;
      border:2px solid var(--line);
      height:30px;
      padding:0 14px;
      font-weight:800;
      font-size:12px;
      display:inline-flex; align-items:center;
      text-decoration:none;
    }
    .newEdition:hover{ background:var(--orange2); }

    .searchMini{
      display:flex; align-items:center;
      border:2px solid var(--line);
      height:30px;
      background:#fff;
    }
    .searchMini input{
      width:160px; border:0; outline:none; padding:0 10px; font-size:12px;
    }
    .searchMini .lens{
      width:34px; height:30px;
      border-left:2px solid var(--line);
      display:flex; align-items:center; justify-content:center;
      font-weight:900;
    }

    .selectMini{
      border:2px solid var(--line);
      height:30px;
      padding:0 10px;
      font-size:12px;
      background:#fff;
    }
    .smallNote{ color:#9a9a9a; font-size:11px; }

    table{ width:100%; border-collapse:collapse; margin-top:10px; }
    th, td{ padding:10px 8px; border-bottom:1px solid #efefef; font-size:12px; vertical-align:top; }
    th{ color:#8a8a8a; font-weight:800; }
    .tblActions{ white-space:nowrap; }
    .ico{
      display:inline-flex; align-items:center; justify-content:center;
      width:22px; height:22px;
      border:1px solid #ddd;
      margin-left:6px;
      font-size:12px;
      border-radius:50%;
      color:#444;
      background:#fff;
    }
    .ico.trash{ border-color:#ffb3b3; color:#d10000; }
  </style>
</head>

<body>
<div class="app">

  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="brand">
      <span class="badge">IT</span>
      <span class="name">Gallery</span>
    </div>

    <div class="nav">
      <a href="/"><span class="left">Home</span></a>
      <a href="#"><span class="left">Artist</span></a>

      <button type="button" class="navdrop" aria-expanded="true" aria-controls="mArt">
        <span class="left"><b style="color:#fff">Artworks</b></span>
        <span class="chev">˅</span>
      </button>
      <div class="submenu" id="mArt">
    <a href="{{ route('ficha.list') }}">Artworks list</a>
    <a class="active" href="{{ url('ficha/' . $obra->id) }}">Artwork detail</a>
    <a href="{{ url('artworks/gestion') }}">Gestión Galera</a>
</div>

      <button type="button" class="navdrop" aria-expanded="false" aria-controls="mMov">
        <span class="left">Movements</span>
        <span class="chev">˅</span>
      </button>
      <div class="submenu" id="mMov" hidden>
        <a href="#">All movements</a>
      </div>

      <a href="#"><span class="left">Exhibitions</span></a>
      <a href="#"><span class="left">Sales</span></a>
      <a href="#"><span class="left">Offers</span></a>
      <a href="#"><span class="left">Contacts</span><span class="chev">˅</span></a>
      <a href="#"><span class="left">Emails</span></a>
      <a href="#"><span class="left">Mailing</span><span class="chev">›</span></a>
    </div>
  </aside>

  <!-- MAIN -->
  <main class="main">

    <!-- TOP -->
    <div class="topbar">
      <div class="topLeft">
        <p class="gname">Gallery name</p>
        <p class="subtitle">Artwork detail</p>
      </div>

      <div class="topRight">
        <div class="qwrap">
          <input placeholder="Quick search" />
          <div class="qicon">⌕</div>
        </div>
        <div class="ticon">□</div>
        <div class="ticon">🔔</div>
        <div class="ticon">👤</div>
      </div>
    </div>

    <div class="crumbRow">
      <div class="crumb">ARTWORKS / ARTWORKS LIST / ARTWORK DETAIL</div>
      <div class="date" id="pageDate">6 • APR • 2021</div>
    </div>

    <!-- TABS -->
    <div class="tabs" role="tablist" aria-label="Artwork detail tabs">
      <button class="tab active" role="tab" id="tSummary" aria-selected="true" aria-controls="pSummary" tabindex="0">Summary</button>
      <button class="tab" role="tab" id="tGeneral" aria-selected="false" aria-controls="pGeneral" tabindex="-1">General</button>
      <button class="tab" role="tab" id="tImages" aria-selected="false" aria-controls="pImages" tabindex="-1">Images</button>
      <button class="tab" role="tab" id="tActions" aria-selected="false" aria-controls="pActions" tabindex="-1">Actions</button>
      <button class="tab" role="tab" id="tAdd" aria-selected="false" aria-controls="pAdd" tabindex="-1">Additional info</button>
      <button class="tab" role="tab" id="tDocs" aria-selected="false" aria-controls="pDocs" tabindex="-1">Documents</button>
      <button class="tab" role="tab" id="tExh" aria-selected="false" aria-controls="pExh" tabindex="-1">Exhibitions</button>
    </div>

    <!-- PANEL -->
    <section class="panel">
      @if(!$obra)
        <div style="color:#b00;font-weight:800">No se encontró la obra.</div>
      @else

        <!-- SUMMARY -->
        <div role="tabpanel" id="pSummary" aria-labelledby="tSummary">
          <div class="summary">

            <!-- IZQUIERDA: imagen -->
            <div class="artBox">
              @if($obra->imagen)
                <img src="{{ asset('storage/imagenes/' . $obra->imagen) }}" alt="Imagen de la obra">
              @endif
            </div>

            <!-- DERECHA: info + BOTONERA AL LADO (abajo) -->
            <div class="infoCol">

              <div class="infoContent">
                <div class="titleRow">
                  <h1>{{ $obra->titulo }}</h1>
                  <div class="navArrows">
                    <a href="/ficha/{{ max(1, $id-1) }}" aria-label="Anterior">‹</a>
                    <a href="/ficha/{{ $id+1 }}" aria-label="Siguiente">›</a>
                  </div>
                </div>

                <div class="series">From series: Interventions</div>

                <div class="artist"><b>{{ $obra->artista }}</b></div>

                <div class="flags">
                  <span class="flag"><span class="dot res"></span>Reserved</span>
                  <span class="flag"><span class="dot av"></span>Available</span>
                </div>

                <div class="meta">
                  <div class="inv">{{ $obra->inventario }}</div>
                  <div>{{ $obra->anio }}</div>
                  <div>{{ $obra->tamano }}</div>
                  <div class="price">800€ · 1.299 USD · 700€ with discount</div>
                </div>
              </div>

              <div class="exportRow">
                <a class="pencil" href="{{ url('/editar/' . $obra->id) }}" aria-label="Editar">✎</a>
                <a class="exBtn orange" href="#" onclick="return false;">Export PDF</a>
                <a class="exBtn dark" href="#" onclick="return false;">Export &amp; send PDF</a>
              </div>

            </div>

          </div>

          <div class="edHeader">Editions</div>

          <div class="edTools">
            <a class="newEdition" href="#" onclick="return false;">New edition</a>

            <div class="searchMini">
              <input placeholder="Search" />
              <div class="lens">⌕</div>
            </div>

            <select class="selectMini">
              <option>Show 15 entries</option>
              <option>Show 25 entries</option>
              <option>Show 50 entries</option>
            </select>

            <div class="smallNote">Showing 1 to 11 of 11 entries</div>
          </div>

          <table>
            <thead>
              <tr>
                <th style="width:28px"><input type="checkbox" /></th>
                <th>Edition</th>
                <th>Inventory ID</th>
                <th>Price</th>
                <th>Frame</th>
                <th>Year</th>
                <th>Location</th>
                <th>Sub location</th>
                <th>Dimensions</th>
                <th>Status</th>
                <th>Availability</th>
                <th class="tblActions">Actions</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><input type="checkbox" /></td>
                <td>1 of 1</td>
                <td>{{ $obra->inventario }}-001</td>
                <td>800€<br>1.299 USD<br>700€ w/discount</td>
                <td style="font-weight:900">×</td>
                <td>{{ $obra->anio }}</td>
                <td>Fundación</td>
                <td>-</td>
                <td>{{ $obra->tamano }}<br>1.9x9.8x5.1 in</td>
                <td><span class="flag"><span class="dot res"></span>In transit</span></td>
                <td><span class="flag"><span class="dot av"></span>Available</span></td>
                <td class="tblActions">
                  <span class="ico">i</span>
                  <span class="ico">✎</span>
                  <span class="ico trash">🗑</span>
                </td>
              </tr>

              <tr>
                <td><input type="checkbox" /></td>
                <td>1 of 1</td>
                <td>{{ $obra->inventario }}-001</td>
                <td>800€<br>1.299 USD<br>700€ w/discount</td>
                <td style="font-weight:900">×</td>
                <td>{{ $obra->anio }}</td>
                <td>Fundación</td>
                <td>-</td>
                <td>{{ $obra->tamano }}<br>1.9x9.8x5.1 in</td>
                <td><span class="flag"><span class="dot res"></span>In transit</span></td>
                <td><span class="flag"><span class="dot av"></span>Available</span></td>
                <td class="tblActions">
                  <span class="ico">i</span>
                  <span class="ico">✎</span>
                  <span class="ico trash">🗑</span>
                </td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Otros tabs (placeholder) -->
        <div role="tabpanel" id="pGeneral" aria-labelledby="tGeneral" hidden>General…</div>
        <div role="tabpanel" id="pImages" aria-labelledby="tImages" hidden>Images…</div>
        <div role="tabpanel" id="pActions" aria-labelledby="tActions" hidden>Actions…</div>
        <div role="tabpanel" id="pAdd" aria-labelledby="tAdd" hidden>Additional info…</div>
        <div role="tabpanel" id="pDocs" aria-labelledby="tDocs" hidden>Documents…</div>
        <div role="tabpanel" id="pExh" aria-labelledby="tExh" hidden>Exhibitions…</div>
      @endif
    </section>

  </main>
</div>

<script>
  // Dropdowns sidebar
  document.querySelectorAll(".navdrop").forEach(btn => {
    const id = btn.getAttribute("aria-controls");
    const panel = document.getElementById(id);
    const open = btn.getAttribute("aria-expanded") === "true";
    if (!open) panel.setAttribute("hidden", "");
    btn.addEventListener("click", () => {
      const isOpen = btn.getAttribute("aria-expanded") === "true";
      btn.setAttribute("aria-expanded", String(!isOpen));
      if (isOpen) panel.setAttribute("hidden", "");
      else panel.removeAttribute("hidden");
    });
  });

  // Tabs
  const tabs = Array.from(document.querySelectorAll('[role="tab"]'));
  function activate(tab){
    tabs.forEach(t => { t.classList.remove("active"); t.setAttribute("aria-selected","false"); t.setAttribute("tabindex","-1"); });

    tab.classList.add("active");
    tab.setAttribute("aria-selected","true");
    tab.setAttribute("tabindex","0");

    document.querySelectorAll('[role="tabpanel"]').forEach(p => p.setAttribute("hidden",""));
    const p = document.getElementById(tab.getAttribute("aria-controls"));
    if (p) p.removeAttribute("hidden");
  }
  tabs.forEach(t => t.addEventListener("click", ()=>activate(t)));

  // Fecha en el formato de la captura
  const d = new Date();
  const m = ["JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC"];
  document.getElementById("pageDate").textContent = `${d.getDate()} • ${m[d.getMonth()]} • ${d.getFullYear()}`;
</script>
</body>
</html>