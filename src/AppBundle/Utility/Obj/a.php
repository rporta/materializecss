<?php
namespace AppBundle\Utility\Obj;

use AppBundle\Utility\Obj\CreateClass\createClass;
/**
 * 
 */
class a extends createClass
{
	protected $id;
	protected $type;
	protected $textColor;
	protected $backgroundColor;
	protected $text;
	protected $textAling;
	protected $flowText;
	protected $href;
	protected $float;
	protected $valign;
	protected $dataActive;
	protected $dataTarget;
	protected $class;
	protected $waves;
	protected $toast;
	protected $js;
	protected $obj;
	protected $html;

	public function __construct($arg = NULL){
		$this->reset($arg);
	}
	public function reset($arg = NULL){
		$this->id = 'a-'.$this->createID(5);
		$this->type = 'a';
		$this->textColor = !isset($arg['textColor']) ? NULL : $arg['textColor'];
		$this->backgroundColor = !isset($arg['backgroundColor']) ? NULL : $arg['backgroundColor'];
		$this->text = !isset($arg['text']) ? '' : $arg['text'];
		$this->textAling = !isset($arg['textAling']) ? NULL : $arg['textAling'];		
		$this->flowText = !isset($arg['flowText']) ? NULL : $arg['flowText'];		
		$this->href = !isset($arg['href']) ? "#" : $arg['href'];
		$this->float = !isset($arg['float']) ? NULL : $arg['float'];
		$this->valign = !isset($arg['valign']) ? NULL : $arg['valign'];
		$this->dataActive = !isset($arg['dataActive']) ? NULL : $arg['dataActive'];
		$this->dataTarget = !isset($arg['dataTarget']) ? NULL : $arg['dataTarget'];
		$this->class = !isset($arg['class']) ? NULL : $arg['class'];
		$this->waves = !isset($arg['waves']) ? NULL : $arg['waves'];
		$this->toast = !isset($arg['toast']) ? NULL : $arg['toast'];
		$this->js = !isset($arg['js']) ? array() : array($arg['js']);
		$this->obj = NULL;
		$this->html = NULL;
		$this->refreshInfo();		
	}
	public function refreshInfo(){
		$id = $this->id;
		$textColor =  $this->textColors($this->textColor);
		$backgroundColor =  $this->backgroundColors($this->backgroundColor);
		$href = $this->href;
		$float =  $this->float($this->float);
		$valign =  $this->valign($this->valign);
		$dataActive = $this->dataActive($this->dataActive);
		$dataTarget = $this->dataTarget($this->dataTarget);
		$text = $this->text;
		$textAling =  $this->textAling($this->textAling);	
		$flowText =  $this->flowText($this->flowText);	
		$class = $this->class;
		$waves = $this->waves($this->waves);
		$objHtml = $this->getObj('html');
		$toast = $this->toast($this->toast);
		
		$this->getObj('js');		
		
		if(!is_null($toast)){
			$this->js[] = "$('#{$id}').click(function() {".$toast."});";
		}

		$search = array("{ID}", "{TEXTCOLOR}", "{BACKGROUNDCOLOR}", "{TEXT}", "{HREF}", "{DATA:ACTIVE}", "{DATA:TARGET}", "{CLASS}", "{obj:html}", "{WAVES}", "{FLOAT}", "{VALIGN}", "{FLOWTEXT}", "{TEXTALING}");
		$replace = array("{$id}", "{$textColor}", "{$backgroundColor}", "{$text}", "{$href}", "{$dataActive}", "{$dataTarget}", "{$class}", "{$objHtml}", "{$waves}", "{$float}", "{$valign}", "{$flowText}", "{$textAling}");
		$tempHtml = '<a id="{ID}" href="{HREF}" {DATA:ACTIVE} {DATA:TARGET} class="{TEXTALING} {TEXTCOLOR} {BACKGROUNDCOLOR} {WAVES} {CLASS} {FLOAT} {VALIGN} {FLOWTEXT}">{TEXT}{obj:html}</a>';
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
				foreach ($this->obj as $idObj) {
					$objHtml[] = $idObj->html;
				}
				$objHtml = implode(" ", $objHtml);
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
						if(!in_array($js, $this->js)){
							$this->js[] = $js;
						}
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
        $this->$property = $value;
        $this->refreshInfo();
    }
    public function __get($property)
    {
        return $this->$property;
    }
}

