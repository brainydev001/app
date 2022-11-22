{{-- check for type and determine the form method and route --}}

@if ($type == 'Activity' || $type == 'Event')
    <!-- Main content for events and activities-->
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
                            <select name="constituency"
                                class="form-control constituency @error('constituency') form-invalid @enderror"
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

                {{-- attachment --}}
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">{{ $type }} Attachment(s)</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                data-toggle="tooltip" title="Collapse">
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
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Estimated budget</span>
                                        <span class="info-box-number text-center text-muted mb-0">2300</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Total amount spent</span>
                                        <span class="info-box-number text-center text-muted mb-0">2000</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                <div class="info-box bg-light">
                                    <div class="info-box-content">
                                        <span class="info-box-text text-center text-muted">Estimated project
                                            duration</span>
                                        <span class="info-box-number text-center text-muted mb-0">20 <span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <h4>Recent Activity</h4>
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg"
                                            alt="user image">
                                        <span class="username">
                                            <a href="#">Jonathan Burke Jr.</a>
                                        </span>
                                        <span class="description">Shared publicly - 7:45 PM today</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore.
                                    </p>

                                    <p>
                                        <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i>
                                            Demo File 1 v2</a>
                                    </p>
                                </div>

                                <div class="post clearfix">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg"
                                            alt="User Image">
                                        <span class="username">
                                            <a href="#">Sarah Ross</a>
                                        </span>
                                        <span class="description">Sent you a message - 3 days ago</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore.
                                    </p>
                                    <p>
                                        <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i>
                                            Demo File 2</a>
                                    </p>
                                </div>

                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="../../dist/img/user1-128x128.jpg"
                                            alt="user image">
                                        <span class="username">
                                            <a href="#">Jonathan Burke Jr.</a>
                                        </span>
                                        <span class="description">Shared publicly - 5 days ago</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>
                                        Lorem ipsum represents a long-held tradition for designers,
                                        typographers and the like. Some people hate it and argue for
                                        its demise, but others ignore.
                                    </p>

                                    <p>
                                        <a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i>
                                            Demo File 1 v1</a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                        <h3 class="text-primary"><i class="fas fa-paint-brush"></i> AdminLTE v3</h3>
                        <p class="text-muted">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt
                            tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi,
                            qui irure terr.</p>
                        <br>
                        <div class="text-muted">
                            <p class="text-sm">Client Company
                                <b class="d-block">Deveint Inc</b>
                            </p>
                            <p class="text-sm">Project Leader
                                <b class="d-block">Tony Chicken</b>
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
                                <a href="" class="btn-link text-secondary"><i class="far fa-fw fa-image "></i>
                                    Logo.png</a>
                            </li>
                            <li>
                                <a href="" class="btn-link text-secondary"><i
                                        class="far fa-fw fa-file-word"></i> Contract-10_12_2014.docx</a>
                            </li>
                        </ul>
                        <div class="text-center mt-5 mb-3">
                            <a href="#" class="btn btn-sm btn-primary">Add files</a>
                            <a href="#" class="btn btn-sm btn-warning">Report contact</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
    <!-- /.content-wrapper -->
@endif

<!-- /.content-wrapper -->
