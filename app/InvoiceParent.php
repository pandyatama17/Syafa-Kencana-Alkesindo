<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceParent extends Model {

	protected $table = 'invoice_parent';
	public $timestaps = false;

	protected $fillable =
	[
		'id',
		'invoice_date',
		'due_date',
		'delivery_date',
		'client_name',
		'client_address',
		'sales',
		'payment',
		'PIC'
	];

}
