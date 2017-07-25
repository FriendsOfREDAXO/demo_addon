<?php
/** 
*
* PlusResponsiveImage
* Gibt ein <picture> oder <img> Element mit verschiedenen Auflösungen aus.
*
* @author: @alexplus_de Alexander Walther
* @version: 0.8
*/

class PlusResponsiveImage
{
	private $file = 'no-image.jpg'; // Bild-Dateiname
	private $profiles = ["320w" => "image_xs", "480w" => "image_s", "768w" => "image_m", "960w" => "image_l", "1400w" => "image_xl"]; // key: viewport-Breite, value: Media Manager Profil
	private $sizes = ""; // To Do
	private $media = ''; // Redaxo Media-Objekt
	private $path = '/images/'; // Redaxo-Pfad zur Bilddatei (Standard: '/images/', benötigt YRewrite)
	private $alt = ''; // Alt-Attribut
	private $attributes = ''; // Zusätzliche Attribute für das img- oder das picture-Element
	private $class = 'responsive'; // Class-Attribut
	private $srcset = ''; // srcset-Attribut
	
	private $width = 0;
	private $height = 0;


    public function setFile($file)
    {
        $this->file = $file;
        return $this;
    }
	
    public function getFile()
    {
        return $this->file;
    }



    public function setProfiles($profiles)
    {
		if(is_array($profiles)) {
        	$this->profiles = $profiles;
        }
        return $this;
    }

    public function getProfiles()
    {
        return $this->profiles;
    }

    public function setSizes($sizes)
    {
		if(is_array($sizes)) {
        	$this->sizes = $sizes;
        }
        return $this;
    }

    public function getSizes()
    {
        return $this->sizes;
    }


	public function setMedia() {
		$media = rex_media::get($this->file);
		$this->media = $media;
		$this->width = $media->getWidth();
		$this->height = $media->getHeight();
		return $this;
	}

	public function getMedia() {
		if(is_object($this->media)) {
			return $this->media;
		} else {
			return false;
		}
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



    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }
	
    public function getClass()
    {
        return $this->class;
    }



    public function setAlt($alt)
    {
        $this->alt = $alt;
        return $this;
    }

    public function setAltFromTitle()
    {
    	if(is_object($this->media)) {
    		$this->alt = $this->media->getTitle();
    	} else if($this->getMedia()) {
    		$this->alt = $this->media->getTitle();
    	}
        return $this;
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



    public function getSrcset() 
    {
		if(is_array($this->profiles)) 
		{
			$srcset_values = [];
			foreach($this->profiles as $size => $profile) 
			{
				$srcset_values[] = $this->path.$profile.'/'.$this->file.' '.$size;
			}
		$this->srcset = implode(',', $srcset_values);
		return $this->srcset;
		} else {
			return false;
		}
   	}


	
	public function getImg()
	{
		$this->getSrcset();
		$this->setMedia();
		$profile = $this->profiles;
		return '<img srcset="'.$this->srcset.'" src="'.$this->path.array_shift($profile)."/".$this->file.'" class="'.$this->class.'" alt="'.$this->alt.'" sizes="'.$this->sizes.'" width="'.$this->width.'" height="'.$this->height.'" '.$this->attributes.' />';
	}


	/* to do: sources umsetzen */
	public function getPicture() {
		$sources = '';
		foreach($profiles as $size => $profile) {
			$sources[] = '<source media="" sizes="" srcset=""></source>';
		}
		return '<picture class="'.$this->class.'" '.$this->attributes.'>'.$sources.'<img alt="'.$this->alt.'" /></picture>';
	}
}
