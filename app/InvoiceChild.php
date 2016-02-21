<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceChild extends Model {

	protected $table = 'invoice_child';
	public $timestaps = false;

	protected $fillable =
	[
		'parent_id',
		'item_id',
		'qty',
		'subtotal',
		'discount'
	];
}
