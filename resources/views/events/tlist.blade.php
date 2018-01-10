@extends('backpack::layout')

@section('header')
    <section class="content-header">

        <h1>
            View all purchased ticket for {{$id->title}}
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url(config('backpack.base.route_prefix', 'ads')) }}">{{ config('backpack.base.project_name') }}</a>
            </li>
            <li class="active">All tickets</li>
        </ol>
    </section>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">


            <div class="box">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="crudTable" class="table table-bordered table-striped dataTable" role="grid"
                           aria-describedby="example1_info">
                        <thead>
                        <tr role="row">
                            <th class="sorting_asc" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                style="width: 230px;">Id
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                style="width: 250px;">Email
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                style="width: 250px;">Qty
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                style="width: 250px;">Ticket Type
                            </th>
                            <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1"
                                style="width: 145px;">Date Purchased
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($get_all as $one)
                            <tr role="row" class="odd">
                                <td class="sorting_1">
                                    {{$one->id}}
                                </td>
                                <td>
                                    {{$one->email}}
                                </td>
                                <td>
                                    {{$one->qty}}
                                </td>
                                <td>
                                    {{$one->ticket->name}}
                                </td>
                                <td>
                                    {{$one->created_at}}
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
