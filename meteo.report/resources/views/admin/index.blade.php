@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('src_top')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
@endsection

@section('content')


@if(!empty($dates))
<div class="row">
    <div class="col-md-12">
        <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <h4 class="c-grey-900 mB-20">Statistic graph</h4>
      <canvas id="totalChart" height="345" width="1297" class="chartjs-render-monitor" style="display: block; height: 276px; width: 1038px;"></canvas>
        </div>
    </div>
</div>




<script>
var ctx = document.getElementById('totalChart').getContext('2d');
function drawChart(dates,total)
{
return new Chart(ctx, {
    type: 'line',
    data: {
            labels: dates,                  
            datasets: [{
                    label: 'Total',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 199, 132)',
                    data: total,
                    fill: false,
                }
            ]
    },
    options: {

            responsive: true,
            tooltips: {
                mode: 'index',
                intersect: false,
            },
            hover: {
                mode: 'nearest',
                intersect: true
            },
            scales: {
                xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                        }
                    }],
                yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                        }
                    }]
            }
        }
});
}
dates = '{{ $dates }}';
responses = '{{ $responses }}';
dates = dates.split(',');
responses = responses.split(',');
drawChart(dates.reverse(),responses.reverse())
</script>





<div class="row">
    <div class="col-md-12">
        <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <h4 class="c-grey-900 mB-20">Statistic table</h4>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Date</th>
                        <th scope="col">Response</th>
                        <th scope="col">Last updated</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($analyticDate as $d)
                    <tr>
                        <th scope="row">{{ $d->id }}</th>
                        <td>{{ $d->date }}</td>
                        <td>{{ $d->response }}</td>
                        <td>{{ $d->updated_at }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{{ $analyticDate->links() }}
@else
<p>no statistic yet</p>
@endif

@endsection