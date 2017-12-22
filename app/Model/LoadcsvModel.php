<?php
class LoadcsvModel extends AppModel{
    
    var $actsAs = array(
        'CsvImport' => array(
        	'delimiter'  => ',',
        )
    );
}