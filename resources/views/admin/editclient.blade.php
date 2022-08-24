@include('layouts.header')

    <div class="container-scroller">
        @include('layouts.topnav')
    <div class="container-fluid page-body-wrapper">
    @include('layouts.navbar')
        <div class="main-panel">
            <div class="content-wrapper">
              <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Edit Client</h4>
                        <p class="card-description">
                          Put in the name and description of the clients
                        </p>
                        <form class="forms-sample" action="/admin/clients/{{$clientinfo['id']}}" method="POST">
                            @method('PUT')
                            @csrf
                          <div class="form-group">
                            <label for="exampleInputName1">Name</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Name" value="{{$clientinfo['name']}}">
                            @if($errors->has('title'))
                                <div class="error">{{ $errors->first('title') }}</div>
                            @endif
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail3">Content</label>
                            <input type="text" class="form-control" id="description" name="description" placeholder="description" value="{{$clientinfo['description']}}"/>
                            @if($errors->has('description'))
                                <div class="error">{{ $errors->first('description') }}</div>
                            @endif
                          </div>
                          
                          <div class="form-group">
                            <label for="exampleFormControlSelect1">Project Manager</label>
                            <select class="form-control form-control-lg" id="pmid" name="pmid">
                                @foreach ($allusers as $item)
                                <option value={{$item->id}} {{ ($pminfo->id == $item->id ? "selected":"") }}>{{$item->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('pmid'))
                                <div class="error">{{ $errors->first('pmid') }}</div>
                            @endif
                          </div>
                          <button type="submit" class="btn btn-primary mr-2">Submit</button>
                          {{-- <button class="btn btn-light">Cancel</button> --}}
                          <button class="btn btn-light" onclick="history.back()">Cancel</button>

                        </form>
                      </div>
                    </div>
                  </div>
                
                <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
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
