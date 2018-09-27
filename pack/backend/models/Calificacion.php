<?php

class Calificacion{

    //object info
    public $id_calificacion;
    public $id_reporte;
    public $servicio;
    public $puntualidad;
    public $observaciones;
    

    function __constructor(){}

    

    /**
     * Get the value of id_calificacion
     */ 
    public function getId_calificacion()
    {
        return $this->id_calificacion;
    }

    /**
     * Set the value of id_calificacion
     *
     * @return  self
     */ 
    public function setId_calificacion($id_calificacion)
    {
        $this->id_calificacion = $id_calificacion;

        return $this;
    }

    /**
     * Get the value of id_reporte
     */ 
    public function getId_reporte()
    {
        return $this->id_reporte;
    }

    /**
     * Set the value of id_reporte
     *
     * @return  self
     */ 
    public function setId_reporte($id_reporte)
    {
        $this->id_reporte = $id_reporte;

        return $this;
    }

    /**
     * Get the value of servicio
     */ 
    public function getServicio()
    {
        return $this->servicio;
    }

    /**
     * Set the value of servicio
     *
     * @return  self
     */ 
    public function setServicio($servicio)
    {
        $this->servicio = $servicio;

        return $this;
    }

    /**
     * Get the value of puntualidad
     */ 
    public function getPuntualidad()
    {
        return $this->puntualidad;
    }

    /**
     * Set the value of puntualidad
     *
     * @return  self
     */ 
    public function setPuntualidad($puntualidad)
    {
        $this->puntualidad = $puntualidad;

        return $this;
    }

    /**
     * Get the value of observaciones
     */ 
    public function getObservaciones()
    {
        return $this->observaciones;
    }

    /**
     * Set the value of observaciones
     *
     * @return  self
     */ 
    public function setObservaciones($observaciones)
    {
        $this->observaciones = $observaciones;

        return $this;
    }
}

?>