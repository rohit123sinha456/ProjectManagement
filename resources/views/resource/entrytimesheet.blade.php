@include('layouts.header')
    <div class="container-scroller">
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
        function addRows(){ 
          var table = document.getElementById('emptbl');
          var rowCount = table.rows.length;
          var cellCount = table.rows[0].cells.length; 
          var row = table.insertRow(rowCount);
          for(var i =0; i <= cellCount; i++){
            var cell = 'cell'+i;
            cell = row.insertCell(i);
            var copycel = document.getElementById('col'+i).innerHTML;
            cell.innerHTML=copycel;
          }
        }
        function deleteRows(){
          var table = document.getElementById('emptbl');
          var rowCount = table.rows.length;
          if(rowCount > '2'){
            var row = table.deleteRow(rowCount-1);
            rowCount--;
          }
          else{
            alert('There should be atleast one row');
          }
        }
        </script>
        @include('resource.layouts.topnav')
    <div class="container-fluid page-body-wrapper">
    @include('resource.layouts.navbar')
        <div class="main-panel">
            <div class="content-wrapper">
              <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">TimeSheet Entry</h4>
                        <p class="card-description">
                         Put in timesheet entry
                        </p>
                        <div class="table-responsive">
                          <form class="forms-sample" method="POST" action="/resource/submittimesheet">
                            @csrf
                            <input type="date" class="form-control file-upload-info" id="date" name="date" value={{$date}}>

                          <table class="table table-striped"  id="emptbl">
                            <thead>
                              <tr>
                                <th>
                                  Objects
                                </th>
                                <th>
                                  SDLC Life Cycle
                                </th>
                                <th>
                                  Hours
                                </th>
                              </tr>
                            </thead>
                            <tbody>
                            
                            <tr>
                              <td  id="col0">
                                <div class="form-group">
                                  <label for="exampleFormControlSelect1">Objects</label>
                                  <select class="form-control form-control-lg" id="oid" name="oid[]">
                                    <option value="none" selected disabled hidden>Select an Option</option>
                                      @foreach ($objects as $colname)
                                      <option value={{$colname->id}}>{{$colname->name}}</option>
                                      @endforeach
                                  </select>
                                </div>
                              </td>
                              <td  id="col1">
                                <div class="form-group">
                                  <label for="exampleFormControlSelect1">SDLC Stage</label>
                                  <select class="form-control form-control-lg" id="sdlc" name="sdlc[]">
                                    <option value="none" selected disabled hidden>Select an Option</option>
                                      @foreach ($column as $colname)
                                      <option value={{$colname}}>{{$colname}}</option>
                                      @endforeach
                                  </select>
                                </div>
                              </td>
                              <td  id="col2">
                                <input type="text" class="form-control" name="hours[]" placeholder="Name">
                              </td>
                            </tr>
                              
                            </tbody>
                          </table>
                          <table class="table table-striped"> 
                            <tr> 
                              <td><input type="button" value="Add Row" onclick="addRows()" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" /></td> 
                              <td><input type="button" value="Delete Row" onclick="deleteRows()" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" /></td> 
                              <td><input type="submit" value="Save" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"></td> 
                            </tr>  
                          </table> 

                          </form>
                          
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