<?php

class ServicioExterno
{
    public static function obtenerTipoCambioPesosporDolar()
    {
        $ch = curl_init();
        $token = "a4aa890a4ea991db53c3745b29e2cb1470acc78e02493a91948862f3d84d2102";

        curl_setopt($ch, CURLOPT_URL, "https://www.banxico.org.mx/SieAPIRest/service/v1/series/SF63528/datos/oportuno?token=" . $token);
        curl_setopt($ch, CURLOPT_HTTPGET,true);
        curl_setopt($ch, CURLOPT_TIMEOUT,10);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        if(!$result = curl_exec($ch))
        {
            return null;
        }
        curl_close($ch);
        $json = json_decode($result);
        return $json->bmx->series[0]->datos[0]->dato;
    }
}