@include('layouts.header')

    <div class="container-scroller">
        @include('layouts.topnav')
    <div class="container-fluid page-body-wrapper">
    @include('pm.layouts.navbar')
        <div class="main-panel">
            <div class="content-wrapper">
              <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">{{$item['name']}} </h4>
                        <p class="card-description">
                         {{$item['description']}}
                        </p>

                        <p>
                          <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample1" aria-expanded="false" aria-controls="multiCollapseExample1"> Details</button>
                          <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2"> Effort Estimate</button>
                        </p>
                     
                          
                            <div class="collapse multi-collapse" id="multiCollapseExample1">  
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
                               {{$item[$colname]}}
                              </td>
                            </tr>
                            @endforeach
                              
                            </tbody>
                          </table>
                        </div>
                            </div>
                          
                          


                            <div class="collapse multi-collapse" id="multiCollapseExample2">
                              @if ($estimate === null)
                                  Create an extimate of the object
                              @else
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
                                  @foreach ($estimatecols as $estcolname)
                                  <tr>
                                    <td>
                                     {{$estcolname}}
                                    </td>
                                    <td>
                                     {{$estimate[$estcolname]}}
                                    </td>
                                  </tr>
                                  @endforeach
                                    
                                  </tbody>
                                </table>
                                
                                @if ($item['state'] === 'running')
                                <p class="card-description">
                                  <div class="btn-group" role="group" aria-label="Basic example">
                                    <form action="/pm/object/updatestatecomplete/{{$item['id']}}" method="GET"> <button type="submit" class="btn btn-outline-secondary btn-sm">Complete</button> </form>
                                  </div>
                                </p>
                                @elseif ($item['state'] === 'reverted')
                                <p class="card-description">
                                  <div class="btn-group" role="group" aria-label="Basic example">
                                    <form action="/pm/object/updatestaterunning/{{$item['id']}}" method="GET"> <button type="submit" class="btn btn-outline-secondary btn-sm">Accept</button> </form>
                                    <form action="/pm/object/updatestaterejected/{{$item['id']}}" method="GET"> <button type="submit" class="btn btn-outline-secondary btn-sm">Reject</button> </form>
                                  </div>
                                </p>
                                @else
                                hello
                                  @endif
                              </div>


                              @endif
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