@extends('layouts.admin')

@section('page')
    {{-- include top nav --}}
    @include('admin.inc.admin_top_nav')

    {{-- include side nav --}}
    @include('admin.inc.admin_side_nav')

    @if ($type == 'Activity' || $type == 'Event')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            {{-- breadcrumbs --}}
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">{{ $data->name }} {{ $type }} Manager</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="dashboard_index">Dashboard</a></li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>

            {{-- action bar --}}
            <a class="btn btn-secondary m-2 text-white" href="{{ route('requisition', [$type, $data->id]) }}">
                <span>
                    Make Requisition
                </span>
                <span class="ml-2 text-white">
                    <i class="fas fa-plus"></i>
                </span>
            </a>

            {{-- include alert messages --}}
            @include('alerts.messages')

            {{-- main content --}}
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-edit"></i>
                        Edit {{ $data->name }}
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-5 col-sm-3">
                            <div class="nav flex-column nav-tabs h-100" id="vert-tabs-tab" role="tablist"
                                aria-orientation="vertical">
                                <a class="nav-link active" id="vert-tabs-home-tab" data-toggle="pill" href="#vert-tabs-home"
                                    role="tab" aria-controls="vert-tabs-home" aria-selected="true">Information</a>
                                <a class="nav-link" id="vert-tabs-profile-tab" data-toggle="pill" href="#vert-tabs-profile"
                                    role="tab" aria-controls="vert-tabs-profile" aria-selected="false">Team Leader</a>
                                <a class="nav-link" id="vert-tabs-messages-tab" data-toggle="pill"
                                    href="#vert-tabs-messages" role="tab" aria-controls="vert-tabs-messages"
                                    aria-selected="false">Members</a>
                                <a class="nav-link" id="vert-tabs-settings-tab" data-toggle="pill"
                                    href="#vert-tabs-settings" role="tab" aria-controls="vert-tabs-settings"
                                    aria-selected="false">Budget</a>
                            </div>
                        </div>
                        <div class="col-7 col-sm-9">
                            <div class="tab-content" id="vert-tabs-tabContent">
                                <div class="tab-pane text-left fade show active" id="vert-tabs-home" role="tabpanel"
                                    aria-labelledby="vert-tabs-home-tab">
                                    {{-- row item --}}
                                    <div class="row mt-2">
                                        {{-- name --}}
                                        <div class="card col-md-4 d-flex">
                                            <div>
                                                {{ $type }} Name:
                                            </div>
                                            <div>
                                                {{ $data->name }}
                                            </div>
                                        </div>
                                        {{-- county --}}
                                        <div class="card col-md-4 d-flex">
                                            <div>
                                                {{ $type }} County:
                                            </div>
                                            <div>
                                                {{ $data->county }}
                                            </div>
                                        </div>
                                        {{-- sub county --}}
                                        <div class="card col-md-4 d-flex">
                                            <div>
                                                {{ $type }} Sub County:
                                            </div>
                                            <div>
                                                {{ $data->sub_county }}
                                            </div>
                                        </div>
                                    </div>
                                    {{-- row item --}}
                                    <div class="row mt-2">
                                        {{-- region --}}
                                        <div class="card col-md-4 d-flex">
                                            <div>
                                                {{ $type }} Region:
                                            </div>
                                            <div>
                                                {{ $data->regions->name }}
                                            </div>
                                        </div>
                                        {{-- constituency --}}
                                        <div class="card col-md-4 d-flex">
                                            <div>
                                                {{ $type }} Constituency:
                                            </div>
                                            <div>
                                                {{ $data->constituencies->name }}
                                            </div>
                                        </div>
                                        {{-- Ward --}}
                                        <div class="card col-md-4 d-flex">
                                            <div>
                                                {{ $type }} Ward:
                                            </div>
                                            <div>
                                                {{ $data->wards->name }}
                                            </div>
                                        </div>
                                    </div>
                                    {{-- row item --}}
                                    <div class="row mt-2">
                                        {{-- Start Time --}}
                                        <div class="card col-md-6 d-flex">
                                            <div>
                                                {{ $type }} Start Time:
                                            </div>
                                            <div>
                                                {{ $data->start_date }}
                                            </div>
                                        </div>
                                        {{-- End Time --}}
                                        <div class="card col-md-6 d-flex">
                                            <div>
                                                {{ $type }} End Time:
                                            </div>
                                            <div>
                                                {{ $data->end_date }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="vert-tabs-profile" role="tabpanel"
                                    aria-labelledby="vert-tabs-profile-tab">
                                    <div class="row">
                                        {{-- Team Leader --}}
                                        <div class="card col-md-6 d-flex">
                                            <div>
                                                {{ $type }} Team Leader:
                                            </div>
                                            <div>
                                                {{ $data->leaders->first_name }} {{ $data->leaders->last_name }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="vert-tabs-messages" role="tabpanel"
                                    aria-labelledby="vert-tabs-messages-tab">
                                    members
                                </div>
                                <div class="tab-pane fade" id="vert-tabs-settings" role="tabpanel"
                                    aria-labelledby="vert-tabs-settings-tab">
                                    <div class="row p-2">
                                        @if (count($budget) > 0)
                                            @foreach ($budget as $item)
                                                <div class="card col-mb-4 p-2 m-2">
                                                    <div>
                                                        <span class="mr-2"> Name : {{ $item->requsition_note }} </span>
                                                        <span>Amount: {{ $item->amount }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="mr-2"> Created at : {{ $item->created_at->diffForHumans() }} </span>
                                                        
                                                    </div>
                                                    <div>
                                                        <span>Note: {{ $item->examination_note }}</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            No requisitions made for this {{ $type }}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>

        </div>
    @else
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>{{ $type }} Detail</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">{{ $type }} Detail</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">

                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $type }} Detail</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                                <div class="row">
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            {{-- budget --}}
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Actual budget</span>
                                                <span
                                                    class="info-box-number text-center text-muted mb-0">{{ $amount }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-light">
                                            {{-- expenditure --}}
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-muted">Total amount
                                                    spent</span>
                                                <span class="info-box-number text-center text-muted mb-0">0</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-4">
                                        <div class="info-box bg-red">
                                            {{-- status --}}
                                            <div class="info-box-content">
                                                <span class="info-box-text text-center text-light">Status</span>
                                                <span class="info-box-number text-center text-light mb-0">Pending
                                                    Approval<span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        {{-- activity --}}
                                        <h4>Activity</h4>
                                        @if (count($activityData) > 0)
                                            @foreach ($activityData as $datas)
                                                @foreach ($datas as $item)
                                                    <div class="post">
                                                        <div class="user-block">
                                                            <span class="username">
                                                                {{ $item->name }}
                                                            </span>
                                                            <span class="description">{{ $item->leaders->first_name }}
                                                                {{ $item->leaders->last_name }}-
                                                                {{ $item->created_at->diffForHumans() }}</span>
                                                        </div>
                                                        <!-- /.user-block -->
                                                        <p>
                                                            <a href="#" class="link-black text-sm"><i
                                                                    class="fas fa-link mr-1"></i> Demo File 1 v2</a>
                                                        </p>
                                                    </div>
                                                @endforeach
                                            @endforeach
                                        @else
                                            No activity for the module 
                                        @endif

                                        {{-- event --}}
                                        <h4>Events</h4>
                                        @if (count($eventData) > 0)
                                        @foreach ($eventData as $datas)
                                            @foreach ($datas as $item)
                                                <div class="post">
                                                    <div class="user-block">
                                                        <span class="username">
                                                            {{ $item->name }}
                                                        </span>
                                                        <span class="description">{{ $item->leaders->first_name }}
                                                            {{ $item->leaders->last_name }}-
                                                            {{ $item->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    <!-- /.user-block -->
                                                    <p>
                                                        <a href="#" class="link-black text-sm"><i
                                                                class="fas fa-link mr-1"></i> Demo File 1 v2</a>
                                                    </p>
                                                </div>
                                            @endforeach
                                        @endforeach
                                    @else
                                        No activity for the module 
                                    @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                                <div class="text-muted">
                                    <p class="text-sm">Approved By
                                        <b class="d-block">Brian Ngugi</b>
                                    </p>
                                    <p class="text-sm">Estimated Budget
                                        <b class="d-block">27000</b>
                                    </p>
                                </div>

                                <h5 class="mt-5 text-muted">Project files</h5>
                                <ul class="list-unstyled">
                                    <li>
                                        <a href="" class="btn-link text-secondary"><i
                                                class="far fa-fw fa-file-word"></i> Functional-requirements.docx</a>
                                    </li>
                                    <li>
                                        <a href="" class="btn-link text-secondary"><i
                                                class="far fa-fw fa-file-pdf"></i> UAT.pdf</a>
                                    </li>
                                    <li>
                                        <a href="" class="btn-link text-secondary"><i
                                                class="far fa-fw fa-envelope"></i> Email-from-flatbal.mln</a>
                                    </li>
                                    <li>
                                        <a href="" class="btn-link text-secondary"><i
                                                class="far fa-fw fa-image "></i> Logo.png</a>
                                    </li>
                                    <li>
                                        <a href="" class="btn-link text-secondary"><i
                                                class="far fa-fw fa-file-word"></i> Contract-10_12_2014.docx</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </section>
            <!-- /.content -->
        </div>
    @endif
@endsection
