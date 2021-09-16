<?php

class Product extends ProductCore {    
    public $panc_mpnumber;

    public function __construct($id_product = null, $full = false, $id_lang = null, $id_shop = null, \Context $context = null) {
        //Définition des nouveaux champs
        self::$definition['fields']['panc_mpnumber'] = [
            'type' => self::TYPE_STRING,
            'required' => false,
            'size' => 12
        ];
        parent::__construct($id_product, $full, $id_lang, $id_shop, $context);
    }
    
}