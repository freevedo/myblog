<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\Http;

class Post extends Model
{
    use HasFactory;

    /**
     * A post(article) belongs to exact one user
     */
    public function autor()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * the content(text) of the article should be hidden
     */
     protected $hidden = ['content'];


     /**
      * post a Http request with guzzle. 
      */
     public function postGuzzleRequest()
     {
         
         $url = "https://sentim-api.herokuapp.com/api/v1/";

         $myBody = [
             'text' => $this->content
         ];

         $request = Http::withHeaders([
             'Accept' => 'application/json',
             'Content-Type' => 'application/json'
         ])->post($url,$myBody);
         
        $statusCode = $request->status();
        $responseBody = json_decode($request->getBody(), true);
         
         dd($responseBody);
         
     }
}
