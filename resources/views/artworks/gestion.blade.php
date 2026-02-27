<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ITGallery - Gestión / Galería</title>

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

      --orange:#d84812;
      --orange2:#c43f10;

      --btnDark:#111111;
      --btnDark2:#000000;

      --ok:#0b7a2a;
      --err:#b10000;
    }

    *{ box-sizing:border-box; }
    body{
      margin:0;
      font-family: Arial, Helvetica, sans-serif;
      background:var(--page);
      color:var(--ink);
    }

    /* ====== Layout (igual que editar/ficha) ====== */
    .app{ display:flex; min-height:100vh; }

    .sidebar{
      width:230px;
      flex:0 0 230px;
      background:var(--sidebar);
      color:var(--sidebarText);
      padding:14px 0;
    }
    .brand{
      display:flex;
      align-items:center;
      gap:8px;
      padding:0 14px 12px;
      border-bottom:1px solid #1f1f1f;
      margin-bottom:8px;
    }
    .brand .badge{
      background:#fff;
      color:#000;
      font-weight:900;
      font-size:14px;
      padding:2px 6px;
      border-radius:2px;
      letter-spacing:.2px;
    }
    .brand .name{
      font-weight:900;
      color:#fff;
      font-size:16px;
    }

    .nav{ padding:8px 0; }
    .nav a, .nav button{
      width:100%;
      display:flex;
      align-items:center;
      justify-content:space-between;
      padding:10px 14px;
      background:transparent;
      border:0;
      color:var(--sidebarText);
      cursor:pointer;
      font-size:13px;
      text-align:left;
      text-decoration:none;
    }
    .nav a:hover, .nav button:hover{ color:#fff; background:#141414; }
    .nav a.active{ color:var(--sidebarActive); font-weight:700; }

    .nav .left{ display:flex; align-items:center; gap:8px; }
    .chev{ color:#9a9a9a; font-weight:900; }

    .submenu{ padding:4px 0 6px; }
    .submenu a{
      padding:8px 14px 8px 32px;
      font-size:12px;
      color:#bdbdbd;
    }
    .submenu a:hover{ color:#fff; }

    .main{ flex:1; display:flex; flex-direction:column; }

    .topbar{
      display:flex;
      align-items:center;
      justify-content:space-between;
      padding:14px 16px 8px;
      border-bottom:2px solid var(--line);
      background:#fff;
    }
    .topLeft .gname{
      font-weight:800;
      font-size:20px;
      margin:0;
    }
    .topLeft .subtitle{
      margin:4px 0 0;
      color:var(--muted);
      font-size:13px;
    }

    .topRight{
      display:flex;
      align-items:center;
      gap:0;
    }
    .qwrap{
      display:flex;
      align-items:center;
      border:2px solid var(--line);
      height:30px;
      background:#fff;
    }
    .qwrap input{
      width:220px;
      border:0;
      outline:none;
      padding:0 10px;
      font-size:12px;
      background:#fff;
    }
    .qwrap .qicon{
      width:34px;
      height:30px;
      border-left:2px solid var(--line);
      display:flex;
      align-items:center;
      justify-content:center;
      font-weight:900;
      user-select:none;
    }
    .ticon{
      width:32px;
      height:30px;
      border:2px solid var(--line);
      border-left:0;
      display:flex;
      align-items:center;
      justify-content:center;
      font-size:12px;
      background:#fff;
      user-select:none;
    }

    .crumbRow{
      display:flex;
      align-items:center;
      justify-content:space-between;
      padding:8px 16px 10px;
      border-bottom:2px solid var(--line);
      background:#fff;
    }
    .crumb{
      color:#9a9a9a;
      font-size:11px;
      letter-spacing:.2px;
      text-transform:uppercase;
    }
    .date{
      color:#9a9a9a;
      font-size:11px;
      white-space:nowrap;
      text-transform:uppercase;
    }

    .panel{
      margin:0 16px 18px;
      border:2px solid var(--line);
      background:#fff;
      padding:18px;
    }

    /* ====== Gestión: layout interno ====== */
    .panelHeader{
      display:flex;
      align-items:flex-start;
      justify-content:space-between;
      gap:14px;
      padding-bottom:12px;
      border-bottom:2px solid var(--softline);
      margin-bottom:14px;
    }
    .panelHeader h1{
      margin:0;
      font-size:20px;
      font-weight:900;
      line-height:1.1;
    }
    .panelHeader p{
      margin:6px 0 0;
      color:var(--muted);
      font-size:12px;
    }

    .split{
      display:grid;
      grid-template-columns: 420px 1fr;
      gap:18px;
      align-items:start;
    }

    @media (max-width: 980px){
      .split{ grid-template-columns:1fr; }
      .qwrap input{ width:160px; }
    }

    /* ====== ActionBar (reutilizada) ====== */
    .actionBar{
      display:flex;
      width:fit-content;
      border:2px solid var(--line);
      height:34px;
      background:#fff;
      margin:0;
    }
    .actionBar .btn{
      height:34px;
      padding:0 18px;
      border:0;
      cursor:pointer;
      font-weight:900;
      font-size:12px;
      background:#fff;
      color:#000;
      display:inline-flex;
      align-items:center;
      justify-content:center;
      text-decoration:none;
      user-select:none;
      border-right:2px solid var(--line);
    }
    .actionBar .btn:last-child{ border-right:0; }
    .actionBar .btn.save{
      background:var(--orange);
      color:#fff;
    }
    .actionBar .btn.save:hover{ background:var(--orange2); }

    /* ====== Form estilo (línea inferior) ====== */
    .cardTitle{
      margin:0 0 10px 0;
      padding:10px 0;
      border-top:2px solid var(--line);
      border-bottom:2px solid var(--line);
      font-size:14px;
      font-weight:900;
    }

    .formWrap{ max-width:820px; }
    .formRow{
      display:grid;
      grid-template-columns: 160px 1fr;
      gap:22px;
      align-items:center;
      padding:10px 0;
    }
    .formRow label{
      font-size:12px;
      color:#9a9a9a;
      line-height:1.2;
      white-space:nowrap;
    }
    .req::after{
      content:"*";
      color:var(--orange);
      margin-left:2px;
      font-weight:900;
    }
    .field{
      display:flex;
      align-items:center;
      gap:14px;
      min-width:0;
      flex-wrap:wrap;
    }
    .inputLine{
      width:520px;
      max-width:100%;
      height:30px;
      border:0;
      border-bottom:2px solid var(--line);
      background:transparent;
      outline:none;
      font-size:13px;
      padding:0 2px;
    }
    .miniHelp{
      font-size:11px;
      color:#9a9a9a;
    }
    .fileLine input[type="file"]{ font-size:12px; }

    @media (max-width: 980px){
      .formRow{ grid-template-columns:1fr; gap:8px; }
      .formRow label{ white-space:normal; }
      .inputLine{ width:100%; }
    }

    /* ====== Alerts ====== */
    .alert{
      border:2px solid var(--line);
      padding:10px 12px;
      margin:0 0 12px 0;
      font-size:12px;
      background:#fff;
    }
    .alert.ok{ border-color:var(--ok); }
    .alert.err{ border-color:var(--err); }
    .alert b{ display:block; margin-bottom:6px; }
    .alert ul{ margin:0; padding-left:18px; }

    /* ====== Tabla simple estilo “ITG” ====== */
    .tableWrap{
      border-top:2px solid var(--line);
      margin-top:10px;
      padding-top:10px;
      overflow:auto;
    }
    table{
      width:100%;
      border-collapse:collapse;
    }
    th, td{
      padding:10px 8px;
      border-bottom:1px solid #efefef;
      font-size:12px;
      vertical-align:top;
      text-align:left;
    }
    th{
      color:#8a8a8a;
      font-weight:800;
      text-transform:none;
      white-space:nowrap;
    }
    .tblActions{ white-space:nowrap; text-align:right; }

    .thumb{
      width:54px;
      height:54px;
      object-fit:cover;
      border:2px solid var(--line);
      background:#fff;
      display:block;
    }
    .muted{ color:#9a9a9a; }

    .miniBtn{
      display:inline-flex;
      align-items:center;
      justify-content:center;
      height:26px;
      padding:0 10px;
      border:2px solid var(--line);
      background:#fff;
      font-size:11px;
      font-weight:900;
      cursor:pointer;
      text-decoration:none;
      color:#000;
      margin-left:6px;
      user-select:none;
    }
    .miniBtn.orange{
      background:var(--orange);
      color:#fff;
      border-color:var(--line);
    }
    .miniBtn.orange:hover{ background:var(--orange2); }
    .miniBtn.danger{
      border-color:#ffb3b3;
      color:var(--err);
    }
    .miniBtn.danger:hover{
      background:var(--err);
      color:#fff;
      border-color:var(--err);
    }
    .inline{ display:inline; }
  </style>
</head>

<body>
@php
  // Para que el link "Artwork detail" del menú no quede muerto si no hay obras:
  $firstId = isset($obras) && $obras->count() ? $obras->first()->id : 1;
@endphp

<div class="app">
  <!-- SIDEBAR -->
  <aside class="sidebar">
    <div class="brand">
      <span class="badge">IT</span>
      <span class="name">Gallery</span>
    </div>

    <div class="nav">
      <a href="{{ url('/') }}"><span class="left">Home</span></a>
      <a href="{{ url('/artists') }}"><span class="left">Artist</span></a>

      <button type="button" class="navdrop" aria-expanded="true" aria-controls="mArt">
        <span class="left"><b style="color:#fff">Artworks</b></span>
        <span class="chev">˅</span>
      </button>
      <div class="submenu" id="mArt">
    <a href="{{ route('ficha.list') }}">Artworks list</a>
    <a href="{{ url('ficha/' . $firstId) }}">Artwork detail</a>
    <a class="active" href="{{ url('artworks/gestion') }}">Gestión Galera</a>
</div>

      <button type="button" class="navdrop" aria-expanded="false" aria-controls="mMov">
        <span class="left">Movements</span>
        <span class="chev">˅</span>
      </button>
      <div class="submenu" id="mMov" hidden>
        <a href="{{ url('/movements') }}">All movements</a>
      </div>

      <a href="{{ url('/exhibitions') }}"><span class="left">Exhibitions</span></a>
      <a href="{{ url('/sales') }}"><span class="left">Sales</span></a>
      <a href="{{ url('/offers') }}"><span class="left">Offers</span></a>
      <a href="{{ url('/contacts') }}"><span class="left">Contacts</span></a>
      <a href="{{ url('/emails') }}"><span class="left">Emails</span></a>
      <a href="{{ url('/mailing') }}"><span class="left">Mailing</span></a>
    </div>
  </aside>

  <!-- MAIN -->
  <main class="main">
    <!-- TOP -->
    <div class="topbar">
      <div class="topLeft">
        <p class="gname">Gallery name</p>
        <p class="subtitle">Gestión / Galería</p>
      </div>

      <div class="topRight">
        <div class="qwrap" title="Quick search (placeholder)">
          <input placeholder="Quick search" />
          <div class="qicon">⌕</div>
        </div>
        <div class="ticon" title="Icon">□</div>
        <div class="ticon" title="Icon">!</div>
        <div class="ticon" title="Icon">👤</div>
      </div>
    </div>

    <div class="crumbRow">
      <div class="crumb">ARTWORKS / GESTIÓN / GALERÍA</div>
      <div class="date" id="pageDate">—</div>
    </div>

    <section class="panel">
      <div class="panelHeader">
        <div>
          <h1>Gestión / Galería</h1>
          <p>Añade obras y gestiona el listado (ver/editar/eliminar).</p>
        </div>

        <div class="actionBar">
          <button class="btn save" type="submit" form="createForm">Crear</button>
          <button class="btn" type="reset" form="createForm">Limpiar</button>
        </div>
      </div>

      {{-- Flash + errores --}}
      @if (session('success'))
        <div class="alert ok">
          <b>OK</b>
          {{ session('success') }}
        </div>
      @endif

      @if ($errors->any())
        <div class="alert err">
          <b>Errores en el formulario</b>
          <ul>
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="split">
        <!-- FORM -->
        <div>
          <div class="cardTitle">Añadir obra</div>

          <form id="createForm" method="POST" action="{{ url('/artworks') }}" enctype="multipart/form-data">
            @csrf

            <div class="formWrap">
              <div class="formRow">
                <label class="req">Title</label>
                <div class="field">
                  <input class="inputLine" type="text" name="titulo" value="{{ old('titulo') }}" required>
                </div>
              </div>

              <div class="formRow">
                <label class="req">Artist</label>
                <div class="field">
                  <input class="inputLine" type="text" name="artista" value="{{ old('artista') }}" required>
                </div>
              </div>

              <div class="formRow">
                <label class="req">Inventory ID</label>
                <div class="field">
                  <input class="inputLine" type="text" name="inventario" value="{{ old('inventario') }}" required>
                </div>
              </div>

              <div class="formRow">
                <label>Year</label>
                <div class="field">
                  <input class="inputLine" type="number" name="anio" value="{{ old('anio') }}">
                </div>
              </div>

              <div class="formRow">
                <label>Dimensions</label>
                <div class="field">
                  <input class="inputLine" type="text" name="tamano" value="{{ old('tamano') }}" placeholder="Ej: 52x15 cm | 20.5x6 in">
                </div>
              </div>

              <div class="formRow">
                <label>Image</label>
                <div class="field fileLine">
                  <input type="file" name="imagen" accept="image/*">
                </div>
              </div>
            </div>
          </form>
        </div>

        <!-- LIST -->
        <div>
          <div class="cardTitle">Obras</div>

          <div class="tableWrap">
            <table>
              <thead>
                <tr>
                  <th style="width:70px">Image</th>
                  <th style="width:60px">ID</th>
                  <th>Title</th>
                  <th>Artist</th>
                  <th>Inventory</th>
                  <th style="width:70px">Year</th>
                  <th style="width:160px">Dimensions</th>
                  <th class="tblActions" style="width:220px">Actions</th>
                </tr>
              </thead>
              <tbody>
                @forelse($obras as $obra)
                  <tr>
                    <td>
                      @if(!empty($obra->imagen))
                        <img class="thumb" src="{{ asset('storage/imagenes/' . $obra->imagen) }}" alt="Imagen obra {{ $obra->id }}">
                      @else
                        <span class="muted">—</span>
                      @endif
                    </td>

                    <td><b>{{ $obra->id }}</b></td>
                    <td>{{ $obra->titulo }}</td>
                    <td>{{ $obra->artista }}</td>
                    <td>{{ $obra->inventario }}</td>
                    <td>{{ $obra->anio ?? '—' }}</td>
                    <td>{{ $obra->tamano ?? '—' }}</td>

                    <td class="tblActions">
                      <a class="miniBtn" href="{{ url('/ficha/' . $obra->id) }}">Ver</a>
                      <a class="miniBtn orange" href="{{ url('/editar/' . $obra->id) }}">Editar</a>

                      <form class="inline" method="POST" action="{{ url('/artworks/' . $obra->id) }}">
                        @csrf
                        @method('DELETE')
                        <button class="miniBtn danger" type="submit"
                          onclick="return confirm('¿Eliminar esta obra?')">
                          Eliminar
                        </button>
                      </form>
                    </td>
                  </tr>
                @empty
                  <tr>
                    <td colspan="8" class="muted">No hay obras todavía.</td>
                  </tr>
                @endforelse
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </section>
  </main>
</div>

<script>
  // Sidebar dropdowns (mismo patrón que en tus otras vistas)
  document.querySelectorAll('.navdrop').forEach(btn => {
    const id = btn.getAttribute('aria-controls');
    const panel = document.getElementById(id);
    const open = btn.getAttribute('aria-expanded') === 'true';

    if (!open) panel.setAttribute('hidden', '');

    btn.addEventListener('click', () => {
      const isOpen = btn.getAttribute('aria-expanded') === 'true';
      btn.setAttribute('aria-expanded', String(!isOpen));
      if (isOpen) panel.setAttribute('hidden', '');
      else panel.removeAttribute('hidden');
    });
  });

  // Fecha tipo captura: "9 FEB 2026"
  (function(){
    const d = new Date();
    const m = ["JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC"];
    const el = document.getElementById('pageDate');
    if (el) el.textContent = d.getDate() + " " + m[d.getMonth()] + " " + d.getFullYear();
  })();
</script>
</body>
</html>