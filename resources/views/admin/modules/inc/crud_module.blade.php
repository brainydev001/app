{{-- check for type and determine the form method and route --}}

@if ($type == 'Activity' || $type == 'Event')
    <form action="{{ route('store', $type) }}" method="post">
        @csrf
        <!-- Main content for events and activities-->
        <section class="content m-3">
            <div class="row">
                <div class="col-md-6">
                    {{-- project details --}}
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">General Information</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                    data-toggle="tooltip" title="Collapse">
                                    <i class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- name --}}
                            <div class="form-group">
                                <label for="inputName">{{ $type }} Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>

                            {{-- description --}}
                            <div class="form-group">
                                <label for="inputDescription">Description</label>
                                <textarea name="description" class="form-control" rows="4"></textarea>
                            </div>

                            {{-- team leader --}}
                            <div class="form-group">
                                <label for="inputDescription">Team leader</label>
                                <select name="staff_id" class="form-control">
                                    <option value="" disabled></option>
                                    @if (count($staffs))
                                        @foreach ($staffs as $staff)
                                            <option value="{{ $staff->id }}">{{ $staff->first_name }}
                                                {{ $staff->last_name }}</option>
                                        @endforeach
                                    @else
                                        <option value="" disabled></option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>

                    {{-- timeline details --}}
                    <div class="card card-warning">
                        {{-- project timeline --}}
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">{{ $type }} Timeline</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        data-toggle="tooltip" title="Collapse">
                                        <i class="fas fa-minus"></i></button>
                                </div>
                            </div>
                            <div class="card-body">
                                {{-- start date --}}
                                <div class="form-group">
                                    <label for="inputEstimatedBudget">Start Date & Time</label>
                                    <input type="datetime-local" name="start_date" class="form-control">
                                </div>

                                {{-- end date --}}
                                <div class="form-group">
                                    <label for="inputEstimatedBudget">End Date & Time</label>
                                    <input type="datetime-local" name="end_date" class="form-control">
                                </div>
                            </div>

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card-body -->
                    </div>

                    <!-- /.card -->
                </div>

                {{-- project location --}}
                {{-- location card --}}
                <div class="card card-warning col-md-6 ">
                    <div class="card-header">
                        <h3 class="card-title">{{ $type }} Location</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                data-toggle="tooltip" title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- county --}}
                        <div class="form-group">
                            <label for="inputDescription">County</label>
                            <select name="county"
                                class="form-control select-county @error('county') form-invalid @enderror"
                                value="{{ old('county') }}">
                                <option value="" disabled selected>Select county</option>
                            </select>
                        </div>

                        {{-- sub-county --}}
                        <div class="form-group">
                            <label for="inputDescription">Sub County</label>
                            <select name="sub_county"
                                class="form-control select-subcounty @error('sub_county') form-invalid @enderror"
                                value="{{ old('sub_county') }}">
                                <option value="" disabled selected>Select subcounty</option>
                            </select>
                        </div>

                        {{-- region --}}
                        <div class="form-group">
                            <label for="inputDescription">Region</label>
                            <select name="region_id"
                                class="form-control region_id @error('region_id') form-invalid @enderror"
                                value="{{ old('region_id') }}">
                                <option value="" disabled selected>Select region</option>
                                @if (count($regions) > 0)
                                    @foreach ($regions as $region)
                                        <option value="{{ $region->id }}">{{ $region->name }}</option>
                                    @endforeach
                                @else
                                    <option value="" disabled selected>Select region</option>
                                @endif
                            </select>
                        </div>

                        {{-- contituency --}}
                        <div class="form-group">
                            <label for="inputDescription">Constituency</label>
                            <select name="constituency_id"
                                class="form-control constituency_id @error('constituency_id') form-invalid @enderror"
                                value="{{ old('constituency_id') }}">
                                <option value="" disabled selected>Select constituency</option>
                                @if (count($constituencies) > 0)
                                    @foreach ($constituencies as $constituency)
                                        <option value="{{ $constituency->id }}">{{ $constituency->name }}</option>
                                    @endforeach
                                @else
                                    <option value="" disabled selected>Select constituency</option>
                                @endif
                            </select>
                        </div>

                        {{-- ward --}}
                        <div class="form-group">
                            <label for="inputDescription">Ward</label>
                            <select name="ward_id" class="form-control ward_id @error('ward_id') form-invalid @enderror"
                                value="{{ old('ward_id') }}">
                                <option value="" disabled selected>Select ward</option>
                                @if (count($wards) > 0)
                                    @foreach ($wards as $ward)
                                        <option value="{{ $ward->id }}">{{ $ward->name }}</option>
                                    @endforeach
                                @else
                                    <option value="" disabled selected>Select ward</option>
                                @endif
                            </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
                    {{-- hidden inputs --}}
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="created_by" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="updated_by" value="{{ auth()->user()->id }}">
                </div>

                <!-- /.card -->
            </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="#" class="btn btn-secondary">Cancel</a>
                    <input type="submit" value="Create {{ $type }}" class="btn btn-success float-right">
                </div>
            </div>
        </section>
        <!-- /.content -->
    </form>
