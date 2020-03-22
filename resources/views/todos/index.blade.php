@extends('layouts.app')

@section('title', 'Alltodos')

@section('content')
    <div class="container">
        <div class="row pt-3 justify-content-center">
            <div class="card" style="width: 50%">
                <div class="card-header text-center">
                    <h1>All Todos</h1>
                </div>
                @if(session() -> has('success'))
                    <div class="alert alert-success">
                        {{session()->get('success')}}
                    </div>
                @endif
                <div class="card-body">
                    <ul class="list-group">
                        @forelse($todos as $item)
                            <li class="list-group-item text-muted">
                                {{ $item -> title }}
                                <span class="float-right mr-2">
                                    <a href="/todos/{{$item -> id}}/delete" style="color: red">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    </a>
                                </span>
                                <span class="float-right mr-2">
                                    <a href="/todos/{{$item -> id}}/edit" style="color: green">
                                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                    </a>
                                </span>
                                <span class="float-right mr-2">
                                    <a href="/todos/{{$item -> id}}" style="color: blue">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    </a>
                                </span>
                                @if(!$item -> completed)
                                    <span class="float-right mr-2">
                                        <a href="/todos/{{$item -> id}}/complete" style="color: aqua">
                                        <i class="fa fa-check-square-o" aria-hidden="true"></i>
                                        </a>
                                    </span>
                                @endif
                            </li>
                            @empty
                                <p class="text-center">No users !!!</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection