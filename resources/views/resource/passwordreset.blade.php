@include('layouts.header')

    <div class="container-scroller">
        @include('resource.layouts.topnav')
    <div class="container-fluid page-body-wrapper">
    @include('resource.layouts.navbar')
        <div class="main-panel">
            <div class="content-wrapper">
              <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link" href="/resource/settings">Profile</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="#">Change Password</a>
                </li>
              </ul>
                       
              <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title"> </h4>
                        <p class="card-description">
                          
                        </p>
                        <form class="forms-sample" action="/resource/passwordreset" method="POST">
                          @csrf
                        <div class="form-group">
                          <label for="exampleInputName1">Password</label>
                          <input type="text" class="form-control" id="password" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                          <label for="exampleInputEmail3">Confirm Password</label>
                          <input type="text" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                      </form>
                      @if($errors->any())
                          {!! implode('', $errors->all('<div>:message</div>')) !!}
                      @endif
                      </div>
                    </div>
                  </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
              </div>
            </footer>
            <!-- partial -->
          </div>
    </div>
    </div>
    </body>
</html>