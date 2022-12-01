@extends('layouts.admin')

@section('page')
    {{-- include top nav --}}
    @include('admin.inc.admin_top_nav')

    {{-- include side nav --}}
    @include('admin.inc.admin_side_nav')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        {{-- breadcrumbs --}}
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Query Manager</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="dashboard_index">Dashboard</a></li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        {{-- include alert messages --}}
        @include('alerts.messages')

        {{-- action bar --}}
        <a href="{{ url('query/activity') }}">
            <button class="btn btn-secondary m-2 text-white">
                <span>
                    Activities
                </span>
            </button>
        </a>

        {{-- action bar --}}
        <a href="{{ url('query/event') }}">
            <button class="btn btn-secondary m-2 text-white">
                <span>
                    Events
                </span>
            </button>
        </a>

        {{-- action bar --}}
        <a href="{{ url('query/module') }}">
            <button class="btn btn-secondary m-2 text-white">
                <span>
                    Module
                </span>
            </button>
        </a>
    </div>

@endsection

