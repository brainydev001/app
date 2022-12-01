{{-- user datatable --}}

{{-- data card --}}
<div class="card">

    {{-- heading --}}
    <div class="card-header">
        <h3 class="card-title">Data-table showing all {{ ucfirst($type) }}s</h3>
    </div>

    {{-- body --}}
    <div class="card-body">

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    <th>Age</th>
                    @if ($type == 'kin')
                        <th>I.D Number</th>
                    @endif
                    @if ($type != 'kin')
                        <th>County</th>
                        <th>Sub County</th>
                        <th>Region</th>
                    @endif
                    @if ($type == 'kin')
                        <th>Related to</th>
                    @endif
                    <th>Online status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($users) && count($users) > 0)
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->phone_number }}</td>
                            <td>{{ $user->age }}</td>
                            @if ($type == 'kin')
                                <td>{{ $user->id_number }}</td>
                            @endif
                            @if ($type != 'kin')
                                <td>{{ $user->county }}</td>
                                <td>{{ $user->sub_county }}</td>
                                <td>{{ $user->userRegion->name }}</td>
                            @endif
                            @if ($type == 'kin')
                                <td>
                                    {{ $user->userKin->first_name }}
                                    {{ $user->userKin->last_name }}
                                </td>
                            @endif
                            @if ($type != 'kin' && Cache::has('user-is-online-' . $user->id) )
                                <td class="text-success">Online</td>
                            @else
                                <td class="text-danger">Offline</td>
                            @endif
                            <td>
                                <a href="">
                                    <span>View</span>
                                    <span class="ml-2">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <p class="font-weight-bold"> No user has been registered in this category!</p>
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Phone Number</th>
                    @if ($type == 'kin')
                        <th>I.D Number</th>
                    @endif
                    @if ($type != 'kin')
                        <th>County</th>
                        <th>Sub County</th>
                        <th>Region</th>
                    @endif
                    @if ($type == 'kin')
                        <th>Related to</th>
                    @endif
                    <th>Online status</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
