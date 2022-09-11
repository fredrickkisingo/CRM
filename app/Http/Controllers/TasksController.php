<?php

namespace App\Http\Controllers;

use App\Task;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB as DB;
use Yajra\DataTables\Facades\DataTables as DataTables;

use function GuzzleHttp\json_decode;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    
        $user_id=Auth::user()->id;
        $tasks_filter = request()->get('tasks_filter');

    
                    $records = DB::table('tasks')
                    ->select(
                            'tasks.id as id',
                            'tasks.title as title',
                            'tasks.description as description',
                            'tasks.status as status',
                            'tasks.type_of_task as  type_of_task',
                    

                    )
                    ->where('tasks.user_id',$user_id)
                    ->orderBy('tasks.created_at','desc')->get();

         
         return view('tasks.index')->with('records',$records);


         
    }
    /**
     * get task status modal for updating
     *
     */

    public function getTaskStatus($id){


        return view('tasks.status')->with('id',$id);
    }
       /**
     * update task status
     * @return Response
     */
    public function postTaskStatus(Request $request)
    {
        try {
            

           
            $task = Task::where('id', $request['record_id'])
                ->update(['status'=>request()->input('status')]);

            // $task->status = request()->input('status');
            // $task->save();

            $output = [
                'msg' => __('lang_v1.success_status')
            ];
            return  redirect()->route('tasks.index')->with('success',$output['msg']);
        } catch (Exception $e) {
            Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());

            $output = [

                'msg' => __('messages.something_went_wrong')
            ];
            return  redirect()->route('tasks.index')->with('error',$output['msg']);

        }

        return $output;
    }

    public function renderTomorrowsTask(Request $request){


        $user_id=Auth::user()->id;
        $tasks_filter = $request['tasks_filter'];
  
        if($tasks_filter =='tomorrow'){

            $filter = date("Y-m-d" ,strtotime(date("Y-m-d", strtotime("+1 day"))));
        
            $filter = date("l", strtotime($filter));
        

            $tasks = DB::table('tasks')
                    ->select(
                            'tasks.title as title',
                            'tasks.description as description',
                            'tasks.status as status',
                            'tasks.type_of_task as  type_of_task',
                            'tasks.repetitive_array as repetitive_array'

                    )
                    ->where('tasks.user_id',$user_id)
                    ->orderBy('tasks.created_at','desc')->get();

        $tasks_arrays = json_decode($tasks);
        $records = [];
        foreach($tasks_arrays as $tasks_array){
            $repetitive_array=$tasks_array->repetitive_array;
            $days_array = json_decode($repetitive_array);

            $count = count($days_array->day); 

            for($i = 0; $i < $count; $i ++){
                $day = $days_array->day[$i];

                
                if($day == $filter){
                    array_push($records, $tasks_array);
                }
            }

        }
        $records=($records);
        // \Log::info($records);

     

        if (!empty($tasks_filter)) {
            return view('tasks/index_tomorrow')->with('records',$records);
        }
    

    }elseif($tasks_filter ==''){

        
        $tasks = DB::table('tasks')
        ->select(
                'tasks.title as title',
                'tasks.description as description',
                'tasks.status as status',
                'tasks.type_of_task as  type_of_task',
                'tasks.repetitive_array as repetitive_array'

        )
        ->where('tasks.user_id',$user_id)
        ->orderBy('tasks.created_at','desc')->paginate(20);

        $records=array($tasks);
        $records=$records[0];
        return view('tasks/index_tomorrow')->with('records',$records);

    }elseif($tasks_filter =='today'){

        $filter = date('l');
     
    
        $tasks = DB::table('tasks')
        ->select(
                'tasks.title as title',
                'tasks.description as description',
                'tasks.status as status',
                'tasks.type_of_task as  type_of_task',
                'tasks.repetitive_array as repetitive_array'

        )
        ->where('tasks.user_id',$user_id)
        ->orderBy('tasks.created_at','desc')->get();
        
        $tasks_arrays = json_decode($tasks);
        $records = [];
        foreach($tasks_arrays as $tasks_array){
            $repetitive_array=$tasks_array->repetitive_array;
            $days_array = json_decode($repetitive_array);

            $count = count($days_array->day); 

            for($i = 0; $i < $count; $i ++){
                $day = $days_array->day[$i];

                
                if($day == $filter){
                    array_push($records, $tasks_array);
                }
            }

        }
        $records=($records);
        return view('tasks/index_tomorrow')->with('records',$records);

    }


    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if( Auth::check()){

        try{

                    $validator = Validator::make($request->all(), [
                        'title' => 'required',
                        'description' => 'required']);
            
                    if ($validator->fails()) {
                        return back()->with('error',$validator->errors());
                    }
            
                    $task_type=$request->input('task_type');

                    if($request->input('task_nature') == 'non-repetitive'){

                        $task_type = 'single_day';
                        $repetitive_array = array(
                                'day'=> array($request->input('daily_month'))
                                );

                    }

                    if($request->input('task_type') == 'daily'){
                        $repetitive_array = array(
                            'day'=> [ 'monday',
                            'tuesday', 
                            'wednesday',
                            'thursday',
                            'friday',
                            'saturday', 
                            'sunday' ]
                            );

                    }

                  
                    if($request->input('task_type') == 'weekly'){
            
                        //fill in the repetitve array here with array of the days
                        $repetitive_array = array(
                        'day'=> $request->input('weekly_checkbox')
                        );
            
            
                    }elseif($request->input('task_type') == 'Monthly'){
            
                
                            if($request->input('monthly_checkbox') == 'Once every month'){

                             
                                $repetitive_array = array(
                                    'day'=> array($request->input('date_of_month'))
                                    );
        
                                    $frequency='single_each';

                            }elseif($request->input('monthly_checkbox')== 'Once a month each year'){

                                //use input from the calendar
                                $repetitive_array = array(
                                    'day'=> array($request->input('monthly_once_and_day'))
                                    );
                                
                                    \Log::info($repetitive_array);
                                    $frequency='single_per_specific_month';
                            }
                        }
                    
                    
            
            
                    $new_task = new Task();
                    $new_task->title=$request->input('title');
                    $new_task->description=$request->input('title');
                    $new_task->type_of_task=$task_type;
                    $new_task->user_id= Auth::user()->id;
                    $new_task->frequency= isset($frequency)?$frequency:null;
                    $new_task->time=$request->input('time');

                    $new_task->repetitive_array=isset($repetitive_array)?json_encode($repetitive_array):null;

                    $new_task->status=$request->input('status');

                    $new_task->save();
                    return  redirect()->route('tasks.index')->with('success','Task added successfully');




    } catch (Exception $e) {
        Log::emergency("File:" . $e->getFile(). "Line:" . $e->getLine(). "Message:" . $e->getMessage());

    
       
        $msg = 'Something went wrong';
        return back()->with('success',$msg);

    }
         
        }else{

            return redirect('login')->with('error','Permission not allowed');

        }
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $
     * id
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
        //
    }
}
