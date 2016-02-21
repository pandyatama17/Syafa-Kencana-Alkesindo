<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Piutang extends Model {

	protected $table = 'piutang';
	public $timestaps = false;

	protected $fillable =
	[
		'invoice_parent_id',
		'date',
		'due_date',
		'total'
	];

}
