<?php
namespace FacturaScripts\Plugins\POS\Controller;

use FacturaScripts\Core\Lib\ExtendedController\EditController;

class EditTasasCambio extends EditController
{
    public function getModelClassName(): string
    {
        return "TasasCambio";
    }

    public function getPageData(): array
    {
        $data = parent::getPageData();
        $data["title"] = "TasasCambio";
        $data["icon"] = "fas fa-search";
        return $data;
    }
}
