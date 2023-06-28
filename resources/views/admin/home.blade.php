@extends('layouts.admin.master')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
<style>
    .star-rating {
    display: inline-flex;
    flex-direction: row-reverse;
    font-size: 16px;
    line-height: 1;
}

.star-rating .star {
    color: #ddd;
    cursor: pointer;
}

.star-rating .filled {
    color: gold;
}
    </style>
@endsection
@section('content')
    <div class="breadcrumb-wrapper">
        <div class="row">
            <div class="col-md-2">
                <h1>Dashboard</h1>
            </div>
            <div class="col-md-10">
                <label class="switch switch-primary form-control-label float-right">
                    <input type="checkbox" id="activityToggle" class="switch-input form-check-input" value="on" {{$show_activity_summary ? 'checked' : ''}}><span class="switch-label"></span>
                    <span class="switch-handle"></span>
                </label>
                <div class="float-right mt-1 mr-2">
                    <label><b>Show Activity Summary to User</b></label>
                </div>
            </div>
        </div>
    </div>
    <div class="container p-0 ">
        <div class="row">
            <div class="col-xl-3 col-sm-6">
                <div class="card card-mini mb-4 bg-success">
                    <div class="card-body">
                        <a href="{{route('admin.proposal.index')}}">
                            <h2 class="mb-1">{{$proposal_count}}</h2>
                            <p>Total Proposals</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card card-mini mb-4 bg-info">
                    <div class="card-body">
                        <a href="{{route('admin.proposal.users')}}">
                            <h2 class="mb-1">{{$user_count}}</h2>
                            <p>Total Users</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card card-mini mb-4 bg-warning">
                    <div class="card-body">
                        <a href="{{route('admin.users')}}">
                            <h2 class="mb-1">{{$gov_count}}</h2>
                            <p>Total Gov Users</p>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card card-mini mb-4 bg-primary">
                    <div class="card-body">
                        <a href="{{route('admin.categories')}}">
                            <h2 class="mb-1">{{$cat_count}}</h2>
                            <p> Total Categories</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Proposal statistics -->
                <div class="card card-default" id="user-activity">
                <div class="row no-gutters">
                    <div class="col-xl-12">
                    <div class="border-right">
                        <div class="card-header justify-content-between py-5">
                        <h2>Proposal Statistics</h2>
                        </div>
                        <ul class="nav nav-tabs nav-style-border justify-content-between justify-content-xl-start border-bottom" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active pb-md-0" data-toggle="tab" href="#user" role="tab" aria-controls="" aria-selected="true">
                            <span class="type-name">Total</span>
                            <h4 class="d-inline-block mr-2 mb-3">{{$proposal_count}}</h4>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pb-md-0" data-toggle="tab" href="#session" role="tab" aria-controls="" aria-selected="false">
                            <span class="type-name">Approved</span>
                            <h4 class="d-inline-block mr-2 mb-3">{{$approved_proposal_count}}</h4>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pb-md-0" data-toggle="tab" href="#bounce" role="tab" aria-controls="" aria-selected="false">
                            <span class="type-name">Pending</span>
                            <h4 class="d-inline-block mr-2 mb-3">{{$pending_proposal_count}}</h4>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pb-md-0" data-toggle="tab" href="#bounce" role="tab" aria-controls="" aria-selected="false">
                            <span class="type-name">Cancel</span>
                            <h4 class="d-inline-block mr-2 mb-3">{{$cancel_proposal_count}}</h4>
                            </a>
                        </li>
                        </ul>
                        <div class="card-body">
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="user" role="tabpanel" aria-labelledby="home-tab">
                                <canvas id="activity" class="chartjs"></canvas>
                            </div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card card-default">
                    <div class="card-header card-header-border-bottom d-flex justify-content-between">
                        <h2>Proposals</h2>
                    </div>
                    <div class="card-body">
                        <div class="basic-data-table">
                            <table id="basic-data-table" class="table nowrap" style="width:100%" data-order='[[ 1, "desc" ]]' >
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Submitted Date</th>
                                        <th>No. of times viewed</th>
                                        <th>Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($proposals as $proposal)
                                        <tr>
                                            <td><a href="{{route('admin.proposal.view',['id'=>$proposal->id])}}">{{ $proposal->title }}</a></td>
                                            <td>{{ date('Y-m-d h:i:s A',strtotime($proposal->created_at->toDateTimeString())) }}</td>
                                            <td>{{ $proposal->no_of_times_viewed ? $proposal->no_of_times_viewed : 0 }}</td>
                                            <td>
                                            <div class="star-rating" >
                                                @for ($i = 5; $i >= 1; $i--)
                                                    <span class="star {{ $proposal->rating >= $i ? 'filled' : 'empty' }}"><i class="fas fa-star"></i></span>
                                                @endfor
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
        </div>
    </div>
    <!-- Confirmation Modal -->
<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to update the activity summary to the user?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="confirmationModalYes">Yes</button>
        <button type="button" class="btn btn-secondary" id="confirmationModalNo" data-dismiss="modal">No</button>
      </div>
    </div>
  </div>
