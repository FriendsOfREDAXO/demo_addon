<?php
/** 
*
* PlusPagination
* Gibt eine Liste mit Paginierungs-Links aus.
*
* @author: @alexplus_de Alexander Walther
* @version: 0.1
*
*/

class PlusPagination {

	public $limit;
	public $offset;
	public $total;
	public $page;
	
	public $page_max;
	
	public $html = array();
	public $text = array();
	public $option = array();
	public $url = array();
	public $params = array();


	private $elements = array();
	private $return = "";

	public function __construct($total = 50, $page = 1, $limit = 10) {
		$this->total = $total; 						// Letzter Eintrag
		$this->page = $page;						// Aktuelle Seite
		$this->limit = $limit; 						// Einträge pro Seite
		$this->offset = $page * $limit; 			// Aktueller Eintrag 
		$this->page_max = (int) ($total / $limit); 	// Letzte Seite

		$this->html['ul'] = '<ul class="###class###">###items###</ul>';
		$this->html['li'] = '<li class="###class###">###anchor###</li>'; 
		$this->html['a'] = '<a href="###href###" class="###class###">###text###</a>'; 
		$this->html['span'] = '<span class="###class###">###text###</span>'; 

		$this->text['first'] = '«';
		$this->text['last'] = '»';
		$this->text['prev'] = '‹';
		$this->text['next'] = '›';

		$this->option['show_max'] = 5;				// Anzahl der Seiten-Links um die aktuelle Seite herum
		$this->option['show_skip'] = true;			// Zeige Erste / Letzte
		$this->option['show_neighbours'] = true;	// Zeige Vor / Zurück

		$this->url['id'] = "REX_ARTICLE_ID";		// Ziel-Artikel-ID
		$this->url['hash'] = "";					// Ziel-ID (ohne "#")

		return true;
	}

	public function show() {

		$elements[] = $this->getFirst();
		$elements[] = $this->getPrev();

		if($this->page_max > $this->option['show_max']) {
			$first = $this->page - (int)($this->option['show_max']/2);
			$last = $this->page + (int)($this->option['show_max']/2);
			while($first < 1) {
				$first++;
				$last++;
			}
			while($last > $this->page_max) {
				$first--;
				$last--;
			}
		} else {
			$first = 1;
			$last = $this->page_max;
		}
		
		// Zahlen
		for($i = $first; ($i <= $last); $i++)
        {
          	$anchor = $this->buildAnchor($i, $i);
			$list = str_replace("###anchor###",$anchor,$this->html['li']);

			if($i == $this->page) {
				$list = str_replace("###class###","search_it-pagination-current",$list);
			} else {
				$list = str_replace("###class###","",$list);
			}

			$elements[] = $list;
        }
	
		$elements[] = $this->getNext();
		$elements[] = $this->getLast();
		
		foreach ($elements as $element) {
			$return .= $element;
		}
		$return = str_replace("###items###",$return,$this->html['ul']);
		$return = str_replace("###class###","search_it-pagination",$return);

		return $return;

	}

	
	public function getFirst() {
		// Erste Seite
		if($this->option['show_skip']) {
			$anchor = $this->buildAnchor(1, $this->text['first']);
			$li  = str_replace("###anchor###",$anchor,$this->html['li']);
			if($this->offset > $this->limit) {
				$li  = str_replace("###class###","",$li);
			} else {
				$li  = str_replace("###class###","search_it-pagination-disabled",$li);
			}
			return $li;
		}
	}
	
	public function getPrev() {
		// Zurück
		if($this->option['show_neighbours']) {
			$page = $this->page-1;
			if($page < 1) {
				$page = 1;
			}
			$anchor = $this->buildAnchor($page, $this->text['prev']);
			$li  = str_replace("###anchor###",$anchor,$this->html['li']);
			if($this->offset > $this->limit) {
				$li  = str_replace("###class###","",$li);
			} else {
				$li  = str_replace("###class###","search_it-pagination-disabled",$li);
			}
			return $li;
		}
	}
	
	
	public function getNext() {
	
		// Nächste
		if($this->option['show_neighbours']) {
			$page = $this->page + 1;
			if(($page * $this->limit) >= $this->total) {
				$page = (int) ($this->total / $this->limit);
			}
			$anchor = $this->buildAnchor($page, $this->text['next']);
			$li  = str_replace("###anchor###",$anchor,$this->html['li']);
			if((($this->page+1) * $this->limit) <= $this->total) {
				$li  = str_replace("###class###","",$li);
			} else {
				$li  = str_replace("###class###","search_it-pagination-disabled",$li);
			}
			return $li;
		}
	}
	
	public function getLast() {

		// Letzte Seite
		if($this->option['show_skip']) {
			$anchor = $this->buildAnchor((int) ($this->total / $this->limit), $this->text['last']);
			$li  = str_replace("###anchor###",$anchor,$this->html['li']);
			if((($this->page+1) * $this->limit) <= $this->total) {
				$li  = str_replace("###class###","",$li);
			} else {
				$li  = str_replace("###class###","search_it-pagination-disabled",$li);
			}
			return $li;
		}
	}
	
	private function buildAnchor($page, $text = '') {

		$this->addParams("page", $page);
		$href = rex_getUrl($this->url['id'], null, $this->params);
		if($this->url['hash']) {
			$href .= "#".$this->url['hash']; 
		}

		$span = str_replace("###text###",$text,$this->html['span']);
		$anchor = str_replace("###text###",$span,$this->html['a']);
		$anchor = str_replace("###href###",$href,$anchor);
		$anchor = str_replace("###key###",$key,$anchor);
		return $anchor;
	}

	/* Setter and Getter */

    public function setText($key, $value) {
		$this->text[$key] = $value;
		return true;
    }
    public function setOption($key, $value) {
		$this->option[$key] = $value;
		return true;
    }
    public function setHash($hash) {
		$this->url['hash'] = $hash;
		return true;
    }

    public function addParams($key, $value) {
		$this->params[$key] = $value;
		return true;
    }
}