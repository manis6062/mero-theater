<?php

namespace App\Http\Controllers\Admin\smsCampaign\sms;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

use App\Models\MessageTemplate;
use App\Library\AjaxResponse;

class TemplateController extends Controller
{
    protected $userId;

    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $templates = MessageTemplate::where('admin_id',Auth::guard('admin')->user()->id)->get();
        return view('admin.smsCampaign.campaign.templates.template', ['templates' => $templates]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $template = MessageTemplate::where('id',$id)->where('admin_id',Auth::guard('admin')->user()->id)->first();
        $result = $template->delete();
        if($result)
        {
           return redirect()->back()->with('success', 'Successfully deleted template');
        }

        return redirect()->back()->with('warning', 'That data does not exist');
    }

    //Save template ajax function
    public function saveTemplate(Request $request){
        $input = $request->all();

        $messageTemplate = MessageTemplate::create([
            'user_id' => $this->userId,
            'body' => $input['message']
        ]);

        if ($messageTemplate){
            return AjaxResponse::sendResponse('Template saved', false, 200);
        }
        return AjaxResponse::sendResponse('Error! occured', true, 200);
    }

    // Mass template delete
    public function postMassDelete(Request $request )
    {
        $inputs = $request->all();
        $checkBeforeDelete=\DB::table('message_templates')->whereIn('id', $inputs['contacts'])->where('admin_id',Auth::guard('admin')->user()->id)->count();
        if($checkBeforeDelete){
            $deletedData = \DB::table('message_templates')->whereIn('id', $inputs['contacts'])->where('admin_id',Auth::guard('admin')->user()->id)->delete();
        }
        return response()->json($deletedData, 200);
    }
}
