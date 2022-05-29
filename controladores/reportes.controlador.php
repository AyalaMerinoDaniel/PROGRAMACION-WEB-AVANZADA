<?php

class ControladorReportes
{

    /*=============================================
    DESCARGAR REPORTE EN EXCEL
    =============================================*/

    public function ctrDescargarReporte()
    {

        if (isset($_GET["reporte"])) {

            $tabla = $_GET["reporte"];

            $reporte = ModeloReportes::mdlDescargarReporte($tabla);

            /*=============================================
            CREAMOS EL ARCHIVO DE EXCEL
            =============================================*/

            $nombre = $_GET["reporte"] . '.xls';

            header('Expires: 0');
            header('Cache-control: private');
            header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
            header("Cache-Control: cache, must-revalidate");
            header('Content-Description: File Transfer');
            header('Last-Modified: ' . date('D, d M Y H:i:s'));
            header("Pragma: public");
            header('Content-Disposition:; filename="' . $nombre . '"');
            header("Content-Transfer-Encoding: binary");

            if ($_GET["reporte"] == "productos") {

                echo utf8_decode("

					<table border='0'>

						<tr>

							<td style='font-weight:bold; border:1px solid #eee;'>COD_PRODUCTO</td>
							<td style='font-weight:bold; border:1px solid #eee;'>TITULO</td>
							<td style='font-weight:bold; border:1px solid #eee;'>ESTADO</td>
							<td style='font-weight:bold; border:1px solid #eee;'>CATEGORIA</td>
							<td style='font-weight:bold; border:1px solid #eee;'>DETALLES</td>
							<td style='font-weight:bold; border:1px solid #eee;'>PRECIO</td>
							<td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>




						</tr>");

                foreach ($reporte as $key => $value) {

                    /*=============================================
                    TRAER PRODUCTO
                    =============================================*/

                    $item       = "id";
                    $valor      = $value["id_categoria"];
                    $categorias = ControladorCategorias::ctrMostrarCategorias($item, $valor);

                    echo utf8_decode("

					 	<tr>
							<td style='border:1px solid #eee;'>" . $value["id"] . "</td>
							<td style='border:1px solid #eee;'>" . $value["titulo"] . "</td>

					 ");

                    echo utf8_decode("<td style='border:1px solid #eee;'>" . $value["estado"] . "</td>
			 					  	 <td style='border:1px solid #eee;'>" . $categorias["categoria"] . "</td>
			 					  	 <td style='border:1px solid #eee;'>" . $value["detalle"] . "</td>
			 					  	  <td style='border:1px solid #eee;'>" . $value["precio"] . "</td>
			 					  	  <td style='border:1px solid #eee;'>" . $value["fecha"] . "</td>

			 					  	 </tr>");

                }

                echo utf8_decode("</table>

					");

            }

        }

    }

}
