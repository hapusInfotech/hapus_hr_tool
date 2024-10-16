@extends('layouts.company_users.companyDashboardLayout')

@section('content')

    <div class="page-header flex-wrap">
        <div class="header-left">
            <button class="btn btn-primary mb-2 mb-md-0 mr-2"> Create new document </button>
            <button class="btn btn-outline-primary bg-white mb-2 mb-md-0"> Import documents </button>
        </div>
        <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
            <div class="d-flex align-items-center">
                <a href="#">
                    <p class="m-0 pr-3">Dashboard</p>
                </a>
                <a class="pl-3 mr-4" href="#">
                    <p class="m-0">ADE-00234</p>
                </a>
            </div>
            <button type="button" class="btn btn-primary mt-2 mt-sm-0 btn-icon-text">
                <i class="mdi mdi-plus-circle"></i> Add Product </button>
        </div>
    </div>
 
    <!-- chart row starts here -->
    <div class="row">
        <div class="col-sm-6 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="card-title"> Customers <small class="d-block text-muted">August 01 -
                                August 31</small>
                        </div>
                        <div class="d-flex text-muted font-20">
                            <i class="mdi mdi-printer mouse-pointer"></i>
                            <i class="mdi mdi-help-circle-outline ml-2 mouse-pointer"></i>
                        </div>
                    </div>
                    <h3 class="font-weight-bold mb-0"> 2,409 <span class="text-success h5">4,5%<i
                                class="mdi mdi-arrow-up"></i></span>
                    </h3>
                    <span class="text-muted font-13">Avg customers/Day</span>
                    <div class="line-chart-wrapper">
                        <canvas id="linechart" height="80"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6 stretch-card grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="card-title"> Conversions <small class="d-block text-muted">August 01
                                - August 31</small>
                        </div>
                        <div class="d-flex text-muted font-20">
                            <i class="mdi mdi-printer mouse-pointer"></i>
                            <i class="mdi mdi-help-circle-outline ml-2 mouse-pointer"></i>
                        </div>
                    </div>
                    <h3 class="font-weight-bold mb-0"> 0.40% <span class="text-success h5">0.20%<i
                                class="mdi mdi-arrow-up"></i></span>
                    </h3>
                    <span class="text-muted font-13">Avg customers/Day</span>
                    <div class="bar-chart-wrapper">
                        <canvas id="barchart" height="80"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
    <!-- table row starts here -->
    <div class="row">
  
        <div class="col-xl-12 stretch-card grid-margin">
            <div class="card">
                <div class="card-body pb-0">
                    <h4 class="card-title mb-0">Financial management review</h4>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table custom-table text-dark">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Sale Rate</th>
                                    <th>Actual</th>
                                    <th>Variance</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="{{ asset('company_dashboard/assets/images/faces/face2.jpg') }}"
                                            class="mr-2" alt="image" /> Jacob Jensen
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <span class="pr-2 d-flex align-items-center">85%</span>
                                            <select id="star-1" name="rating" autocomplete="off">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>32,435</td>
                                    <td>40,234</td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="{{ asset('company_dashboard/assets/images/faces/face3.jpg') }}"
                                            class="mr-2" alt="image" /> Cecelia Bradley
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <span class="pr-2 d-flex align-items-center">55%</span>
                                            <select id="star-2" name="rating" autocomplete="off">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>4,36780</td>
                                    <td>765728</td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="{{ asset('company_dashboard/assets/images/faces/face4.jpg') }}"
                                            class="mr-2" alt="image" /> Leah Sherman
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <span class="pr-2 d-flex align-items-center">23%</span>
                                            <select id="star-3" name="rating" autocomplete="off">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>2300</td>
                                    <td>22437</td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="{{ asset('company_dashboard/assets/images/faces/face5.jpg') }}"
                                            class="mr-2" alt="image" /> Ina Curry
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <span class="pr-2 d-flex align-items-center">44%</span>
                                            <select id="star-4" name="rating" autocomplete="off">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>53462</td>
                                    <td>1,75938</td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="{{ asset('company_dashboard/assets/images/faces/face7.jpg') }}"
                                            class="mr-2" alt="image" /> Lida Fitzgerald
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <span class="pr-2 d-flex align-items-center">65%</span>
                                            <select id="star-5" name="rating" autocomplete="off">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>67453</td>
                                    <td>765377</td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="{{ asset('company_dashboard/assets/images/faces/face2.jpg') }}"
                                            class="mr-2" alt="image" /> Stella Johnson
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <span class="pr-2 d-flex align-items-center">49%</span>
                                            <select id="star-6" name="rating" autocomplete="off">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>43662</td>
                                    <td>96535</td>
                                </tr>
                                <tr>
                                    <td>
                                        <img src="{{ asset('company_dashboard/assets/images/faces/face9.jpg') }}"
                                            class="mr-2" alt="image" /> Maria Ortiz
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <span class="pr-2 d-flex align-items-center">65%</span>
                                            <select id="star-7" name="rating" autocomplete="off">
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </td>
                                    <td>76555</td>
                                    <td>258546</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <a class="text-black font-13 d-block pt-2 pb-2 pb-lg-0 font-weight-bold pl-4"
                        href="#">Show more</a>
                </div>
            </div>
        </div>
    </div>
    <!-- doughnut chart row starts -->
 
</div>

<footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">
        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright ©
            hapusinfotech.com 2024</span>
       
    </div>

</footer>

@endsection
