<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;
use App\Traits\UUIDs;

class Clientreport extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UUIDs;

    public function authors()
    {
        $authorsofclientreport = Authorsofclientreport::where('clientreport_id', $this->id)
            ->select('author_id')
            ->get();
        $authors = Author::whereIn('id', $authorsofclientreport)->get();
        
        return $authors;
    }
}