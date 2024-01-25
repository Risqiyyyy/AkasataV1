@extends('layouts/contentNavbarLayout')

@section('title', 'Chart')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="row">
    <div class="d-grid gap-2 d-md-block">
        <a href="{{ route('chart') }}"><button type="button" class="btn btn-primary mb-3">Chart</button></a>
        <a href="{{ route('ipfilter.index') }}"><button type="button" class="btn btn-primary mb-3">IP Filter</button></a>
      </div>
    <div class="input-group mb-3">  
        <input type="file" class="form-control" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" aria-label="Upload">
        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Dropdown</button>
        {{-- <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">SSH Login Failed</a></li>
            <li><a class="dropdown-item" href="#">Windows Multiple Logon</a></li>
        </ul> --}}
      </div>
      <div id="sankey_chart"></div>
</div>
<script type="text/javascript">
    // Function to convert rawDataStr to JSON for each row

    // Function to generate Google's Sankey data
    function generateSankeyData(data) {
        let flows = {};

        data.forEach(row => {
            
            let sourceIP = row.remarks;
            const str = sourceIP.split(' ');
            const data = str[11];
            var filter = data.slice(5);
            let targetHostname = row.endpointHostName;
            let endpointIp = row.endpointIp;
            // let key = `${sourceIP} -> ${targetUsername} -> ${targetHostname}`;
            let key = `src:${filter} -> ${targetHostname} -> dst:${endpointIp}`;
            flows[key] = (flows[key] || 0) + 1;
        });

        let result = [['Source', 'Target', 'Count']];
        for (let key in flows) {
            let parts = key.split(' -> ');
            result.push([parts[0], parts[1], flows[key]]);
            result.push([parts[1], parts[2], flows[key]]);
        }

        return result;
    }

    // Load the Google Charts library
    google.charts.load('current', { 'packages': ['sankey'] });

    function drawChart(sankey_data) {
        google.charts.setOnLoadCallback(function () {
            var data = google.visualization.arrayToDataTable(sankey_data);

            // Set chart options
            var options = {
                width: '1024',
                height: 800,
                sankey: {
                    node: {
                        colors: ['#a61d4c', '#5a8f29', '#be9800', '#3366cc', '#109618', '#ff9900', '#dc3912']
                    },
                    link: {
                        colorMode: 'gradient',
                        colors: ['#a61d4c', '#5a8f29']
                    }
                }
            };

            // Instantiate and draw the chart
            var chart = new google.visualization.Sankey(document.getElementById('sankey_chart'));
            chart.draw(data, options);
        });
    }

    // Fetch data from the JSON URL
    fetch('./ssh.json')
        .then(response => response.json())
        .then(data => {
            // Generate Sankey data
            let sankeyData = generateSankeyData(data);

            // Draw the chart
            drawChart(sankeyData);
        })
        .catch(error => {
            console.error('Error fetching the JSON data:', error);
        });

</script>
@endsection