<?php
	// On récupère les variables de sessions
	$session = \Config\Services::session();
?>


		
<script type="text/javascript">

	$(function() {
		
		// On ferme les autres fenêtre au cas où elle seraient ouvertes
		$('#modal_login').on('show.bs.modal', function () {
			$("#modal_forgotten").modal('hide'); 
			$("#modal_msg").modal('hide'); 
		});
		// Gestion de l'autofocus sur les modal box
		$('#modal_login').on('shown.bs.modal', function () {
			$('#input').focus();
		});
		$('#modal_msg').on('shown.bs.modal', function () {
			$('#modal_close').focus();
		});
		$('#modal_msg').on('hidden.bs.modal', function () {
			$('#pass').focus();
		});
		$('#modal_forgotten').on('shown.bs.modal', function () {
			$('#email').focus();
		});
	});


	/********* Login ***********/
	// Bootstrap s'occupe de la validation (email valide, pas de champs vide)
	function login() {
		
		// On change le curseur
		document.body.style.cursor = 'wait';
		
		// Requète ajax au serveur
		$.post("<?php echo site_url('members/login'); ?>",
		
			// On récupère les données nécessaires
			{
				'input':$('#input').val(),
				'pass':$('#pass').val()
			},
			
			// On traite la réponse du serveur			
			function (return_data) {
				
				console.log(return_data);
				
				$obj = JSON.parse(return_data);
				// On change le curseur
				document.body.style.cursor = 'default';

				// Utilisateur loggé
				if ($obj['state'] == 1) {
					//window.location.href = $obj['data'];
					location.reload();
				}
				
				//Utilisateur non loggé
				else {
					// Erreur
					$("#modal_msg .modal-dialog").removeClass("success");
					$("#modal_msg .modal-dialog").addClass("error");
					$("#modal_msg .modal-dialog").addClass("backdrop","static");
					$("#modal_msg .modal-header").html("Erreur !");
					$("#modal_msg .modal-body").html($obj['data']);
					$("#modal_msg .modal-footer").html('<a id="modal_close" href="#" data-dismiss="modal">Fermer</a>');

					// On cache la modal de login et on vide ses input
					$("#pass").val("");
					$("#modal_msg").modal('show');
				}
			}
		);
	}
	
	
	
	/***** Modal box de Mot de passe oublié *******/
	function forgotten_box() {

		$("#modal_login").modal('hide');
		
		// On teste si le input est un email. Si oui on la recopie pour le forgotten
		var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
		if($("#input").val().match(re)) {
			$("#email").val($("#input").val());
		}
		
		$("#modal_forgotten").modal('show');
	}
	
	
	/***** Mot de passe oublié *******/
	function forgotten() {
	
		// On change le curseur
		document.body.style.cursor = 'wait';
		
		// Requète ajax au serveur
		$.post("<?php echo site_url('ajax_members/forgotten'); ?>",
		
			// On récupère les données nécessaires
			{'email':$('#email').val()
			},
			
			// On traite la réponse du serveur			
			function (return_data) {
				
				$obj = JSON.parse(return_data);
				// On change le curseur
				document.body.style.cursor = 'default';

				// Mot de passe envoyé par email
				if ($obj['state'] == 1) {
					// Success
					$("#modal_msg .modal-dialog").removeClass("error");
					$("#modal_msg .modal-dialog").addClass("success");
					$("#modal_msg .modal-dialog").addClass("backdrop","static");
					$("#modal_msg .modal-header").html("Email envoyé");
					$("#modal_msg .modal-body").html($obj['data']);
					$("#modal_msg .modal-footer").html('<a id="modal_close" href="#" data-dismiss="modal">Fermer</a>');
				}
				
				//Utilisateur non loggé
				else {
					// Erreur
					$("#modal_msg .modal-dialog").removeClass("success");
					$("#modal_msg .modal-dialog").addClass("error");
					$("#modal_msg .modal-dialog").addClass("backdrop","static");
					$("#modal_msg .modal-header").html("Erreur !");
					$("#modal_msg .modal-body").html($obj['data']);
					$("#modal_msg .modal-footer").html('<a id="modal_close" href="#" data-dismiss="modal">Fermer</a>');
				}
				
				// On cache la modal de forgotten et on vide ses input
				$("#modal_forgotten").modal('hide');
				$("#email").val("");
				$("#modal_msg").modal('show');
			}
		);
	}
	
