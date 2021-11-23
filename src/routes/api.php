<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\{Post, Website, Subscription};
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function () {

    Route::prefix('websites')->group(function () {

        //Getting list of posts.
        Route::get('/{websiteId}/posts', function($websiteId){
            $websiteDetails = Website::find($websiteId);
            if(empty($websiteDetails)){
                return response()->json([
                    "error" => 'not_found',
                    "message" => "Website not found",
                ], 404);
            }

            return $websiteDetails->with('posts')->first();
        })->where('websiteId', '[0-9]+');

        //Creating post.
        Route::post('/{websiteId}/posts', function($websiteId){

            $validator =  Validator::make(request()->all(), [
                "title" => 'required|min:5|max:255'
                , "description" => 'required|min:5|max:2000'
            ]);

            if($validator->fails()){
                return response()->json([
                    "error" => 'validation_error',
                    "message" => $validator->errors(),
                ], 422);
            }

            return Post::create([
                "title" => request("title")
                , "website_id" => $websiteId
                , "description" => request("description")
            ]);
        })->where('websiteId', '[0-9]+');

        //Subscribe to a website.
        Route::post('/{websiteId}/subscribe', function($websiteId){

            $validatorMessages = [
                "email.unique" => 'Email is already subscribed to the website.'
            ];

            $validator =  Validator::make(request()->all(), [
                "email" => 'required|email|unique:subscriptions|min:5|max:255'
                , "name" => 'required|min:5|max:255'
            ], $validatorMessages);

            if($validator->fails()){
                return response()->json([
                    "error" => 'validation_error',
                    "message" => $validator->errors(),
                ], 422);
            }

            return Subscription::create([
                "email" => request("email")
                , "name" => request("name")
                , "website_id" => $websiteId
                , "subscription_status" => "subscribed"
            ]);
        })->where('websiteId', '[0-9]+');
        //Subscribe to a website.

        Route::get('/{websiteId}/subscribers', function($websiteId){
            return Website::find($websiteId)->with('subscriptions')->first();
        })->where('websiteId', '[0-9]+');//Get list of subscriptions for a website.

    });
    
});
