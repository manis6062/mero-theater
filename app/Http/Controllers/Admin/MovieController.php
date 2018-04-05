<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\MovieModel;
use App\ArtistsModel;
use Illuminate\Support\Facades\DB;


class MovieController extends Controller
{	
	protected $movie;
    protected $artist;

	public function __construct()
	{
		$this->movie = new  MovieModel();
        $this->artist = new ArtistsModel();
	}

	public function movieslist(Request $request)
	{  
        $data = $this->movie->listofmovies();
        if (isset($request->status) && $request->status == 'successfully-updated')
            return view('admin.movies.movielist', compact('data'))->with('alertify', 'successfully-updated');
        elseif (isset($request->status) && $request->status == 'error-updating') {
            return view('admin.movies.movielist', compact('data'))->with('alertify', 'error-updating');
        }elseif (isset($request->status) && $request->status == 'successfully-deleted') {
            return view('admin.movies.movielist', compact('data'))->with('alertify', 'successfully-deleted');
        }
        else{
            return view('admin.movies.movielist',compact('data'));
        }
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
            'image' => 'sometimes|required|mimes:jpeg,jpg,bmp,png,svg',
            'bannerimage' => 'sometimes|required|mimes:jpeg,jpg,bmp,png,svg',
            'trailerurl' => 'nullable|url',
            'rating' => 'required',
            'language' => 'required',
            'nationality' => 'required',
        ]);

		$data = array(
            'movie_title' => $request->movieTitle,
            'movie_short_name'=>$request->movieShortName,
            'synopsis'=>$request->synopsis,
            'genre'=>$request->genre,
            'distributor'=>$request->distributor,
            'openingdate'=>$request->openingdate,
            'content'=>$request->movie_content,
            'duration'=>$request->duration,
            'isrestricted'=>$request->isrestricted,
            'displaysequence'=>$request->displaysequence,
            'filmformat'=>$request->filmformat,
            'trailerurl'=>$request->trailerurl,
            'status'=>$request->status,
            'direct_artist'=>$request->directartist,
            'rating'=>$request->rating,
            'language'=>$request->language,
            'nationality'=>$request->nationality,
            );

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('movies/posterimage');
            $image->move($path, $filename);
            $data['image'] = $filename;
        }

        if($request->has('artist'))
        {
            $artistDataArr = [];
             for($i = 0; $i < count($request->artist); $i++)
            {
                $artistData = [
                    'artist_id' => $request->artist[$i],
                    'artist_role' => $request->artistrole[$i]
                ];
                $artistDataArr[] = $artistData;
            }

            $data['artists_from_db'] = json_encode($artistDataArr);
        }

         if ($request->hasFile('bannerimage')) 
         {
            $image = $request->file('bannerimage');
            $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('movies/bannerimage');
            $image->move($path, $filename);
            $data['banner_image'] = $filename;
        }


          $result = MovieModel::create($data);
          if (isset($result))
            return redirect('admin/box-office/movies')->with('message', 'Movie Successfully Created !');

	}

    public function editmovie($movieid)
    {   
        $artists = $this->artist->listofartists();
        $editdata = $this->movie->getrequestedmovie($movieid);
        if(isset($editdata->artists_from_db) && $editdata->artists_from_db != null)
        {
            $artistsFromDb = json_decode($editdata->artists_from_db, true);
        }else{
            $artistsFromDb = null;
        }
        return view('admin.movies.editmovie',compact('editdata','artists', 'artistsFromDb'));
    }

    public function viewmovie($movieid)
    {   
        $artists = $this->artist->listofartists();
        $editdata = $this->movie->getrequestedmovie($movieid);
         if(isset($editdata->artists_from_db) && $editdata->artists_from_db != null)
        {
            $artistsFromDb = json_decode($editdata->artists_from_db, true);
        }else{
            $artistsFromDb = null;
        }
        return view('admin.movies.viewmovie',compact('editdata','artists','artistsFromDb'));
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
             'rating' => 'required',
            'language' => 'required',
            'nationality' => 'required',
        ]);

        $data = array(
            'movie_title' => $request->movieTitle,
            'movie_short_name'=>$request->movieShortName,
            'synopsis'=>$request->synopsis,
            'genre'=>$request->genre,
            'distributor'=>$request->distributor,
            'openingdate'=>$request->openingdate,
            'content'=>$request->movie_content,
            'duration'=>$request->duration,
            'isrestricted'=>$request->isrestricted,
            'displaysequence'=>$request->displaysequence,
            'filmformat'=>$request->filmformat,
            'trailerurl'=>$request->trailerurl,
            'status'=>$request->status,
            'direct_artist'=>$request->directartist,
            'rating'=>$request->rating,
            'language'=>$request->language,
            'nationality'=>$request->nationality,
            );

        if($request->has('artist'))
        {  
            $artistDataArr = [];
             for($i = 0; $i < count($request->artist); $i++)
            {
                $artistData = [
                    'artist_id' => $request->artist[$i],
                    'artist_role' => $request->artistrole[$i]
                ];

                $artistDataArr[] = $artistData;
            }
            $data['artists_from_db'] = json_encode($artistDataArr);
        }

        $detail = MovieModel::where('id',$movieid)->first();

        if ($request->hasFile('image')) {
            if (file_exists(public_path('movies/posterimage/' . $detail->image)))
                unlink(public_path('movies/posterimage/' . $detail->image));
            $image = $request->file('image');
            $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('movies/posterimage');
            $image->move($path, $filename);
            $data['image'] = $filename;
        }

         if ($request->hasFile('bannerimage')) {
            if (file_exists(public_path('movies/bannerimage/' . $detail->banner_image)))
                unlink(public_path('movies/bannerimage/' . $detail->banner_image));
            $image = $request->file('bannerimage');
            $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('movies/bannerimage');
            $image->move($path, $filename);
            $data['banner_image'] = $filename;
        }

       $updated = $this->movie->updatedata($data,$movieid);

         if (isset($updated))
            return redirect('admin/box-office/movies?status=successfully-updated')->with('message', 'Movie Successfully Updated !');
    }


         public function delete(Request $request)
    {
       $deleted = $this->movie->deletedata($request->movieId);
       if($deleted){
         return 'true';
       }
    else{
          return 'false';
    }
}

    public function addartistformovie()
    {
        $artistslist = $this->artist->listofartists();
        if($artistslist)
        {   
            $table = '<tr><td><select name="artist[]" class="artist-select"><option value="">Select Artist</option>';
            foreach($artistslist as $alist)
            {
                $table .='<option value="'.$alist->id.'">'.$alist->artists_name.'</option>';
            }
            $table .= '</td><td><select name="artistrole[]" class="artist-role-select"><option value="">Select Role</option><option value="actor">Actor</option><option value="actress">Actress</option><option value="producer">Producer</option><option value="director">Director</option><option value="writer">Writer</option><select></td></tr>'; 
            return $table;
        }
    }
}
