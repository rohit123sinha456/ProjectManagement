@include('layouts.header')

    <div class="container-scroller">
        @include('layouts.topnav')
    <div class="container-fluid page-body-wrapper">
    @include('layouts.navbar')
        <div class="main-panel">
            <div class="content-wrapper">
              <div class="row">
                <div class="col-md-12 grid-margin">
                  <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                      <h3 class="font-weight-bold">Welcome {{$name}}</h3>
                      {{-- <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6> --}}
                    </div>
                    
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                  <div class="card tale-bg">
                    <div class="card-people mt-auto">
                      <img src="{{asset('images/admindash.svg')}}" alt="people">
                      <div class="weather-info">
                        <div class="d-flex">
                          <div class="ml-2">
                            <h4 class="location font-weight-normal">Welcome</h4>
                            <h6 class="font-weight-normal">{{$name}}</h6>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 grid-margin transparent">
                  <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent">
                      <div class="card card-tale">
                        <div class="card-body">
                          <p class="mb-4">Total Clients</p>
                          <p class="fs-30 mb-2">{{$client}}</p>
                          
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                      <div class="card card-dark-blue">
                        <div class="card-body">
                          <p class="mb-4">Total Objects</p>
                          <p class="fs-30 mb-2">{{$objects}}</p>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                      <div class="card card-light-blue">
                        <div class="card-body">
                          <p class="mb-4">Total Resources</p>
                          <p class="fs-30 mb-2">{{$users}}</p>
                          
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 stretch-card transparent">
                      <div class="card card-light-danger">
                        <div class="card-body">
                          <p class="mb-4">A Metric of Choice</p>
                          <p class="fs-30 mb-2">-</p>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i> by RS</span>
              </div>
            </footer>
            <!-- partial -->
          </div>
    </div>
    </div>
    </body>
</html>