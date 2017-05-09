 @extends('backpack::layout')

@section('header')
    <section class="content-header">
      <h1>
       Create a new advert in the system
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url(config('backpack.base.route_prefix', 'ads')) }}">{{ config('backpack.base.project_name') }}</a></li>
        <li class="active">Adverts</li>
      </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
           

        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Create New Advert</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form class="form-horizontal" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Url</label>

                  <div class="col-sm-10">
                    <input type="text" name="url" value="{{$id->url}}" class="form-control" id="inputEmail3" placeholder="url to be redirected to on click" required>
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-2 control-label">Alt</label>

                  <div class="col-sm-10">
                    <input type="text" name="alt" class="form-control" value="{{$id->alt}}" id="inputPassword3" placeholder="Alt caption for advert" required>
                  </div>
                </div>
               
               <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Advert Image</label>

                  <div class="col-sm-10">
                    <input type="file" name="image" class="form-control" id="inputEmail3" >
                    <img src="/{{$id->image_path}}"/>
                  </div>
                </div>


               <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label">Advert Category</label>

                  <div class="col-sm-10">
                    <select name="advert_category" class="form-control" required>
                    @foreach($categories as $cat)
                    <option value="{{$cat->id}}">{{$cat->type}}</option>
                    @endforeach
                    </select>
                  </div>
                </div>
               
               
            </div>

              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Save Advert</button>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>



        </div>
    </div>
@endsection
