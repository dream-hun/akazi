@extends('layouts.admin')
@section('content')
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.subscriber.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class=" table table-bordered table-striped table-hover datatable datatable-Subscriber">
                    <thead>
                        <tr>

                            <th>
                                {{ trans('cruds.subscriber.fields.name') }}
                            </th>
                            <th>
                                {{ trans('cruds.subscriber.fields.email') }}
                            </th>
                            <th>
                                {{ trans('cruds.subscriber.fields.status') }}
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subscribers as $key => $subscriber)
                            <tr>

                                <td>
                                    {{ $subscriber->name ?? '' }}
                                </td>
                                <td>
                                    {{ $subscriber->email ?? '' }}
                                </td>
                                <td>
                                    {{ App\Models\Subscriber::STATUS_SELECT[$subscriber->status] ?? '' }}
                                </td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            let table = $('.datatable-Subscriber:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
