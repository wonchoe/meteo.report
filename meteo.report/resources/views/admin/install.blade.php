@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('src_top')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
@endsection

@section('content')
<div class="row">
    <div class="col-md-6" style="text-align: left;">
        <button id="archiveBtn" type="button" class="btn btn-primary" style="margin-bottom: 10px;">Archive</button>
    </div>
    <div class="col-md-6" style="text-align: right;">
        <button id="resetBtn" type="button" class="btn btn-primary" style="margin-bottom: 10px;">Reset</button>
    </div>    
</div>

<div class="row">
    <div class="col-md-12">
        <div class="bgc-white bd bdrs-3 p-20 mB-20">
            <h4 class="c-grey-900 mB-20">Statistic table</h4>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Installed</th>
                        <th scope="col">Total</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($res as $d)
                    <tr style="background-color: {{ ($d->cdate == date('Y-m-d') ? '#f0ffe8' : 'white') }}; font-weight: {{ ($d->cdate == date('Y-m-d') ? '600' : '100') }}">
                        <th scope="row"  style="font-weight: {{ ($d->cdate == date('Y-m-d') ? '600' : '100') }}">{{ $d->site_id }}</th>
                        <td>{{ $d->inst }}</td>
                        <td>{{ $d->cnt }}</td>
                        <td>{{ $d->cdate }}</td>                        
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
resetBtn.addEventListener('click', function () {
    $.ajaxSetup({
        beforeSend: function (xhr, type) {
            if (!type.crossDomain) {
                xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'));
            }
        },
    });
    $.post('https://meteo.report/admin/install', function (r) {
        if (r.result) location.href = 'https://meteo.report/admin/install';
    })    
});

archiveBtn.addEventListener('click', function(){
    location.href='https://meteo.report/admin/install/archived';
});
</script>
@endsection