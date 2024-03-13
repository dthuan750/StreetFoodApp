<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $appends = ['totalPrice'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'customer_id',
        'token',
        'status',
    ];

    public function customer(){
        return $this->hasOne(Customer::class, 'id','customer_id');
    }

    public function details(){
        return $this->hasMany(OrderDetail::class, 'order_id','id');
    }

    public function getTotalPriceAttribute(){
        $t = 0;

        foreach($this->details as $detail){
            $t += $detail->price * $detail->quantity; 
        }

        return $t;
    }

}