</script>
		
		
<!-- ***************************************************************** !-->

		
	<!-- <nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="197"> !-->
	<nav id="menubar" class="navbar navbar-inverse bs-dark">

		<div class="row">

			<div class="navbar-header">
				<a id="brand_header" class="navbar-brand visible-xs <?php if($title == "Home") echo "active" ?>" href="<?php echo site_url() ?>">Grenoble Reggae Orchestra</a>
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

			</div>

			<div id="navbar" class="collapse navbar-collapse">

				<ul class="nav navbar-nav">
					<!-- A faire, corriger le titre de page dans le header !-->
					<?php
						if ($title == 'Home') echo'<li id="home_link" class="active hidden-xs" style="display:none"><a href="'.site_url().'"><b>GRO</b></a></li>';
						else echo'<li id="home_link" class="hidden-xs" style="display:none"><a href="'.site_url().'"><b>GRO</b></a></li>';
						
						if ($title == 'Jam') {
							// permet un retour à la section jam avec la dernière jam selectionnée
							//if ($this->uri->segment(1) == "jam" && $this->uri->segment(2) == "inscriptions") echo '<li class="active"><a href="/jam/'.$this->uri->segment(3).'">Jam</a></li>';
							//else echo'<li class="active"><a href="/jam/">Jam</a></li>';
							 echo'<li class="active"><a href="'.site_url("jam").'">Jam</a></li>';
						}
						else echo'<li><a href="'.site_url("jam").'">Jam</a></li>';
					?>
					
					<!-- Dropdown A propos (About) !-->
					<li class="dropdown <?php if ($title == "About") echo "active" ?>">
						<a class="dropdown-toggle" data-toggle="dropdown" href="#">A propos
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li class="<?php if (isset($sub_title) && $sub_title == "Infos") echo "active" ?>"><a href="<?php echo site_url('infos') ?>"><small><i class="glyphicon glyphicon-question-sign"></i></small>&nbsp;&nbsp;&nbsp;Infos</a></li>
							<li class="<?php if (isset($sub_title) && $sub_title == "Répertoire") echo "active" ?>"><a href="<?php echo site_url('repertoire') ?>"><small><i class="glyphicon glyphicon-folder-open"></i></small>&nbsp;&nbsp;&nbsp;Répertoire</a></li>
							<li class="<?php if (isset($sub_title) && $sub_title == "Wishlist") echo "active" ?>"><a href="<?php echo site_url('wishlist') ?>"><small><i class="glyphicon glyphicon-comment"></i></small>&nbsp;&nbsp;&nbsp;Wishlist</a></li>
						</ul>
					</li>
						
					<!-- Contact !-->
					<li class="<?php if ($title == "Contact") echo "active" ?>"><a href="<?php echo site_url('contact') ?>">Contact</a></li>

					
					<!-- /*** Rubriques visibles uniquement par le super admin ***/ !-->
					<?php if ($is_admin == "1" ):  ?>
					
						<!-- Dropdown Admin !-->
						<li class="dropdown <?php if ($title == "Admin") echo "active" ?>">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#"><small><i class="glyphicon glyphicon-cog"></i></small>&nbsp;&nbsp;Admin
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li class="<?php if (isset($sub_title) && $sub_title == "Médiathèque") echo "active" ?>"><a href="<?php echo site_url('morceau') ?>"><small><i class="glyphicon glyphicon-music"></i></small>&nbsp;&nbsp;&nbsp;Médiathèque</a></li>
								<li class="<?php if (isset($sub_title) && $sub_title == "Playlist") echo "active" ?>"><a href="<?php echo site_url('playlist') ?>"><small><i class="glyphicon glyphicon-th-list"></i></small>&nbsp;&nbsp;&nbsp;Playlist</a></li>
								<li class="<?php if (isset($sub_title) && $sub_title == "Membres") echo "active" ?>"><a href="<?php echo site_url('members') ?>"><small><i class="glyphicon glyphicon-list-alt"></i></small>&nbsp;&nbsp;&nbsp;Membres</a></li>
							</ul>
						</li>
					<?php endif; ?>
					
				</ul>
				
				
				<!-- Right Navbar => Connexion !-->
				<ul class="nav navbar-nav navbar-right">
				
					<!-- Utilisateur connecté !-->
					<?php if ($session->logged) : ?>
						<li class="<?php if (strpos(uri_string(),"members") && strpos(uri_string(),url_title($session->login))) echo "active" ?>">
							<a id="memberLogin" href="<?php echo site_url('members'); ?>/<?php echo url_title($session->login); ?>">
								<?php echo $session->login; ?>
								<?php if (!$session->validMail) : ?>
									<sup><span class="badge badge-warning">!</span></sup>
								<?php endif; ?>
							</a>
						</li>
						<li><a href="<?php echo site_url('members/logout'); ?>"><span class="glyphicon glyphicon-log-out"></span> Déconnexion</a></li>
					<?php else: ?>
					<!-- Utilisateur non connecté !-->							
						<li class="<?php if (strpos(uri_string(),"members") && strpos(uri_string(),"create")) echo "active" ?>"><a href="<?php echo site_url('members/create'); ?>"><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;Inscription</a></li>
						<li><a id="login_link" data-toggle="modal" href="#modal_login"><span class="glyphicon glyphicon-log-in"></span>&nbsp;&nbsp;Connexion</a></li>
					<?php endif; ?>
				</ul>

			</div><!--/.nav-collapse -->

		</div>

	</nav>
