@include('layouts.header')
<script>

  $(function() {
  /* ChartJS
   * -------
   * Data and config for chartjs
   */
  'use strict';
  var data = {
    labels: {{ json_encode($uid) }},
    datasets: [{
      label: '# of Hours',
      data: {{ json_encode($uhours) }},
      borderWidth: 1,
      fill: false
    }]
  };

  var data1 = {
    labels:  @json($names),
    datasets: [{
      label: '# of Objects',
      data: {{ json_encode($ocount) }},
      borderWidth: 1,
      fill: false
    }]
  };
 
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
      data: data,
      options: options
    });
  }

  if ($("#barChart2").length) {
    var barChartCanvas = $("#barChart2").get(0).getContext("2d");
    // This will get the first returned node in the jQuery collection.
    var barChart = new Chart(barChartCanvas, {
      type: 'bar',
      data: data1,
      options: options
    });
  }

});
</script>
<div class="container-scroller">
  @include('layouts.topnav')
  <div class="container-fluid page-body-wrapper">
  @include('layouts.navbar')
      <div class="main-panel">
        <div class="content-wrapper">


          <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Working Hours for Users</h4>
                  <canvas id="barChart1"></canvas>
                </div>
              </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Client Object Count</h4>
                  <canvas id="barChart2"></canvas>
                </div>
              </div>
            </div>
          </div>
          
          
          
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>