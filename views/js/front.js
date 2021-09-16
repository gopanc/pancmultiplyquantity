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
*
* Don't forget to prefix your containers with your own identifier
* to avoid any conflicts with others containers.
*/

$( document ).ready(function() {
    $( "#quantity_wanted" ).change(function() {
        if ($(this).val() > 0) {
            $(this).val(Math.ceil($(this).val() / panc_mpnumber) * panc_mpnumber)
        } else if ($(this).val() < 0) {
            $(this).val(Math.floor($(this).val() / panc_mpnumber) * panc_mpnumber)
        } else {
            $(this).val(panc_mpnumber)
        }
    });

    $( ".bootstrap-touchspin-down" ).change(function() {
        if ($("#quantity_wanted").val() != panc_mpnumber) {
            var pc_quantinput = parseInt($("#quantity_wanted").val());
            $("#quantity_wanted").val(pc_quantinput - panc_mpnumber)
        }
    });    


    // Product page multiply quantity
	// var panc_mpnumber = {$product->multiplication}; <-- Called in file product-add-to-cart.tpl
	var pc_quantinput = parseInt($("#quantity_wanted").val());

    $("#quantity_wanted").change(function() {            
	  	if($(this).val() > 0){
			$(this).val(Math.ceil($(this).val()/panc_mpnumber) * panc_mpnumber);
		} else if( $(this).val() < 0) {
			$(this).val(Math.floor($(this).val()/panc_mpnumber) * panc_mpnumber);
		} else {
			$(this).val(panc_mpnumber);
		}
	});

	$(".bootstrap-touchspin-down").click(function() {
		if($("#quantity_wanted").val() != panc_mpnumber){
			var pc_quantinput = parseInt($("#quantity_wanted").val());
			$("#quantity_wanted").val(pc_quantinput-panc_mpnumber);
		}		
	});
});