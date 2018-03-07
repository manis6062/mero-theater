<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\MovieModel;

class MovieController extends Controller
{	
	protected $movie;

	public function __construct()
	{
		$this->movie = new  MovieModel();
	}

	public function movieslist()
	{
		return view('admin.movies.movielist');
	}

	public function createmovie()
	{
	 	return view('admin.movies.createmovies');
	}

	public function submit(Request $request)
	{
		$this->validate($request, [
            'movieTitle' => 'required',
            'movieShortName' => 'required',
            'genre' => 'required',
            'distributor' => 'required',
            'openingdate' => 'required|date',
            'duration' => 'required|numeric|max:4',
            'displaysequence' => 'required|numeric',
            'filmformat' =>'required',
            'image' => 'nullable|image|dimensions:width=420,height=200|max:2097152',
            'banner' => 'nullable|image|dimensions:width=1280,height=490|max:2097152',
            // 'video' => 'sometimes|required|mimetypes:video/ogg,video/mp4,video/webm|max:2097152',
            'trailerurl' => 'nullable|url',
        ]);
		// dd($request->movieTitle);

		$data = array(
            'movie_title' => $request->movieTitle,
            'movie_short_name'=>$request->movieShortName,
            'synopsis'=>$request->synopsis,
            'genre'=>$request->genre,
            'distributor'=>$request->distributor,
            'openingdate'=>$request->openingdate,
            'content'=>$request->content,
            'duration'=>$request->duration,
            'isrestricted'=>$request->isrestricted,
            'displaysequence'=>$request->displaysequence,
            'filmformat'=>$request->filmformat,
            'trailerurl'=>$request->trailerurl,
            // 'image'=>$request->image,
            // 'banner_image'=>$request->banner
            );

        $this->movie->store($data);

        // if ($request->hasFile('image')) {
        //     $orgiImage = $request->file('image');
        //     $filename = time() . time() . '.' . $orgiImage->getClientOriginalExtension();
        //     $path2 = public_path('images/events/small-thumb');
        //     $img = Image::make($orgiImage->getRealPath());
        //     $img->resize(60, 60)->save($path2 . '/' . $filename);
        //     $path = public_path('images/events/thumbnail');
        //     $orgiImage->move($path, $filename);
        //     $eventData['image'] = $filename;
        // }

        // if ($request->hasFile('banner')) {
        //     $orgiBanner = $request->file('banner');
        //     $filename = time() . time() . '.' . $orgiBanner->getClientOriginalExtension();
        //     $path = public_path('images/events/banner');
        //     $orgiBanner->move($path, $filename);
        //     $eventData['banner'] = $filename;
        // }


	}
}