</div>
 @endsection
 @section('script')
 <script>
  var activity = document.getElementById("activity");
  if (activity !== null) {
     var activityData = @json($activityData);
    console.log(activityData);
    var config = {
      // The type of chart we want to create
      type: "line",
      // The data for our dataset
      data: {
        labels: activityData.labels,
        datasets: [
          {
            label: "Pending",
            backgroundColor: "transparent",
            borderColor: "rgb(82, 136, 255)",
            data: activityData.pending,
            lineTension: 0,
            pointRadius: 5,
            pointBackgroundColor: "rgba(255,255,255,1)",
            pointHoverBackgroundColor: "rgba(255,255,255,1)",
            pointBorderWidth: 2,
            pointHoverRadius: 7,
            pointHoverBorderWidth: 1
          },
          {
            label: "Approved",
            backgroundColor: "transparent",
            borderColor: "rgb(255, 199, 15)",
            data: activityData.approved,
            lineTension: 0,
            borderDash: [10, 5],
            borderWidth: 1,
            pointRadius: 5,
            pointBackgroundColor: "rgba(255,255,255,1)",
            pointHoverBackgroundColor: "rgba(255,255,255,1)",
            pointBorderWidth: 2,
            pointHoverRadius: 7,
            pointHoverBorderWidth: 1
          }
        ]
      },
      // Configuration options go here
      options: {
        responsive: true,
        maintainAspectRatio: false,
        legend: {
          display: false
        },
        scales: {
          xAxes: [
            {
              gridLines: {
                display: false,
              },
              ticks: {
                fontColor: "#8a909d", // this here
              },
            }
          ],
          yAxes: [
            {
              gridLines: {
                fontColor: "#8a909d",
                fontFamily: "Roboto, sans-serif",
                display: true,
                color: "#eee",
                zeroLineColor: "#eee"
              },
              ticks: {
                // callback: function(tick, index, array) {
                //   return (index % 2) ? "" : tick;
                // }
                stepSize: 50,
                fontColor: "#8a909d",
                fontFamily: "Roboto, sans-serif"
              }
            }
          ]
        },
        tooltips: {
          mode: "index",
          intersect: false,
          titleFontColor: "#888",
          bodyFontColor: "#555",
          titleFontSize: 12,
          bodyFontSize: 15,
          backgroundColor: "rgba(256,256,256,0.95)",
          displayColors: true,
          xPadding: 10,
          yPadding: 7,
          borderColor: "rgba(220, 220, 220, 0.9)",
          borderWidth: 2,
          caretSize: 6,
          caretPadding: 5
        }
      }
    };

    var ctx = document.getElementById("activity").getContext("2d");
    var myLine = new Chart(ctx, config);

    var items = document.querySelectorAll("#user-activity .nav-tabs .nav-item");
    items.forEach(function(item, index){
      item.addEventListener("click", function() {
        config.data.datasets[0].data = activityData.approved;
        config.data.datasets[1].data = activityData.pending;
        myLine.update();
      });
    });
  }

$(document).ready(function() {
 // Get the checkbox element
  var activityToggle = $('#activityToggle');
  var previousToggleState = activityToggle.is(':checked'); // Store the previous toggle state

  // Attach a click event listener to the toggle label
  $('#activityToggleLabel').on('click', function() {
    // Toggle the checkbox manually if it's enabled
    if (!activityToggle.is(':disabled')) {
      activityToggle.prop('checked', !activityToggle.is(':checked'));
      activityToggle.trigger('change');
    }
  });

  // Attach a change event listener to the checkbox
  activityToggle.on('change', function() {
    // Get the new value of the checkbox
    var isChecked = $(this).is(':checked');

    // Show confirmation modal
    if (isChecked) {
      showConfirmationModal(function() {
        updateToggle(isChecked);
      });
    } else {
      showConfirmationModal(function() {
        updateToggle(isChecked);
      });
    }
  });

  // Function to show the confirmation modal
  function showConfirmationModal(confirmCallback) {
    $('#confirmationModal').modal('show');

    $('#confirmationModalYes').on('click', function() {
      confirmCallback();
      $('#confirmationModal').modal('hide'); // Close the confirmation modal
    });

    $('#confirmationModalNo').on('click', function() {
      $('#confirmationModal').modal('hide');
      activityToggle.prop('checked', previousToggleState);
    });

    $('#confirmationModal').on('hidden.bs.modal', function() {
      $('#confirmationModalYes').off('click');
      $('#confirmationModalNo').off('click');
    });
  }

  // Function to update toggle value
  function updateToggle(isChecked) {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');
    // Make an AJAX call to update the value in the database
    $.ajax({
      url: 'update-setting',  // Replace with the actual URL to update the database
      method: 'POST',
      data: {
        show_activity_summary: isChecked,
        _token: csrfToken,
      },  // Pass the new value to the server
      success: function(response) {
        // Handle the response from the server
        console.log(response);
        toastr.success(response.message);
        previousToggleState = isChecked; // Update the previous toggle state
      },
      error: function(xhr, status, error) {
        // Handle errors
        console.log(error);
        activityToggle.prop('checked', previousToggleState); // Revert toggle to the previous state on error
      }
    });
  }
});
</script>
@endsection