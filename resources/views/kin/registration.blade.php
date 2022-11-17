@extends('layouts.app')

@section('page')
    
{{-- include top navigation --}}
@include('kin.inc.kin_top_nav')

{{-- heading --}}
<div class="container-fluid text-center m-auto font-weight-bold text-xl mt-2 mb-4">
    Kin Registration form
</div>

{{-- include registration form --}}
<div class="container bg-light  mt-4">
   <form action="{{ route('kin_create', auth()->user()->id) }}" method="post">
    @csrf
    {{-- include registration form --}}
    @include('kin.inc.kin_registration')

    {{-- submit button --}}
    <div class="pt-3 pb-3 text-center">
        <button class="btn btn-success btn-sm auth-btn" type="submit">SUBMIT</button>
    </div>

   </form>
</div>


@endsection