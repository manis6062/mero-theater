<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Support\Facades\Input;

class ContactImport extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'contacts' => 'required'
        ];
    }

    /**
     * Getting and saving the uploaded contacts list file
     */
    public function getFile($id)
    {
        // Uploading contact list file
        if (Input::file('contacts')) {
            $imageName = 'contacts_' . time() . '-' . $id . '.' . Input::file('contacts')->getClientOriginalExtension();
            $path = '/public/uploads/import/';
            $returnPath = "/uploads/import/";
            Input::file('contacts')->move(base_path() . $path, $imageName);
            $filename = $path . $imageName;
        } else {
            $filename = "";
        }

        // Return it's location
        return $returnPath.$imageName;
    }

    /**
     * Delete the file
     *
     * @param $filename
     * @return bool
     */
    public function deleteFile($filename){
        if (\File::exists($filename)) {
            \File::delete($filename);

            return true;
        }
        return false;
    }
}
