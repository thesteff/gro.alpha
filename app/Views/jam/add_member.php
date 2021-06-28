<!-- flexdatalist pour les input !-->
<script type="text/javascript" src="<?php echo base_url();?>/ressources/script/jquery-flexdatalist-2.2.4/jquery.flexdatalist.min.js"></script>
<link href="<?php echo base_url();?>/ressources/script/jquery-flexdatalist-2.2.4/jquery.flexdatalist.min.css" rel="stylesheet" type="text/css" />


<script type="text/javascript">
	
	$(function() {
		
		
		// On rempli les FLEXDATALIST
		// MEMBRES
		$('.memberList').flexdatalist({
			 minLength: 2,
			 selectionRequired: true,
			 url: "<?php echo site_url('ajax_group/get_members_not_in_event'); ?>",
			 params: { 'eventId': <?php echo $jam_item["id"] ?> },
			 searchIn: ["pseudo","prenom","nom","mainInstru"],
			 visibleProperties: ["pseudo","prenom","nom","mainInstru"],
			 searchByWord: true,	// mots séparé par un espace pris en compte
			 searchContain: false,	// keyword forcément au début d'un mot
			 valueProperty: ['id','pseudo']	// on envoie l'attribut 'id' quand on appelle la méthode val()
			})
			
			// Un member est select ou value.length < minLength => set.text = undefined
			.on('change:flexdatalist', function(event, set, options) {

				console.log(set.text);
				console.log(set.text == "");
				
				// value.length < minLength => set.text = undefined
				if (set.text == "") {
					$("#add_member_form #member_details div:not(.col)").each(function(index) {
						$(this).children("span").empty();
						$(this).addClass("hidden");
					});
					$("#add_member_form #member_details").addClass("hidden");
				}

				else {
					
					// On change le curseur
					document.body.style.cursor = 'wait';
					
					// Requète ajax au serveur
					$.post("<?php echo site_url(); ?>/ajax_members/get_member_and_listInstru",
					
						{
							'memberId': $(".memberList").flexdatalist('value')['id'],	// renvoie l'id du membre
						},
					
						function (return_data) {
							
							console.log(return_data);
							$obj = JSON.parse(return_data);
							
							// On change le curseur
							document.body.style.cursor = 'default';
							
							// On affiche les données du membre sélectionné
							if ($obj['state'] == 1) {
								
								// On actualise l'id du membre (évite une recherche de l'id dans la datalist sur un add)
								$("#add_member_form #member_details").attr("memberId",$obj["member"].id);
								
								if ($obj["member"].nom.length) {
									$("#add_member_form #prenom_nom_span").empty().append("<b>"+$obj["member"].prenom+" "+$obj["member"].nom+"</b>");
									$("#add_member_form #prenom_nom").removeClass("hidden");
								}
								if (typeof $obj["listInstru"][0].instruName !== 'undefined' && $obj["listInstru"][0].instruName.length) {
									$("#add_member_form #mainInstru_span").empty().append($obj["listInstru"][0]['instruName']);
									$("#add_member_form #mainInstru").removeClass("hidden");
								}
								if ($obj["member"].email.length) {
									$("#add_member_form #email_span").empty().append($obj["member"].email);
									$("#add_member_form #email").removeClass("hidden");
								}
								
								$("#add_member_form #member_details").removeClass("hidden");
								
							}
							else {
								console.log($obj['data']);
							}
						}
					);
				}


				// On active ou non le bouton d'ajout
				if (set.text == "") $("#addBtn").addClass("disabled");
				else $("#addBtn").removeClass("disabled");
				
			});
	});
	
	
	
	
	// Requête ajax d'ajout d'un membre appartenant au groupe mais pas à l'évènement
	//	!! le boutton d'ajout garanti l'existence de la saisie dans la liste des membres
	function add_member_request() {

		// On change le curseur
		/*document.body.style.cursor = 'wait';
	
		// Requète ajax au serveur
		$.post("<?php echo site_url(); ?>/ajax_jam/join_jam",
		
			{	
				'slugJam':'<?php echo $jam_item['slug']; ?>',
				'id': $("#adminInput").flexdatalist('value')['id'],	// renvoie l'id du membre
				'event_admin':1
			},
		
			function (return_data) {
				
				$obj = JSON.parse(return_data);
				
				// On change le curseur
				document.body.style.cursor = 'default';
				
				if ($obj['state'] == 1) {
					add_event_admin($("#adminInput").flexdatalist('value')['pseudo'], $("#adminInput").flexdatalist('value')['id']);
					$("#add_adminBtn").addClass("disabled");
				}
				else {
					console.log($obj['data']);
				}
			}
		);*/
	}
	
	
	// Ajout d'admin dans la liste
	function add_member($pseudo, $memberId) {
	/*
		// On créé l'item qui sera affiché
		$listElem = $("<li class='list-group-item clearfix' memberId='"+$memberId+"'></li>");
			// Pseudo
			$content = "<span class='pseudo soften'><b>"+$pseudo+"</b></span>";
			// Btn Supprimer
			$content += '<button id="deleteBtn" class="btn btn-default btn-xs pull-right" title="Retirer de la liste"><i class="glyphicon glyphicon-trash"></i></button>';
		$listElem.append($content);
	
		// On définit le btn delete
		$listElem.children("#deleteBtn").on({
			click: function(event) {
				remove_event_admin_request($(this).parent().index());
				event.preventDefault();
			}
		});
		
		// On ajoute l'admin à la liste
		$("#admin_list").append($listElem);
		
		
		// On vide l'input
		$("#adminInput").val('');
		
		// On actualise l'affichage de la liste d'admin
		$("#admin_list").css("display","block");*/
	}
	
	/*function reset() {
		if ($("#add_member_form #member_details").css("display") == "block") {
			$("#add_member_form #member_details").css("display","none");
			$("#add_member_form #prenom_nom").empty();
			$("#add_member_form #instru1_span").empty();
			$("#add_member_form #email_span").empty();
		}
	}*/
	
	
	
 </script>
 
 
<!-- Formulaire !-->
<div id="add_member_form" class="container-fluid">
	<form role="form" class="form-horizontal" data-toggle="validator">

		<!-------- SEARCH MEMBER --------->
		<div class="form-group">
			<div class="col-sm-12">
				<label for="pseudo" class="hidden">Pseudo</label>
				<input id="searchInput" class="form-control memberList flexdatalist" type="input" name="adminInput" placeholder="Membre du gro">
				
				<!-- On affiche les détails s'il y en a !-->
				<div id="member_details" class="soften small panel panel-default hidden flexDetails" memberId="">
					<div class="col" style="display:inline-block; vertical-align:top"><img class="img-circle avatarNotSet" src="<?php echo base_url('images/icons/avatar2.png'); ?>" hasavatar="0" width="50" height="50"></div>
					<div class="col" style="display:inline-block; padding-left: 3px">
						<div id="prenom_nom" class="hidden"><span id="prenom_nom_span"></span></div>
						<div id="mainInstru" class="hidden"><i class="bi bi-music-note-beamed"></i><span id="mainInstru_span"></span></div>
						<div id="email" class="hidden"><i class="bi bi-envelope-fill"></i><span id="email_span"></span></div>
					</div>
				</div>
			</div>
		</div>
		
		<hr>
		
		
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
			<button id="addBtn" class="btn btn-primary disabled" type="button" onclick="add_member_request()">Ajouter</button>
		</div>

	</form>
</div>