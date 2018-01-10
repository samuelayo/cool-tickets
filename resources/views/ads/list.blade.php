@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            View all adverts in the system
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url(config('backpack.base.route_prefix', 'ads')) }}">{{ config('backpack.base.project_name') }}</a>
            </li>
            <li class="active">All Adverts</li>
        </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">


            <div class="box">
                <div class="box-header">
                    <a class="btn btn-success" href="/admin/ads">Add Advert </a>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="crudTable" class="table table-bordered table-striped dataTable" role="grid"
                           aria-describedby="example1_info">
                        <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                style="width: 230px;">Image
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                style="width: 250px;">Alt
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                style="width: 250px;">Category
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                style="width: 145px;">Actions
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($ads as $ad)
                            <tr role="row" class="odd">
                                <td class="sorting_1">
                                    <img src="/{{$ad->image_url}}" width="60px" height="60px"/>
                                </td>
                                <td>{{$ad->alt}}</td>
                                <td>{{$ad->advert_category->type}}</td>
                                <td>
                                    <a class="btn btn-success btn-sm" href="/admin/adslist/{{$ad->id}}/edit">
                                        Edit
                                    </a>
                                    <a class="btn btn-success btn-sm" href="/admin/adslist/{{$ad->id}}/delete">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>


        </div>
    </div>
@endsection
