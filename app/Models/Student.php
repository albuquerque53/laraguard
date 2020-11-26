<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{ Factories\HasFactory, Model };
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use Illuminate\Notifications\Notifiable;

class Student extends Model implements Authenticatable
{
    use HasFactory, AuthenticableTrait, Notifiable;
}
