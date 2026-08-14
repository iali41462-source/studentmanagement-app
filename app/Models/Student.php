<?php

namespace App\Models;
use App\Models\Enrollment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
use Notifiable;
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $fillable = ['name','email', 'address', 'mobile','photo'];
    use HasFactory, SoftDeletes;
     public function routeNotificationForMail()
    {
        return $this->email;
    }

    public function enrollments()
{
    return $this->hasMany(Enrollment::class);
}

}

