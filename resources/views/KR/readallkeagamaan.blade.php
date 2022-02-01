@extends('pembimbing.main')
@section('content')

<!--begin::Card-->
<div class="card card-custom">
    <div class="card-header flex-wrap py-5">
        <div class="card-title">
            <h3 class="card-label">Data Keagamaan 
            <div class="text-muted pt-2 font-size-sm">all data Keagamaan</div></h3>
        </div>
        <div class="card-toolbar">
            <!--begin::Dropdown-->
            <div class="dropdown dropdown-inline mr-2">
                
                    
                </div>
                <!--end::Dropdown Menu-->
            </div>
            <!--end::Dropdown-->          
    </div>
    <div class="card-body">
        <!--begin: Datatable-->
        <table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
            INI NANTI ADA BUAT MILIH TANGGAL GITU..
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>Activity</th>                                                                 
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Tugas 1</td>
                    <td>Hayes Boule</td>
                    <td>Casper-Kerluke</td>                           
                </tr>
                <tr>
                    <td>2</td>
                    <td>tugas 2</td>
                    <td>Humbert Bresnen</td>
                    <td>Hodkiewicz and Sons</td>                           
                </tr>
                <tr>
                    <td>3</td>
                    <td>tugas 3</td>
                    <td>Jareb Labro</td>
                    <td>Kuhlman Inc</td>                      
                </tr>
                <tr>
                    <td>4</td>
                    <td>ktosspell3</td>
                    <td>Krishnah Tosspell</td>
                    <td>Prosacco-Kessler</td>                          
                </tr>
                <tr>
                    <td>5</td>
                    <td>dkernan4</td>
                    <td>Dale Kernan</td>
                    <td>Bernier and Sons</td>                        
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
    </div>
</div>
