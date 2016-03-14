<?php

class UtlLocation {

    static function getAllLocations() {
        return array(
            "Artigas", "Canelones", "Cerro Largo", "Colonia", "Durazno", "Flores", "Florida",
            "Lavalleja", "Maldonado", "Montevideo", "Paysandú", "Río Negro", "Rivera",
            "Rocha", "Salto", "San José", "Soriano", "Tacuarembó", "Treinta y Tres"
        );
    }

    static function getLocationById($id) {
        $locations = self::getAllLocations();
        return $locations[$id];
    }

}
