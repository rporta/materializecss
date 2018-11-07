<?php

namespace AppBundle\Utility\Obj;

use AppBundle\Utility\Obj\CreateClass\createClass;

class sideNav extends createClass
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
	// protected $menuWidth;
	protected $edge;
	protected $js;
	protected $html;
	protected $obj;

	public function __construct($arg = NULL){
		$this->reset($arg);
	}
	public function reset($arg = NULL)
	{
		$this->type = 'sideNav';
		$this->id = 'sideNav-'.$this->createID(5);
		$this->textColor = !isset($arg['textColor']) ? 'b-w-t,0' : $arg['textColor'];
		$this->backgroundColor = !isset($arg['backgroundColor']) ? 'b-w-t,1' : $arg['backgroundColor'];
		$this->container = !isset($arg['container']) ? NULL : $arg['container'];
		$this->valign = !isset($arg['valign']) ? NULL : $arg['valign'];
		$this->textAling = !isset($arg['textAling']) ? NULL : $arg['textAling'];
		$this->float = !isset($arg['float']) ? NULL : $arg['float'];
		$this->shadow = !isset($arg['shadow']) ? NULL : $arg['shadow'];
		$this->truncate = !isset($arg['truncate']) ? NULL : $arg['truncate'];			
		$this->cardPanel = !isset($arg['cardPanel']) ? NULL : $arg['cardPanel'];			
		$this->hoverable = !isset($arg['hoverable']) ? NULL : $arg['hoverable'];			
		// $this->menuWidth = !isset($arg['menuWidth']) ? "300" : $arg['menuWidth'];			
		$this->edge = !isset($arg['edge']) ? NULL : $arg['edge'];			
		$this->js = !isset($arg['js']) ? array() : array($arg['js']);
		$this->html = NULL;		
		$this->obj = NULL;

		$this->refreshInfo();			
	}
	public function refreshInfo(){
		$id = $this->id;
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
		$objHtml = $this->getObj('html');
		$objHtmla = $this->getObj('html:a');

		$this->getObj('js');

		$search = array("{ID}", "{obj:html}", "{obj:html:a}", "{TEXTCOLOR}", "{BACKGROUNDCOLOR}", "{CONTAINER}", "{VALIGN}", "{TEXTALING}", "{FLOAT}", "{SHADOW}", "{TRUNCATE}", "{CARDPANEL}", "{HOVERABLE}");
		$replace = array("{$id}", "{$objHtml}", "{$objHtmla}", "{$textColor}", "{$backgroundColor}", "{$container}", "{$valign}", "{$textAling}", "{$float}", "{$shadow}", "{$truncate}", "{$cardPanel}", "{$hoverable}");
		$tempHtml = 
		"<ul id='{ID}' class='side-nav {BACKGROUNDCOLOR}'>
  			{obj:html}
		</ul>
		{obj:html:a}";
		$tempHtml = str_replace($search, $replace, $tempHtml);

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
					// $idObj->waves = 2;
					// $idObj->refreshInfo();
					if($key !== 0)	$objHtml[] = '<li>'.$idObj->html.'</li>';
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
		elseif($arg == 'html:a' ){
			if(!empty($this->obj)){
				foreach ($this->obj as $key => $idObj) {
					if($key == 0){
						$idObj->dataActive = $this->id;
						$idObj->class = 'btn';
						$aId = $idObj->id;
						$idObj->refreshInfo();
						
						// $menuWidth = $this->menuWidth;
						$edge = $this->edge($this->edge);

						$objHtml[] = $idObj->html;
						
						$js = 
						"$('#{$aId}').sideNav({
							edge: '{$edge}'
						});";
						if(!in_array($js, $this->js)){
							$this->js[] = $js;
						}						


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

