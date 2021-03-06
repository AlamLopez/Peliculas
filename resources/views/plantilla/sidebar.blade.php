<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li @click="menu=7" class="nav-item">
                <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Categorias</a>
            </li>
            <li @click="menu=0" class="nav-item">
                <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Peliculas</a>
            </li>
            @if(Auth::user()->idrol == 1)
                <li class="nav-title">
                    Mantenimiento
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-people"></i> Acceso</a>
                    <ul class="nav-dropdown-items">
                        <li @click="menu=1" class="nav-item">
                            <a class="nav-link" href="#"><i class="icon-user"></i> Usuarios</a>
                        </li>
                        <li @click="menu=2" class="nav-item">
                            <a class="nav-link" href="#"><i class="icon-user-following"></i> Roles</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item nav-dropdown">
                    <a class="nav-link nav-dropdown-toggle" href="#"><i class="icon-pie-chart"></i> Reportes</a>
                    <ul class="nav-dropdown-items">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="icon-chart"></i> Reporte Ingresos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#"><i class="icon-chart"></i> Reporte Ventas</a>
                        </li>
                    </ul>
                </li>
                <li @click="menu=6" class="nav-item">
                    <a class="nav-link active" href="#"><i class="icon-speedometer"></i> Historial</a>
                </li>
            @endif
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>