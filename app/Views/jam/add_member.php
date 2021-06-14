
<!-- bootstrapValidator !-->
<!-- <script type="text/javascript" src="<?php echo base_url();?>/ressources/script/validator.js"></script> -->

<!-- flexdatalist pour l'input !-->
<script type="text/javascript" src="<?php echo base_url();?>/ressources/script/jquery-flexdatalist-2.2.4/jquery.flexdatalist.min.js"></script>
<link href="<?php echo base_url();?>/ressources/script/jquery-flexdatalist-2.2.4/jquery.flexdatalist.min.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
	
	$(function() {
		
		// ANCHOR remplissage flexdatalist
		$('.memberList').flexdatalist({
			data: [
				<?php foreach ($list_members as $membre): ?>
					
					{ 'id':'<?php echo $membre->id ?>',
					'pseudo':'<?php echo addslashes(htmlspecialchars($membre->pseudo)) ?>', 
					'nom':'<?php echo addslashes(htmlspecialchars($membre->nom)) ?>',
					'prenom':'<?php echo addslashes(htmlspecialchars($membre->prenom)) ?>',
					'mainInstru':'<?php echo addslashes(htmlspecialchars($membre->mainInstruName)) ?>'
					},
				<?php endforeach ?>
			],
			minLength: 2,
			maxShownResults: 20,
			searchByWord: true,
			searchContain: true,
			selectionRequired: true,
			searchIn: ["pseudo","prenom","nom","mainInstru"],
			searchDelay: 150,
			noResultsText: 'Aucun résultat trouvé pour "{keyword}"',
			visibleProperties: ["pseudo","prenom","nom","mainInstru"],
			valueProperty: ['id','pseudo']	// on envoie l'attribut 'id' quand on appelle la méthode val()
		});
		$('.flexdatalist').on('change:flexdatalist', function(event, set, options) {
			 memberSelected($(this));
		});

		
		
	});

</script>

<!-- Formulaire ! -->
		
<div id="add_member_form" class="container-fluid">
	<form role="form" class="form-horizontal" data-toggle="validator">
		<div class="form-group">
			<div class="col-sm-12">
				<!-- <input id="pseudo" class="form-control memberList flexdatalist" type="input" name="membre" placeholder="Trouver un membre"
 						required /> -->
				<input type="text"
					placeholder="Trouver un membre par son pseudo ou autre info"
					class="memberList form-control flexdatalist"
					id="pseudo">
				
				
				
				
				
				
 				<!-- On affiche les détails s'il y en a !-->
 				<!-- <div id="member_details" class="soften small panel panel-default" style="display:none; padding: 5px 10px; margin-bottom: 0px">
 					<div id="memberId" class="hidden"></div>
 					<span id="prenom_nom" style="display:none; padding-bottom:4px"></span>
 					<div id="instru1" style="display:none"><i class="glyphicon glyphicon-music"></i>&nbsp;&nbsp;<span id="instru1_span"></span></div>
 					<div id="email" style="display:none"><i class="glyphicon glyphicon-envelope"></i>&nbsp;&nbsp;<span id="email_span"></span></div>
 				</div> -->
			
			
			
 			</div>
 		</div>
 		<hr>
		
		
 		<div class="modal-footer">
 			<button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
 			<button id="addBtn" type="submit" class="btn btn-primary">Ajouter</button>
 		</div>

 	</form>
 </div>
 
