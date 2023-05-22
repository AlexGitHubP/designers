<?php

namespace Locomotif\Designers\Controller;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Locomotif\Designers\Models\Designer;
use Locomotif\Media\Controller\MediaController;
use Locomotif\Admin\Models\Users;

class DesignerController extends Controller
{
    public function __construct()
    {
        $this->middleware('authgate');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $designers = Designer::orderBy('ordering', 'desc')->get();
        foreach ($designers as $key => $value) {
            $designers[$key]->status_nice = mapStatus($value->status);
        }
        return view('designers::list')->with('items', $designers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('designers::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required',
            'surname' => 'required',
            'email'   => 'required',
            'status'  =>'required'
        ]);
        
        //create new user
        $user = Users::create(['name' => $request->name,'email' => $request->email]);
        //set the role for the user
        setUserRole('designer', $user->id);

        //save designer
        $designer = new Designer();

        $designer->name         = $request->name;
        $designer->user_id      = $user->id;
        $designer->surname      = $request->surname;
        $designer->email        = $request->email;
        $designer->phone        = $request->phone;
        $designer->url          = $request->url;
        $designer->description  = $request->description;
        $designer->ordering     = getOrdering($designer->getTable(), 'ordering');
        $designer->status       = $request->status;
        
        $designer->save();
        

        return redirect('admin/designers/'.$designer->id.'/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Designer  $designer
     * @return \Illuminate\Http\Response
     */
    public function show(Designer $designer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Designer  $designer
     * @return \Illuminate\Http\Response
     */
    public function edit(Designer $designer)
    {
        $associatedMedia      = app(MediaController::class)->mediaAssociations($designer->getTable(), $designer->id);
        return view('designers::edit')->with('item', $designer)->with('associatedMedia', $associatedMedia);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Designer  $designer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Designer $designer)
    {
        $request->validate([
            'name'    => 'required',
            'surname' => 'required',
            'email'   => 'required',
            'status'  =>'required'
        ]);

        $designer->name         = $request->name;
        $designer->surname      = $request->surname;
        $designer->email        = $request->email;
        $designer->phone        = $request->phone;
        $designer->url          = $request->url;
        $designer->description  = $request->description;
        $designer->status       = $request->status;
        
        $designer->save();

        return redirect('admin/designers/'.$designer->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Designer  $designer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designer $designer)
    {
        //
    }
}
