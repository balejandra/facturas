<?php
/**
 * This file is part of POS plugin for FacturaScripts
 * Copyright (C) 2019 Juan José Prieto Dzul <juanjoseprieto88@gmail.com>
 */

namespace FacturaScripts\Plugins\POS\Model;

use FacturaScripts\Core\Model\Base;
use FacturaScripts\Dinamic\Model\FormaPago;

/**
 * Operaciones realizadas terminales POS.
 *
 * @author Juan José Prieto Dzul <juanjoseprieto88@gmail.com>
 */
class PagoPuntoVenta extends Base\ModelClass
{
    use Base\ModelTrait;

    public $codpago;
    public $idoperacion;
    public $idpago;
    public $idsesion;
    public $cantidad;
    public $cambio;
    public $referencia;

    public function clear()
    {
        parent::clear();
        $this->cantidad = 0;
        $this->cambio = 0;
    }

    public function install()
    {
        new SesionPuntoVenta();
        new OrdenPuntoVenta();
        new MovimientoPuntoVenta();

        return parent::install();
    }

    public static function primaryColumn(): string
    {
        return 'idpago';
    }

    public static function tableName(): string
    {
        return 'pagospos';
    }

    public function pagoNeto()
    {
        return $this->cantidad - $this->cambio;
    }

    public function descripcion(): string
    {
        return (new FormaPago())->get($this->codpago)->descripcion;
    }

    public function test()
    {
        $sesionPOS = new OrdenPuntoVenta();

        if ($sesionPOS->loadFromCode($this->idoperacion) && empty($this->idsesion)) {
            $this->idsesion = $sesionPOS->idsesion;
        }

        return parent::test(); // TODO: Change the autogenerated stub
    }
}