@else
    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{ $type }} Detail</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                        <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip"
                        title="Remove">
                        <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body m-2 p-3">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                        <div class="row">
                            <div class="col-12">
                                <h4>Module Activities and Events</h4>
                                {{-- cards --}}
                                <form action="{{ route('create_module') }}" method="POST">
                                    @csrf
                                    <!-- /.card -->
                                    <div class="card card-primary card-outline">
                                        <div class="card-body">
                                            <h4>Input Forms</h4>
                                            <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="custom-content-below-home-tab"
                                                        data-toggle="pill" href="#custom-content-below-home"
                                                        role="tab" aria-controls="custom-content-below-home"
                                                        aria-selected="true">Name</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-content-below-profile-tab"
                                                        data-toggle="pill" href="#custom-content-below-profile"
                                                        role="tab" aria-controls="custom-content-below-profile"
                                                        aria-selected="false">Activites</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-content-below-messages-tab"
                                                        data-toggle="pill" href="#custom-content-below-messages"
                                                        role="tab" aria-controls="custom-content-below-messages"
                                                        aria-selected="false">Events</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="custom-content-below-settings-tab"
                                                        data-toggle="pill" href="#custom-content-below-settings"
                                                        role="tab" aria-controls="custom-content-below-settings"
                                                        aria-selected="false">Modules</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="custom-content-below-tabContent">
                                                <div class="tab-pane fade show active" id="custom-content-below-home"
                                                    role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                                                    {{-- module name --}}
                                                    <div class="p-3">
                                                        <label for="">Milestone Name</label>
                                                        <input type="text" name="file" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="custom-content-below-profile"
                                                    role="tabpanel"
                                                    aria-labelledby="custom-content-below-profile-tab">
                                                    <div class="p-3">
                                                        <label for="">Activities</label>
                                                        @if (count($activites) > 0)
                                                            <div class="row">
                                                                @foreach ($activites as $activity)
                                                                    <div class="col-4">
                                                                        <label for="">{{ $activity->name }}
                                                                            <input type="checkbox"
                                                                                name="activity_id[]"
                                                                                value="{{ $activity->id }}">
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @else
                                                            No Activities Recorded
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="custom-content-below-messages"
                                                    role="tabpanel"
                                                    aria-labelledby="custom-content-below-messages-tab">
                                                    <div class="p-3">
                                                        <label for="">Events</label>
                                                        @if (count($events) > 0)
                                                            <div class="row">
                                                                @foreach ($events as $event)
                                                                    <div class="col-4">
                                                                        <label for="">{{ $event->name }}
                                                                            <input type="checkbox" name="event_id[]"
                                                                                value="{{ $activity->id }}">
                                                                        </label>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        @else
                                                            No Events Recorded
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="tab-pane fade" id="custom-content-below-settings"
                                                    role="tabpanel"
                                                    aria-labelledby="custom-content-below-settings-tab">
                                                    <div class="p-3">
                                                        <label for="">Module Name</label>
                                                        <select name="relation_id" class="form-control">
                                                            @if (count($milestones) > 0)
                                                                @foreach ($milestones as $module)
                                                                    <option value="{{ $module->id }}" class="text-black">
                                                                        {{ $module->name }} </option>
                                                                @endforeach
                                                        </select>
                                                    @else
                                                        <input type="text" class="form-control" name="relation_id"
                                                            value="null">
@endif
</div>
<div class="text-right">
    <button class="btn btn-warning" type="submit">
        Submit
    </button>
</div>
</div>
</div>
</div>
<!-- /.card -->
</div>
<!-- /.card -->
</form>
</div>
</div>
</div>
</div>
</div>
<!-- /.card-body -->
</div>

</section>
<!-- /.content -->
<!-- /.content-wrapper -->
@endif

<!-- /.content-wrapper -->
