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
        $data = $this->movie->listofmovies();
		return view('admin.movies.movielist',compact('data'));
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
            'duration' => 'required|numeric',
            'displaysequence' => 'required|numeric',
            'filmformat' =>'required',
            'image' => 'required|mimes:jpeg,jpg,bmp,png,svg',
            'bannerimage' => 'required|mimes:jpeg,jpg,bmp,png,svg',
            'trailerurl' => 'nullable|url',
        ]);

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
            'status'=>$request->status
            );

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('movies/posterimage');
            $image->move($path, $filename);
            $data['image'] = $filename;
        }

         if ($request->hasFile('bannerimage')) {
            $image = $request->file('bannerimage');
            $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('movies/bannerimage');
            $image->move($path, $filename);
            $data['banner_image'] = $filename;
        }

        $this->movie->store($data);
        return  redirect('admin/movies');

	}

    public function editmovie($movieid)
    {   
        $editdata = $this->movie->getrequestedmovie($movieid);
        return view('admin.movies.editmovie',compact('editdata'));
    }

    public function update(Request $request,$movieid)
    {
        $this->validate($request, [
            'movieTitle' => 'required',
            'movieShortName' => 'required',
            'genre' => 'required',
            'distributor' => 'required',
            'openingdate' => 'required|date',
            'duration' => 'required|numeric',
            'displaysequence' => 'required|numeric',
            'filmformat' =>'required',
            'image' => 'sometimes|required|mimes:jpeg,jpg,bmp,png,svg',
            'bannerimage' => 'sometimes|required|mimes:jpeg,jpg,bmp,png,svg',
            'trailerurl' => 'nullable|url',
        ]);

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
            'status'=>$request->status
            );

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('movies/posterimage');
            $image->move($path, $filename);
            $data['image'] = $filename;
        }

         if ($request->hasFile('bannerimage')) {
            $image = $request->file('bannerimage');
            $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('movies/bannerimage');
            $image->move($path, $filename);
            $data['banner_image'] = $filename;
        }

       $updated = $this->movie->updatedata($data,$movieid);
       if($updated)
          return redirect('admin/movies');

      return redirect('admin/movies');
    }

    public function deletemovie($movieid)
    {
       $deleted = $this->movie->deletedata($movieid);
       if($deleted)
        return redirect('admin/movies');
    }

    public function changemoviestatus($movieid)
    {   
        // dd($movieid);
         $statuschanged = $this->movie->newstatus($movieid);
         if($statuschanged)
            return true;
    }
}
