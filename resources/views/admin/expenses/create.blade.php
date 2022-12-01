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
                        <h1 class="m-0 text-dark">Expense Manager</h1>
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

        <form action="{{ route('expense_store') }}" method="post">
            @csrf
            <div class="container m-5">
                <div class="row">
                    <div class="col-md-6 card bg-yellow p-3">
                        {{-- name --}}
                        <div class="text-dark-bg-light p-2">
                            <div>
                                <label for="">Expense Name</label>
                            </div>
                            <div>
                                <input type="text" name="name" class="form-control">
                            </div>
                        </div>
                        {{-- input amount --}}
                        <div class="text-dark-bg-light p-2">
                            <div>
                                <label for="">Amount</label>
                            </div>
                            <div>
                                <input type="number" class="form-control" name="amount">
                            </div>
                        </div>

                        <div class="text-dark-bg-light p-2">
                            <div>
                                <label for="">Type</label>
                            </div>
                            <div>
                                <input type="text" class="form-control" name="type">
                            </div>
                        </div>
                        <div class="text-dark-bg-light p-2">
                            <div>
                                <label for="">Note</label>
                            </div>
                            <div>
                                <input type="text" class="form-control" name="note">
                            </div>
                        </div>
                        {{-- input note --}}
                        {{-- <div class="text-dark-bg-light">
                            <div>
                                <label for="">Input Note</label>
                            </div>
                            <div>
                                <textarea name="requsition_note" rows="3"></textarea>
                            </div>
                        </div> --}}
                        <button class="btn btn-secondary m-3">
                            Save
                        </button>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection