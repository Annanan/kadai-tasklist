<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tasklist;

class TasklistsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deta = [];
        if (\Auth::check()){
            $user = \Auth::user();
            $tasklists = $user->tasklists;
             $data = [
                'user' => $user,
                'tasklists' => $tasklists,
            ];
            return view('users.show', $data);
        }
        else {
            return view ('welcome');
        }
    }
}




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         $tasklist = new Tasklist;

        return view('tasklists.create', [
            'tasklist' => $tasklist,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|max:10',
            'content' => 'required|max:191',
            ]);
        
        $tasklist = new Tasklist;
        $tasklist->status = $request->status;
        $tasklist->content = $request->content;
        $tasklist->save();
        
        return redirect('/index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         $tasklist = Tasklist::find($id);

        return view('tasklists.show', [
            'tasklist' => $tasklist,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tasklist = Tasklist::find($id);

       return view('tasklists.edit',[
           'tasklist' => $tasklist,
     ]);
 
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
        $this->validate($request, [
            'status' =>'required|max:10',
            'content' => 'required|max:191',
            ]);
            
            
        $tasklist = Tasklist::find($id);
        $tasklist->status = $request->status;
        $tasklist->content = $request->content;
        $tasklist->save();

        return redirect('/index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tasklist = Tasklist::find($id);
        $tasklist->delete();

        return redirect('/index');
    }
}
