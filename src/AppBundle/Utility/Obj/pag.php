<?php
namespace AppBundle\Utility\Obj;

use AppBundle\Utility\Obj\CreateClass\createClass;

class pag extends createClass
{	
	protected $type;
	protected $id;
	protected $textColor;
	protected $backgroundColor;
	protected $js;
	protected $obj;
	
	public function __construct($arg = NULL){
		$this->reset($arg);
	}
	public function reset($arg = NULL)
	{
		$this->type = 'pag';
		$this->id = 'pag-'.$this->createID(5);
		$this->textColor = !isset($arg['textColor']) ? 'b-w-t,0' : $arg['textColor'];
		$this->backgroundColor = !isset($arg['backgroundColor']) ? 'b-w-t,1' : $arg['backgroundColor'];
		$this->js = !isset($arg['js']) ? array() : array($arg['js']);
		$this->obj = NULL;
	}
	public function render($arg = NULL){
		$id = $this->id;
		$textColor =  $this->textColors($this->textColor);
		$backgroundColor =  $this->backgroundColors($this->backgroundColor);

		$css[] = "/css/materialize.min.css";
		$css[] = "/css/1.0.0-rc.2.css";

		$html = 
		"<html>\n".
		"	<head>\n".
		"		<link href='/css/icon.css' rel='stylesheet'>\n".
		"		<link type='text/css' rel='stylesheet' href='{$css[0]}'  media='screen,projection'/>\n".
		"		<link type='text/css' rel='stylesheet' href='/css/nouislider.css' />\n".
		"		<meta name='viewport' content='width=device-width, initial-scale=1.0'/>\n".
		"		{STICKYFOOTER}\n".
		"	</head>\n".
		"	<body id='{ID}' class='{TEXTCOLOR} {BACKGROUNDCOLOR}'>\n".
	    "    	{obj:html}\n".
		"		<script src='/js/jquery-3.2.1.min.js'></script>\n".
		"		<script src='/js/jqueryui-1.8.18.js'></script>\n".
		"		<script src='/js/materialize.min.js'></script>\n".
		"		<script src='/js/nouislider.js'></script>\n".
		"		<script >\n".
		"		var pF = null;".
		"		$( document ).ready(function() {\n".
		"			{obj:js}\n".
		"		});\n".
		"		</script>\n".
		"	</body>\n".
		"</html>";

		$objHtml = $this->getObj('html');
		$objJs =  $this->getObj('js');
		$stickyfooter = $this->stickyfooter();

		$search = array("{ID}", "{obj:html}", "{TEXTCOLOR}", "{BACKGROUNDCOLOR}", "{STICKYFOOTER}", "{obj:js}");
		$replace = array("{$id}", "{$objHtml}", "{$textColor}", "{$backgroundColor}", "{$stickyfooter}", "{$objJs}");

		$html = str_replace($search, $replace, $html);

		if($arg == 'export'){ 
			return $html;
		}
		else{
			echo $html;
		}  
	}

	public function addObj($obj){
		$this->obj[] = $obj;
	}

	public function delObj($obj){
		$reversed = array_reverse($this->obj , 1);
		foreach ($reversed as $key => $objR) {
			if($objR->type == $obj->type && $objR->id == $obj->id){
				unset($this->obj[$key]);
				break;
			}
		}
	}
	public function getObj($arg = NULL){
		$arg = strtolower((string)$arg);
		if($arg == 'html'){
			if(!empty($this->obj)){
				foreach ($this->obj as $idObj) {
					$objHtml[] = $idObj->html;
				}
				$objHtml = implode("\n\t\t", $objHtml);
			}
			else{
				$objHtml = "";
			}
			return $objHtml;
		}
		elseif($arg == 'js'){
			if(!empty($this->obj)){
				foreach ($this->obj as $Obj) {
					foreach ($Obj->js as $js) {
						if(!is_null($js)) {
							if (is_array($js)){ $objJs[] = implode("\n\t\t\t", $js);}
							else {$objJs[] = $js;}
						}
					}
				}
				if(!empty($objJs)) array_unique($objJs);
				if(!empty($this->js)){
					foreach ($this->js as $key => $js) {
						if(is_array($js)){ $objJs[] = implode("\n\t\t\t", $js);	}
						else{$objJs[] = $js;}
					}
				}
				if(!empty($objJs)) array_unique($objJs);
				if(isset($objJs)) return implode("\n\t\t\t", $objJs);
			}
			else{
				return NULL;
			}
		}
	}	
	public function stickyfooter(){
		$style = 
		"<style type='text/css'>
			body {
				display: flex;
				min-height: 100vh;
				flex-direction: column;
			}

			main {
				flex: 1 0 auto;
			}
		</style>";
		if(!empty($this->obj)){
			foreach ($this->obj as $idObj) {
				if($idObj->type == 'footer'){
					if($idObj->stickyfooter){
						return $style;
					}
				}
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
    	if($property == 'js'){
        	$this->js[] = $value;
    	}
    	else{
        	$this->$property = $value;
    	}
    }
    public function __get($property)
    {
        return $this->$property;
    }
}