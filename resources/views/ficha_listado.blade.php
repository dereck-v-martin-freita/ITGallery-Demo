<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ITGallery - Artworks list</title>

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
        }

        *{ box-sizing:border-box; }

        body{
            margin:0;
            font-family:Arial, Helvetica, sans-serif;
            background:var(--page);
            color:var(--ink);
        }

        .app{
            display:flex;
            min-height:100vh;
        }

        /* ===== SIDEBAR (copiado de gestion/ficha) ===== */
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

        .nav{
            padding:8px 0;
        }

        .nav a,
        .nav button{
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

        .nav a:hover,
        .nav button:hover{
            color:#fff;
            background:#141414;
        }

        .nav a.active{
            color:var(--sidebarActive);
            font-weight:700;
        }

        .nav .left{
            display:flex;
            align-items:center;
            gap:8px;
        }

        .chev{
            color:#9a9a9a;
            font-weight:900;
        }

        .submenu{
            padding:4px 0 6px;
        }

        .submenu a{
            padding:8px 14px 8px 32px;
            font-size:12px;
            color:#bdbdbd;
            display:block;
            text-decoration:none;
        }

        .submenu a:hover{
            color:#fff;
        }

        /* ===== MAIN (mismo layout) ===== */
        .main{
            flex:1;
            display:flex;
            flex-direction:column;
        }

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

        .qwrap form{
            display:flex;
        }

        .qwrap input{
            width:220px;
            border:0;
            outline:none;
            padding:0 10px;
            font-size:12px;
            background:#fff;
        }

        .qicon{
            width:34px;
            height:30px;
            border-left:2px solid var(--line);
            display:flex;
            align-items:center;
            justify-content:center;
            font-weight:900;
            font-size:13px;
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

        /* ===== FILTROS ===== */
        .toolbar{
            display:flex;
            gap:10px;
            flex-wrap:wrap;
            align-items:flex-end;
            margin-bottom:12px;
        }

        .tool{
            display:flex;
            flex-direction:column;
            gap:4px;
            font-size:11px;
            color:var(--muted);
        }

        .tool input,
        .tool select{
            height:30px;
            border:2px solid var(--line);
            padding:0 8px;
            font-size:12px;
            background:#fff;
            min-width:150px;
        }

        .btn{
            height:30px;
            border:2px solid var(--line);
            background:#fff;
            padding:0 14px;
            font-weight:900;
            font-size:12px;
            cursor:pointer;
            text-decoration:none;
            color:#000;
            display:inline-flex;
            align-items:center;
            justify-content:center;
        }

        .btn.orange{
            background:var(--orange);
            color:#fff;
        }

        .btn.orange:hover{
            background:var(--orange2);
        }

        /* ===== TABLA ===== */
        .tableWrap{
            overflow:auto;
            border-top:2px solid var(--line);
            padding-top:10px;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th,td{
            padding:10px 8px;
            border-bottom:1px solid #efefef;
            font-size:12px;
            vertical-align:top;
            text-align:left;
        }

        th{
            color:#8a8a8a;
            font-weight:800;
            white-space:nowrap;
        }

        tbody tr{
            cursor:pointer;
        }

        tbody tr:hover{
            background:#f7f7f7;
        }

        .thumb{
            width:40px;
            height:40px;
            object-fit:cover;
            border:2px solid var(--line);
            background:#fff;
            display:block;
        }

        .muted{
            color:#9a9a9a;
        }

        .actions{
            white-space:nowrap;
            text-align:right;
        }

        .pager{
            margin-top:10px;
            font-size:12px;
        }

        @media (max-width:980px){
            .app{ flex-direction:column; }
            .sidebar{ width:100%; flex:0 0 auto; }
            .qwrap input{ width:160px; }
            .toolbar{ flex-direction:column; align-items:flex-start; }
        }
    </style>
</head>
<body>
<div class="app">
    {{-- SIDEBAR COMPLETA --}}
    <aside class="sidebar">
        <div class="brand">
            <span class="badge">IT</span>
            <span class="name">Gallery</span>
        </div>

        <div class="nav">
            <a href="{{ url('/') }}">
                <span class="left"><span>Home</span></span>
            </a>

            <a href="{{ url('artist') }}">
                <span class="left"><span>Artist</span></span>
            </a>

            <button type="button" class="navdrop" aria-expanded="true" aria-controls="mArt">
                <span class="left"><b style="color:#fff;">Artworks</b></span>
                <span class="chev">▾</span>
            </button>
            <div class="submenu" id="mArt">
                <a class="active" href="{{ route('ficha.list') }}">Artworks list</a>
                <a href="{{ url('artworks/gestion') }}">Gestión Galera</a>
                <a href="{{ route('ficha', optional($obras->first())->id ?? 1) }}">Artwork detail</a>
            </div>

            <button type="button" class="navdrop" aria-expanded="false" aria-controls="mMov">
                <span class="left"><span>Movements</span></span>
                <span class="chev">▾</span>
            </button>
            <div class="submenu" id="mMov" hidden>
                <a href="{{ url('movements') }}">All movements</a>
            </div>

            <a href="{{ url('exhibitions') }}"><span class="left"><span>Exhibitions</span></span></a>
            <a href="{{ url('sales') }}"><span class="left"><span>Sales</span></span></a>
            <a href="{{ url('offers') }}"><span class="left"><span>Offers</span></span></a>
            <a href="{{ url('contacts') }}"><span class="left"><span>Contacts</span></span></a>
            <a href="{{ url('emails') }}"><span class="left"><span>Emails</span></span></a>
            <a href="{{ url('mailing') }}"><span class="left"><span>Mailing</span></span></a>
        </div>
    </aside>

    {{-- MAIN --}}
    <main class="main">
        <div class="topbar">
            <div class="topLeft">
                <p class="gname">Demo ITGallery</p>
                <p class="subtitle">Artworks list</p>
            </div>
            <div class="topRight">
                <div class="qwrap">
                    <form method="GET" action="{{ route('ficha.list') }}">
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscador rápido">
                    </form>
                    <div class="qicon">🔍</div>
                </div>
            </div>
        </div>

        <div class="crumbRow">
            <div class="crumb">ARTWORKS / ARTWORKS LIST</div>
            <div class="date" id="pageDate"></div>
        </div>

        <section class="panel">
            <form method="GET" action="{{ route('ficha.list') }}" class="toolbar">
                <div class="tool">
                    <span>Buscar</span>
                    <input type="text" name="q" value="{{ request('q') }}">
                </div>

                <div class="tool">
                    <span>Artista</span>
                    <input type="text" name="artist" value="{{ request('artist') }}">
                </div>

                <div class="tool">
                    <span>Inventario</span>
                    <input type="text" name="inventory" value="{{ request('inventory') }}">
                </div>

                <div class="tool">
                    <span>Año desde</span>
                    <input type="number" name="year_from" value="{{ request('year_from') }}">
                </div>

                <div class="tool">
                    <span>Año hasta</span>
                    <input type="number" name="year_to" value="{{ request('year_to') }}">
                </div>

                <div class="tool">
                    <span>Imagen</span>
                    <select name="has_image">
                        <option value=""  {{ request('has_image')==='' ? 'selected' : '' }}>Todas</option>
                        <option value="1" {{ request('has_image')==='1' ? 'selected' : '' }}>Con imagen</option>
                        <option value="0" {{ request('has_image')==='0' ? 'selected' : '' }}>Sin imagen</option>
                    </select>
                </div>

                <div class="tool">
                    <span>Por página</span>
                    @php($pp = (int) request('per_page', 15))
                    <select name="per_page">
                        <option value="15" {{ $pp===15 ? 'selected' : '' }}>15</option>
                        <option value="25" {{ $pp===25 ? 'selected' : '' }}>25</option>
                        <option value="50" {{ $pp===50 ? 'selected' : '' }}>50</option>
                    </select>
                </div>

                <button type="submit" class="btn orange">Filtrar</button>
                <a href="{{ route('ficha.list') }}" class="btn">Reset</a>
            </form>

            <div class="tableWrap">
                <table>
                    <thead>
                    <tr>
                        <th style="width:60px;">Imagen</th>
                        <th>Id</th>
                        <th>Título</th>
                        <th>Artista</th>
                        <th>Año</th>
                        <th>Medidas</th>
                        <th>Inventario</th>
                        <th class="actions">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($obras as $obra)
                        <tr onclick="window.location.href='{{ route('ficha', $obra->id) }}'">
                            <td>
                                @if(!empty($obra->imagen))
                                    <img class="thumb" src="{{ asset('storage/imagenes/' . $obra->imagen) }}" alt="Img {{ $obra->id }}">
                                @endif
                            </td>
                            <td>{{ $obra->id }}</td>
                            <td>{{ $obra->titulo }}</td>
                            <td>{{ $obra->artista }}</td>
                            <td>{{ $obra->anio }}</td>
                            <td>{{ $obra->tamano ?? 'n/a' }}</td>
                            <td>{{ $obra->inventario }}</td>
                            <td class="actions" onclick="event.stopPropagation();">
                                <a class="btn" style="height:26px; padding:0 10px; font-size:11px;"
                                   href="{{ route('ficha', $obra->id) }}">Ver</a>
                                <a class="btn" style="height:26px; padding:0 10px; font-size:11px;"
                                   href="{{ route('editar', $obra->id) }}">Editar</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="muted">No hay obras con esos filtros.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pager">
                {{ $obras->links() }}
            </div>
        </section>
    </main>
</div>

<script>
    // Dropdowns del sidebar (igual que en las otras vistas)
    document.querySelectorAll('.navdrop').forEach(btn => {
        const id = btn.getAttribute('aria-controls');
        const panel = document.getElementById(id);
        const open = btn.getAttribute('aria-expanded') === 'true';
        if (!open && panel) panel.setAttribute('hidden','');

        btn.addEventListener('click', () => {
            const isOpen = btn.getAttribute('aria-expanded') === 'true';
            btn.setAttribute('aria-expanded', String(!isOpen));
            if (!panel) return;
            if (isOpen) panel.setAttribute('hidden','');
            else panel.removeAttribute('hidden');
        });
    });

    // Fecha arriba derecha
    (function(){
        const d = new Date();
        const m = ['JAN','FEB','MAR','APR','MAY','JUN','JUL','AUG','SEP','OCT','NOV','DEC'];
        const el = document.getElementById('pageDate');
        if (el) el.textContent = d.getDate() + ' ' + m[d.getMonth()] + ' ' + d.getFullYear();
    })();
</script>
</body>
</html>