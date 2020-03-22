<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo; // Trait

class todosController extends Controller
{
    public function index(){
        $todos = Todo::All();

        return view('todos.index', ['todos'=> $todos]);
        // return view('todos.todos') -> with('todos', $todos); //One Variable
        // return view('todos.todos', compact('todos'));
    }

    public function show(Todo $todo) {
        //$todo = Todo::find($todo);

        return view('todos.show') -> with('todo', $todo);
    }

    public function create() {
        return view('todos.create');
    }

    public function store(Request $request){
        //return $request->all();
        //return $request -> input('todoTitle');
        //$request -> todoTitle;
        
        #M1
        // $request -> validate([
        //     'todoTitle' => 'required|min:6',
        //     'todoDesciption' => 'required'
        // ]);
        
        #M2
        $this -> validate( $request, [
            'todoTitle' => 'required',
            'todoDescription' => 'required'
        ]);
        
        #create classe in (input/droplist ...) in view

        $todo = new Todo();

        $todo -> title = $request -> todoTitle;
        $todo -> description = $request -> input('todoDescription');
        // $todo -> comleted = false;//Deja value default = false

        $todo -> save();

        $request -> session()->flash('success','todo created successfully ☺');

        return redirect('/todos');
    }

    public function edit(Todo $todo) {

        //$todo = Todo::find($todo);

        return view('todos.edit') -> with('todo', $todo);
    }

    public function update(Request $request,Todo $todo) {

        $this -> validate( $request, [
            'todoTitle' => 'required',
            'todoDescription' => 'required'
        ]);

       // $todo = Todo::find($todo);
        $todo->title = $request->get('todoTitle');
        $todo->description = $request->get('todoDescription');

        $todo->save();

        $request -> session()->flash('success','todo Updated successfully ☺');
        
        return redirect('/todos');
    }

    public function destroy(Todo $todo){
        //$todo = Todo::find($todo);

        $todo -> delete();

        session()->flash('success','todo Deleted successfully ☺');

        return redirect('/todos');
    }

    public function complete(Todo $todo) {

        $todo -> completed = true;

        $todo->save();

        session()->flash('success','todo Completed successfully ☺');

        return redirect('/todos');
    }
}
