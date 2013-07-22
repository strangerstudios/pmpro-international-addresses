<?php
/*
Plugin Name: PMPro International Adresses
Plugin URI: http://www.paidmembershipspro.com/wp/pmpro-international-addresses/
Description: Add long form addresses to the PMPro checkout.
Version: .2.2
Author: Stranger Studios
Author URI: http://www.strangerstudios.com
 
/*
	First we need to enable international addresses. We just use the pmpro_international_addresses hook and return true.
	This will add a "countries" dropdown to the checkout page.
*/
function pmproia_pmpro_international_addresses()
{
	return true;
}
add_filter("pmpro_international_addresses", "pmproia_pmpro_international_addresses");

/*
	Change some of the billing fields to be not required to support international addresses that don't have a state, etc.
	Default fields are: bfirstname, blastname, baddress1, bcity, bstate, bzipcode, bphone, bemail, bcountry, CardType, AccountNumber, ExpirationMonth, ExpirationYear, CVV
*/
function pmproia_pmpro_required_billing_fields($fields)
{
	//remove state and zip
	unset($fields['bstate']);
	unset($fields['bzipcode']);
	
	return $fields;
}
add_filter("pmpro_required_billing_fields", "pmproia_pmpro_required_billing_fields");

/*
	Make the city, state, and zip/postal code fields show up on their own lines.
*/
function pmproia_pmpro_longform_address()
{
	return true;
}
add_filter("pmpro_longform_address", "pmproia_pmpro_longform_address");

/*
	(optional) Now we want to change the default country from US to say the United Kingdom (GB)
	Use the 2-letter acronym.
*/
function pmproia_pmpro_default_country($default)
{	
	return "GB";
}
//add_filter("pmpro_default_country", "pmproia_pmpro_default_country");

/*
	(optional) You may want to add/remove certain countries from the list. The pmpro_countries filter allows you to do this.
	The array is formatted like array("US"=>"United States", "GB"=>"United Kingdom"); with the acronym as the key and the full
	country name as the value.
*/
function pmproia_pmpro_countries($countries)
{
	//remove the US
	unset($countries["US"]);
	
	//add The Moon (LN short for Lunar?)
	$countries["LN"] = "The Moon";
	
	//You could also rebuild the array from scratch.
	//$countries = array("CA" => "Canada", "US" => "United States", "GB" => "United Kingdom");
	
	return $countries;
}
//add_filter("pmpro_countries", "pmproia_pmpro_countries");