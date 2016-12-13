<?php
/**
 * AmChartsPHP
 * 
 * @link      http://github.com/neeckeloo/AmChartsPHP
 * @copyright Copyright (c) 2012 Nicolas Eeckeloo
 */
namespace AmCharts\Chart;

use AmCharts\Chart\DataProvider\DataProviderInterface;

class DataProvider implements DataProviderInterface
{    
    /**
     * @var array 
     */
    protected $data;
    
    /**
     * Constructor
     * 
     * @param array $data 
     */
    public function __construct($data)
    {
        $this->setFromArray($data);
    }

    /**
     * Sets data from array
     *
     * @param array $data
     * @return DataProvider
     */
    public function setFromArray(array $data)
    {
        $this->data = $data;
    }

    /**
     * Returns data
     *
     * @return array
     */
    public function toJson()
    {
        $json = json_encode(array_values($this->data));
        if (json_last_error()) {
            $error = '';
            switch (json_last_error()) {
                case JSON_ERROR_NONE:
                    $error = ' - Aucune erreur';
                break;
                case JSON_ERROR_DEPTH:
                    $error = ' - Profondeur maximale atteinte';
                break;
                case JSON_ERROR_STATE_MISMATCH:
                    $error = ' - Inadéquation des modes ou underflow';
                break;
                case JSON_ERROR_CTRL_CHAR:
                    $error = ' - Erreur lors du contrôle des caractères';
                break;
                case JSON_ERROR_SYNTAX:
                    $error = ' - Erreur de syntaxe ; JSON malformé';
                break;
                case JSON_ERROR_UTF8:
                    $error = ' - Caractères UTF-8 malformés, probablement une erreur d\'encodage';
                break;
                case JSON_ERROR_RECURSION:
                    $error = ' - Une ou plusieurs références récursives sont présentes dans la valeur à encoder';
                break;
                case JSON_ERROR_INF_OR_NAN:
                    $error = ' - Une ou plusieurs valeurs NAN ou INF sont présentes dans la valeurs à encoder.';
                break;
                case JSON_ERROR_UNSUPPORTED_TYPE:
                    $error = ' - Une valeur d\'un type qui ne peut être encodée a été fournie';
                break;
                default:
                    $error = ' - Erreur inconnue '.json_last_error();
                break;
            }
            throw new \Exception('Unable to convert dataProvider to Json ('.$error.') : '.serialize(array_values($this->data)));
        }
        return $json;
    }
}
