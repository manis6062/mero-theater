<?php
namespace App\Repositories;

use App\Models\Contact;
use App\Models\ContactGroup;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Mockery\Exception;

class ContactRepository
{

    protected $request;

    /**
     * Defining constructor
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getAll($userId)
    {
        try {
            $contacts = Contact::where('admin_id', $userId)->get();
        } catch (ModelNotFoundException $exception) {
            $contacts = false;
        }

        return $contacts;
    }

    /**
     * Adding contact to group
     */
    public function insertContactToGroup()
    {
        $inputs = $this->request->all();
        foreach ($inputs['contacts'] as $contact) {
            ContactGroup::insert([
                'contact_id' => $contact,
                'group_id' => $inputs['group_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }

        return true;
    }


    public function findByColumn($columnName, $columnValue)
    {
        try{
            $data = Contact::where($columnName, $columnValue)->get();
            if($data->count() != 0)
            {
                return $data;
            }
            return false;
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

//    public function findAllContactsIdOfUser($id)
//    {
//        try{
//            return Contact::where('user_id', $id)->pluck('id');
//        }catch (Exception $e){
//            return $e->getMessage();
//        }
//    }

    public function deleteUserContacts($id)
    {
        try{
            return Contact::where('user_id', $id)->delete();
        }catch (Exception $e)
        {
            return $e->getMessage();
        }
    }

    public function getContactByuserId($userId)
    {
        try{
            return Contact::where('user_id', $userId)->get();
        }catch (Exception $e)
        {
            return $e->getMessage();
        }
    }
}