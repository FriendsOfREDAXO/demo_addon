<?php
/** 
*
* PlusDownloads
* Gibt eine Liste an Downloads aus.
*
* @author: @alexplus_de Alexander Walther
* @version: 0.1
*
*/

class PlusDownloads
{
	private $files = ['no-file.pdf']; // Array der Datei-Anhänge
	private $class = 'downloads';
	private $force = true; // Soll der Download über den Header erzwungen werden?
	private $path = '/media/'; // Pfad zum Medienordner (Standard: '/media/')
	private $force_path = '/download/'; // Benötigt .htaccess-Rewrite und Media Manager Profil
	private $target = '_blank'; // Target-Attribut, Standard: '_blank'
	private $attributes = ''; // Zusätzliche Attribute für das Anker-Element
	private $show_title = true; // Gibt den Medienpool-Titel zur Datei aus, wenn möglich
	// private $show_thumbnail = false; // Gibt ein Icon / Vorschaubild aus.
	private $show_container = true; // Gibt den Container aus. False, um nur den Link auszugeben.

	/* Templates */
	private $template_container = '<ul class="###class###">###downloads###</ul>';
	private $template_list = '<li>###download###</li>';
	private $template_anchor = '<a href="###href###" target="###target###" ###attributes###>###content###</a>';
	private $template_content = '<span class="title">###title###</span><span class="filesize">###filesize###</span>';
	// private $template_content = '<span class="image">###image###</span><span class="title">###title###</span><span class="filesize">###filesize###</span>';
	
    public function setFiles($files) {
		if(is_string($files)) 
		{
			$files = array_filter(explode(",",$files));
			$this->files = $files;
		} else if (is_array($files)) {
	        $this->files = $files;
		}
        return $this;
    }
	
    public function getFiles()
    {
        return $this->files;
    }

	private function getHref($file) 
	{
		$path = '';
		if($this->force === true) 
		{
			$path = $this->force_path . $file;
		} else {
			$path = $this->path . $file;
		}
		return $path;
	}

    public function setPath($path)
    {
		$this->path = $path;
        return $this;
    }

    public function getPath()
    {
        return $this->path;
    }

	private function getMedia($file) {
		$media = rex_media::get($file);
		return $media;
	}

    public function setForcePath($force_path)
    {
        $this->force_path = $force_path;
        return $this;
    }
	
    public function getForcePath()
    {
        return $this->force_path;
    }


    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }
	
    public function getClass()
    {
        return $this->class;
    }	

    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
        return $this;
    }
	
    public function getAttributes()
    {
        return $this->attributes;
    }
	
	private function getImage($file) {
		if($this->show_thumbnail === true) {
			return ''; // todo
		} else {
			return '';
		}
	}
	
	private function getContent($placeholder) {
		return str_replace(array_keys($placeholder), array_values($placeholder), $this->template_content);
	}
	
	private function getAnchor($placeholder) {
		return str_replace(array_keys($placeholder), array_values($placeholder), $this->template_anchor);
	}
	
	public function getDownloads()
	{
		$html = '';
		$placeholder = [];
		foreach($this->files as $file)
		{
			$media = $this->getMedia($file);
			if($this->title) 
			{
				$placeholder['###title###'] = $media->getTitle();
			} 
			if (trim($placeholder['###title###']) === '') 
			{
				$placeholder['###title###'] = $file;			
			}
			$placeholder['###filesize###'] = "(".$media->getFormattedSize().")";
			$placeholder['###image###'] = $this->getImage($file);
			$placeholder['###attributes###'] = $this->attributes;
			$placeholder['###target###'] = $this->target;
			$placeholder['###href###'] = $this->getHref($file);
			
			$placeholder['###content###'] = $this->getContent($placeholder);

			$html .= str_replace('###download###', $this->getAnchor($placeholder), $this->template_list);
		}
		
		// Template befüllen
        $html = str_replace('###downloads###', $html, $this->template_container);
        $html = str_replace('###class###', $this->class, $html);
		
		return $html;
	}
}
