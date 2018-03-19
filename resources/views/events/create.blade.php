@extends('backpack::layout')

@section('header')
    <section class="content-header">
        <h1>
            Create a new Event in the system
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url(config('backpack.base.route_prefix', 'ads')) }}">{{ config('backpack.base.project_name') }}</a>
            </li>
            <li class="active">Events</li>
        </ol>
    </section>
@endsection


@section('content')
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css"/>

    <div class="row">
        <div class="col-md-12">


            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">Create New Event</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Title</label>

                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control" id="inputEmail3"
                                       placeholder="Title/Name of Event" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Organizer of event</label>

                            <div class="col-sm-10">
                                <input type="text" name="organizer" class="form-control" id="inputEmail3"
                                       placeholder="Organizer of Event e.g (Cool FM)" required>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label" name="description"
                                   placeholder="description">Description</label>

                            <div class="col-sm-10">
                                <textarea name="description" class="form-control" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label" name="date"
                                   placeholder="date and time">Date</label>

                            <div class="col-sm-10">
                                <input type="text" name="date" class="form-control" id="daepicker" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label" name="date"
                                   placeholder="Venue of the event">Venue</label>

                            <div class="col-sm-10">
                                <textarea name="venue" class="form-control" required></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Event Image</label>

                            <div class="col-sm-10">
                                <input type="file" name="image" class="form-control" id="inputEmail3" required>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Event Category</label>

                            <div class="col-sm-10">
                                <select name="category" id="category" class="form-control" required>
                                    <option value="" selected disabled>Select a category</option>
                                    @foreach(App\Models\Eventscategory::all() as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group">

                            <label for="inputEmail3" class="col-sm-2 control-label">Ticket Types</label>

                            <div class="col-sm-10">
                                <div class="col-md-12" id="parent">
                                    <div id="child" class="child" style="margin-bottom: 20px">
                                        <div class="col-md-6">
                                            <input type="text" name="ticket_name[]" class="form-control"
                                                   placeholder="Name" required/>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" name="ticket_price[]" class="form-control"
                                                   placeholder="Price" required/>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="number" name="amount[]" class="form-control"
                                                   placeholder="Amount of tickets available" required/>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="number" name="discount[]" class="form-control"
                                                   placeholder="Discount on ticket in % (Optional)"/>
                                        </div>

                                        <!--  <div class="col-md-8">

                                              <input type="file"  name="ticket_image[]" class="form-control" id="inputEmail3"  required>
                                          </div> -->

                                    </div>
                                </div>
                            </div>


                        </div>
                        <div class="col-md-1 pull-right form-group">
                            <button type="button" class="btn btn-info" onclick="add_c()">Add</button>

                        </div>

                    </div>


                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button type="submit" class="btn btn-info pull-right">Save Event</button>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>


        </div>
    </div>
    <script>
        window.onload = function () {
            $('#daepicker').datetimepicker();
        };

        function add_c() {
            var child = document.getElementsByClassName('child')[0].innerHTML;
            document.getElementById('parent').innerHTML = document.getElementById('parent').innerHTML + child;
        }
    </script>

@endsection

