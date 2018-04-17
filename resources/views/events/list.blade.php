@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            View all events in the system
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url(config('backpack.base.route_prefix', 'ads')) }}">{{ config('backpack.base.project_name') }}</a>
            </li>
            <li class="active">All Events</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">


            <div class="box">
                <div class="box-header">
                    <a class="btn btn-success" href="/admin/events/create">Add Events </a>
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
                                style="width: 250px;">Title
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                style="width: 250px;">Date
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
                        @foreach($all as $one)
                            <tr role="row" class="odd">
                                <td class="sorting_1">
                                    <img src="{{$one->image}}" width="70%" height="80px"/>
                                </td>
                                <td>{{$one->title}}</td>
                                <td>{{$one->date}}</td>
                                <td>{{\App\Models\Eventscategory::find($one->category)->name}}</td>
                                <td>
                                    <a onclick="return confirm('are you sure you want to delete this Event ({{$one->title}})')"
                                       class="btn btn-success btn-sm" href="/admin/events/{{$one->id}}/delete">
                                        Delete
                                    </a>
                                    <a class="btn btn-success btn-sm" href="/admin/events/{{$one->id}}/tlist">
                                        Ticket List
                                    </a>

                                    <a class="btn btn-success btn-sm" href="/admin/events/{{$one->id}}/edit">
                                        Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        </tfoot>
                    </table>
                    {{$all->links()}}
                </div>
                <!-- /.box-body -->
            </div>


        </div>
    </div>
@endsection
