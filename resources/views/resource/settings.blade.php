@include('layouts.header')

    <div class="container-scroller">
        @include('resource.layouts.topnav')
    <div class="container-fluid page-body-wrapper">
    @include('resource.layouts.navbar')
        <div class="main-panel">
            <div class="content-wrapper">
              <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link active" href="#">Profile</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/resource/passwordreset">Change Password</a>
                </li>
              </ul>
                       
              <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title"> </h4>
                        <p class="card-description">
                          
                        </p>
                        <div class="table-responsive">
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th>
                                    Particulars
                                  </th>
                                  <th>
                                    Details
                                  </th>
                                </tr>
                              </thead>
                              <tbody>
                              @foreach ($column as $colname)
                              <tr>
                                <td>
                                 {{$colname}}
                                </td>
                                <td>
                                 {{$item->$colname}}
                                </td>
                              </tr>
                              @endforeach
                                
                              </tbody>
                            </table>
                          </div>
                      </div>
                    </div>
                  </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021. </span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i> by RS</span>
              </div>
            </footer>
            <!-- partial -->
          </div>
    </div>
    </div>
    </body>
</html>