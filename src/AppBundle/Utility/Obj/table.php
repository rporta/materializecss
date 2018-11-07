<?php

namespace AppBundle\Utility\Obj;

use AppBundle\Utility\Obj\CreateClass\createClass;
/**
 * 
 */
class table extends createClass
{
	protected $id;
	protected $type;
	protected $textColor;
	protected $backgroundColor;
	protected $float;
	protected $center;
	protected $valign;
	protected $js;
	protected $class;
	protected $mode;
	protected $shadow;
	protected $html;
	protected $head;
	protected $row;
	protected $waves;
	protected $sortable;

	public function __construct($arg = NULL){
		$this->reset($arg);
	}
	public function reset($arg = NULL)
	{
		$this->id = 'table-'.$this->createID(5);
		$this->type = 'table';
		$this->textColor = !isset($arg['textColor']) ? NULL : $arg['textColor'];
		$this->backgroundColor = !isset($arg['backgroundColor']) ? NULL : $arg['backgroundColor'];
		$this->float = !isset($arg['float']) ? NULL : $arg['float'];
		$this->center = !isset($arg['center']) ? NULL : $arg['center'];
		$this->valign = !isset($arg['valign']) ? NULL : $arg['valign'];
		$this->js = !isset($arg['js']) ? array() : array($arg['js']);
		$this->class = !isset($arg['class']) ? NULL : $arg['class'];
		$this->mode = !isset($arg['mode']) ? NULL : $arg['mode'];
		$this->shadow = !isset($arg['shadow']) ? NULL : $arg['shadow'];
		$this->waves = !isset($arg['waves']) ? NULL : $arg['waves'];		
		$this->sortable = !isset($arg['sortable']) ? NULL : $arg['sortable'];		
		$this->html = NULL;
		$this->head = NULL;
		$this->row = NULL;
		$this->refreshInfo();			
	}
	public function refreshInfo(){

		$id = $this->id;
		$textColor =  $this->textColors($this->textColor);
		$backgroundColor =  $this->backgroundColors($this->backgroundColor);
		$float =  $this->float($this->float);
		$center =  $this->tableCenter($this->center);	
		$valign =  $this->valign($this->valign);
		$class = $this->class;
		$waves = $this->waves($this->waves);
		$head = $this->getObj('html:head');
		$row = $this->getObj('html:row');
		$mode = $this->modeTable($this->mode);
		$shadow =  $this->shadow($this->shadow);	
		$sortable = $this->sortable;
		


		$search = array("{ID}", "{TEXTCOLOR}", "{BACKGROUNDCOLOR}", "{MODE}", "{CLASS}", "{HEAD}", "{ROW}", "{WAVES}", "{FLOAT}", "{VALIGN}", "{CENTER}", "{SHADOW}");
		$replace = array("{$id}", "{$textColor}", "{$backgroundColor}", "{$mode}", "{$class}", "{$head}", "{$row}", "{$waves}", "{$float}", "{$valign}", "{$center}", "{$shadow}");
		$tempHtml = 
		'<style>
			tr:after {  position:absolute; height:100%; width:100%; top:0px; left:0px; content:\' \'; z-index:-1; }
			tr { -moz-transition:border-top-width 0.1s ease-in; -webkit-transition:border-top-width 0.1s ease-in; border-top:0px solid rgba(0,0,0,0); 
			 position:relative; 
			}
			.marker { opacity:0.0; }
		</style>
		<style name="impostor_size">
			.marker + tr { border-top-width:0px; }
		</style>
		<table id="{ID}" class="{MODE} {TEXTCOLOR} {BACKGROUNDCOLOR} {WAVES} {CLASS} {FLOAT} {VALIGN} {CENTER} {SHADOW}"><thead>{HEAD}</thead>
			<tbody>{ROW}</tbody>
		</table>';
		$tempHtml = str_replace($search, $replace, $tempHtml);

		if(!is_null($sortable)){
			$this->js[] = 
			" 
			var stylesheet = $('style[name=impostor_size]')[0].sheet;
			var rule = stylesheet.rules ? stylesheet.rules[0].style : stylesheet.cssRules[0].style;
			var setPadding = function(atHeight) {
			    rule.cssText = 'border-top-width: '+atHeight+'px'; 
			};
			console.log($($('#{$id}')[0].children[1]));
			$($('#{$id}')[0].children[1]).sortable({
			    'placeholder':'marker',
			    'start':function(ev, ui) {
			        setPadding(ui.item.height());
			    },
			    'stop':function(ev, ui) {
			        var next = ui.item.next();
			        next.css({'-moz-transition':'none', '-webkit-transition':'none', 'transition':'none'});
			        setTimeout(next.css.bind(next, {'-moz-transition':'border-top-width 0.1s ease-in', '-webkit-transition':'border-top-width 0.1s ease-in', 'transition':'border-top-width 0.1s ease-in'}));
			    }
			}); ";
		}

		$this->html = $tempHtml;
	}
	/*se agrega por campos*/
	public function addHead($arg){
		$this->head[] = $arg;
		$this->refreshInfo();
	}
	/*Se agregan registros como array cada item del array es un campo*/
	public function addRow($arg){
		$this->row[] = $arg;
		$this->refreshInfo();
	}
	public function getObj($arg){
		$arg = strtolower((string)$arg);
		if($arg == 'html:head'){
			if(!empty($this->head)){
				$objHtml[] = "<tr>";
				foreach ($this->head as $head) {
					$objHtml[] = "<th>{$head}</th>";
				}
				$objHtml[] = "</tr>";
				if(isset($objHtml)) return implode("", $objHtml);
			}
		}
		elseif($arg == 'html:row'){
			if(!empty($this->row)){
				foreach ($this->row as $arrayRow) {
					$tempRow = "<tr><td>".implode('</td><td>', $arrayRow)."</td></tr>";
					$objHtml[] = $tempRow;
				}
			}
			if(isset($objHtml)) return implode("", $objHtml);
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
