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
                        <h4 class="card-title">Clients </h4>
                        <p class="card-description">
                          
                          <a href="/pm/object/{{$clientid}}/create"> <button type="submit" class="btn btn-outline-secondary btn-sm">Create</button> </a>

                        </p>
                        @if ($clientcount === 0)
                            <p class="card-description">
                                No Object is Created for the Client. Create an Object
                            </p>
                        @else
                        <div class="table-responsive">
                          <table class="table table-striped">
                            <thead>
                              <tr>
                                <th>
                                   Name
                                </th>
                                
                                <th>
                                  Description
                                </th>

                                <th>
                                  State
                                </th>
                               
                                <th>
                                  Actions
                                </th>
                               
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($clients as $item)
                              <tr>
                                <td>
                                 {{$item['name']}}
                                </td>
                                <td>
                                  {{$item['description']}}
                              </td>
                              <td>
                                {{$item['state']}}
                            </td>
                            
                                <td>

                                  @if ($item['state'] === 'running')
                                  <p class="card-description">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                      <form action="/pm/object/view/{{$item['id']}}" method="GET"> <button type="submit" class="btn btn-outline-secondary btn-sm">View</button> </form>
                                      <form action="/pm/object/updatestatecomplete/{{$item['id']}}" method="GET"> <button type="submit" class="btn btn-outline-secondary btn-sm">Complete</button> </form>
                                    </div>
                                  </p>
                                  @elseif ($item['state'] === 'reverted')
                                  <p class="card-description">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                      <form action="/pm/object/view/{{$item['id']}}" method="GET"> <button type="submit" class="btn btn-outline-secondary btn-sm">View</button> </form>
                                      <form action="/pm/object/updatestaterunning/{{$item['id']}}" method="GET"> <button type="submit" class="btn btn-outline-secondary btn-sm">Accept</button> </form>
                                      <form action="/pm/object/updatestaterejected/{{$item['id']}}" method="GET"> <button type="submit" class="btn btn-outline-secondary btn-sm">Reject</button> </form>
                                    </div>
                                  </p>
                                  @else
                                  <form action="/pm/object/view/{{$item['id']}}" method="GET"> <button type="submit" class="btn btn-outline-secondary btn-sm">View</button> </form>
                                    @endif

                                </td>
                              </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </div>
                        @endif
                      </div>
                    </div>
                  </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            <footer class="footer">
              <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021. </span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i>by RS</span>
              </div>
            </footer>
            <!-- partial -->
          </div>
    </div>
    </div>
    </body>
</html>