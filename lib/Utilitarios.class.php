<?php

/**
 * Clase de capa intermedia para cosas utiles
 *
 * @author Dario Chuquilla
 */
class Utilitarios {

    /**
     * Retorna un tipo de Discipulo solicitado
     * @param Integer $tipo Tipo Solicitado
     * @return String Nombre del tipo 
     */
    public static function getTipoDiscipulo($tipo) {
        $tipos = DiscipuloTable::getTipos();
        return $tipos[$tipo];
    }

    /**
     * Reduce tamaño de la imagen
     * @param type $nombre_foto 
     */
    public static function cambiarFoto($nombre_foto) {
        $foto = new sfThumbnail(180, 180);
        $foto->loadFile(sfConfig::get('sf_upload_dir') . '/discipulos/' . $nombre_foto);
        $foto->save(sfConfig::get('sf_upload_dir') . '/discipulos/' . $nombre_foto);
    }

    /**
     * Genera una rando de dos digitos para armar las horas
     * @param Integer $desde El número desde donde debe iniciar
     * @param Integer $hasta El número a donde debe llegar
     * @param Integer $saltos La separación que debe tener
     * @return array El rago de números generado
     */
    public static function generarRangoHorario($desde, $hasta, $saltos = 1) {
        $resultados = array();
        for ($i = $desde; $i <= $hasta; $i = $i + $saltos) {
            $resultados[$i] = sprintf('%02d', $i);
        }
        return $resultados;
    }

    public static function enviarMail($destinatario, $titulo, $mensaje) {
        $mailer = new sfMailer();
        if($mailer->composeAndSend($from, $destinatario, $titulo, $mensaje) > 0) {
            return 'ok';
        } else {
            return 'No se pudo enviar el correo a ' . $destinatario;
        }
    }

}

?>
