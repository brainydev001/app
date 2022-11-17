{{-- check for type and determine the form method and route --}}

<!-- Main content -->
<section class="content mt-3">
    <div class="row">
        <div class="col-md-6">
            {{-- project details --}}
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">General Information</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                            <i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    {{-- name --}}
                    <div class="form-group">
                        <label for="inputName">{{ $type }} Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>

                    {{-- descreption --}}
                    <div class="form-group">
                        <label for="inputDescription">Description</label>
                        <textarea name="description" class="form-control" rows="4"></textarea>
                    </div>

                    {{-- team leader --}}
                    <div class="form-group">
                        <label for="inputDescription">Team leader</label>
                        <input type="text" name="team_leader" class="form-control">
                    </div>
                </div>
                <!-- /.card-body -->
            </div>

            {{-- location card --}}
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">{{ $type }} Location</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
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
                        <select name="region" class="form-control region @error('region') form-invalid @enderror"
                            value="{{ old('region') }}">
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
                        <select name="constituency" class="form-control constituency @error('constituency') form-invalid @enderror"
                            value="{{ old('constituency') }}">
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
                        <select name="ward" class="form-control ward @error('ward') form-invalid @enderror"
                            value="{{ old('ward') }}">
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
            </div>
            <!-- /.card -->
        </div>

        <div class="col-md-6">
            {{-- project timeline --}}
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">{{ $type }} Timeline</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
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

            {{-- attachment --}}
            <div class="card card-secondary">
                <div class="card-header">
                    <h3 class="card-title">{{ $type }} Attachment(s)</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                            title="Collapse">
                            <i class="fas fa-minus"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    {{-- attachment --}}
                    <div class="form-group">
                        <label for="inputEstimatedBudget">{{ $type }} Files</label>
                        <input type="file" name="file" class="form-control">
                    </div>
                </div>
                <!-- /.card-body -->
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

<!-- /.content-wrapper -->
