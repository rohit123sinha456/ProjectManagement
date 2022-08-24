@include('layouts.header')
    <div class="container-scroller">
        @include('resource.layouts.topnav')
    <div class="container-fluid page-body-wrapper">
    @include('resource.layouts.navbar')
        <div class="main-panel">
            <div class="content-wrapper">
              <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Timesheet Entry </h4>
                        <p class="card-description">
                          Once You Submit the values can't be updated anymore
                          @if($errors->any())
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach

                                @endif
                        </p>
                        <div class="table-responsive">
                          @if($nodate)
                          <form class="forms-sample" method="POST" action="/resource/viewtimesheetentry">
                            @csrf
                              <div class="input-group col-xs-12">
                                <input type="date" class="form-control file-upload-info" id="date" name="date">
                                <span class="input-group-append">
                                  <button class="file-upload-browse btn btn-primary" type="submit">Go</button>
                                </span>
                              </div>
                        </form>
                          @else
                          <form class="forms-sample" method="POST" action="/resource/submittimesheetentry">
                            @csrf
                            @if(count($entries) == 0)
                            No Data Found
                            @else
                          <table class="table table-striped" id="emptbl">
                            <thead>
                              <tr>
                                <th>
                                   Object
                                </th>
                                
                                <th>
                                  SDLC Stage
                                </th>
                               
                                <th>
                                  Hours
                                </th>

                               
                              </tr>
                            </thead>
                            <tbody>
                              @foreach ($entries as $entry)
                              <tr>
                                <td>
                                  <input type="hidden" class="form-control" id="tsid" name="tsid[]" value={{$entry->id}}>
                                  <input type="hidden" class="form-control" id="hours" name="oid[]" value={{$entry->object_id}}>
                                    {{$objects[$entry->object_id]}}
                                </td>

                                <td>
                                  <input type="hidden" class="form-control" id="hours" name="sdlc[]" value={{$entry->sdlcstep}}>
                                    {{$entry->sdlcstep}}
                                </td>
                            
                                <td>
                                  <div class="input-group col-xs-12">
                                    @if ($entry->is_submitted == 1)
                                    <label>{{$entry->hours}}</label>
                                    <input type="hidden" class="form-control" id="hours" name="hours[]" value={{$entry->hours}}>
                                    @else
                                    <input type="text" class="form-control" id="hours" name="hours[]" value={{$entry->hours}}>
                                        
                                    @endif
                                  </div>
                                </td>
                               
                              </tr>
                              @endforeach
                             
                            </tbody>
                            <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value='Submit' {{$entry->is_submitted == 1 ? 'disabled':''}}>

                          </table>
                          @endif
                          </form>
                        @endif
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