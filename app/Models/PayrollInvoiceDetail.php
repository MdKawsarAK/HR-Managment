<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PayrollInvoiceDetail extends Model
{
    use HasFactory;

    // protected $table = 'core_hr_payroll_invoices_details';

    protected $fillable = [
        'invoice_id',
        'item_id',
        'amount',
    ];

    public $timestamps = false;

    // Relationships
    public function invoice()
    {
        return $this->belongsTo(PayrollInvoice::class, 'invoice_id');
    }

    public function payroll_item()
{
    return $this->belongsTo(PayrollItem::class, 'item_id');
}

}
