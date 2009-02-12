<?php

Markup('openlayers',
       'directives',
       '/\\(:openlayers(\\s+.*?)?:\\)/ei',
       "openlayers('$1')");

function openlayers($args){
    global $HTMLHeaderFmt, $HTMLFooterFmt;
    $params=ParseArgs($args); 
    $slippymap_default = array('width'=> 500,
                               'height'=> 400,
                               'lat'=>'49.4312',
                               'lon'=>'-2.364',
                               'zoom'=>14);
    $width = $params['width'] ? $params['width'] : $slippymap_default['width'];
    $height = $params['height'] ? $params['height'] : $slippymap_default['height'];
    $lat = $params['lat'] ? $params['lat'] : $slippymap_default['lat'];
    $lon = $params['lon'] ? $params['lon'] : $slippymap_default['lon'];
    $zoom = $params['zoom'] ? $params['zoom'] : $slippymap_default['zoom'];
    $HTMLHeaderFmt['slippymap'] = "\r\n".
                                  '<script src="http://localhost/pmwiki-2.2.0-beta65/pub/js/OpenLayers/OpenLayers.js"></script>'."\r\n".
                                  '<script src="http://www.openstreetmap.org/openlayers/OpenStreetMap.js"></script>'."\r\n".
                                  '<script type="text/javascript">'."\r\n".
                                  '     var lat = '.$lat.";\r\n".
                                  '     var lon = '.$lon.";\r\n".
                                  '     var zoom = '.$zoom.";\r\n".
                                  '     var map; //complex object of type OpenLayers.Map'."\r\n".
                                  '     //"map" Objekt initialisieren'."\r\n".
                                  '     function slippymap_init() {'."\r\n".
                                  '         map = new OpenLayers.Map ("map", {'."\r\n".
                                  '             controls:['."\r\n".
                                  '                 new OpenLayers.Control.Navigation(),'."\r\n".
                                  '                 new OpenLayers.Control.PanZoomBar(),'."\r\n".
                                  '                 new OpenLayers.Control.Attribution()],'."\r\n".
                                  '             maxExtent: new OpenLayers.Bounds(-20037508.34,-20037508.34,20037508.34,20037508.34),'."\r\n".
                                  '             maxResolution: 156543.0399,'."\r\n".
                                  '             numZoomLevels: 19,'."\r\n".
                                  '             units: \'m\','."\r\n".
                                  '             projection: new OpenLayers.Projection("EPSG:900913"),'."\r\n".
                                  '             displayProjection: new OpenLayers.Projection("EPSG:4326")'."\r\n".
                                  '         } );'."\r\n".
                                  '         // weitere Basiskarten: OpenLayers.Layer.OSM.Mapnik, OpenLayers.Layer.OSM.Maplint und OpenLayers.Layer.OSM.CycleMap'."\r\n".
                                  '         layerTilesAtHome = new OpenLayers.Layer.OSM.Osmarender("Osmarender");'."\r\n".
                                  '         map.addLayer(layerTilesAtHome);'."\r\n".
                                  '         var lonLat = new OpenLayers.LonLat(lon, lat).transform(new OpenLayers.Projection("EPSG:4326"), map.getProjectionObject());'."\r\n".
                                  '         map.setCenter (lonLat, zoom);'."\r\n".
                                  '     }'."\r\n".
                                  '</script>'."\r\n".
                                  "\r\n";
    $HTMLFooterFmt = '<script type="text/javascript">'."\n\t".'slippymap_init();'."\n".'</script>';
    return '<div style="width: '.$width.'px; height:'.$height.'px; border-style:solid; border-width:1px; border-color:lightgrey;" id="map">'."\n\t".
           '<noscript>'."\n\t\t".
           'Die Nutzung der Karte setzt die Aktivierung von JavaScript voraus.'."\n\t".
           '</noscript>'."\n".
           '</div>';
}
