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
                        <h4 class="card-title">Create SDLC</h4>
                        <p class="card-description">
                          Put in the name and description of the SDLC
                        </p>
                        <form class="forms-sample" action="/admin/sdlc" method="POST">
                            @csrf
                          <div class="form-group">
                            <label for="exampleInputName1">Name</label>
                            <input type="text" class="form-control" id="acrnym" name="acrnym" placeholder="Name">
                            @if($errors->has('acrnym'))
                                <div class="error">{{ $errors->first('acrnym') }}</div>
                            @endif
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail3">Description</label>
                            <input type="text" class="form-control" id="desc" name="desc" placeholder="Name">
                            @if($errors->has('desc'))
                                <div class="error">{{ $errors->first('desc') }}</div>
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
