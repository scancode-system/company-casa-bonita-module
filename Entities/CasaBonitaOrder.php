<?php

namespace Modules\CompanyCasaBonita\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Order\Entities\Order;


class CasaBonitaOrder extends Model
{
	protected $fillable = ['order_id', 'status', 'message', 'codigo'];

	public function order()
	{
		return $this->belongsTo(Order::class);
	}
}


