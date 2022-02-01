@extends('pembimbing.main')
@section('content')

<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">Data Task 
            <div class="text-muted pt-2 font-size-sm">all data of task had given (gatau enggresnya)</div></h3>
        </div>
        <div class="card-toolbar">
            <!--begin::Dropdown-->
            <div class="dropdown dropdown-inline mr-2">
                <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:/keen/theme/demo1/dist/assets/media/svg/icons/Design/PenAndRuller.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                            <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                        </g>
                    </svg> 
                    <!--end::Svg Icon-->
                 </span>Export</button>
                <!--begin::Dropdown Menu-->
                <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                    <!--begin::Navigation-->
                    <ul class="navi flex-column navi-hover py-2">
                        <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-print"></i>
                                </span>
                                <span class="navi-text">Print</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-copy"></i>
                                </span>
                                <span class="navi-text">Copy</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-file-excel-o"></i>
                                </span>
                                <span class="navi-text">Excel</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-file-text-o"></i>
                                </span>
                                <span class="navi-text">CSV</span>
                            </a>
                        </li>
                        <li class="navi-item">
                            <a href="#" class="navi-link">
                                <span class="navi-icon">
                                    <i class="la la-file-pdf-o"></i>
                                </span>
                                <span class="navi-text">PDF</span>
                            </a>
                        </li>
                    </ul>
                    <!--end::Navigation-->
                </div>
                <!--end::Dropdown Menu-->
            </div>
            <!--end::Dropdown-->
            <!--begin::Button-->
            <a href="#" class="btn btn-primary font-weight-bolder" data-toggle="modal" data-target="#exampleModalCenter">
            <span class="svg-icon svg-icon-md">
                <!--begin::Svg Icon | path:/keen/theme/demo1/dist/assets/media/svg/icons/Design/Flatten.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24" />
                        <circle fill="#000000" cx="9" cy="15" r="6" />
                        <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>Create Task</a>
            <!--end::Button-->
        </div>
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Task</th>
                    <th>Description</th>
                    <th>Name of member</th>
                    <th>Deadline</th>
                    <th>Status</th>                    
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Tugas 1 </td>
                    <td>Hayes Boule</td>
                    <td>Casper-Kerluke</td>
                    <td>5</td>
                    <td>1</td>
                    <td nowrap="nowrap"></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>tugas 2</td>
                    <td>Humbert Bresnen</td>
                    <td>Hodkiewicz and Sons</td>
                    <td>2</td>
                    <td>2</td>
                    <td nowrap="nowrap"></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>tugas 3</td>
                    <td>Jareb Labro</td>
                    <td>Kuhlman Inc</td>
                    <td>6</td>
                    <td>2</td>
                    <td nowrap="nowrap"></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>ktosspell3</td>
                    <td>Krishnah Tosspell</td>
                    <td>Prosacco-Kessler</td>
                    <td>1</td>
                    <td>1</td>
                    <td nowrap="nowrap"></td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>dkernan4</td>
                    <td>Dale Kernan</td>
                    <td>Bernier and Sons</td>
                    <td>5</td>
                    <td>2</td>
                    <td nowrap="nowrap"></td>
                </tr>          
            </tbody>
        </table>
        <!--end: Datatable-->
    </div>
</div>
<!--end::Card-->
@endsection


<!-- Modal-->
<div class="modal fade" id="exampleModalCenter" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="submit_presence">Create some Task</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i aria-hidden="true" class="ki ki-close"></i>
                </button>
            </div>
            <div class="modal-body">                
                <div class="form-group">
                    <label for="exampleTextarea">Name of Task</label>
                    <input class="form-control"></input>
                </div> 
                <div class="form-group">
                    <label for="exampleTextarea">Description of Task</label>
                    <textarea class="form-control" rows="3"></textarea>
                </div> 
                <div class="form-group">
                    <label for="example-date-input" class="col-2 col-form-label">Deadline</label>                    
                     <input class="form-control" type="date" value="2011-08-19" id="example-date-input"/>                    
                </div>   
            </div>       
            <div class="modal-footer">
                <button type="button" class="btn btn-light-primary font-weight-bold" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary font-weight-bold">Save Task</button>
            </div>
        </div>
    </div>
    </div>
