<?php
/*
Plugin Name: Fest Widget
Plugin URI: http://www.fest.fr/widget.html
Description: Affiche l'agenda des sorties de votre ville : concerts, spectacles, théâtre, soirées, expositions, fêtes, brocantes, vide-greniers, lotos... Propulsé par Fest.
Author: Adarre Sarl
Version: 1.2
Author URI: https://www.fest.fr
*/


$instance = array("","","","","","","");

add_action('widgets_init', 'fest_init');

function fest_init(){

	register_widget('fest_widget');
}

/*class*/
class fest_widget extends WP_widget{

	function fest_widget(){
        
        /*options*/
        $options = array(
			'classname' => 'fest-widget',
			'description' => 'Affiche l\'agenda des sorties de votre ville : concerts, spectacles, théâtre, soirées, expositions, fêtes, brocantes, vide-greniers, lotos... Propulsé par Fest.'
			
		);
		$this->WP_widget('widget-fest','Fest Widget',$options);
	}
    
    function widget($args, $instance){
    	?>	
		<style type="text/css">
			div.fest_item { margin-bottom: 10px; padding-bottom: 10px; border-bottom: 1px solid #e6e6e6; }
			img.fest_vignette { width: 100px; margin-bottom: 3px; padding: 1px; border: solid 1px #b4b4b4; }
			img.fest_vignette:hover { border: solid 1px #0062a7; }
			span.fest_titre { font-size: 105%; font-weight: bold; display: block; }
			span.fest_categorie { color: #969696; font-size: 90%; display: block; }
			span.fest_ville { font-weight: bold; display: block; }
			span.fest_date { display: block; }
			span.fest_lien { font-size: 90%; display: block; }
		</style>
		<?php
        //recupere variable
        extract($args);
        
        
        echo $before_widget;

       	echo $before_title.$instance['titre'].$after_title;

				$items=0;
				//recuperation des variables utilisateur
				$qte = $instance['qte'];
				if($qte==0) return;
				//
				$categorie = trim($instance['categorie']);
				$ville 	= trim($instance['ville']);
				$distance  	= trim($instance['distance']);
				$ordre  	= trim($instance['ordre']);
				//
				$url = 'http'.((isset($_SERVER['HTTPS']))?(($_SERVER['HTTPS']=='on')?'s':''):'').'://'.$_SERVER['HTTP_HOST'].(($_SERVER['SERVER_PORT']!='80')?':'.$_SERVER['SERVER_PORT']:'').$_SERVER['REQUEST_URI'];//url de la page affichant le module

				//récuperation du flux en consequence
				$rss = new DOMDocument();
				$rssUrl = 'https://www.fest.fr/api/?nbr='.$qte.
						'&categorie='.$categorie.
						'&ville='.$ville.
						'&distance='.$distance.
						'&ordre='.$ordre.
						'&url='.$url.'&v=1.2';

				$rss->load($rssUrl);

				//traitement du flux
				$feed = array();
				$lien = $rss->getElementsByTagName('link')->item(0)->firstChild->textContent;
				foreach ($rss->getElementsByTagName('item') as $node) {
					$item = array ( 
						'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
						'cat' => $node->getElementsByTagName('category')->item(0)->nodeValue,
						'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
						'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
						'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
						'guid' => $node->getElementsByTagName('guid')->item(0)->nodeValue,
						'image' => $node->getElementsByTagName('image')->item(0)->nodeValue
					);
					array_push($feed, $item);
					$items++;
				}

				
			/***DISPLAY***/
			
				//feed
				$counter = 0;
				for($x=0;$x<$items;$x++) {

						$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
						$link = $feed[$x]['link'];
						$category = $feed[$x]['cat'];
						$description = $feed[$x]['desc'];
						$date =  $feed[$x]['date'];
						$guid = $feed[$x]['guid'];
						$image = $feed[$x]['image'];

						If($title != ''){
		
							echo '<div class="fest_item">';
							if ($image) echo '<a href="'.$link.'" title="Plus d\'infos sur cet événement"><img class="fest_vignette" alt="'.$title.'" src="'.$image.'"></a>';
							echo '<span class="fest_titre"><a  href="'.$link.'" title="Plus d\'infos sur cet événement">'.$title.'</a></span>';
							echo '<span class="fest_categorie">'.$category.'</span>';
							echo '<span class="fest_ville">'.$description.'</span>';
							echo '<span class="fest_date">'.$date.'</span>';
							echo '</div>';

							$counter = $counter + 1;
						}				
				}

				if($counter==0) return;
		
				// Lien
				echo '<span class="fest_lien"><a  href="'.$lien.'" title="Voir tous les événements sur le site Fest.fr">Afficher plus d\'événements</a></span>';
			?>


        	
        	<?php
		
        	echo $after_widget;
	}
	
	
	
	
	/*************** PARAM ***********************/
	/*************** PARAM ***********************/
	/*************** PARAM ***********************/
	/*************** PARAM ***********************/
	/*************** PARAM ***********************/
	/*************** PARAM ***********************/
	/*************** PARAM ***********************/
	/*************** PARAM ***********************/
	
	
	
	/*formulaire param*/
	function form($instance){
    
        $default = array(
			"titre" => "Fest Widget",			
            "qte" => "10",			
            "ville" => "",
            "categorie" => "",
			"distance" => "10",
			"ordre" => "date",
		);        
        
        $instance = wp_parse_args($instance, $default);
        
        
        ?>	
		
		<!--titre-->
        <p>
            <label for="<?php echo $this->get_field_id("titre");?>"><b>Titre</b> </label><br/>
            <input name="<?php echo $this->get_field_name("titre");?>" value="<?php echo $instance["titre"]; ?>" id="<?php echo $this->get_field_id("titre"); ?>" type="text"/>
        </p>
        
		<!-- Nombre de manifestations -->
		<p>
			<label for="<?php echo $this->get_field_id("qte");?>"><b>Nombre de manifestations à afficher (max. 20)</b></label><br/>
			<select name="<?php echo $this->get_field_name("qte");?>" id="<?php echo $this->get_field_id("qte"); ?>"size="1">
				<option <?php if($instance["qte"] == 1){echo 'selected="selected"';} ?> value="1">1</option>
				<option <?php if($instance["qte"] == 2){echo 'selected="selected"';} ?> value="2">2</option>
				<option <?php if($instance["qte"] == 3){echo 'selected="selected"';} ?> value="3">3</option>
				<option <?php if($instance["qte"] == 4){echo 'selected="selected"';} ?> value="4">4</option>
				<option <?php if($instance["qte"] == 5){echo 'selected="selected"';} ?> value="5">5</option>
				<option <?php if($instance["qte"] == 6){echo 'selected="selected"';} ?> value="6">6</option>
				<option <?php if($instance["qte"] == 7){echo 'selected="selected"';} ?> value="7">7</option>
				<option <?php if($instance["qte"] == 8){echo 'selected="selected"';} ?> value="8">8</option>
				<option <?php if($instance["qte"] == 9){echo 'selected="selected"';} ?> value="9">9</option>
				<option <?php if($instance["qte"] == 10){echo 'selected="selected"';} ?> value="10">10</option>
				<option <?php if($instance["qte"] == 11){echo 'selected="selected"';} ?> value="11">11</option>
				<option <?php if($instance["qte"] == 12){echo 'selected="selected"';} ?> value="12">12</option>
				<option <?php if($instance["qte"] == 13){echo 'selected="selected"';} ?> value="13">13</option>
				<option <?php if($instance["qte"] == 14){echo 'selected="selected"';} ?> value="14">14</option>
				<option <?php if($instance["qte"] == 15){echo 'selected="selected"';} ?> value="15">15</option>
				<option <?php if($instance["qte"] == 16){echo 'selected="selected"';} ?> value="16">16</option>
				<option <?php if($instance["qte"] == 17){echo 'selected="selected"';} ?> value="17">17</option>
				<option <?php if($instance["qte"] == 18){echo 'selected="selected"';} ?> value="18">18</option>
				<option <?php if($instance["qte"] == 19){echo 'selected="selected"';} ?> value="19">19</option>
				<option <?php if($instance["qte"] == 20){echo 'selected="selected"';} ?> value="20">20</option>
			</select>
		</p>
       
       <!--ville-->
		<p>
			<label for="<?php echo $this->get_field_id("ville");?>"><b>Ville</b> </label><br/>
			<input name="<?php echo $this->get_field_name("ville");?>" value="<?php echo $instance["ville"];?>" id="<?php echo $this->get_field_id("ville"); ?>" type="text"/>
        </p>
       
 		<!--categorie-->
        <p>
			<label for="<?php echo $this->get_field_id("categorie");?>"><b>Catégorie</b></label><br/>
       		<select name="<?php echo $this->get_field_name("categorie");?>" id="<?php echo $this->get_field_id("categorie"); ?>"size="1">
				<option <?php if($instance["categorie"] == ""){echo 'selected="selected"';} ?> value="">Toutes</option>
				<option <?php if($instance["categorie"] == "Bals et thés dansants"){echo 'selected="selected"';} ?> value="Bals et thés dansants">Bals et thés dansants</option>
				<option <?php if($instance["categorie"] == "Brocantes, bourses et vide-greniers"){echo 'selected="selected"';} ?> value="Brocantes, bourses et vide-greniers">Brocantes, bourses et vide-greniers</option>
				<option <?php if($instance["categorie"] == "Cirques"){echo 'selected="selected"';} ?> value="Cirques">Cirques</option>
				<option <?php if($instance["categorie"] == "Clubs et discothèques"){echo 'selected="selected"';} ?> value="Clubs et discothèques">Clubs et discothèques</option>
				<option <?php if($instance["categorie"] == "Concerts et musique"){echo 'selected="selected"';} ?> value="Concerts et musique">Concerts et musique</option>
				<option <?php if($instance["categorie"] == "Conférences, forums et débats"){echo 'selected="selected"';} ?> value="Conférences, forums et débats">Conférences, forums et débats</option>
				<option <?php if($instance["categorie"] == "Danse et ballets"){echo 'selected="selected"';} ?> value="Danse et ballets">Danse et ballets</option>
				<option <?php if($instance["categorie"] == "Expositions, visites et découvertes"){echo 'selected="selected"';} ?> value="Expositions, visites et découvertes">Expositions, visites et découvertes</option>
				<option <?php if($instance["categorie"] == "Fest-noz et fest-deiz"){echo 'selected="selected"';} ?> value="Fest-noz et fest-deiz">Fest-noz et fest-deiz</option>
				<option <?php if($instance["categorie"] == "Fêtes foraines"){echo 'selected="selected"';} ?> value="Fêtes foraines">Fêtes foraines</option>
				<option <?php if($instance["categorie"] == "Fêtes, animations et soirées"){echo 'selected="selected"';} ?> value="Fêtes, animations et soirées">Fêtes, animations et soirées</option>
				<option <?php if($instance["categorie"] == "Hippisme et sports équestres"){echo 'selected="selected"';} ?> value="Hippisme et sports équestres">Hippisme et sports équestres</option>
				<option <?php if($instance["categorie"] == "Jeux et concours"){echo 'selected="selected"';} ?> value="Jeux et concours">Jeux et concours</option>
				<option <?php if($instance["categorie"] == "Lotos"){echo 'selected="selected"';} ?> value="Lotos">Lotos</option>
				<option <?php if($instance["categorie"] == "Marchés, foires et salons"){echo 'selected="selected"';} ?> value="Marchés, foires et salons">Marchés, foires et salons</option>
				<option <?php if($instance["categorie"] == "Meetings et rassemblements"){echo 'selected="selected"';} ?> value="Meetings et rassemblements">Meetings et rassemblements</option>
				<option <?php if($instance["categorie"] == "Randonnées"){echo 'selected="selected"';} ?> value="Randonnées">Randonnées</option>
				<option <?php if($instance["categorie"] == "Spectacles et théâtre"){echo 'selected="selected"';} ?> value="Spectacles et théâtre">Spectacles et théâtre</option>
				<option <?php if($instance["categorie"] == "Sports"){echo 'selected="selected"';} ?> value="Sports">Sports</option>
				<option <?php if($instance["categorie"] == "Stages, ateliers et initiations"){echo 'selected="selected"';} ?> value="Stages, ateliers et initiations">Stages, ateliers et initiations</option>
			</select>
        </p>

        
		<!--distance-->
        <p>
			<label for="<?php echo $this->get_field_id("distance");?>"><b>Dans un rayon de</b></label><br/>
       		<select name="<?php echo $this->get_field_name("distance");?>" id="<?php echo $this->get_field_id("distance"); ?>"size="1">
				<option <?php if($instance["distance"] == 2){echo 'selected="selected"';} ?> value="2">2 km</option>
				<option <?php if($instance["distance"] == 5){echo 'selected="selected"';} ?> value="5">5 km</option>
				<option <?php if($instance["distance"] == 10){echo 'selected="selected"';} ?> value="10">10 km</option>
				<option <?php if($instance["distance"] == 20){echo 'selected="selected"';} ?> value="20">20 km</option>
				<option <?php if($instance["distance"] == 30){echo 'selected="selected"';} ?> value="30">30 km</option>
				<option <?php if($instance["distance"] == 50){echo 'selected="selected"';} ?> value="50">50 km</option>
				<option <?php if($instance["distance"] == 100){echo 'selected="selected"';} ?> value="100">100 km</option>
			</select>
		</p>

        <!--ordre-->
        <p>
       		<label for="<?php echo $this->get_field_id("ordre");?>"><b>Mode de tri</b></label><br/>
       		<select name="<?php echo $this->get_field_name("ordre");?>" id="<?php echo $this->get_field_id("ordre"); ?>"size="1">
				<option <?php if($instance["ordre"] == "date"){echo 'selected="selected"';} ?> value="date">date</option>
				<option <?php if($instance["ordre"] == "popu"){echo 'selected="selected"';} ?> value="popu">popularité</option>	
			</select>
		</p>
        
        <?php


    }
	
	/*update - onSubmit*/
	function update($new,$old){
        
        /*ici traitements*/
        
        return $new;
    }
	
}
?>