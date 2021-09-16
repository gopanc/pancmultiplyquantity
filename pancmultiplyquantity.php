<?php
/**
* 2007-2021 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2021 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

if (!defined('_PS_VERSION_')) {
    exit;
}

class Pancmultiplyquantity extends Module
{
    protected $config_form = false;

    public function __construct()
    {
        $this->name = 'pancmultiplyquantity';
        $this->tab = 'checkout';
        $this->version = '1.0.0';
        $this->author = 'PANC';
        $this->need_instance = 0;

        /**
         * Set $this->bootstrap to true if your module is compliant with bootstrap (PrestaShop 1.6)
         */
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->l('Quantity Multiplication');
        $this->description = $this->l('Multiplicates product quantity');

        $this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
    }

    /**
     * Don't forget to create update methods if needed:
     * http://doc.prestashop.com/display/PS16/Enabling+the+Auto-Update
     */
    public function install()
    {
        return parent::install() &&
            $this->_installSql() &&
            $this->registerHook('header') &&
            $this->registerHook('displayAdminProductsQuantitiesStepBottom') &&
            $this->registerHook('displayFooterProduct');            
    }

    public function uninstall() {
        return parent::uninstall() && 
            $this->_unInstallSql();
    }

    protected function _installSql() {
        $sqlInstall = 'ALTER TABLE ' . _DB_PREFIX_ . 'product' . ' ADD panc_mpnumber INT';
 
        $returnSql = Db::getInstance()->execute($sqlInstall);
 
        return $returnSql;
    }
 
    /* Delete created fields from databasel */
    protected function _unInstallSql() {
        $sqlInstall = 'ALTER TABLE ' . _DB_PREFIX_ . 'product' . ' DROP panc_mpnumber';
 
        $returnSql = Db::getInstance()->execute($sqlInstall);
 
        return $returnSql;
    }

    /*  Add CSS & JavaScript to FO */
    public function hookHeader()
    {
        $this->context->controller->addJS($this->_path.'/views/js/front.js');
        $this->context->controller->addCSS($this->_path.'/views/css/front.css');
    }

    /* Backoffice field */
    public function hookDisplayAdminProductsQuantitiesStepBottom($params) 
    {
        $product = new Product($params['id_product']);
        $this->smarty->assign('panc_mpnumber', $product->panc_mpnumber);
        
        return $this->display(__FILE__, 'views/templates/admin/hooks/adminproductsquantitiesstepbottom.tpl');
    }

    /* Define JS variable in FO */
    public function hookDisplayFooterProduct($params)
    {
        $product = new Product(Tools::getValue('id_product'));
        $this->smarty->assign('panc_mpnumber', $product->panc_mpnumber);
        
        return $this->display(__FILE__, 'views/templates/front/hooks/displayfooterproduct.tpl');
    }
}
