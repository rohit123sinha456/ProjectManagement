@include('layouts.header')

    <div class="container-scroller">
        @include('layouts.topnav')
    <div class="container-fluid page-body-wrapper">
    @include('pm.layouts.navbar')
        <div class="main-panel">
            <div class="content-wrapper">
              <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Create Object</h4>
                        <p class="card-description">
                          Put in the name and description of the Object
                        </p>
                        <form class="forms-sample" action="/pm/object/create" method="POST">
                            @csrf
                          <div class="form-group">
                            <label for="exampleInputName1">Name</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Name">
                            @error('title')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail3">Description</label>
                            <textarea type="text" class="form-control" id="content" name="content" placeholder="Description"></textarea>
                            @error('content')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          
                          <div class="form-group">
                            
                            <input type="hidden" class="form-control" id="clientid" name="clientid" value="{{$clientid}}"/>
                          </div>


                          <div class="form-group">
                            <label for="exampleFormControlSelect1">Primary Resource</label>
                            <select class="form-control form-control-lg" id="prid" name="prid">
                                @foreach ($pm as $item)
                                <option value={{$item->id}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                            @error('prid')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                          </div>
                          <div class="form-group">
                            <label>Secondary Resource</label>
                            <select class="js-example-basic-multiple w-100" multiple="multiple" id="srid" name="srid[]">
                              @foreach ($pm as $item)
                                <option value={{$item->id}}>{{$item->name}}</option>
                                @endforeach
                            </select>
                          </div>
                          <button type="submit" class="btn btn-primary mr-2">Submit</button>
                          <button class="btn btn-light"  onclick="history.back()">Cancel</button>
                        </form>
                        
                      </div>
                    </div>
                  </div>
                
                <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
              <script src="{{  asset('js/select2.js')}}"></script>
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i> by RS</span>
              </div>
            </footer>
            <!-- partial -->
          </div>
    </div>
    </div>
    </body>
</html>
