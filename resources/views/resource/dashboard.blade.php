@include('layouts.header')
<script>
  function getDaysInMonth(year, month) {
  return new Date(year, month, 0).getDate();
}
window.onload = function(){
  date = new Date();
  year = date.getFullYear();
  month = date.getMonth() + 1;
  day = date.getDate();
  working_days = getDaysInMonth(year,month);
  document.getElementById("current_date").innerHTML = month + "/" + day + "/" + year;
  let dateToday = new Date();
  let lastDayOfMonth = new Date(dateToday.getFullYear(), dateToday.getMonth()+1, 0).getDate();
  let daysUntilEndOfMonth = lastDayOfMonth - dateToday.getDate();
  document.getElementById("twh").innerHTML = 160;
  document.getElementById("twhp").innerHTML = "("+lastDayOfMonth+" days )";
  document.getElementById('hwp').innerHTML = {{$filledhours}}/160 * 100 + "% hours clocked "
}
  </script>
    <div class="container-scroller">
    @include('resource.layouts.topnav')
    <div class="container-fluid page-body-wrapper">
    @include('resource.layouts.navbar')
        <div class="main-panel">
            <div class="content-wrapper">
              <div class="row">
                <div class="col-md-12 grid-margin">
                  <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                      <h3 class="font-weight-bold">Welcome {{$name}}</h3>
                      <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6>
                    </div>
                    <div class="col-12 col-xl-4">
                     <div class="justify-content-end d-flex">
                      <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                        <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                          <i class="mdi mdi-calendar" id="current_date"></i>
                        </button>
                      </div>
                     </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6 grid-margin stretch-card">
                  <div class="card tale-bg">
                    <div class="card-people mt-auto">
                      <img src="{{asset('images/admindash.svg')}}" alt="people">
                     
                    </div>
                  </div>
                </div>
                <div class="col-md-6 grid-margin transparent">
                  <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent">
                      <div class="card card-tale">
                        <div class="card-body">
                          <p class="mb-4">Total Clocked Hours</p>
                          <p class="fs-30 mb-2">{{$filledhours}}</p>
                          <p id="hwp"></p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                      <div class="card card-dark-blue">
                        <div class="card-body">
                          <p class="mb-4">Total Working Hours</p>
                          <p class="fs-30 mb-2" id="twh"></p>
                          <p id="twhp"></p>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                      <div class="card card-light-blue">
                        <div class="card-body">
                          <p class="mb-4">Total Students</p>
                          <p class="fs-30 mb-2">hi</p>
                          <p>2.00% (30 days)</p>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 stretch-card transparent">
                      <div class="card card-light-danger">
                        <div class="card-body">
                          <p class="mb-4">Total Lessons</p>
                          <p class="fs-30 mb-2">ll</p>
                          <p>0.22% (30 days)</p>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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