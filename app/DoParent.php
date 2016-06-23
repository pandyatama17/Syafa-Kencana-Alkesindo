<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class DoParent extends Model {

	protected $table = 'do_parents';
	// public $timestamps = false;

	protected $fillable = [
		'id',
		'do_date',
		'due_date',
		'delivery_date',
		'client_name',
		'client_address',
		'sales',
		'payment',
		'total',
		'PIC'
	];

}
