{{-- activity or event or module datatable --}}

{{-- data card --}}
<div class="card">

    {{-- heading --}}
    <div class="card-header">
        <h3 class="card-title">Data-table</h3>
    </div>

    {{-- body --}}
    <div class="card-body">

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    @if ($type == 'Event' || $type == 'Activity')
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>County</th>
                        <th>Region</th>
                    @endif
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

                @if (count($datas) > 0)
                    @foreach ($datas as $data)
                        {{-- item --}}
                        <tr>
                            <td>{{ $data->name }}</td>
                            @if ($type == 'Event' || $type == 'Activity')
                                <td>{{ $data->start_date }}</td>
                                <td>{{ $data->end_date }}</td>
                                <td>{{ $data->county }}</td>
                                <td>{{ $data->regions->name }}</td>
                            @endif
                            <td>{{ $data->created_at }}</td>
                            <td class="border-none d-flex">
                                <a href="{{ route ('module_view', [$data->id, $type]) }}" class="ml-4">
                                    <i class="fa fa-eye text-green"></i>
                                </a> 
                                <a href="{{ url('module_edit/' . $data->id) }}" class="ml-4">
                                    <i class="fa fa-edit text-blue"></i>
                                </a>
                                <a href="{{ url('module_delete/' . $data->id) }}" class="ml-4">
                                    <i class="fa fa-trash text-red"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    Opps No {{ $type }} Found !!!.
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    @if ($type == 'Event' || $type == 'Activity')
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>County</th>
                        <th>Region</th>
                    @endif
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
