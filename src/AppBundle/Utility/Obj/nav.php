<?php

namespace AppBundle\Utility\Obj;

use AppBundle\Utility\Obj\CreateClass\createClass;
use AppBundle\Utility\Obj\a;
use AppBundle\Utility\Obj\icon;

/**
 * al agreagar el primer objeto sera considerado como logo, 
 * el resto de los objetos son los que salen en la lista del panel mobil y de la barra del nav
 */

class nav extends createClass
{
	protected $type;
	protected $id;
	protected $textColor;
	protected $backgroundColor;
	protected $container;
	protected $valign;
	protected $textAling;
	protected $float;
	protected $shadow;
	protected $truncate;
	protected $cardPanel;
	protected $hoverable;
	protected $mobile;
	protected $mobileBackgroundColor;
	protected $fixed;
	protected $extended;
	protected $js;
	protected $html;
	protected $obj;
	protected $classData;

	public function __construct($arg = NULL){
		$this->reset($arg);
	}
	public function reset($arg = NULL)
	{
		$this->type = 'nav';
		$this->id = 'nav-'.$this->createID(5);
		$this->idJs = 'idJs-'.$this->createID(5);
		$this->textColor = !isset($arg['textColor']) ? 'b-w-t,0' : $arg['textColor'];
		$this->backgroundColor = !isset($arg['backgroundColor']) ? 'b-w-t,2' : $arg['backgroundColor'];
		$this->container = !isset($arg['container']) ? NULL : $arg['container'];
		$this->valign = !isset($arg['valign']) ? NULL : $arg['valign'];
		$this->textAling = !isset($arg['textAling']) ? NULL : $arg['textAling'];
		$this->float = !isset($arg['float']) ? NULL : $arg['float'];
		$this->shadow = !isset($arg['shadow']) ? NULL : $arg['shadow'];
		$this->truncate = !isset($arg['truncate']) ? NULL : $arg['truncate'];			
		$this->cardPanel = !isset($arg['cardPanel']) ? NULL : $arg['cardPanel'];			
		$this->hoverable = !isset($arg['hoverable']) ? NULL : $arg['hoverable'];			
		$this->mobile = !isset($arg['mobile']) ? FALSE : $arg['mobile'];			
		$this->mobileBackgroundColor = !isset($arg['mobileBackgroundColor']) ? FALSE : $arg['mobileBackgroundColor'];			
		$this->fixed = !isset($arg['fixed']) ? FALSE : $arg['fixed'];			
		$this->extended = !isset($arg['extended']) ? FALSE : $arg['extended'];		
		$this->js = !isset($arg['js']) ? array() : array($arg['js']);
		$this->html = NULL;
		$this->obj = NULL;
		$this->classData = NULL;
		$this->refreshInfo();			
	}
	public function refreshInfo(){
		$id = $this->id;
		$idJs = $this->idJs;
		$textColor =  $this->textColors($this->textColor);
		$backgroundColor =  $this->backgroundColors($this->backgroundColor);
		$container =  $this->container($this->container);
		$valign =  $this->valign($this->valign);	
		$textAling =  $this->textAling($this->textAling);	
		$float =  $this->float($this->float);	
		$shadow =  $this->shadow($this->shadow);	
		$truncate =  $this->truncate($this->truncate);		
		$cardPanel =  $this->cardPanel($this->cardPanel);		
		$hoverable =  $this->hoverable($this->hoverable);
		$extended =  $this->navExtended($this->extended);

		$oldId = $this->classData['id'];

		$newId = 'dropdown-'.$this->createID(5);

		$objHtml = str_replace($oldId, $newId, $this->getObj('html'));

		$objHtmlLogo = $this->getObj('html:Logo');

		$this->getObj('js');

		$search = array("{ID}", "{obj:html}", "{obj:html:Logo}", "{TEXTCOLOR}", "{BACKGROUNDCOLOR}", "{CONTAINER}", "{VALIGN}", "{TEXTALING}", "{FLOAT}", "{SHADOW}", "{TRUNCATE}", "{CARDPANEL}", "{HOVERABLE}", "{EXTENDED}");
		$replace = array("{$id}", "{$objHtml}", "{$objHtmlLogo}", "{$textColor}", "{$backgroundColor}", "{$container}", "{$valign}", "{$textAling}", "{$float}", "{$shadow}", "{$truncate}", "{$cardPanel}", "{$hoverable}", "{$extended}");
		$tempHtml = 
		"<nav id='{ID}' class='{TEXTCOLOR} {BACKGROUNDCOLOR} {CONTAINER} {VALIGN} {TEXTALING} {FLOAT} {SHADOW} {TRUNCATE} {CARDPANEL} {HOVERABLE} {EXTENDED}'>
			<div class='nav-wrapper'>
				{obj:html:Logo}
				{obj:html:mobileButton}
				<ul class='{FLOAT} hide-on-med-and-down'>
  					{obj:html}
  				</ul>
			{obj:html:mobileList}
  			</div>
		</nav>";
		$tempHtml = str_replace($search, $replace, $tempHtml);

		if($this->mobile){
			$mobileBackgroundColor =  $this->backgroundColors($this->mobileBackgroundColor);

			$objHtmlButton['class'] = "button-collapse";
			$objHtmlButton['dataActive'] = $idJs;
			$objHtmlButton['href'] = "#";
			$objHtmlButton = new a($objHtmlButton);

			$colorN = explode(",", $this->backgroundColor)[1];

				$icon_1['icon'] = "menu";
				$icon_1['float'] = "l";
				$icon_1['size'] = "1";
				$icon_1['textColor'] = ($colorN >= 5 ) ? 'grey,0' : 'grey,9' ;
				$icon_1 = new icon($icon_1);

			$objHtmlButton->addObj($icon_1);

			$objHtmlButton = $objHtmlButton->html;

			$objHtml = "<ul id='{$idJs}' class='side-nav {$mobileBackgroundColor}'>";

			$oldId = $this->classData['id'];

			$newId = 'dropdown-'.$this->createID(5);

			$objHtml .= str_replace($oldId, $newId, $this->getObj('html'));
			$objHtml .= "</ul>";


			$search = array("{obj:html:mobileButton}", "{obj:html:mobileList}");
			$replace = array("{$objHtmlButton}", "{$objHtml}");

			$js = "$('.button-collapse').sideNav();";

			if(!in_array($js, $this->js)){
				$this->js[] = $js;
			}	

			$tempHtml = str_replace($search, $replace, $tempHtml);
		}
		else{
			$search = array("{obj:html:mobileButton}", "{obj:html:mobileList}");
			$replace = explode(",", ",");


			$tempHtml = str_replace($search, $replace, $tempHtml);
		}

		if($this->fixed){
			$tempHtml = "<div class='navbar-fixed'>{$tempHtml}</div>";
		}

		$this->html = $tempHtml;
		
	}
	public function addObj($obj){
		$this->obj[] = $obj;
		$this->refreshInfo();
	}

