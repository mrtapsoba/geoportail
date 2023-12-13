<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Shapefile\ShapefileAutoloader;

// Register autoloader
require_once(base_path('') . '/shapefile/ShapefileAutoloader.php');
ShapefileAutoloader::register();

// Import classes
use Shapefile\Shapefile;
use Shapefile\ShapefileException;
use Shapefile\ShapefileReader;

class ShpController extends Controller
{
    //
    public $shapeName;
    public $filterFields = [];
    public $filterData = [];

    function __construct($sN, $fD, $fF)
    {
        $this->shapeName = $sN;
        $this->filterData = $fD;
        $this->filterFields = $fF;
    }

    public function parseMyString($myString)
    {
        $arrayFromString = str_split($myString);
        $finalString = "";
        $tabNumber = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

        //var_dump($myString);
        //var_dump($arrayFromString);
        while (in_array($arrayFromString[0], $tabNumber)) array_shift($arrayFromString);
        //var_dump($arrayFromString);
        $tail = count($arrayFromString);
        while ($tail > 0) {
            $finalString .= array_shift($arrayFromString);
            $tail = count($arrayFromString);
        }
        return $finalString;
    }

    public function getShpFields()
    {
        try {
            $Shapefile = new ShapefileReader(
                public_path('files/shapefiles') . "/" . $this->shapeName . "/" . $this->parseMyString($this->shapeName) . ".shp"
            );
            $field = $Shapefile->getFields();
            $fields = [];
            foreach ($field as $key => $value) {
                $fields[] = $key;
            }
            return $fields;
        } catch (ShapefileException $e) {
            return [];
        }
    }

    public function getFieldData()
    {
        try {
            $Shapefile = new ShapefileReader(public_path('files/shapefiles') . "/" . $this->shapeName . "/" . $this->parseMyString($this->shapeName) . ".shp");


            $dataFund = [];
            $props = [];

            $fields = [];
            $finalFields = [];

            $fields = $this->getShpFields($Shapefile);

            foreach ($this->filterFields as $myField) {

                if (in_array($myField, $fields)) {
                    $finalFields[] = $myField;
                }
            }
            //var_dump($this->filterFields);
            //var_dump($finalFields);
            while ($Geometry = $Shapefile->fetchRecord()) {
                //Skip the record if marked as "deleted"
                if ($Geometry->isDeleted()) {
                    continue;
                }

                $data = $Geometry->getDataArray();

                foreach ($finalFields as $myField) {
                    $props[$myField] = $data[$myField];
                    //var_dump($props);
                }
                if (!empty($props)) array_push($dataFund, $props);
            }
            return $dataFund;
        } catch (ShapefileException $e) {
            return [];
        }
    }

    public function getFieldDataWithGeoJSON()
    {
        //echo "files/unzip/".$this->shapeName."/".$this->shapeName.".shp<br>";
        try {
            //echo "files/unzip/".$this->shapeName."/".$this->shapeName.".shp<br>";
            $Shapefile = new ShapefileReader(public_path('files/shapefiles') . "/" . $this->shapeName . "/" . $this->parseMyString($this->shapeName) . ".shp");


            $features = [];
            $props = [];

            $fields = [];
            $finalFields = [];

            $fields[] = $this->getShpFields($Shapefile);

            foreach ($this->filterFields as $myField) {
                if (in_array($myField, $fields)) {
                    $finalFields[] = $myField;
                }
            }

            //var_dump($finalFields);

            while ($Geometry = $Shapefile->fetchRecord()) {
                //Skip the record if marked as "deleted"
                if ($Geometry->isDeleted()) {
                    continue;
                }

                $data = $Geometry->getDataArray();

                //get geometry as GeoJSON
                $geometry = $array = json_decode($Geometry->getGeoJSON(), true);

                foreach ($finalFields as $myField) {
                    $props[$myField] = $data[$myField];
                }
                $feature = [];
                $feature = [
                    "type" => "Feature",
                    "geometry" => $geometry,
                    "properties" => $props
                ];
                if (!empty($props)) array_push($features, $feature);
            }
            $featureCollection = [
                "type" => "FeatureCollection",
                "features" => $features
            ];
            return $featureCollection;
        } catch (ShapefileException $e) {
            return [];
        }
    }

