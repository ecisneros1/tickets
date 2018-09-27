<?php

class Reporte{

    //object info
    public $id_reporte;
    public $id_ticket;
    public $cliente;
    public $contacto;

    
    public $solicitadopor;
    public $partesdescripcion;
    public $tareas;
    public $tipo;
    public $horallegada;
    public $horasalida;
    public $tiempotraslado;
    public $fecha;
    public $servicio;
    public $puntualidad;
    public $observaciones;
    public $confirmacion;

    function __constructor(){}

    

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
     * Get the value of id_ticket
     */ 
    public function getId_ticket()
    {
        return $this->id_ticket;
    }

    /**
     * Set the value of id_ticket
     *
     * @return  self
     */ 
    public function setId_ticket($id_ticket)
    {
        $this->id_ticket = $id_ticket;

        return $this;
    }

    /**
     * Get the value of id_cliente
     */ 
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set the value of id_cliente
     *
     * @return  self
     */ 
    public function setCliente($cliente)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get the value of contacto
     */ 
    public function getContacto()
    {
        return $this->contacto;
    }

    /**
     * Set the value of contacto
     *
     * @return  self
     */ 
    public function setContacto($contacto)
    {
        $this->contacto = $contacto;

        return $this;
    }

    /**
     * Get the value of solicitadopor
     */ 
    public function getSolicitadopor()
    {
        return $this->solicitadopor;
    }

    /**
     * Set the value of solicitadopor
     *
     * @return  self
     */ 
    public function setSolicitadopor($solicitadopor)
    {
        $this->solicitadopor = $solicitadopor;

        return $this;
    }

    /**
     * Get the value of partesdescripcion
     */ 
    public function getPartesdescripcion()
    {
        return $this->partesdescripcion;
    }

    /**
     * Set the value of partesdescripcion
     *
     * @return  self
     */ 
    public function setPartesdescripcion($partesdescripcion)
    {
        $this->partesdescripcion = $partesdescripcion;

        return $this;
    }

    /**
     * Get the value of tareas
     */ 
    public function getTareas()
    {
        return $this->tareas;
    }

    /**
     * Set the value of tareas
     *
     * @return  self
     */ 
    public function setTareas($tareas)
    {
        $this->tareas = $tareas;

        return $this;
    }

    /**
     * Get the value of tipo
     */ 
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set the value of tipo
     *
     * @return  self
     */ 
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get the value of horallegada
     */ 
    public function getHorallegada()
    {
        return $this->horallegada;
    }

    /**
     * Set the value of horallegada
     *
     * @return  self
     */ 
    public function setHorallegada($horallegada)
    {
        $this->horallegada = $horallegada;

        return $this;
    }

    /**
     * Get the value of horasalida
     */ 
    public function getHorasalida()
    {
        return $this->horasalida;
    }

    /**
     * Set the value of horasalida
     *
     * @return  self
     */ 
    public function setHorasalida($horasalida)
    {
        $this->horasalida = $horasalida;

        return $this;
    }

    /**
     * Get the value of tiempotraslado
     */ 
    public function getTiempotraslado()
    {
        return $this->tiempotraslado;
    }

    /**
     * Set the value of tiempotraslado
     *
     * @return  self
     */ 
    public function setTiempotraslado($tiempotraslado)
    {
        $this->tiempotraslado = $tiempotraslado;

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

    /**
     * Get the value of confirmacion
     */ 
    public function getConfirmacion()
    {
        return $this->confirmacion;
    }

    /**
     * Set the value of confirmacion
     *
     * @return  self
     */ 
    public function setConfirmacion($confirmacion)
    {
        $this->confirmacion = $confirmacion;

        return $this;
    }

    /**
     * Get the value of fecha
     */ 
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * Set the value of fecha
     *
     * @return  self
     */ 
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }
}

?>