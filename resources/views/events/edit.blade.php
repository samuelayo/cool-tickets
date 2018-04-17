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
                    <h3 class="box-title">Edit event {{$event->title}}</h3>
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
                                       placeholder="Title/Name of Event" value="{{$event->title}}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Organizer of event</label>

                            <div class="col-sm-10">
                                <input type="text" name="organizer" class="form-control" id="inputEmail3"
                                       placeholder="Organizer of Event e.g (Cool FM)" value="{{$event->organizer}}" required>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label" name="description"
                                   placeholder="description">Description</label>

                            <div class="col-sm-10">
                                <textarea name="description" class="form-control"  required>{{$event->description}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label" name="date"
                                   placeholder="date and time">Date</label>

                            <div class="col-sm-10">
                                <input type="text" name="date" class="form-control" id="daepicker" value="{{$event->date}}" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputPassword3" class="col-sm-2 control-label" name="date"
                                   placeholder="Venue of the event">Venue</label>

                            <div class="col-sm-10">
                                <textarea name="venue" class="form-control" required >{{$event->venue}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Event Image</label>

                            <div class="col-sm-10">
                            <img src="{{$event->image}}" width="70%" height="80px"/>
                                <input type="file" name="image" class="form-control" id="inputEmail3" >
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="inputEmail3" class="col-sm-2 control-label">Event Category</label>

                            <div class="col-sm-10">
                                <select name="category" id="category" class="form-control" required>
                                    <option value="" selected disabled>Select a category</option>
                                    @foreach(App\Models\Eventscategory::all() as $item)
                                        @if($item->id == $event->category)
                                            <option value="{{$item->id}}" selected>{{$item->name}}</option>
                                        @else
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endif                                     
                                        
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group">

                            <label for="inputEmail3" class="col-sm-2 control-label">Ticket Types</label>
                            
                            
                            <div class="col-sm-10">
                            
                                <div class="col-md-12" id="parent">
                                @foreach($event->tickets as $ticket)
                                    <div id="child" class="child" style="margin-bottom: 20px">
                                    <input type="hidden" name="ticket_id[]" value="{{$ticket->id}}" />
                                        <div class="col-md-6">
                                            <input type="text" name="ticket_name[]" class="form-control"
                                                   placeholder="Name" value="{{$ticket->name}}" required/>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="number" name="ticket_price[]" class="form-control"
                                                   placeholder="Price" value="{{$ticket->price}}" required/>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="number" name="amount[]" class="form-control"
                                                   placeholder="Amount of tickets available" value="{{$ticket->amount}}" required/>
                                        </div>
                                        <div class="col-md-12">
                                            <input type="number" name="discount[]" class="form-control"
                                                   placeholder="Discount on ticket in % (Optional)" value="{{$ticket->discount}}"/>
                                        </div>

                                        <!--  <div class="col-md-8">

                                              <input type="file"  name="ticket_image[]" class="form-control" id="inputEmail3"  required>
                                          </div> -->

                                    </div>
                                    <div style="margin-bottom: 10px">---</div>
                                    @endforeach
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
            var theKid = document.createElement("div");
            theKid.innerHTML = child + '<div style="margin-bottom: 10px">---</div>';
            var theParent =  document.getElementById('parent');
            theKid.children[0].value="";
            theParent.appendChild(theKid);
        }
    </script>

@endsection

