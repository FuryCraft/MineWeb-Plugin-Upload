<?php
/**
 * Fury_Craft : Développeur (https://dev.fury-craft.tk), YouTubeur (https://www.youtube.com/c/furycraft/) et administrateur de Fury Land (https://www.furyland.ga/)
 * @author        Fury_Craft - https://dev.fury-craft.tk
 * @copyright     Fury_Craft - All rights reserved
 * @link          http://mineweb.org/market
 * @since         ERROR
 */

class UploadsAppSchema extends CakeSchema {

	public function before($event = []) {
		return true;
	}

	public function after($event = []) {}

	public $uploads__list = [
		'id' => [
			'type' => 'integer',
			'null' => false,
			'default' => null,
			'length' => 11,
			'unsigned' => false,
			'autoIncrement' => true,
			'key' => 'primary'],
			
		'author' => [
			'type' => 'string',
			'null' => false,
			'default' => null,
			'length' => 50],

		'description' => [
			'type' => 'text',
			'null' => false,
			'default' => null,
			'length' => 255],
		
		'level' => [
			'type' => 'integer', 
			'null' => false, 
			'default' => '0', 
			'unsigned' => false],

		'created' => [
			'type' => 'datetime',
			'null' => false,
			'default' => null],

		'tableParameters' => [
			'charset' => 'utf8', 
			'collate' => 'utf8_general_ci', 
			'engine' => 'InnoDB']
	];
}