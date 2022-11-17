{{-- logs datatable --}}

{{-- data card --}}
<div class="card">

    {{-- heading --}}
    <div class="card-header">
        <h3 class="card-title">Data-table showing all user logs</h3>
    </div>

    {{-- body --}}
    <div class="card-body">

        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Log Details</th>
                    <th>User</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>

                @if (count($logs) > 0)
                    @foreach ($logs as $log)
                        {{-- item --}}
                        <tr>
                            <td>
                                <p>
                                    {{ $log->origin }}
                                </p>
                            </td>
                            <td>
                                {{ $log->userLogs->first_name }}
                                {{ $log->userLogs->last_name }}
                            </td>
                            <td>{{ $log->created_at->diffForHumans() }}</td>
                        </tr>
                    @endforeach
                @else
                <p>
                    No user logs available
                </p>
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <th>Log Details</th>
                    <th>User</th>
                    <th>Created At</th>
                </tr>
            </tfoot>
        </table>
    </div>
    <!-- /.card-body -->
</div>
