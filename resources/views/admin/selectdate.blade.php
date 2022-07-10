@include('layouts.header')
    <div class="container-scroller">
        @include('layouts.topnav')
    <div class="container-fluid page-body-wrapper">
    @include('layouts.navbar')
        <div class="main-panel">
            
            <div class="content-wrapper">
              <div class="row">

                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Analysis</h4>
                        
                            <div class="form-group">
                                
                                <form class="forms-sample" method="POST" action="/admin/selecteddate">
                                    @csrf
                                
                                  <label>From Date </label>
                                  <input type="date" class="form-control file-upload-info" id="fromdate" name="fromdate">
                                
                                  <label>To Date </label>
                                  <input type="date" class="form-control file-upload-info" id="todate" name="todate">


                                  <button class="file-upload-browse btn btn-primary" type="submit">Go</button>
                                  
                               
                                </form>

                               
                              </div>
                      
                        
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