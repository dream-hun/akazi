<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header"><i class="fa fa-align-justify"></i> Latest Adverts</div>
            <div class="card-body">
                <table class="table table-responsive-sm table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Company</th>
                            <th>Deadline</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($adverts as $advert)
                            <tr>
                                <td>{{ $advert->title }}</td>
                                <td>{{ $advert->company->name }}</td>
                                <td>{{ $advert->deadline }}</td>
                                <td><span
                                        class="badge badge-success">{{ App\Models\Advert::STATUS_SELECT[$advert->status] ?? '' }}</span>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>
        </div>
    </div>
