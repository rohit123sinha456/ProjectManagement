@extends('layouts.header')
<!DOCTYPE html>
<html lang="en">

<head>
    @yield('header')
    <div class="container-scroller">
        @include('layouts.topnav')
    <div class="container-fluid page-body-wrapper">
    @include('resource.layouts.navbar')
        <div class="main-panel">
            <div class="content-wrapper">
              <div class="row">
                <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <h4 class="card-title">Clients </h4>
                        <p class="card-description">
                          Add class <code>.table-striped</code>

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
                              @foreach ($entries as $item)
                              <tr>
                                <td>
                                 {{$item->name}}
                                </td>
                                <td>
                                  {{$item->description}}
                              </td>
                            
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                      <form action="/resource/filleffortestimation/{{$item->id}}" method="GET"> <button type="submit" value="Submit" class="btn btn-outline-secondary btn-sm">Fill Effort Estimation</button> </form>
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