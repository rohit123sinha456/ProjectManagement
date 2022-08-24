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
                        <h4 class="card-title">Clients </h4>
                        <p class="card-description">
                          
                          <a href="/admin/resources/create"> <button type="submit" class="btn btn-outline-secondary btn-sm">Create</button> </a>

                        </p>
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
                                  {{$item['email']}}
                              </td>
                            
                                <td>
                                    <input type="hidden" name="courseid" id="courseid" value={{$item['id']}}>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                      <form action="/admin/resources/{{$item['id']}}" method="GET"> <button type="submit" class="btn btn-outline-secondary btn-sm">View</button> </form>
                                      <form action="/admin/resources/{{$item['id']}}/edit" method="GET"> @csrf<button type="submit" class="btn btn-outline-secondary btn-sm">Edit</button> </form>
                                      {{-- <form action="/admin/clresourcesients/{{$item['id']}}" method="POST">@csrf<button type="submit" class="btn btn-outline-secondary btn-sm">Delete</button> </form> --}}
                                    </div>
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