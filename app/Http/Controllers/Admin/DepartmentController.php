<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    /**
   * Set middleware to quard controller.
   *
   * @return void
   */
    public function __construct()
    {
        $this->middleware('sentinel.auth');
    }

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::orderBy('level','ASC')->orderBy('name','ASC')->get();

		return view('admin.departments.index',['departments'=>$departments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::where('level',1 || 0)->orderBy('name','ASC')->get();
		
		return view('admin.departments.create',['departments'=>$departments]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->except(['_token']);

		if($input['level'] == 1){
			$input['level1'] = 0;
		}
		
		$data = array(
			'name'  			=> $input['name'],
			'email'     		=> $input['email'],
			'level'	 			=> $input['level'],
			'level1'	 		=> $input['level1']
		);
		
		$department = new Department();
		$department->saveDepartment($data);
		
		$message = session()->flash('success', 'Novi odjel je snimljen');
		
		return redirect()->route('admin.departments.index')->withFlashMessage($message);
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
        $department = Department::find($id);
		$departments = Department::where('level',1 || 0)->orderBy('name','ASC')->get();
	
		return view('admin.departments.edit', ['department' => $department,'departments'=>$departments]);
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
        $department = Department::find($id);
		$input = $request->except(['_token']);
		
		if($input['level'] == 1){
			$input['level1'] = '0';
		}
		
		$data = array(
			'name'	 			=> $input['name'],
			'email'     		=> $input['email'],
			'level'	 			=> $input['level'],
			'level1'	 		=> $input['level1']
		);
		
		$department->updateDepartment($data);
		
		$message = session()->flash('success', 'Podaci su ispravljeni');
		
		return redirect()->route('admin.departments.index')->withFlashMessage($message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = Department::find($id);
		$department->delete();
		
		$message = session()->flash('success', 'Odjel je obrisan.');
		
		return redirect()->route('admin.departments.index')->withFlashMessage($message);
    }
}
