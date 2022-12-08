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
                        @if($iscreatesdlcmodel == true)
                        <h4 class="card-title">SDLC Model</h4>
                        <p class="card-description">
                         Put in SDLC Models
                        </p>
                        @else
                        <h4 class="card-title">SDLC Stages</h4>
                        <p class="card-description">
                         Put in SDLC Stages
                         </p>
                        @endif



                        @if($iscreatesdlcmodel == true)
                        <a href="/admin/sdlcmodels/create"> <button type="submit" class="btn btn-outline-secondary btn-sm">Create</button> </a>
                        @else
                        <a href="/admin/sdlc/create"> <button type="submit" class="btn btn-outline-secondary btn-sm">Create</button> </a>
                        @endif
                        <div class="table-responsive">

                          <table class="table table-striped"  id="emptbl">
                            <thead>
                              <tr>
                                <th>
                                  SDLC Acrynym
                                </th>
                                <th>
                                  Short Description
                                </th>
                                @if(!$iscreatesdlcmodel == true)
                                <th>
                                  SDLC Model
                                </th>
                                @endif
                                
                              </tr>
                            </thead>
                            <tbody>
                            @if(count($sdlc) == 0)
                            <tr>
                               <label>No Data Found</label>
                            </tr>
                            @else
                                @foreach($sdlc as $item)
                                <tr>
                                <td  id="col0">
                                    <label>{{$item->name}}</label>
                                  </td>
                                <td  id="col1">
                                    <label>{{$item->description}}</label>
                                </td>
                                @if(!$iscreatesdlcmodel == true)
                                <td id="col2">
                                  <label>{{$item->sdlcmodelname}}</label>
                                </td>
                                @endif
                                </tr>
                                @endforeach
                            @endif
                              
                            </tbody>
                          </table>
                     
                          @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div>{{$error}}</div>
                            @endforeach
                        @endif
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