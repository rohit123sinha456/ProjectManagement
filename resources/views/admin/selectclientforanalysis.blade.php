@include('layouts.header')
<script>
  var clientandObejcts = {!! $clientandObejcts  !!};
  var subjectObject = clientandObejcts;/**{
    "Front-end": {
      "HTML",
      "CSS",
      "JavaScript"   
    },
    "Back-end": {
      "PHP": ,
      "SQL": 
    }
  }*/
  window.onload = function() {
    var subjectSel = document.getElementById("subject");
    var topicSel = document.getElementById("topic");
    
    for (var x in subjectObject) {
      // var tempdata = subjectObject[x];
      // // console.log(Object.keys(subjectObject[x]));
      // var cz = Object.keys(subjectObject[x])[0];
      // // console.log(tempdata[cz]['id'])
      // var tempid = "-".concat(tempdata[cz]['id'])
      subjectSel.options[subjectSel.options.length] = new Option(x, x);
    }
    subjectSel.onchange = function() {
      //empty Chapters- and Topics- dropdowns
      //console.log(subjectObject[this.value]);
      topicSel.length = 1;
      //display correct values
      for (var y in subjectObject[this.value]) {
        // var tempdata = subjectObject[this.value.split("-")[0]];
        console.log(subjectObject[this.value][y].oid);
        topicSel.options[topicSel.options.length] = new Option(y, subjectObject[this.value][y].oid);
      }
    }
   
  }
  </script>
    <div class="container-scroller">
        @include('layouts.topnav')
    <div class="container-fluid page-body-wrapper">
    @include('layouts.navbar')
        <div class="main-panel">
            <div class="content-wrapper">
              <form class="forms-sample" action="/admin/detailsummary/analysis" method="POST">
                @csrf
              <div class="row">
               
                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Client</h4>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1"></label>
                                  <p>Select a Client to proceed</p>
                                  <select class="form-control form-control-lg" name="subject" id="subject">
                                    <option value="" selected="selected">Select Client</option>
                                  </select>
                              </div> 
                      </div>
                    </div>
                </div>

                <div class="col-lg-6 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Object</h4>
                        
                            <div class="form-group">
                              <p>Select a Object to proceed</p>
                                <select class="form-control form-control-lg" name="topic" id="topic">
                                  <option value="" selected="selected">Select Object</option>
                                </select>

                              </div>
                      
                        
                      </div>
                    </div>
                  </div>
              </div>

              <button type="submit" class="btn btn-primary mr-2">Submit</button>
            </form>
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