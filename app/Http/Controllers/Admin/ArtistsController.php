<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\ArtistsModel;

class ArtistsController extends Controller
{	
	protected $movie;

	public function __construct()
	{
		$this->artist = new  ArtistsModel();
	}

	public function artistslist(Request $request)
	{  
        $data = $this->artist->listofartists();
        if(isset($request->status) && $request->status=='successfully-updated')
        {
            return view('admin.artist.artistlist',compact('data'))->with('alertify', 'successfully-updated');
        }elseif(isset($request->status) && $request->status=='error-updating')
        {
            return view('admin.artist.artistlist',compact('data'))->with('alertify', 'error-updating');
        }elseif(isset($request->status) && $request->status=='successfully-deleted')
        {
            return view('admin.artist.artistlist',compact('data'))->with('alertify', 'successfully-deleted');
        }else{
            return view('admin.artist.artistlist',compact('data'));
        }
	}

	public function createartist()
	{
	 	return view('admin.artist.createartist');
	}

	public function submit(Request $request)
	{
		$this->validate($request, [
            'artist_name' => 'required',
            'artist_achievements' => 'required',
            'artist_current_status' => 'required',
            'artist_early_life' => 'required',
            'artist_hash_tags'=>'required',
            'artist_avatar' => 'sometimes|required|mimes:jpeg,jpg,bmp,png,svg'
        ]);

		$data = array(
            'artists_name' => $request->artist_name,
            'artists_achievements'=>$request->artist_achievements,
            'artists_current_status'=>$request->artist_current_status,
            'artists_early_life'=>$request->artist_early_life,
            'hashtag'=>$request->artist_hash_tags,
            );

        if ($request->hasFile('artist_avatar')) {
            $image = $request->file('artist_avatar');
            $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('artists');
            $image->move($path, $filename);
            $data['artists_avatar'] = $filename;
        }

        $this->artist->store($data);
        return  redirect('admin/box-office/artist');

	}

    public function editartist($artistid)
    {   
        $editdata = $this->artist->getrequestedartist($artistid);
        return view('admin.artist.editartist',compact('editdata'));
    }

    public function viewartist($artistid)
    {   
        $viewdata = $this->artist->getrequestedartist($artistid);
        return view('admin.artist.viewartist',compact('viewdata'));
    }

    public function update(Request $request,$artistid)
    {
        $this->validate($request, [
            'artist_name' => 'required',
            'artist_achievements' => 'required',
            'artist_current_status' => 'required',
            'artist_early_life' => 'required',
            'artist_hash_tags'=>'required',
            'artist_avatar' => 'sometimes|required|mimes:jpeg,jpg,bmp,png,svg'
        ]);

        $data = array(
            'artists_name' => $request->artist_name,
            'artists_achievements'=>$request->artist_achievements,
            'artists_current_status'=>$request->artist_current_status,
            'artists_early_life'=>$request->artist_early_life,
            'hashtag'=>$request->artist_hash_tags,
            );

        if ($request->hasFile('artist_avatar')) {
            $image = $request->file('artist_avatar');
            $filename = time() . uniqid() . '.' . $image->getClientOriginalExtension();
            $path = public_path('artists');
            $image->move($path, $filename);
            $data['artists_avatar'] = $filename;
        }

       $updated = $this->artist->updatedata($data,$artistid);
       if($updated)
          return redirect('admin/box-office/artist?status=successfully-updated');

      return redirect('admin/box-office/artist?status=error-updating');
    }

    public function deleteartist($artistid)
    {
       $deleted = $this->artist->deletedata($artistid);
       if($deleted)
        return redirect('admin/box-office/artist?status=successfully-deleted');
    }
}
