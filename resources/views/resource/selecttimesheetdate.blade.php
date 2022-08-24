@include('layouts.header')
<script type="text/javascript">
      window.onload = function(){
      date = new Date();
      year = date.getFullYear();
      month = date.getMonth() + 1;
      day = date.getDate();
      if (day < 10) {
        day = '0' + day;
      }
      if (month < 10) {  
        month = '0' + month;
      } 
        
    today = year + '-' + month + '-' + day; 
    console.log(today);
    document.getElementById('date').setAttribute('max',today);
    }
</script>
    <div class="container-scroller">
        @include('resource.layouts.topnav')
    <div class="container-fluid page-body-wrapper">
    @include('resource.layouts.navbar')
        <div class="main-panel">
            
            <div class="content-wrapper">
              <div class="row">
                
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        
                        
                        <h4 class="card-title">Submission Details</h4>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1"></label>
                                @if($errors->any())
                                  @foreach ($errors->all() as $error)
                                      <li>{{ $error }}</li>
                                  @endforeach

                                @else
                                     <p> No Error </p>
                                @endif
                              </div> 
                      </div>
                    </div>
                </div>

                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Timesheet</h4>
                        
                            <div class="form-group">
                                <label>Date </label>
                                @if(!$dateselected)
                                <form class="forms-sample" method="POST" action="/resource/selecteddate">
                                    @csrf
                                <div class="input-group col-xs-12">
                                  <input type="date" class="form-control file-upload-info" id="date" name="date">
                                  <span class="input-group-append">
                                    <button class="file-upload-browse btn btn-primary" type="submit">Go</button>
                                  </span>
                                </div>
                                </form>

                                @else
                                <input type="hidden" id="date" name="date" value={{$date}}>
                                {{$date}}
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