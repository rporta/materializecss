<?php
namespace AppBundle\Utility\Obj\CreateClass;

class createClass 
{
	protected function createID($arg = 5){
		return substr(md5(uniqid(rand(), true)),0,$arg);
	}
	protected function colors(){
		$colors['red'] = explode(",", "#ffebee red lighten-5,#ffcdd2 red lighten-4,#ef9a9a red lighten-3,#e57373 red lighten-2,#ef5350 red lighten-1,#f44336 red,#e53935 red darken-1,#d32f2f red darken-2,#c62828 red darken-3,#b71c1c red darken-4,#ff8a80 red accent-1,#ff5252 red accent-2,#ff1744 red accent-3,#d50000 red accent-4");
		$colors['pink'] = explode(",", "#fce4ec pink lighten-5,#f8bbd0 pink lighten-4,#f48fb1 pink lighten-3,#f06292 pink lighten-2,#ec407a pink lighten-1,#e91e63 pink,#d81b60 pink darken-1,#c2185b pink darken-2,#ad1457 pink darken-3,#880e4f pink darken-4,#ff80ab pink accent-1,#ff4081 pink accent-2,#f50057 pink accent-3,#c51162 pink accent-4");
		$colors['purple'] = explode(",", "#f3e5f5 purple lighten-5,#e1bee7 purple lighten-4,#ce93d8 purple lighten-3,#ba68c8 purple lighten-2,#ab47bc purple lighten-1,#9c27b0 purple,#8e24aa purple darken-1,#7b1fa2 purple darken-2,#6a1b9a purple darken-3,#4a148c purple darken-4,#ea80fc purple accent-1,#e040fb purple accent-2,#d500f9 purple accent-3,#aa00ff purple accent-4");
		$colors['deep-purple'] = explode(",", "#ede7f6 deep-purple lighten-5,#d1c4e9 deep-purple lighten-4,#b39ddb deep-purple lighten-3,#9575cd deep-purple lighten-2,#7e57c2 deep-purple lighten-1,#673ab7 deep-purple,#5e35b1 deep-purple darken-1,#512da8 deep-purple darken-2,#4527a0 deep-purple darken-3,#311b92 deep-purple darken-4,#b388ff deep-purple accent-1,#7c4dff deep-purple accent-2,#651fff deep-purple accent-3,#6200ea deep-purple accent-4");
		$colors['indigo'] = explode(",", "#e8eaf6 indigo lighten-5,c5cae9 indigo lighten-4,9fa8da indigo lighten-3,7986cb indigo lighten-2,5c6bc0 indigo lighten-1,3f51b5 indigo,3949ab indigo darken-1,303f9f indigo darken-2,283593 indigo darken-3,1a237e indigo darken-4,8c9eff indigo accent-1,536dfe indigo accent-2,3d5afe indigo accent-3,304ffe indigo accent-4");
		$colors['blue'] = explode(",", "#e3f2fd blue lighten-5,#bbdefb blue lighten-4,#90caf9 blue lighten-3,#64b5f6 blue lighten-2,#42a5f5 blue lighten-1,#2196f3 blue,#1e88e5 blue darken-1,#1976d2 blue darken-2,#1565c0 blue darken-3,#0d47a1 blue darken-4,#82b1ff blue accent-1,#448aff blue accent-2,#2979ff blue accent-3,#2962ff blue accent-4");
		$colors['light-blue'] = explode(",", "#e1f5fe light-blue lighten-5,#b3e5fc light-blue lighten-4,#81d4fa light-blue lighten-3,#4fc3f7 light-blue lighten-2,#29b6f6 light-blue lighten-1,#03a9f4 light-blue,#039be5 light-blue darken-1,#0288d1 light-blue darken-2,#0277bd light-blue darken-3,#01579b light-blue darken-4,#80d8ff light-blue accent-1,#40c4ff light-blue accent-2,#00b0ff light-blue accent-3,#0091ea light-blue accent-4");
		$colors['cyan'] = explode(",", "#e0f7fa cyan lighten-5,#b2ebf2 cyan lighten-4,#80deea cyan lighten-3,#4dd0e1 cyan lighten-2,#26c6da cyan lighten-1,#00bcd4 cyan,#00acc1 cyan darken-1,#0097a7 cyan darken-2,#00838f cyan darken-3,#006064 cyan darken-4,#84ffff cyan accent-1,#18ffff cyan accent-2,#00e5ff cyan accent-3,#00b8d4 cyan accent-4");
		$colors['teal'] = explode(",", "#e0f2f1 teal lighten-5,#b2dfdb teal lighten-4,#80cbc4 teal lighten-3,#4db6ac teal lighten-2,#26a69a teal lighten-1,#009688 teal,#00897b teal darken-1,#00796b teal darken-2,#00695c teal darken-3,#004d40 teal darken-4,#a7ffeb teal accent-1,#64ffda teal accent-2,#1de9b6 teal accent-3,#00bfa5 teal accent-4");
		$colors['green'] = explode(",", "#e8f5e9 green lighten-5,#c8e6c9 green lighten-4,#a5d6a7 green lighten-3,#81c784 green lighten-2,#66bb6a green lighten-1,#4caf50 green,#43a047 green darken-1,#388e3c green darken-2,#2e7d32 green darken-3,#1b5e20 green darken-4,#b9f6ca green accent-1,#69f0ae green accent-2,#00e676 green accent-3,#00c853 green accent-4");
		$colors['light-green'] = explode(",", "#f1f8e9 light-green lighten-5,#dcedc8 light-green lighten-4,#c5e1a5 light-green lighten-3,#aed581 light-green lighten-2,#9ccc65 light-green lighten-1,#8bc34a light-green,#7cb342 light-green darken-1,#689f38 light-green darken-2,#558b2f light-green darken-3,#33691e light-green darken-4,#ccff90 light-green accent-1,#b2ff59 light-green accent-2,#76ff03 light-green accent-3,#64dd17 light-green accent-4");
		$colors['lime'] = explode(",", "#f9fbe7 lime lighten-5,#f0f4c3 lime lighten-4,#e6ee9c lime lighten-3,#dce775 lime lighten-2,#d4e157 lime lighten-1,#cddc39 lime,#c0ca33 lime darken-1,#afb42b lime darken-2,#9e9d24 lime darken-3,#827717 lime darken-4,#f4ff81 lime accent-1,#eeff41 lime accent-2,#c6ff00 lime accent-3,#aeea00 lime accent-4");
		$colors['yellow'] = explode(",", "#fffde7 yellow lighten-5,#fff9c4 yellow lighten-4,#fff59d yellow lighten-3,#fff176 yellow lighten-2,#ffee58 yellow lighten-1,#ffeb3b yellow,#fdd835 yellow darken-1,#fbc02d yellow darken-2,#f9a825 yellow darken-3,#f57f17 yellow darken-4,#ffff8d yellow accent-1,#ffff00 yellow accent-2,#ffea00 yellow accent-3,#ffd600 yellow accent-4");
		$colors['amber'] = explode(",", "#fff8e1 amber lighten-5,#ffecb3 amber lighten-4,#ffe082 amber lighten-3,#ffd54f amber lighten-2,#ffca28 amber lighten-1,#ffc107 amber,#ffb300 amber darken-1,#ffa000 amber darken-2,#ff8f00 amber darken-3,#ff6f00 amber darken-4,#ffe57f amber accent-1,#ffd740 amber accent-2,#ffc400 amber accent-3,#ffab00 amber accent-4");
		$colors['orange'] = explode(",", "#fff3e0 orange lighten-5,#ffe0b2 orange lighten-4,#ffcc80 orange lighten-3,#ffb74d orange lighten-2,#ffa726 orange lighten-1,#ff9800 orange,#fb8c00 orange darken-1,#f57c00 orange darken-2,#ef6c00 orange darken-3,#e65100 orange darken-4,#ffd180 orange accent-1,#ffab40 orange accent-2,#ff9100 orange accent-3,#ff6d00 orange accent-4");
		$colors['deep-orange'] = explode(",", "#fbe9e7 deep-orange lighten-5,#ffccbc deep-orange lighten-4,#ffab91 deep-orange lighten-3,#ff8a65 deep-orange lighten-2,#ff7043 deep-orange lighten-1,#ff5722 deep-orange,#f4511e deep-orange darken-1,#e64a19 deep-orange darken-2,#d84315 deep-orange darken-3,#bf360c deep-orange darken-4,#ff9e80 deep-orange accent-1,#ff6e40 deep-orange accent-2,#ff3d00 deep-orange accent-3,#dd2c00 deep-orange accent-4");
		$colors['brown'] = explode(",", "#efebe9 brown lighten-5,#d7ccc8 brown lighten-4,#bcaaa4 brown lighten-3,#a1887f brown lighten-2,#8d6e63 brown lighten-1,#795548 brown,#6d4c41 brown darken-1,#5d4037 brown darken-2,#4e342e brown darken-3,#3e2723 brown darken-4");
		$colors['grey'] = explode(",", "#fafafa grey lighten-5,#f5f5f5 grey lighten-4,#eeeeee grey lighten-3,#e0e0e0 grey lighten-2,#bdbdbd grey lighten-1,#9e9e9e grey,#757575 grey darken-1,#616161 grey darken-2,#424242 grey darken-3,#212121 grey darken-4");
		$colors['blue-grey'] = explode(",", "#eceff1 blue-grey lighten-5,#cfd8dc blue-grey lighten-4,#b0bec5 blue-grey lighten-3,#90a4ae blue-grey lighten-2,#78909c blue-grey lighten-1,#607d8b blue-grey,#546e7a blue-grey darken-1,#455a64 blue-grey darken-2,#37474f blue-grey darken-3,#263238 blue-grey darken-4");
		$colors['b-w-t'] = explode(",", "#000000 black,#ffffff white,transparent");
		return $colors;
	}
	protected function textColors($arg = null){
		$colors = $this->colors();
		unset($colors['b-w-t'][2]);
		foreach ($colors as $colorKey => $array) {
			foreach ($array as $key => $value) {
				preg_match("|(#*([a-fA-F0-9]{6}))\040|", $value, $hex);
				str_replace($hex, "", $value);
				$colors2[$colorKey][$key] = str_replace($hex, "", $value);
			}
		}
		foreach ($colors2 as $colorKey => $array) {
			foreach ($array as $key => $value) {
				if($colorKey == 'b-w-t' || $key == 5){
					$out[$colorKey][$key] = $value."-text";
				}
				else{
					$color = str_replace(" ", "-text text-", $value);
					$out[$colorKey][$key] = $color;
				}
			}
		}
		if($arg == null){
			return NULL;
		}
		else{
			$key = explode(",", $arg);
			if(empty($out[$key[0]][$key[1]])){ return NULL;}
			else{ return $out[$key[0]][$key[1]];}
		}
	}
	protected function backgroundColors($arg = null){
		$colors = $this->colors();
		unset($colors['b-w-t'][2]);
		foreach ($colors as $colorKey => $array) {
			foreach ($array as $key => $value) {
				preg_match("|(#*([a-fA-F0-9]{6}))\040|", $value, $hex);
				str_replace($hex, "", $value);
				$out[$colorKey][$key] = str_replace($hex, "", $value);
			}
		}
		$out['b-w-t'][2] = 'transparent';
		if($arg == null){
			return NULL;
		}
		else{
			$key = explode(",", $arg);
			return $out[$key[0]][$key[1]];
		}

	}
	protected function hexColors($arg = null){
		$colors = $this->colors();
		unset($colors['b-w-t'][2]);
		foreach ($colors as $colorKey => $array) {
			foreach ($array as $key => $value) {
				preg_match("|(#*([a-fA-F0-9]{6}))|", $value, $hex);
				$out[$colorKey][$key] = "{$hex[0]}";
			}
		}
		if($arg == null){
			return NULL;
		}
		else{
			$key = explode(",", $arg);
			return $out[$key[0]][$key[1]];
		}

	}
	protected function float($arg = NULL){
		switch (strtolower((string)$arg)) {
			case "0":
			case "l":
				$out = "left";
				break;
			case "1":
			case "c":
				$out = "center"; 
				break;
			case "2":
			case "r":
				$out = "right";
				break;
		}
		return is_null($arg) ? NULL :$out;
	}
	protected function modeAlert($arg = NULL){
		switch (strtolower((string)$arg)) {
			case "0":
			case "redirect":
				$out = "redirect";
				break;
			case "1":
			case "custom":
				$out = "custom"; 
				break;
		}
		return is_null($arg) ? NULL :$out;
	}
	protected function textAling($arg = NULL){
		return is_null($arg) ? NULL : $this->float($arg).'-align';
	}
	protected function edge($arg = NULL){
		$arg = is_null($arg) ? 'l' : $arg;
		switch (strtolower((string)$arg)) {
			case "0":
			case "l":
				$out = "left";
				break;
			case "1":
			case "r":
				$out = "right";
				break;
		}
		return $out;
	}
	protected function shadow($arg = NULL){
		if(is_null($arg)) return NULL;

		if($arg >= "1" || $arg <= "4"){
			return "z-depth-".$arg;
		}
		else{
			return "z-depth-1";
		}
	}
	protected function transitions($arg){
		switch (strtolower((string)$arg)) {
			case '0':
			case 'in':
				$out = "scale-transition"; 
				break;
			case '1':
			case 'out':
				$out = "scale-transition scale-out"; 
				break;		
		}
		return is_null($arg) ? NULL :$out;
	}
	protected function waves($arg, $arg2 = NULL){
		#0-8
		$waves = explode(",", "waves-effect,waves-effect waves-light,waves-effect waves-red,waves-effect waves-yellow,waves-effect waves-orange,waves-effect waves-purple,waves-effect waves-green,waves-effect waves-teal");
		if($arg2 == NULL){
			if($arg == NULL) return NULL;
			return $waves[$arg];
		}
		elseif($arg2 == 'circle'){
			if($arg == 0){
				return  $waves[$arg]." waves-circle";
			}
			else{
				return  str_replace(" ", " waves-circle ", $waves[$arg]) ;
			}
		}
	}
	protected function sizeIcon($arg = 0){
		$size = "tiny,small,medium,large";
		$size = explode(",", $size);
		$arg = is_null($arg) ? 0 :$arg;
		switch (strtolower((string)$arg)) {
			case '0':
			case 't':
				$out = $size[0];
				break;
			case '1':
			case 's':
				$out = $size[1];
				break;
			case '2':
			case 'm':
				$out = $size[2];
				break;
			case '3':
			case 'l':
				$out = $size[3];
				break;
		}
		return $out;
	}
	protected function sizeCard($arg = NULL){
		$size = "small,medium,large";
		$size = explode(",", $size);
		switch (strtolower((string)$arg)) {
			case '0':
			case 's':
				$out = $size[0];
				break;
			case '1':
			case 'm':
				$out = $size[1];
				break;
			case '2':
			case 'l':
				$out = $size[2];
				break;
		}
		return is_null($arg) ? NULL : $out;
	}	
	protected function sizePreloader($arg = 0){
		$size = array("small", "medium", "big");
		$arg = is_null($arg) ? 0 :$arg;
		switch (strtolower((string)$arg)) {
			case '0':
			case 's':
				$out = $size[0];
				break;
			case '1':
			case 'm':
				$out = $size[1];
				break;
			case '2':
			case 'b':
				$out = $size[2];
				break;
		}
		return $out;
	}
	protected function modeTable($arg){
		switch (strtolower((string)$arg)) {
			case '0':
			case 'bordered':
				$out = "bordered"; 
				break;
			case '1':
			case 'striped':
				$out = "striped"; 
				break;		
			case '2':
			case 'highlight':
				$out = "highlight"; 
				break;		
			case '3':
			case 'responsive-table':
				$out = "responsive-table"; 
				break;		
		}
		return is_null($arg) ? NULL :$out;
	}
	protected function modeCard($arg){
		switch (strtolower((string)$arg)) {
			case '0':
			case 'basic':
				$out = "basic"; 
				break;
			case '1':
			case 'reveal':
				$out = "reveal"; 
				break;			
		}
		return is_null($arg) ? NULL :$out;
	}
	protected function orientationCard($arg){
		switch (strtolower((string)$arg)) {
			case 'h':
			case 'horizontal':
				$out = "horizontal"; 
				break;			
		}
		return is_null($arg) ? NULL :$out;
	}	
	protected function modePreloader($arg){
		switch (strtolower((string)$arg)) {
			case '0':
			case 'linear':
				$out = "linear"; 
				break;
			case '1':
			case 'circular':
				$out = "circular"; 
				break;		
			case '2':
			case 'circularflashing':
				$out = "circularFlashing"; 
				break;		
		}
		return is_null($arg) ? NULL : $out;
	}
	protected function modeInputFields($arg){
		switch (strtolower((string)$arg)) {
			case '0':
			case 'text':
				$out = "text"; 
				break;
			case '1':
			case 'password':
				$out = "password"; 
				break;		
			case '2':
			case 'email':
				$out = "email"; 
				break;		
			case '3':
			case 'hidden':
				$out = "hidden"; 
				break;		
		}
		return is_null($arg) ? NULL :$out;
	}
	protected function modeInputinputButton($arg){
		switch (strtolower((string)$arg)) {
			case '0':
			case 'a':
				$out = "a"; 
				break;
			case '1':
			case 'button':
				$out = "button"; 
				break;
		}
		return is_null($arg) ? NULL :$out;
	}	
	protected function modeInputRange($arg){
		switch (strtolower((string)$arg)) {
			case '0':
			case 'nouislider':
				$out = "noUiSlider"; 
				break;
			case '1':
			case 'html5 range':
				$out = "HTML5 Range"; 
				break;
		}
		return is_null($arg) ? NULL :$out;
	}		
	protected function modeInputSelect($arg){
		switch (strtolower((string)$arg)) {
			case '0':
			case 'single':
				$out = "single"; 
				break;
			case '1':	
			case 'icon':
				$out = "icon"; 
				break;		
			case '2':
			case 'browser':
				$out = "browser"; 
				break;		
		}
		return is_null($arg) ? NULL :$out;
	}
	protected function modeInputRadioButtons($arg){
		switch (strtolower((string)$arg)) {
			case '0':
			case 'default':
				$out = NULL; 
				break;
			case '1':	
			case 'gap':
				$out = "with-gap"; 
				break;			
		}
		return is_null($arg) ? NULL :$out;
	}		
	protected function modeInputCheckboxes($arg){
		switch (strtolower((string)$arg)) {
			case '0':
			case 'default':
				$out = NULL; 
				break;
			case '1':	
			case 'filled':
				$out = "filled-in"; 
				break;			
		}
		return is_null($arg) ? NULL :$out;
	}		
	protected function modeMedia($arg){
		switch (strtolower((string)$arg)) {
			case '0':
			case 'img':
				$out = "img"; 
				break;
			case '1':
			case 'materialbox':
				$out = "MaterialBox"; 
				break;	
			case '2':
			case 'video':
				$out = "video"; 
				break;		
		}
		return is_null($arg) ? NULL :$out;
	}	
	protected function modeChip($arg){
		switch (strtolower((string)$arg)) {
			case '0':
			case 'contactos':
				$out = "Contactos"; 
				break;
			case '1':
			case 'etiquetas':
				$out = "Etiquetas"; 
				break;		
		}
		return is_null($arg) ? NULL :$out;
	}
	protected function modeTempElemet($arg){
		switch (strtolower($Argf)) {
			case '0':
			case 'listDir':
				$out = "listDir"; 
				break;
			case '1':
			case 'new':
				$out = "new"; 
				break;

		}
		return is_null($arg) ? NULL :$out;
	}
	protected function sizeTitle($arg = NULL){
		return is_null($arg) ? NULL : ($arg <= 6 && $arg >= 1 ? $arg : "1");
	}
	protected function toast($arg = NULL, $arg2 = 4000){
		return is_null($arg) ? NULL : $tmp = "Materialize.toast('{$arg}', {$arg2});";
	}
	protected function submitInputButton($arg){
		return is_null($arg) ? NULL :  "type='submit'";
	}	
	protected function truncate($arg = NULL){
		return is_null($arg) ? NULL :  "truncate";
	}
	protected function flowText($arg = NULL){
		return is_null($arg) ? NULL :  "flow-text";
	}
	protected function tableCenter($arg = NULL){
		return is_null($arg) ? NULL :  "centered";
	}
	protected function valign($arg = NULL){
		return is_null($arg) ? NULL :  "valign-wrapper";
	}
	protected function hoverable($arg = NULL){
		return is_null($arg) ? NULL :  "hoverable";
	}
	protected function pulse($arg = NULL){
		return is_null($arg) ? NULL :  "pulse";
	}
	protected function cardPanel($arg = NULL){
		return is_null($arg) ? NULL :  "card-panel";
	}
	protected function largeInputButton($arg = NULL){
		return is_null($arg) ? NULL :  "btn-large";
	}
	protected function floatingInputButton($arg = NULL){
		return is_null($arg) ? NULL :  "btn-floating";
	}
	protected function flatButton($arg = NULL){
		return is_null($arg) ? NULL :  "btn-flat";
	}	
	protected function container($arg = NULL){
		return is_null($arg) ? NULL : "container";
	}
	protected function circle($arg = NULL){
		return is_null($arg) ? NULL : "circle";
	}
	protected function responsiveImg($arg = NULL){
		return is_null($arg) ? NULL : "responsive-img";
	}
	protected function navExtended($arg = NULL){
		return is_null($arg) ? NULL : "nav-extended";
	}
	protected function newBadge($arg = NULL){
		return is_null($arg) ? NULL : "new";
	}
	protected function formFiles($arg = NULL){
		return is_null($arg) ? NULL : "enctype='multipart/form-data'";
	}
	protected function formAction($arg = NULL){
		return is_null($arg) ? NULL : " action='{$arg}' ";
	}
	protected function style($arg = NULL){
		return is_null($arg) ? NULL : " style='{$arg}' ";
	}
	protected function placeholderInputFields($arg = NULL){
		return is_null($arg) ? NULL : "placeholder='{$arg}'";
	}
	protected function nameInputFields($arg = NULL){
		return is_null($arg) ? NULL : "name='{$arg}'";
	}
	protected function textErrorInputFields($arg = NULL){
		return is_null($arg) ? NULL : "data-error='{$arg}'";
	}
	protected function multipleInputFile($arg = NULL){
		return is_null($arg) ? NULL : "multiple";
	}
	protected function textSuccessInputFields($arg = NULL){
		return is_null($arg) ? NULL : "data-success='{$arg}'";
	}
	protected function characterCounterInputFields($arg = NULL){
		return is_null($arg) ? NULL : "data-length='{$arg}'";
	}
	protected function dataCaption($arg = NULL){
		return is_null($arg) ? NULL : "data-caption='{$arg}'";
	}
	protected function valueInputFields($arg = NULL){
		return is_null($arg) ? NULL : (is_array($arg) ? "value='{$arg[0]}'" : "value='{$arg}'");
	}
	protected function activeInputFields($arg = NULL){
		return is_null($arg) ? NULL : "active";
	}
	protected function disabledInputFields($arg = NULL){
		return is_null($arg) ? NULL : "disabled";
	}
	protected function indicatorCarousel($arg = NULL){
		return is_null($arg) ? NULL : " data-indicators='true' ";
	}
	protected function disabledInputSwitch($arg = NULL){
		return is_null($arg) ? NULL : "disabled";
	}
	protected function activeInputSwitch($arg = NULL){
		return is_null($arg) ? NULL : "checked";
	}	
	protected function dataActive($arg = NULL){
		return is_null($arg) ? NULL : "data-activates='{$arg}'";
	}
	protected function dataTarget($arg = NULL){
		return is_null($arg) ? NULL : "data-target='{$arg}'";
	}
	protected function altMedia($arg = NULL){
		return is_null($arg) ? NULL : "alt='{$arg}'";
	}
	protected function srcMedia($arg = NULL){
		return is_null($arg) ? NULL : "src='{$arg}'";
	}
	protected function modalFooterFixed($arg = NULL){
		return is_null($arg) ? NULL : "modal-fixed-footer";
	}
	protected function modalBottonSheet($arg = NULL){
		return is_null($arg) ? NULL : "bottom-sheet";
	}
}