	public function delObj($obj){
		$reversed = array_reverse($this->obj , 1);
		foreach ($reversed as $key => $objR) {
			if($objR->type == $obj->type && $objR->id == $obj->id){
				unset($this->obj[$key]);
				break;
			}
		}
		$this->refreshInfo();
	}
	public function getObj($arg){

		$arg = strtolower((string)$arg);
		if($arg == 'html'){
			if(!empty($this->obj)){
				foreach ($this->obj as $key => $idObj) {
					if($key !== 0){	
						if($idObj->type == 'dropdown'){

							$this->classData['id'] = $idObj->id;
	
						}
					// $idObj->waves = 2;
					// $idObj->refreshInfo();
						$objHtml[] = '<li>'.$idObj->html.'</li>';
					}

				}
				if(isset($objHtml)) return implode("", $objHtml);
			}
		}
		elseif($arg == 'js'){
			if(!empty($this->obj)){
				foreach ($this->obj as $Obj) {
					foreach ($Obj->js as $js) {
						if(!in_array($js, $this->js)){
							$this->js[] = $js;
						}
					}
				}
			}
		}
		elseif($arg == 'html:logo' ){

			if(!empty($this->obj)){
				foreach ($this->obj as $key => $idObj) {
					if($key == 0){
						$idObj->class = 'brand-logo';
						$idObj->refreshInfo();

						$objHtml[] = $idObj->html;			
						break;
					}
				}
				if(isset($objHtml)) return implode("", $objHtml);
			}
		}
	}
	public function refreshId(){
		$type = $this->type;
		$id = $this->createID(5);
		$this->id = "{$type}-{$id}";
	}
    public function __set($property, $value )
    {
        $this->$property = $value;
        $this->refreshInfo();
    }
    public function __get($property)
    {
        return $this->$property;
    }

}