    public function getAllData()
    {
        try {
            $Shapefile = new ShapefileReader(public_path('files/shapefiles') . "/" . $this->shapeName . "/" . $this->parseMyString($this->shapeName) . ".shp");


            //print dbf field
            $field = $Shapefile->getFields();

            $fields = [];
            $features = [];
            $props = [];
            $search = 'a';

            //var_dump($field);
            foreach ($field as $key => $value) {
                $fields[] = $key;
            }
            while ($Geometry = $Shapefile->fetchRecord()) {
                //Skip the record if marked as "deleted"
                if ($Geometry->isDeleted()) {
                    continue;
                }

                $data = $Geometry->getDataArray();

                //get geometry as GeoJSON
                $geometry = $array = json_decode($Geometry->getGeoJSON(), true);

                foreach ($fields as $myField) {
                    $props[$myField] = $data[$myField];
                }
                $feature = [];
                $feature = [
                    "type" => "Feature",
                    "geometry" => $geometry,
                    "properties" => $props
                ];
                array_push($features, $feature);
            }
            $featureCollection = [
                "type" => "FeatureCollection",
                "features" => $features
            ];
            return $featureCollection;
        } catch (ShapefileException $e) {
            return [];
        }
    }

    public function search()
    {
        try {
            $Shapefile = new ShapefileReader(public_path('files/shapefiles') . "/" . $this->shapeName . "/" . $this->parseMyString($this->shapeName) . ".shp");


            //print dbf field
            $allFields = $Shapefile->getFields();

            $fields = [];
            $features = [];
            $props = [];
            $finalFields = [];
            $search = 'a';

            //var_dump($field);
            foreach ($allFields as $key => $value) {
                $fields[] = $key;
            }
            foreach ($this->filterFields as $myField) {
                if (in_array($myField, $fields)) {
                    $finalFields[] = $myField;
                }
            }
            //var_dump($finalFields);
            while ($Geometry = $Shapefile->fetchRecord()) {
                //Skip the record if marked as "deleted"
                if ($Geometry->isDeleted()) {
                    continue;
                }

                $data = $Geometry->getDataArray();

                //get geometry as GeoJSON
                $geometry = $array = json_decode($Geometry->getGeoJSON(), true);

                //var_dump($geometry);

                $test = false;

                if (empty($this->filterFields)) {
                    foreach ($fields as $myField) {
                        $props[$myField] = $data[$myField];
                        //echo $data[$myField]."<br>";
                        foreach ($this->filterData as $search) {
                            if (stripos($data[$myField], $search) !== false) {
                                //var_dump($search);
                                //var_dump($data[$myField]);
                                $test = true;
                                //echo "true";
                            }
                        }
                    }
                } else {
                    //echo "search: ";
                    //var_dump($this->filterData);
                    foreach ($finalFields as $myField) {
                        $props[$myField] = $data[$myField];
                        //echo $data[$myField]."<br>";
                        foreach ($this->filterData as $search) {
                            if (stripos($data[$myField], $search) !== false) {
                                $test = true;
                                //echo "true<br><br><br><br>";
                            }
                        }
                    }
                }
                $feature = [];
                if ($test) {
                    //var_dump($props);
                    $feature = [
                        "type" => "Feature",
                        "geometry" => $geometry,
                        "properties" => $props
                    ];
                    array_push($features, $feature);
                }
            }
            $featureCollection = [
                "type" => "FeatureCollection",
                "features" => $features
            ];
            return $featureCollection;
        } catch (ShapefileException $e) {
            var_dump("exception");
            return [];
        }
    }
}
