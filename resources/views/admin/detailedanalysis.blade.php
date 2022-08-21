@include('layouts.header')
<script>

  $(function() {
  var effortname = @json($effortname);
  var efforthours =  @json($efforthours);
  var effortdata = effortname.map((name,index)=>{
      let data = {};
      data.name = name;
      data.hours = {};
      data.hours.value = efforthours[index];
      return data;
  });
  
  var estimatename = @json($estimatename);
  var estimatehours =  @json($estimatehours);
  var estimatedata = estimatename.map((name,index)=>{
      let data = {};
      data.name = name;
      data.hours = {};
      data.hours.value = estimatehours[index];
      return data;
  });


  'use strict';
  
  var options = {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    },
    legend: {
      display: false
    },
    elements: {
      bar: {
      backgroundColor:'rgba(255, 99, 132, 0.2)',
      borderColor: 'rgba(255,99,132,1)',
      }
    }

  };
  // Get context with jQuery - using jQuery's .get() method.
  if ($("#barChart1").length) {
    var barChartCanvas = $("#barChart1").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var barChart = new Chart(barChartCanvas, {
      type: 'bar',
      data: {
          datasets: [{
            label : "Estimate",
              data: estimatedata,
              backgroundColor: 'rgba(75,190,190,0.6)',
              parsing: {
              xAxisKey: 'name',
              yAxisKey: 'hours.value'
          }
          },
          {
            label : "Effort",
              data: effortdata,
              backgroundColor: 'rgba(75,100,100,0.6)',
              parsing: {
              xAxisKey: 'name',
              yAxisKey: 'hours.value'
          }
          }
        ]
      },
      
    });
  }

  var userhoursdata = {!! $sdlc_user_hours !!};//{
  //   ABC:{
  //     U1:{value:1},
  //     U2:{value:20},
  //   },
  //   DEF:{
  //     U3:{value:100},
  //   },
  //   XYZ:{
  //     U1:{value:"-"},
  //   }
  // }
  
  function format ( d ) {
      // `d` is the original data object for the row
      console.log(userhoursdata[d.SDLC]);
      var table_data = "";
      for(var users in userhoursdata[d.SDLC] ){
        // console.log(userhoursdata[d.SDLC][users].value);
        var temp_table_row =   '<tr class="expanded-row">'+  '<td class="row-bg"></td>';
        temp_table_row = temp_table_row +  '<td class="row-bg">'+users+'</td>';
        temp_table_row = temp_table_row +  '<td class="row-bg">'+userhoursdata[d.SDLC][users].value+'</td>';
        temp_table_row = temp_table_row +  '</tr>';
        table_data = table_data + temp_table_row;
      }
      return '<table cellpadding="5" cellspacing="0" border="0" style="width:100%;">'+
        table_data + 
      '</table>';
  }
  var data =  [
    {
      "Client": "1",
      "Object": "Incs234",
      "SDLC": "Car insurance",
      "Effort": "Business type 1",
      "Estimate": "Jesse Thomas"
    }
    
  ];
  var table = $('#example').DataTable( {
    data:{!! $table_data !!},
    columns: [
        { "data": "Client","defaultContent": '-' },
        { "data": "Object","defaultContent": '-' }, 
        { "data": "SDLC","defaultContent": '-' },
        { "data": "Effort","defaultContent": '-' },
        { "data": "Estimate","defaultContent": '-' },
        {
          "className":      'details-control',
          "orderable":      false,
          "data":           null,
          "defaultContent": ''
        }
        
    ],
    order: [[1, 'asc']]
    
  } );
$('#example tbody').on('click', 'td.details-control', function () {
  var tr = $(this).closest('tr');
  var row = table.row( tr );

  if ( row.child.isShown() ) {
      // This row is already open - close it
      row.child.hide();
      tr.removeClass('shown');
  }
  else {
      // Open this row
      row.child( format(row.data()) ).show();
      tr.addClass('shown');
  }
} );


});
</script>
<div class="container-scroller">
  @include('layouts.topnav')
  <div class="container-fluid page-body-wrapper">
  @include('layouts.navbar')
      <div class="main-panel">
        <div class="content-wrapper">


          <div class="row">
            <div class="col-lg-8 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Effort Vs Estimate Hours of SDLC Stages</h4>
                  <canvas id="barChart1"></canvas>
                </div>
              </div>
            </div>
            
          </div>

          
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <p class="card-title">Timesheet Efforts</p>
                  <div class="row">
                    <div class="col-12">
                      <div class="table-responsive">
                        <table id="example" class="display expandable-table" style="width:100%">
                          <thead>
                            <tr>
                              <th>Client Name</th>
                              <th>Object name</th>
                              <th>SDLC Stage</th>
                              <th>Effort Hours</th>
                              <th>Estimate Hours</th>
                              <th></th>
                            </tr>
                          </thead>
                      </table>
                      </div>
                    </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>

          
          
          
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i>by RS</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>