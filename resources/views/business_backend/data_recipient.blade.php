@extends('business_backend.master')
@section('header')
@endsection
@section('content')


<div class="container-fluid">

  <!-- start page title -->
  <div class="row">
    <div class="col-12">



      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">

            <div class="modal-body">
              <h4 class='text-center p-2'><b>Create Recipient</b></h4>
              <form id='create_form' method='post'>@csrf
                <label><b>Name</b></label>
                <input id='name' type='text' class='form-control' name='name' placeholder='e.g My Mum' />
                <input id='group_id' type='hidden' value='{{ $group->id }}' />
                <label><b>Phone</b></label>
                <input id='phone' oninput="fetchNetwork()" type='number' class='form-control' name='phone'
                  placeholder='08XXXXXXXXX' />
                <label><b>Network</b></label>
                <select required onchange="fetchPlan()" id="network" class="form-control">
                  <option>Select Network</option>
                  <option value="1">MTN</option>
                  <option value="2">GLO</option>
                  <option value="3">AIRTEL</option>
                  <option value="4">9MOBILE</option>
                </select>
                <label><b>Plan</b></label>
                <select id='plan_id' required class="form-control">
                  <option>--Select Plan --</option>

                </select>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Create</button>

            </div>
            </form>
          </div>
        </div>
      </div>


    </div>
  </div>
  <!-- end page title -->

  <div class="row">

    <div class="card">
      <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
          <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="fw-bolder">{{ $group->name }} <span class='text-danger'>(NGN{{
                number_format($recipients->sum('amount')) }})</span></h4>
            <div>
              <a class='btn btn-secondary' href='/data_group'>←Initiate Purchase</a>
              <a class='btn btn-primary' data-bs-toggle="modal" data-bs-target="#exampleModal">Add Recipient</a>
            </div>
          </div>

        </div>

      </div>

      <div class="card-body">
        <table id='myTable' class='table m-0'>
          <tr>
            <th>Name</th>
            <th>Contact</th>
            <th>Plan</th>
            <th>Amount</th>
            <th>Action</th>
          </tr>
          <tbody>
            @foreach($recipients as $reci)
            <tr>
              <td>{{ $reci->name }}</td>
              <td>{{ $reci->phone }}</td>
              <td>{{ $reci->plan_name }}</td>
              <td>NGN{{number_format($reci->amount) }}</td>

              <td>
                <a onclick='return confirm("Are you sure you want to delete this recipient?")'
                  href='/delete_recipient/{{ $reci->uid }}' class='btn sm btn-danger'>Delete</a>

              </td>
            </tr>
            @endforeach
          </tbody>


        </table>
      </div>
      <!-- end card body -->
    </div>

  </div>
  <!-- end row -->


  <!-- end row -->
</div>
@section('script')
<script>
  function createRecipient() {
        const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener("mouseenter", Swal.stopTimer);
          toast.addEventListener("mouseleave", Swal.resumeTimer);
        },
      });
       
        let fd = new FormData();
              fd.append("name", $("#name").val());
              fd.append("phone", $("#phone").val());
              fd.append("network", $("#network").val());
              fd.append("plan_id", $("#plan_id").val());
              fd.append("group_id", $("#group_id").val());
              fd.append("plan_name", $("#plan_id option:selected").text());
            
            
              axios
                .post("/saveRecipient", fd)
                .then((response) => {
                  console.log(response, "the data");
                
                
                    Toast.fire({
                      icon: "success",
                      title: "Recipient Added Successfully!",
                    });
                    window.location.reload()
                    var table = $("#myTable tbody");
                    var row = $("<tr>");

                    // Create table cells (td) for each column in your data
                    var cell1 = $("<td>").text(response.data.name);
                    var cell2 = $("<td>").text(response.data.phone);
                    var cell3 = $("<td>").text(response.data.plan_name);
                    var cell4 = $("<td>").text("NGN"+response.data.amount);
                    var cell5 = $("<td>").text("Delete");
                 
                    // Add more cells for additional columns as needed
                    
                    // Append the cells to the row
                    row.append(cell1, cell2, cell3, cell4,cell5);
                    
                    // Append the row to the table
                    table.append(row);
                    $("#exampleModal").modal("hide");
                   
                })
                .catch((error) => {
                  console.log(error.message);
                  Swal.fire(error.message);
                });
        

    }
     function fetchNetwork() {
      if ($("#phone").val().length >= 10 && $("#phone").val().length <= 12) {
        axios
          .get("/fetchnetwork/" + $("#phone").val())
          .then((response) => {
            console.log(response);
            if (response.data !== 0) {
              $("#network").val(response.data)
              fetchPlan();
             
            }
          })
          .catch((error) => {
           
            console.log(error.message);
          });
      } else {
        
        // this.network = "";
      }
    }

    function fetchPlan() {
       
        console.log($("#phone").val())
  if ($("#phone").val().length >= 10) {
    console.log($("#network").val(), "this one");
    $.get("/fetchplan/" + $("#network").val(), function (response) {
      console.log(response);
      if (response !== false) {
        var selectField = $("#plan_id"); // Replace with your actual select field ID or selector
      selectField.empty(); // Clear existing options (if any)

      // Loop through the response data and create options
      response.forEach(function (item) {
        var option = $("<option></option>")
          .attr("value", item.plan_id) // Set the value attribute
          .text(item.plan_name); // Set the text content
        selectField.append(option); // Append the option to the select field
      });
      }
    })
    .fail(function (error) {
   
      console.log(error.statusText);
    });
  } else {
    // this.transfer_status = false;
    // this.network = "";
  }
}
    $(document).ready(function() {
        
        $("#create_form").on("submit", function(e) {
    e.preventDefault(); 
    createRecipient();
  });

        $("#type").on('change',function() {
            $("#show_notify").show()
            $("#title").val($("#type").find(':selected').data('title'))
            $("#description").val($("#type").find(':selected').data('description'))
            $("#notf_id").val($("#type").find(':selected').val())
        })
        const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
                })

                @if (session('success'))
        Toast.fire({
                        icon: 'success',
                        title: '{{ session("success") }}'
                        }) 
           
        @endif
                    })
</script>

@endsection

@endsection