<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;
use App\Traits\UUIDs;

class Article extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UUIDs;

    public function authors()
    {
        $authorsofarticle = Authorsofarticle::where('article_id', $this->id)
            ->select('author_id')
            ->get();
        $authors = Author::whereIn('id', $authorsofarticle)->get();
        
        return $authors;
    }
}