@extends('layouts.admin')
@section('content')
    <div class="content">
        <div class="row">
            <div class="col-lg-12">
                <x-latest-advert />
            </div>
        </div>
    </div>
    </div>
@endsection
@section('scripts')
    @parent
@endsection
