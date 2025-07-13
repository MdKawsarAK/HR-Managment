<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PayrollInvoice extends Model
{
    use HasFactory;

    // protected $table = 'core_hr_payroll_invoices';

    protected $fillable = [
        'employee_id',
        'created_at',
        'bill_date',
        'bill_total',
        'status',
        'remarks',
    ];

    public $timestamps = false; // because you're manually setting created_at

    // Relationships
    public function employee()
    {
        return $this->belongsTo(Employee::class); // You must have an Employee model
    }

    public function details()
    {
        return $this->hasMany(PayrollInvoiceDetail::class, 'invoice_id');
    }
}
