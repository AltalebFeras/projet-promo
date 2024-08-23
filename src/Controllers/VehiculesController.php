<?php

namespace src\Controllers;

use Exception;
use src\Repositories\VehiculesRepository;

class VehiculesController{

    public function getAllVehicules()
    {
        $vehiculesRepository = new VehiculesRepository();
        $vehicles = $vehiculesRepository->getAllVehicules();
        var_dump($vehicles);
        die();
    }

}