</div> <!-- on ferme le canevas !-->
</div> <!-- on ferme le wrapper !-->

	

<!-- on ouvre le cadre de contenu dans le menu et on le ferme dans le footer-->
<div id="content" class="container">

	<!-- Box de connexion !-->
	<div id="modal_login" class="modal fade" role="dialog">
		<div class="modal-dialog default modal-sm">
			<div class="modal-content">
				<div class="modal-header lead">Connexion</div>
				<div class="modal-body">
					
					<!-- Formulaire !-->
					<form method="post" action="javascript:login()" name="login_form">
					
						<!-- Nom ou Email!-->
						<div class="row">
							<input id="input" type="text" class="form-control form-group" required="true" name="email" placeholder="Pseudo ou Email">
						</div>
						
						<!-- Pass !-->
						<div class="row">
							<input id="pass" type="password" class="form-control form-group" required="true" name="pass" placeholder="Mot de passe">
						</div>
						
						<!-- Connexion !-->
						<div class="row">
							<button type="submit" class="btn btn-default form-control">Connexion</button>
						</div>
						
					</form>
					
				</div>
				
				<!-- Mot de passe oublié !-->
				<div class="modal-footer">
					<div class="row text-center">
						<a href="javascript:forgotten_box()">Mot de passe oublié</a>
					</div>
				</div>
			</div>
		</div>
	</div>


	<!-- Box de mot de passe oublié !-->
	<div id="modal_forgotten" class="modal fade" role="dialog">
		<div class="modal-dialog default modal-sm">
			<div class="modal-content">
				<div class="modal-header lead">Mot de passe oublié</div>
				<div class="modal-body">
					
					<!-- Formulaire !-->
					<form method="post" action="javascript:forgotten()" name="login_form">
					
						<!-- email !-->
						<div class="row">
							<input id="email" type="email" class="form-control form-group" required="true" name="email" placeholder="Email">
						</div>

						<!-- Connexion !-->
						<div class="row">
							<button type="submit" class="btn btn-default form-control">Envoyer mot de passe</button>
						</div>
						
					</form>
					
				</div>
			</div>
		</div>
	</div>


	<!-- Dialogue box de resultat !-->
	<div id="modal_msg" class="modal fade" role="dialog" data-keyboard="true" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header lead"></div>
				<div class="modal-body"></div>
				<div class="modal-footer"></div>
			</div>
		</div>
	</div>
