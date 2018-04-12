<?php

namespace App\Http\Controllers\API\V1;

use App\MovieModel;
use App\ProgrammingModel\ScheduledMovie;
use App\Response\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MoviesController extends Controller
{
    public function getNowShowingMovies()
    {
        $movieIds = ScheduledMovie::whereDate('show_date', '>=', date('Y-m-d'))->distinct()->pluck('movie_id');
        if($movieIds->count() > 0)
        {
            $returnMovies = [];
            foreach ($movieIds as $movieId)
            {
                $movieDetail = MovieModel::findOrFail($movieId);
                $arr['movie_id'] = $movieDetail->id;
                $arr['movie_name'] = $movieDetail->movie_title;
                $arr['movie_thumb'] = asset('movies/posterimage/'.$movieDetail->image);
                $arr['movie_rating'] = $movieDetail->rating;
                $arr['movie_runtime'] = $movieDetail->duration.' minutes';
                $arr['movie_genre'] = $movieDetail->genre;
                $returnMovies[] = $arr;
            }

            $returnData['status'] = 200;
            $returnData['error'] = false;
            $returnData['message'] = 'List of now showing movies';
            $returnData['data'] = $returnMovies;

            return ApiResponse::sendResponse($returnData['status'], $returnData['error'], $returnData['message'], $returnData['data']);
        }

        $returnData['status'] = 200;
        $returnData['error'] = false;
        $returnData['message'] = 'No movies found';
        $returnData['data'] = [];

        return ApiResponse::sendResponse($returnData['status'], $returnData['error'], $returnData['message'], $returnData['data']);
    }
}
