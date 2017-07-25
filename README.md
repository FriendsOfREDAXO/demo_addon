# PlusHelferlein

Helferlein für widerkehrende Aufgaben in Modulen und über Projekte hinweg. Work in progress. Wer einzelne Klassen verbessern will, darf gerne PRs beisteuern - ich befinde mich erst am Anfang von OOP.

**In Bearbeitung**
* PlusDownloads: Gibt eine Liste mit Dateien aus dem Medienpool aus.
* PlusResponsiveImage: Gibt ein <picture> oder <img> Element mit verschiedenen Auflösungen aus.

**Geplant**
* PlusGallery: Gibt eine Liste mit Bildern für Galerie- und Lightbox-Skripte aus, bspw. Flexslider und Magnific Popup
* PlusSData: Gibt strukturierte Daten von Produkten und Events aus.

## PlusDownloads

Gibt eine Liste mit Dateien aus dem Medienpool aus.

### Todo

* Thumbnail / Dateiicon generieren
* Clang berücksichtigen
* Templates editierbar machen

### Beispiel

**Setup**

1. PlusDownloads.php in `/redaxo/src/addons/project/lib/classes/` kopieren
2. MediaManager-Profil `downloads` anlegen
3. Dem Profil "downloads" den Effekt `header` zuweisen, Parameter: Download: `download`, Cache-Control: `no_cache`
4. .htaccess-Einstellung hinzufügen: `RewriteRule ^download/([^/]*)/([^/]*) %{ENV:BASE}/index.php?rex_media_type=downloads&rex_media_file=$2&%{QUERY_STRING} [B]`
5. Modul anlegen, bspw. mit mForm:

**Eingabe mit Form**
```
<?php

$mform = new mform();
$mform->addMedialistField(1,array('label'=>'Dateianhang'));
echo $mform->show();
?>
```

**Ausgabe**
```
<section class="modul modul-text" id="modul-REX_SLICE_ID">
    <div class="wrapper">
        <?php
if(class_exists('PlusDownloads')) 
{
    $downloads = new PlusDownloads();
    $downloads->setFiles("REX_MEDIALIST[1]");
    echo $downloads->getDownloads();
} else {
    // Hilfsklasse PlussDownloads befindet sich nicht in /addons/projects/
    echo '<p class="warning">Das Modul "Downloads" ist defekt. <code>/redaxo/src/addons/project/lib/classes/</code> überprüfen.</p>';   
}
        ?>
    </div>
</section>
```

**Ausgabe**
```
<ul class="downloads">
<li><a href="/download/photo-1460400408855-36abd76648b9.jpg" target="_blank"><span class="title">photo-1460400408855-36abd76648b9.jpg</span><span class="filesize">(995,31 KiB)</span></a></li>
<li><a href="/download/photo-1469204691332-56e068855403.jpg" target="_blank"><span class="title">photo-1460400408855-36abd76648b9.jpg</span><span class="filesize">(943,24 KiB)</span></a></li>
</ul>
```

## PlusResponsiveImage
Gibt ein &lt;picture> oder &lt;img> Element mit verschiedenen Auflösungen aus.

### Todo

* Picture-Element ausgeben
* sizes-Attribut berücksichtigen
* width/height aus dem Medienpool optional machen

### Beispiel
```
<?php

$image = new PlusResponsiveImage();
$image->setFile('my-image.jpg');
$image->setProfiles(["320w" => "image_xs", "480w" => "image_s", "768w" => "image_m", "960w" => "image_l", "1400w" => "image_xl"]);
# $image->setProfiles(["1x" => "image", "2x" => "image_retina"]); // oder Abhängig von der Pixel Density
$image->setPath("/images/");
$image->setAlt('Bildtitel'); // Bildtitel mitgeben
# $image->setAltFromTitle(); // oder Titel aus dem Medienpool
$image->setAttributes('id="image_id" style="border: 1rem solid white; box-shadow: 0 0 1rem 0 rgba(0,0,0,0.2);"');
$image->setClass('responsive-image');

echo $image->getImg(); // gibt den img-Tag aus.
# echo $image->getPicture(); // funktioniert noch nicht
?>
```

### Ausgabe:

```
<img srcset="/images/image_xs-square/0005.jpg 320w,/images/image_s-square/0005.jpg 480w,/images/image_m-square/0005.jpg 960w" src="/images/image_xs-square/0005.jpg" class="responsive" alt="Sarah Duerr" sizes="" width="3000" height="2000">
```
