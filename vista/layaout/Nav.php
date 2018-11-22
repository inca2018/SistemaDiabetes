<body class="layout-fixedaside-hover offsidebar-open layout-fixed aside-collapsed aside-collapsed-text">
	<div class="wrapper">
		<!-- top navbar-->
		<header class="topnavbar-wrapper">
			<!-- START Top Navbar-->
			<nav class="navbar topnavbar" role="navigation">
				<!-- START navbar header-->
				<div class="navbar-header">
					<span class="navbar-brand" href="#/">
						<div class="brand-logo">
							<i class="fab fa-angular fa-2x text-white"></i>
						</div>
						<div class="brand-logo-collapsed">
							<i class="fab fa-angular fa-2x text-white"></i>
						</div>
					</span>
				</div>
				<!-- END navbar header-->
				<!-- START Left navbar-->
				<ul class="navbar-nav mr-auto flex-row text-muted text-white align-items-center">
					<?php if(isset($_SESSION['idUsuario'])){ ?>
					<li class="nav-item ">
						<h4 class="col-md-12  text-center">Bienvenido</h4>
					</li>
					<li>
						<h5 class="p-2" style="font-size:10px">
							<?php echo " Usuario: <br>".$_SESSION['NombreUsuario'].""; ?>
						</h5>
					</li>
					<li>
						<h5 class="p-2" style="font-size:10px">
							<?php echo " Perfil: <br>".$_SESSION['nombrePerfil']; ?>
						</h5>
					</li>
					<?php };?>
				</ul>
				<!-- END Left navbar-->
				<!-- START Right Navbar-->
				<ul class="navbar-nav flex-row">

					<!-- Fullscreen (only desktops)-->
					<li class="nav-item d-none d-md-block" title="Expandir Pantalla Completa">
						<a class="nav-link" href="#" data-toggle-fullscreen="">
							<em class="fa fa-expand"></em>
						</a>
					</li>
					<!-- START Alert menu-->
					<li class="nav-item dropdown dropdown-list">
						<a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" data-toggle="dropdown">
							<em class="fa fa-ellipsis-h"></em>
						</a>
						<!-- START Dropdown menu-->
						<div class="dropdown-menu dropdown-menu-right animated flipInX">
							<div class="dropdown-item">
								<!-- START list group-->
								<div class="list-group">

									<div class="list-group-item list-group-item-action">
										<div class="media" onclick="PerfilUsuarioOperaciones();">
											<div class="align-self-start mr-2">
												<em class="fa fa-user fa-2x text-info"></em>
											</div>
											<div class="media-body">
												<p class="m-0">Perfil de Usuario</p>
												<p class="m-0 text-muted text-sm">Información de Usuario</p>
											</div>
										</div>
									</div>
									<!-- Cerrar Session -->
									<div class="list-group-item list-group-item-action">
										<div class="media" onclick="cerrarSession()">
											<div class="align-self-start mr-2">
												<em class="fa fa-sign-out-alt fa-2x text-danger"></em>
											</div>
											<div class="media-body">
												<p class="m-0">Cerrar</p>
												<p class="m-0 text-muted text-sm">Finalizar Sessión</p>
											</div>
										</div>
									</div>
								</div>
								<!-- END list group-->
							</div>
						</div>
						<!-- END Dropdown menu-->
					</li>
					<!-- END Alert menu-->
				</ul>
				<!-- END Right Navbar-->

			</nav>
			<!-- END Top Navbar-->
		</header>
		<!-- sidebar-->
		<aside class="aside-container">
			<!-- START Sidebar (left)-->
			<div class="aside-inner">
				<nav class="sidebar" data-sidebar-anyclick-close="">
					<!-- START sidebar nav-->
					<ul class="sidebar-nav">
						<!-- START user info-->
						<!-- END user info-->
						<!-- Iterates over all sidebar items-->
						<li class="nav-heading ">
							<span data-localize="sidebar.heading.HEADER">Menu de Navegación</span>
						</li>
						<li id="Menu" class="">
							<a href="<?php echo  $conexionConfig->rutaOP().'vista/Menu/Menu.php';?>" title="Inicio">
								<em class="fa fa-home  fa-lg"></em>
								<span data-localize="sidebar.nav.SINGLEVIEW">Menu</span>
							</a>
						</li>

						<li id="MGestion" class=" ">
							<a id="level0" href="#multilevelOperaciones" title="Multilevel" data-toggle="collapse">
								<em class="fa fa-cogs fa-lg"></em>
								<span>Gestion</span>
							</a>
							<ul class="sidebar-nav sidebar-subnav collapse" id="multilevelOperaciones">

								<?php if(isset($_SESSION['permiso1'])){ if($_SESSION['permiso1']=='1' || $_SESSION['permiso1']==1){ ?>

								<li id="Gestion1" class="">
									<a href="<?php echo  $conexionConfig->rutaOP().'vista/Operaciones/Enconado.php';?>" title="Gestión de Enconado">
										<span>Gestión de Enconado</span>
									</a>
								</li>

								<?php  }}else{ };?>

								<?php if(isset($_SESSION['permiso2'])){ if($_SESSION['permiso2']=='1' || $_SESSION['permiso2']==1){ ?>

								<li id="Gestion2" class="">
									<a href="<?php echo  $conexionConfig->rutaOP().'vista/Operaciones/Ovillado.php';?>" title="estión de Ovillado">
										<span>Gestión de Ovillado</span>
									</a>
								</li>

								<?php  }}else{ };?>
								<?php if(isset($_SESSION['permiso3'])){ if($_SESSION['permiso3']=='1' || $_SESSION['permiso3']==1){ ?>

								<!-- <li id="Gestion3" class="">
									<a href="<?php  // echo  $conexionConfig->rutaOP().'vista/Operaciones/Tintoreria.php';?>" title="Gestión de Tinteroria">
										<span>Gestión de Tinteroria</span>
									</a>
								</li> -->

								<?php  }}else{ };?>
								<?php if(isset($_SESSION['permiso4'])){ if($_SESSION['permiso4']=='1' || $_SESSION['permiso4']==1){ ?>

								<li id="Gestion4" class="">
									<a href="<?php echo  $conexionConfig->rutaOP().'vista/Operaciones/Calidad.php';?>" title="Gestión de Calidad">
										<span>Gestión de Calidad</span>
									</a>
								</li>

								<?php  }}else{ };?>
							</ul>
						</li>

						<?php if(isset($_SESSION['permiso5'])){ if($_SESSION['permiso5']=='1' || $_SESSION['permiso5']==1){ ?>
						<li id="MPersonal" class=" ">
							<a id="level0" href="#multilevelColaborador" title="Multilevel" data-toggle="collapse">
								<em class="fa fa-briefcase  fa-lg"></em>
								<span>Mantenimiento</span>
							</a>
							<ul class="sidebar-nav sidebar-subnav collapse" id="multilevelColaborador">

								<li id="Usuarios" class="">
									<a href="<?php echo  $conexionConfig->rutaOP().'vista/Mantenimiento/MantUsuarios.php';?>" title="Usuarios">
										<span> Usuarios </span>
									</a>
								</li>
								<li id="Personal" class="">
									<a href="<?php echo  $conexionConfig->rutaOP().'vista/Mantenimiento/MantPerfiles.php';?>" title="Perfiles">
										<span> Perfiles </span>
									</a>
								</li>
								<li id="" class="">
									<a href="<?php echo  $conexionConfig->rutaOP().'vista/Mantenimiento/MantPersonas.php';?>" title="Personas">
										<span> Personas </span>
									</a>
								</li>
								<li id="" class="">
									<a href="<?php echo  $conexionConfig->rutaOP().'vista/Mantenimiento/MantMaterial.php';?>" title="Materiales">
										<span> Material </span>
									</a>
								</li>
							</ul>
						</li>
						<?php }}else{ };?>

						<?php if(isset($_SESSION['permiso6'])){ if($_SESSION['permiso6']=='1' || $_SESSION['permiso6']==1){ ?>
						<li id="Servicios" class=" ">
							<a id="level0" href="#multilevelServicios" title="Multilevel" data-toggle="collapse">
								<em class="fa fa-chart-bar fa-lg"></em>
								<span>Reportes</span>
							</a>
							<ul class="sidebar-nav sidebar-subnav collapse" id="multilevelServicios">

								<li id="Asignacion" class="">
									<a href="<?php echo  $conexionConfig->rutaOP().'vista/Reporte/Indicadores.php';?>" title="Indicadores">
										<span>Indicadores</span>
									</a>
								</li>
								<li id="GeneracionFactura" class=" ">
									<a href="<?php echo  $conexionConfig->rutaOP().'vista/Reporte/Reporte.php';?>" title="Reporte">
										<span>Reportes</span>
									</a>
								</li>

							</ul>
						</li>
						<?php  }}else{ };?>
					</ul>
					<!-- END sidebar nav-->
				</nav>
			</div>
			<!-- END Sidebar (left)-->
		</aside>
		<!-- offsidebar-->
