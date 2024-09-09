@extends('layouts.admin_app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="content-header">
            </div>
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Plan Details</h3>
                    <button type="button" class="btn btn-sm btn-secondary float-right" data-toggle="modal"
                    data-target="#addplan"><i class="fa fa-plus"> </i> Add Plan</button>
                </div>
                <div class="card-body">
                    @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissable" style="margin: 15px;">
                        <a href="#" style="color:white !important" class="close" data-dismiss="alert"
                        aria-label="close">&times;</a>
                        <strong> {{ session('success') }} </strong>
                    </div>
                    @endif

                    <table id="example2" class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Plan Name</th>
                                <th>Description</th>
                                <th>Days</th>
                                <th>Products</th>
                                <th>Amount</th>
                                <th>GST</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @foreach($plans as $plan)
                           <tr> 
                            <td>{{ $plan->id }}</td>
                            <td>{{ $plan->plan_name }}</td>
                            <td>{{ $plan->description }}</td>
                            <td>{{ $plan->days }}</td>
                            <td>{{ $plan->no_of_products }}</td>
                            <td>{{ $plan->amount }}</td>
                            <td>{{ $plan->gst }}</td>
                            <td>{{ $plan->status }}</td>
                        </td>
                        <td>
                         <a onclick="edit_plan('{{ $plan->id }}','{{ $plan->plan_name }}','{{ $plan->description }}','{{ $plan->days }}','{{ $plan->no_of_products }}','{{ $plan->amount }}','{{ $plan->gst }}','{{ $plan->status }}')" href="#" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i>Edit</a>
                      </tr>
                      @endforeach
                  </tbody>
              </table>

              <div class="modal fade" id="addplan">
                <form action="{{ url('/addplan') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title">Add Plan</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group row">
                                            <label for="plan_name" class="col-sm-4 col-form-label"><span style="color:red">*</span>Plan Name</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="text" class="form-control"
                                                name="plan_name" id="plan_name" maxlength="50"
                                                placeholder="Plan Name">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="description" class="col-sm-4 col-form-label"><span style="color:red">*</span>Description</label>
                                            <div class="col-sm-8">
                                                <textarea rows="2" required="required" class="form-control"
                                                name="description" id="description" maxlength="200" 
                                                 placeholder="Description"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="days" class="col-sm-4 col-form-label"><span style="color:red">*</span>Days</label>
                                            <div class="col-sm-8">
                                                <select name="days" class="form-control" required="required">
                                                    <option value="">Select</option>
                                                    <option value="7">1 Week</option>
                                                    <option value="30">1 Month</option>
                                                    <option value="90">3 Months</option>
                                                    <option value="180">6 Months</option>
                                                    <option value="365">1 Year</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="no_of_products" class="col-sm-4 col-form-label"><span style="color:red">*</span>No of Products</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="text" class="form-control number"
                                                name="no_of_products" id="no_of_products" maxlength="3"
                                                placeholder="No of Products">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="amount" class="col-sm-4 col-form-label"><span style="color:red">*</span>Amount</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="text" class="form-control number"
                                                name="amount" id="amount" maxlength="6"
                                                placeholder="Amount">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="GST" class="col-sm-4 col-form-label"><span style="color:red">*</span>GST</label>
                                            <div class="col-sm-8">
                                                <select name="gst" class="form-control">
                                                    <option value="5">5%</option>
                                                    <option value="12">12%</option>
                                                    <option selected="selected" value="18">18%</option>
                                                    <option value="28">28%</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default"
                                data-dismiss="modal">Close</button>
                                <input class="btn btn-primary" type="submit" value="Submit" />
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal fade" id="editplan" tabindex="-1" aria-hidden="true">
                <form action="{{ url('/editplan') }}" method="post">
                    {{ csrf_field() }}
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalScrollable">Edit Plan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <input type="hidden" name="plan_id" id="plan_id">
                                        <div class="form-group row">
                                            <label for="plan_name" class="col-sm-4 col-form-label"><span
                                                style="color:red">*</span>Plan Name</label>
                                                <div class="col-sm-8">
                                                    <input required="required" type="text"
                                                    class="form-control" name="plan_name" id="editplanname"
                                                    maxlength="50" placeholder="Plan Name">
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label for="description" class="col-sm-4 col-form-label"><span
                                                    style="color:red">*</span>Description</label>
                                                    <div class="col-sm-8">
                                                     <textarea required="required" class="form-control" name="description" id="editdescription" maxlength="200" placeholder="Description"></textarea>
                                                 </div>
                                             </div>
                                             
                                            <div class="form-group row">
                                            <label for="days" class="col-sm-4 col-form-label"><span style="color:red">*</span>Days</label>
                                            <div class="col-sm-8">
                                                <select name="days" id="editdays" class="form-control" required="required">
                                                    <option value="">Select</option>
                                                    <option value="7">1 Week</option>
                                                    <option value="30">1 Month</option>
                                                    <option value="90">3 Months</option>
                                                    <option value="180">6 Months</option>
                                                    <option value="365">1 Year</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="no_of_products" class="col-sm-4 col-form-label"><span style="color:red">*</span>No of Products</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="text" class="form-control number"
                                                name="no_of_products" id="editno_of_products" maxlength="3"
                                                placeholder="No of Products">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="amount" class="col-sm-4 col-form-label"><span style="color:red">*</span>Amount</label>
                                            <div class="col-sm-8">
                                                <input required="required" type="text" class="form-control number"
                                                name="amount" id="editamount" maxlength="6" placeholder="Amount">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="gst" class="col-sm-4 col-form-label"><span style="color:red">*</span>GST</label>
                                            <div class="col-sm-8">
                                                <select id="editgst" name="gst" class="form-control">
                                                    <option value="0">0</option>
                                                    <option value="5">5%</option>
                                                    <option value="12">12%</option>
                                                    <option selected="selected" value="18">18%</option>
                                                    <option value="28">28%</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="name" class="col-sm-4 col-form-label"><span
                                                    style="color:red">*</span>Status</label>
                                                    <div class="col-sm-8">
                                                        <select name="status" class="form-control" id="editstatus">
                                                            <option value="Active">Active</option>
                                                            <option value="Inactive">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default"
                                            data-dismiss="modal">Close</button>
                                            <input class="btn btn-primary" type="submit" value="Submit" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
    @push('page_scripts')
    <script>
        function edit_plan(id, plan_name, description,days,no_of_products,amount,gst,status,) {
            $("#editplanname").val(plan_name);
            $("#editdescription").val(description);
            $("#editdays").val(days);
            $("#editno_of_products").val(no_of_products);
            $("#editamount").val(amount);
            if(id == 1){
                $("#editamount").attr('readonly', true);
                $("#editgst").attr('disabled',true);
                $("#editstatus").attr('disabled',true);
                $("#editgst").val("0");
            }else{
                $("#editgst").val(gst);
                $("#editamount").attr('readonly', false);
                $("#editgst").attr('disabled',false);
                $("#editstatus").attr('disabled',false);
            }
            $("#editstatus").val(status);
            $("#plan_id").val(id);
            $("#editplan").modal("show");
        }
    </script>
    @endpush
