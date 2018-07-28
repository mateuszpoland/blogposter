@extends('layouts.app')

@section('content')
            <div class="card">
                <div class="card-header">Panel administracyjny</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Witaj, {{ Auth::user()->name }}.
                </div>
            </div>
        
    

@endsection
