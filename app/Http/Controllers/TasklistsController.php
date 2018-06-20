<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

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
    
        if (\Auth::check()){
            $user = \Auth::user();
            $tasklists = $user->tasklists;
   
            return view('tasklists.index', ['tasklists' => $tasklists,]);
        }
        else {
            return view ('welcome');
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
   
            return view('tasklists.create', ['tasklist' => $tasklist,]);

        
        
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
            
         $request->user()->tasklists()->create([
            'status' => $request->status,
             'content' => $request->content,
             ]);
            
        return redirect('/');
       
       
        
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
        
        if (\Auth::id() === $tasklist->user_id){
            $tasklist->show();
        
        return view('tasklists.show', [
            'tasklists' => $tasklists,
        ]);
            
        }
        
        else{
            return view ('/');
        }
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
    
    if(\Auth::id() === $tasklist->user_id) {
        $tasklist->edit();
  
       return view('tasklists.edit',[
           'tasklist' => $tasklist,
     ]);
    }
    
    else {
        return redirect('/');
    }
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

        return redirect('/');
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
        
        if (\Auth::id() === $tasklist->user_id){
            $tasklist->delete();
            
            return view('tasklists.index',[
           'tasklist' => $tasklist,
     ]);
    }
    
    else {
        return redirect('/');
    }
    }
 
}
