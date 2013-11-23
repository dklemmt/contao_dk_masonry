Masonry - ein intelligentes Grid Layout für Contao
==================================================

***Masonry*** ist ein JavaScript-Plugin von David DeSandro, das ein intelligentes *Grid Layout* implementiert. Masonry, aus dem Englischen für Mauerwerk, platziert die enthaltenen Elemente anhand ihrer Größe und des zur Verfügung stehenden vertikalen Platzes optimal verzahnt/versetzt wie ein Mauerwerk. 

Nach der Installation dieser Erweiterung stehen innerhalb von Contao zusätzliche Inhaltselemente zur Verfügung:

* *Masonry - Galerie* analog der Contao Galerie erweitert um die neue Funktionalität
* und die beiden Wrapper Elemente *Masonry - Umschlag Anfang* sowie *Masonry - Umschlag Ende* um beliebige Elemente im Grid platzieren zu können

Möglichkeiten der Erweiterung und von Masonry
---------------------------------------------

* Konfiguration der Spaltenbreite als fester Wert oder indirekt über eine anzugebene CSS-Klasse
* Konfiguration der Breite des Spaltenzwischenraums als fester Wert oder indirekt über eine anzugebene CSS-Klasse
* Horizontale Ausrichtung (links/rechts) von wo aus mit der Platzierung der Elemente begonnen wird
* Vertikale Ausrichtung (oben/unten) von wo aus mit der Platzierung der Elemente begonnen wird
* verschiedene Themes

Quelle/Beispiele
----------------

http://masonry.desandro.com/

Tipps/Hinweise
--------------

* Damit Masonry gestartet wird, muß im Seitenlayout *jQuery* zum Layout hinzugefügt werden.
* Die Elementbreiten **sollten** per CSS definiert werden und zwar unabhängig der Einstellung der Spaltenbreite - selbst wenn diese gleich sind. Unterläßt man es, kann dies unter Umständen zu Layout-Fehlern führen.
