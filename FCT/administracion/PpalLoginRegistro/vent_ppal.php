<?php
	session_name("fct");
	session_start();
	require_once("../../funciones/config.php");
	cabecera(1);
?>

<aside class="enlaces">
	<div>
		<ul>
    <li>
        <h3>Noticias</h3>
        <ul>
            <li><a href="https://www.boe.es/biblioteca_juridica/codigos/codigo.php?id=363&modo=1&nota=0&tab=2">BOE</a></li>
            <li><a href="https://www.comunidad.madrid/servicios/educacion">Comunidad de Madrid</a></li>
            <li><a href="https://www.comunidad.madrid/servicios/educacion/formacion-profesional">FP Comunidad de Madrid</a></li>
       </ul>
    </li>
    <li>
        <h3>Teide</h3>
        <ul>
            <li><a href="https://campus.teideformacion.com/">Campus Virtual</a></li>
            <li><a href="https://www.teideformacion.com/nuestros-centros/teide-quintana">Página Principal Teide</a></li>
            <li><a href="https://elblogdeteidehease.com/">Blog Teide</a></li>
        </ul>
    </li>
    <li>
        <h3>Becas</h3>
        <ul>
            <li><a href="https://www.comunidad.madrid/servicios/educacion/becas-ayudas-premios-actividades-culturales-artisticas">Becas Comunidad de Madrid</a></li>
            <li><a href="http://www.educacionyfp.gob.es/servicios-al-ciudadano/catalogo/estudiantes/becas-ayudas.html">Becas Ministerio</a></li>
            <li><a href="https://www.educacionyfp.gob.es/educacion/mc/becas-generales/2019-2020/inicio.html">Información acerca de las Becas</a></li>
        </ul>
    </li>
</ul>
	</div>	
</aside>

<aside class="img_ppal">
	<img src="../../img/principal.png" usemap="#mapa_zonas">
    <map name="mapa_zonas">
        <area shape="rect" coords="0,0,719,243" href="https://www.teideformacion.com/oferta-formativa/grado-superior" />
        <area shape="rect" coords="0,243,720,477" href="https://www.teideformacion.com/oferta-formativa/grado-medio" />
        <area shape="rect" coords="0,479,719,720" href="https://www.teideformacion.com/oferta-formativa/fp-basica" />
    </map>
</aside>




<?php
	pie(1);
?>