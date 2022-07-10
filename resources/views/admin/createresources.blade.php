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
                        <h4 class="card-title">Create Clients</h4>
                        <p class="card-description">
                          Put in the name and description of the clients
                        </p>
                        <form class="forms-sample" action="/admin/resources" method="POST">
                            @csrf
                          <div class="form-group">
                            <label for="exampleInputName1">Name</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Name">
                          </div>
                          <div class="form-group">
                            <label for="exampleInputEmail3">Content</label>
                            <textarea type="text" class="form-control" id="content" name="content" placeholder="Description"></textarea>
                          </div>
                          
                          <div class="form-group">
                            <label for="exampleFormControlSelect1">Project Manager</label>
                            <select class="form-control form-control-lg" id="pmid" name="pmid">
                                @foreach ($pm as $item)
                                <option value={{$item['id']}}>{{$item['name']}}</option>
                                @endforeach
                            </select>
                          </div>
                          <button type="submit" class="btn btn-primary mr-2">Submit</button>
                          <button class="btn btn-light">Cancel</button>
                        </form>
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
