<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar obra</title>

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
      text-decoration:none;
    }
    .nav a:hover, .nav button:hover{ color:#fff; background:#141414; }
    .nav a.active{ color:var(--sidebarActive); font-weight:700; }
    .nav .left{ display:flex; align-items:center; gap:8px; }
    .chev{ color:#9a9a9a; font-weight:900; }
    .submenu{ padding:4px 0 6px; }
    .submenu a{ padding:8px 14px 8px 32px; font-size:12px; color:#bdbdbd; }

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
    .crumb{ color:#9a9a9a; font-size:11px; letter-spacing:.2px; }
    .date{ color:#9a9a9a; font-size:11px; white-space:nowrap; }

    .panel{
      margin:0 16px 18px;
      border:2px solid var(--line);
      background:#fff;
      padding:18px;
    }

    /* Barra Save / Cancel */
    .actionBar{
      display:flex;
      width:fit-content;
      border:2px solid var(--line);
      height:34px;
      background:#fff;
      margin:0 0 18px 0;
    }
    .actionBar .btn{
      height:34px;
      padding:0 24px;
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
    }
    .actionBar .btn.save{
      background:var(--orange);
      color:#fff;
      border-right:2px solid var(--line);
    }
    .actionBar .btn.save:hover{ background:var(--orange2); }

    /* Form estilo */
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
    .req::after{ content:"*"; color:var(--orange); margin-left:2px; font-weight:900; }

    .field{ display:flex; align-items:center; gap:14px; min-width:0; flex-wrap:wrap; }
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
    select.inputLine{ padding-left:0; }

    .miniHelp{ font-size:11px; color:#9a9a9a; }

    .sectionTitle{
      margin:18px 0 10px;
      padding:10px 0;
      border-top:2px solid var(--line);
      border-bottom:2px solid var(--line);
      font-size:14px;
      font-weight:900;
    }

    /* Toggle */
    .toggle{ display:inline-flex; align-items:center; gap:10px; }
    .toggle input{ display:none; }
    .switch{
      width:38px; height:20px;
      border:2px solid var(--line);
      border-radius:999px;
      position:relative;
      background:#fff;
      flex:0 0 auto;
    }
    .switch::after{
      content:"";
      width:14px; height:14px;
      border:2px solid var(--line);
      border-radius:50%;
      position:absolute;
      top:50%; left:2px;
      transform:translateY(-50%);
      background:#fff;
    }
    .toggle input:checked + .switch{ background:#f2f2f2; }
    .toggle input:checked + .switch::after{ left:18px; }

    /* Chips */
    .chips{ display:flex; gap:8px; flex-wrap:wrap; align-items:center; }
    .chip{
      display:inline-flex;
      align-items:center;
      gap:6px;
      border:2px solid var(--line);
      height:22px;
      padding:0 8px;
      font-size:11px;
      background:#fff;
    }
    .chip .x{ font-weight:900; cursor:pointer; }

    /* Inline groups */
    .rowInline{ display:flex; gap:12px; flex-wrap:wrap; align-items:flex-end; }
    .miniInput{
      width:90px; height:30px;
      border:0; border-bottom:2px solid var(--line);
      outline:none;
      font-size:13px;
      background:transparent;
      padding:0 2px;
    }
    .miniSelect{
      width:90px; height:30px;
      border:0; border-bottom:2px solid var(--line);
      outline:none;
      font-size:13px;
      background:transparent;
      padding:0 2px;
    }

    .btnGhost, .btnWide{
      height:30px;
      padding:0 12px;
      border:2px solid var(--line);
      background:#fff;
      font-size:12px;
      font-weight:900;
      cursor:pointer;
      white-space:nowrap;
    }
    .btnGhost:hover, .btnWide:hover{ background:#f4f4f4; }

    .fileLine input[type="file"]{ font-size:12px; }

    @media (max-width: 980px){
      .formRow{ grid-template-columns:1fr; gap:8px; }
      .formRow label{ white-space:normal; }
      .inputLine{ width:100%; }
    }
  </style>
</head>

<body>
<div class="app">

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
    <a href="{{ url('ficha/' . $obra->id) }}">Artwork detail</a>
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

  <main class="main">
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
      <div class="date" id="pageDate">5 • FEB • 2026</div>
    </div>

    <section class="panel">

      <div class="actionBar">
        <button class="btn save" type="submit" form="editForm">Save</button>
        <a class="btn" href="{{ url('/ficha/' . $obra->id) }}">Cancel</a>
      </div>

      <form id="editForm" action="{{ url('/api/obra/' . $obra->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="formWrap">

          <div class="formRow">
            <label class="req">Language</label>
            <div class="field">
              @php($lang = old('language', $obra->language ?? 'English'))
              <select class="inputLine" name="language">
                <option value="English" {{ $lang==='English' ? 'selected' : '' }}>English</option>
                <option value="Spanish" {{ $lang==='Spanish' ? 'selected' : '' }}>Spanish</option>
              </select>
              <a href="#" onclick="return false;" style="font-size:12px;color:var(--orange);font-weight:800;text-decoration:none;">Help</a>
            </div>
          </div>

          <div class="formRow">
            <label class="req">Title</label>
            <div class="field">
              <input class="inputLine" type="text" name="titulo" value="{{ old('titulo', $obra->titulo) }}">
            </div>
          </div>

          <div class="formRow">
            <label>Serie name</label>
            <div class="field">
              <input class="inputLine" type="text" name="serie" value="{{ old('serie', $obra->serie ?? 'Interventions') }}">
            </div>
          </div>

          <div class="formRow">
            <label class="req">Artist</label>
            <div class="field">
              <input class="inputLine" type="text" name="artista" value="{{ old('artista', $obra->artista) }}">
            </div>
          </div>

          <div class="formRow">
            <label>Year</label>
            <div class="field">
              <input class="inputLine" type="number" name="anio" value="{{ old('anio', $obra->anio) }}">
            </div>
          </div>

          <div class="formRow">
            <label class="req">Inventory ID</label>
            <div class="field">
              <input class="inputLine" type="text" name="inventario" value="{{ old('inventario', $obra->inventario) }}">
            </div>
          </div>

          <div class="formRow">
            <label class="req">Status</label>
            <div class="field">
              @php($st = old('status', $obra->status ?? 'Reserved'))
              <select class="inputLine" name="status">
                <option value="Reserved" {{ $st==='Reserved' ? 'selected' : '' }}>Reserved</option>
                <option value="In transit" {{ $st==='In transit' ? 'selected' : '' }}>In transit</option>
                <option value="Sold" {{ $st==='Sold' ? 'selected' : '' }}>Sold</option>
              </select>
            </div>
          </div>

          <div class="formRow">
            <label class="req">Availability</label>
            <div class="field">
              @php($av = old('availability', $obra->availability ?? 'Available'))
              <select class="inputLine" name="availability">
                <option value="Available" {{ $av==='Available' ? 'selected' : '' }}>Available</option>
                <option value="Not available" {{ $av==='Not available' ? 'selected' : '' }}>Not available</option>
              </select>
            </div>
          </div>

          <div class="formRow">
            <label>Ownership</label>
            <div class="field">
              @php($own = old('ownership', $obra->ownership ?? ''))
              <select class="inputLine" name="ownership">
                <option value="" {{ $own==='' ? 'selected' : '' }}>Select an option</option>
                <option value="Gallery" {{ $own==='Gallery' ? 'selected' : '' }}>Gallery</option>
                <option value="Artist" {{ $own==='Artist' ? 'selected' : '' }}>Artist</option>
                <option value="Collector" {{ $own==='Collector' ? 'selected' : '' }}>Collector</option>
              </select>
            </div>
          </div>

          <div class="formRow">
            <label>Tags</label>
            <div class="field">
              <div class="chips" id="chipsTags">
                @php($tagsValue = old('tags', $obra->tags ?? 'Contemporary,Art'))
                @php($tagsArr = array_values(array_filter(array_map('trim', explode(',', $tagsValue)))))
                @forelse($tagsArr as $t)
                  <span class="chip">{{ $t }} <span class="x" data-x>×</span></span>
                @empty
                @endforelse
              </div>
              <input type="hidden" id="tagsHidden" name="tags" value="{{ $tagsValue }}">
              <input class="inputLine" style="width:220px" type="text" id="tagAdd" placeholder="Add tag">
              <button class="btnGhost" type="button" id="tagAddBtn">Add</button>
            </div>
          </div>

          <div class="sectionTitle">Dimensions <span class="miniHelp"></span></div>

          <div class="formRow">
            <label></label>
            <div class="field rowInline">
              <button class="btnGhost" type="button" onclick="return false;">Add dimensions</button>

              <label class="toggle">
                <input type="checkbox" name="variable_dimensions" value="1" {{ old('variable_dimensions', $obra->variable_dimensions ?? false) ? 'checked' : '' }}>
                <span class="switch"></span>
                <span style="font-size:12px;">Variable dimensions</span>
              </label>
            </div>
          </div>

          <div class="formRow">
            <label></label>
            <div class="field rowInline">
              <input class="miniInput" name="dim_cm_h" value="{{ old('dim_cm_h', $obra->dim_cm_h ?? '5') }}">
              <input class="miniInput" name="dim_cm_w" value="{{ old('dim_cm_w', $obra->dim_cm_w ?? '25') }}">
              <input class="miniInput" name="dim_cm_d" value="{{ old('dim_cm_d', $obra->dim_cm_d ?? '13') }}">
              <select class="miniSelect" name="dim_cm_unit">
                @php($cmu = old('dim_cm_unit', $obra->dim_cm_unit ?? 'cm'))
                <option value="cm" {{ $cmu==='cm' ? 'selected' : '' }}>cm</option>
              </select>
              <div class="chips" id="chipsDim1">
                <span class="chip">Contemporary <span class="x" data-x>×</span></span>
                <span class="chip">Art <span class="x" data-x>×</span></span>
              </div>
            </div>
          </div>

          <div class="formRow">
            <label></label>
            <div class="field rowInline">
              <input class="miniInput" name="dim_in_h" value="{{ old('dim_in_h', $obra->dim_in_h ?? '1.9') }}">
              <input class="miniInput" name="dim_in_w" value="{{ old('dim_in_w', $obra->dim_in_w ?? '9.80') }}">
              <input class="miniInput" name="dim_in_d" value="{{ old('dim_in_d', $obra->dim_in_d ?? '5.10') }}">
              <select class="miniSelect" name="dim_in_unit">
                @php($inu = old('dim_in_unit', $obra->dim_in_unit ?? 'in'))
                <option value="in" {{ $inu==='in' ? 'selected' : '' }}>in</option>
              </select>
              <div class="chips" id="chipsDim2">
                <span class="chip">Contemporary <span class="x" data-x>×</span></span>
              </div>
            </div>
          </div>

          <div class="formRow">
            <label>Duration (video)<br><span class="miniHelp">(Hrs : Mins : Secs)</span></label>
            <div class="field rowInline">
              <input class="miniInput" name="dur_h" value="{{ old('dur_h', $obra->dur_h ?? '00') }}">
              <input class="miniInput" name="dur_m" value="{{ old('dur_m', $obra->dur_m ?? '00') }}">
              <input class="miniInput" name="dur_s" value="{{ old('dur_s', $obra->dur_s ?? '00') }}">
            </div>
          </div>

          <div class="formRow">
            <label>Weight</label>
            <div class="field">
              <input class="inputLine" name="weight" value="{{ old('weight', $obra->weight ?? '0,00') }}">
            </div>
          </div>

          <div class="formRow">
            <label class="req">Editions</label>
            <div class="field rowInline">
              <input class="miniInput" name="editions" value="{{ old('editions', $obra->editions ?? '1') }}">

              <label class="toggle">
                <input type="checkbox" name="unique_edition" value="1" {{ old('unique_edition', $obra->unique_edition ?? true) ? 'checked' : '' }}>
                <span class="switch"></span>
                <span style="font-size:12px;">Unique edition</span>
              </label>

              <button class="btnWide" type="button" onclick="return false;">Configurar ediciones</button>
              <span class="miniHelp">There must be at least one edit to be able to use this functionality</span>
            </div>
          </div>

          <div class="sectionTitle">Price</div>

          <div class="formRow">
            <label class="req">Price</label>
            <div class="field rowInline">
              <button class="btnGhost" type="button" onclick="return false;">Add price</button>

              <label class="toggle">
                <input type="checkbox" name="no_price" value="1" {{ old('no_price', $obra->no_price ?? false) ? 'checked' : '' }}>
                <span class="switch"></span>
                <span style="font-size:12px;">No price</span>
              </label>
            </div>
          </div>

          <div class="formRow">
            <label></label>
            <div class="field rowInline">
              <input class="miniInput" name="price_1_amount" value="{{ old('price_1_amount', $obra->price_1_amount ?? '800') }}">
              <select class="miniSelect" name="price_1_currency">
                @php($p1c = old('price_1_currency', $obra->price_1_currency ?? 'EUR'))
                <option value="EUR" {{ $p1c==='EUR' ? 'selected' : '' }}>EUR</option>
                <option value="USD" {{ $p1c==='USD' ? 'selected' : '' }}>USD</option>
              </select>
              <input class="inputLine" style="width:260px" name="price_1_type" placeholder="Type" value="{{ old('price_1_type', $obra->price_1_type ?? '') }}">
              <span class="x" style="color:#b00;font-weight:900;cursor:pointer;" onclick="return false;">×</span>
            </div>
          </div>

          <div class="formRow">
            <label></label>
            <div class="field rowInline">
              <input class="miniInput" name="price_2_amount" value="{{ old('price_2_amount', $obra->price_2_amount ?? '1299') }}">
              <select class="miniSelect" name="price_2_currency">
                @php($p2c = old('price_2_currency', $obra->price_2_currency ?? 'USD'))
                <option value="EUR" {{ $p2c==='EUR' ? 'selected' : '' }}>EUR</option>
                <option value="USD" {{ $p2c==='USD' ? 'selected' : '' }}>USD</option>
              </select>
              <input class="inputLine" style="width:260px" name="price_2_type" placeholder="Type" value="{{ old('price_2_type', $obra->price_2_type ?? '') }}">
              <span class="x" style="color:#b00;font-weight:900;cursor:pointer;" onclick="return false;">×</span>
            </div>
          </div>

          <div class="formRow">
            <label></label>
            <div class="field rowInline">
              <input class="miniInput" name="price_3_amount" value="{{ old('price_3_amount', $obra->price_3_amount ?? '700') }}">
              <select class="miniSelect" name="price_3_currency">
                @php($p3c = old('price_3_currency', $obra->price_3_currency ?? 'EUR'))
                <option value="EUR" {{ $p3c==='EUR' ? 'selected' : '' }}>EUR</option>
                <option value="USD" {{ $p3c==='USD' ? 'selected' : '' }}>USD</option>
              </select>
              <input class="inputLine" style="width:260px" name="price_3_type" placeholder="Type" value="{{ old('price_3_type', $obra->price_3_type ?? 'descuento') }}">
              <span class="x" style="color:#b00;font-weight:900;cursor:pointer;" onclick="return false;">×</span>
            </div>
          </div>

          <div class="formRow">
            <label>Artist amount</label>
            <div class="field rowInline">
              <input class="inputLine" style="width:220px" name="artist_amount" value="{{ old('artist_amount', $obra->artist_amount ?? '0,00') }}">
              <select class="miniSelect" name="artist_amount_unit">
                @php($au = old('artist_amount_unit', $obra->artist_amount_unit ?? 'Percent'))
                <option value="Percent" {{ $au==='Percent' ? 'selected' : '' }}>Percent</option>
                <option value="Fixed" {{ $au==='Fixed' ? 'selected' : '' }}>Fixed</option>
              </select>
            </div>
          </div>

          <div class="formRow">
            <label>Description</label>
            <div class="field">
              <input class="inputLine" name="description" value="{{ old('description', $obra->description ?? '') }}">
            </div>
          </div>

          <div class="formRow">
            <label>Type</label>
            <div class="field">
              @php($type = old('type', $obra->type ?? 'Sculpture'))
              <select class="inputLine" name="type">
                <option value="Sculpture" {{ $type==='Sculpture' ? 'selected' : '' }}>Sculpture</option>
                <option value="Painting" {{ $type==='Painting' ? 'selected' : '' }}>Painting</option>
                <option value="Photography" {{ $type==='Photography' ? 'selected' : '' }}>Photography</option>
                <option value="Video" {{ $type==='Video' ? 'selected' : '' }}>Video</option>
              </select>
            </div>
          </div>

          <div class="formRow">
            <label>Technique</label>
            <div class="field">
              <input class="inputLine" name="technique" value="{{ old('technique', $obra->technique ?? '') }}">
            </div>
          </div>

          <div class="formRow">
            <label>Support</label>
            <div class="field">
              <input class="inputLine" name="support" value="{{ old('support', $obra->support ?? '') }}">
            </div>
          </div>

          <div class="formRow">
            <label>Material</label>
            <div class="field">
              <input class="inputLine" name="material" value="{{ old('material', $obra->material ?? '') }}">
            </div>
          </div>

          <div class="formRow">
            <label>Location</label>
            <div class="field">
              <input class="inputLine" name="location" value="{{ old('location', $obra->location ?? 'Fundación') }}">
            </div>
          </div>

          <div class="formRow">
            <label>Sublocation</label>
            <div class="field">
              <input class="inputLine" name="sublocation" value="{{ old('sublocation', $obra->sublocation ?? '') }}">
            </div>
          </div>

          <div class="formRow">
            <label>Notes</label>
            <div class="field">
              <input class="inputLine" name="notes" value="{{ old('notes', $obra->notes ?? '') }}">
            </div>
          </div>

          <div class="formRow">
            <label>Documentation notes</label>
            <div class="field">
              <input class="inputLine" name="documentation_notes" value="{{ old('documentation_notes', $obra->documentation_notes ?? '') }}">
            </div>
          </div>

          <div class="formRow">
            <label>PDF notes</label>
            <div class="field">
              <input class="inputLine" name="pdf_notes" value="{{ old('pdf_notes', $obra->pdf_notes ?? '') }}">
            </div>
          </div>

          <div class="formRow">
            <label>New image</label>
            <div class="field fileLine">
              <input type="file" name="imagen" accept="image/*">
            </div>
          </div>

          <div class="actionBar" style="margin-top:18px;">
            <button class="btn save" type="submit">Save</button>
            <a class="btn" href="{{ url('/ficha/' . $obra->id) }}">Cancel</a>
          </div>

        </div>
      </form>
    </section>
  </main>
</div>

<script>
  // Envío por fetch porque el form apunta a /api y quieres redirigir a la ficha.
  document.querySelector('#editForm').addEventListener('submit', async (e) => {
    e.preventDefault();

    const form = e.target;
    const data = new FormData(form);

    const res = await fetch(form.action, {
      method: 'POST',
      body: data,
      headers: { 'Accept': 'application/json' }
    });

    if (!res.ok) {
      const txt = await res.text();
      alert('Error guardando:\n' + txt);
      return;
    }

    window.location.href = "{{ url('/ficha/' . $obra->id) }}";
  });

  // Sidebar dropdowns
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

  // Chips: borrar y añadir tags
  const chips = document.getElementById('chipsTags');
  const hidden = document.getElementById('tagsHidden');

  function syncTagsHidden(){
    const vals = Array.from(chips.querySelectorAll('.chip'))
      .map(c => c.childNodes[0].textContent.trim())
      .filter(Boolean);
    hidden.value = vals.join(',');
  }

  chips?.addEventListener('click', (e) => {
    if (e.target && e.target.matches('[data-x]')) {
      e.target.parentElement.remove();
      syncTagsHidden();
    }
  });

  document.getElementById('tagAddBtn')?.addEventListener('click', () => {
    const inp = document.getElementById('tagAdd');
    const val = (inp.value || '').trim();
    if (!val) return;

    const span = document.createElement('span');
    span.className = 'chip';
    span.innerHTML = `${val} <span class="x" data-x>×</span>`;
    chips.appendChild(span);

    inp.value = '';
    syncTagsHidden();
  });

  // Fecha
  const d = new Date();
  const m = ["JAN","FEB","MAR","APR","MAY","JUN","JUL","AUG","SEP","OCT","NOV","DEC"];
  const el = document.getElementById("pageDate");
  if (el) el.textContent = `${d.getDate()} • ${m[d.getMonth()]} • ${d.getFullYear()}`;
</script>
</body>
</html>