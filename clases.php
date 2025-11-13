<?php
// clases.php

/**
 * Clase Evento: representa un evento con sus propiedades.
 */
class Evento {
    public $descripcion;
    public $tipo;
    public $lugar;
    public $fecha;
    public $hora;

    /**
     * Constructor para inicializar un nuevo objeto Evento.
     */
    public function __construct($descripcion, $tipo, $lugar, $fecha, $hora) {
        $this->descripcion = $descripcion;
        $this->tipo = $tipo;
        $this->lugar = $lugar;
        $this->fecha = $fecha;
        $this->hora = $hora;
    }

    /**
     * Método para obtener una representación en HTML de la información del evento.
     */
    public function obtenerInfo() {
        return "<p><strong>Descripción:</strong> {$this->descripcion}</p>
                <p><strong>Tipo:</strong> {$this->tipo}</p>
                <p><strong>Lugar:</strong> {$this->lugar}</p>
                <p><strong>Fecha:</strong> {$this->fecha}</p>
                <p><strong>Hora:</strong> {$this->hora}</p>";
    }
}

/**
 * Clase GestorEventos: maneja la colección de eventos y sus operaciones.
 */
class GestorEventos {
    private $eventos = [];

    /**
     * Agrega un nuevo evento a la colección.
     */
    public function agregarEvento(Evento $evento) {
        $this->eventos[] = $evento;
    }

    /**
     * Retorna todos los eventos.
     */
    public function obtenerEventos() {
        return $this->eventos;
    }

    /**
     * Filtra los eventos basándose en un array de criterios.
     */
    public function filtrarEventos($criterios) {
        $eventosFiltrados = [];
        foreach ($this->eventos as $evento) {
            $coincide = true;

            if (!empty($criterios['tipo']) && $evento->tipo !== $criterios['tipo']) {
                $coincide = false;
            }
            if (!empty($criterios['lugar']) && strpos(strtolower($evento->lugar), strtolower($criterios['lugar'])) === false) {
                $coincide = false;
            }
            if (!empty($criterios['fecha']) && $evento->fecha !== $criterios['fecha']) {
                $coincide = false;
            }

            if ($coincide) {
                $eventosFiltrados[] = $evento;
            }
        }
        return $eventosFiltrados;
    }
}

?>
