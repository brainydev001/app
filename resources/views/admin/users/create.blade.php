@extends('layouts.admin')

@section('page')
    {{-- include top nav --}}
    @include('admin.inc.admin_top_nav')

    {{-- include side nav --}}
    @include('admin.inc.admin_side_nav')

    {{-- include registration form --}}
    @include('admin.users.inc.crud')
@endsection

{{-- section custom scripts --}}
@section('adminScripts')
    <form action="{{ route('create_user') }}" method="post" enctype="multipart/form-data">
        @csrf
        {{-- include user create page --}}
        @include('admin.users.inc.crud_js')

        {{--submit button --}}
        <div class="text-center mt-4 mb-4">
            <button class="btn btn-warning" type="submit">
                Create User
            </button>
        </div>
    </form>
@endsection


