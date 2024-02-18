<?php

include_once 'ConsultasPermisos.php';

class ServicioPermisos
{
    public function obtenerPermisos()
    {
        return ConsultasPermisos::obtenerPermisos();
    }
}