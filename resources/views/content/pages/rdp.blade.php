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
        <a href="{{ route('chart') }}"><button type="button" class="btn btn-primary mb-3">SSH</button></a>
        <a href="{{ route('rdp.index') }}"><button type="button" class="btn btn-primary mb-3">RDP</button></a>
        <a href="{{ route('ipfilter.index') }}"><button type="button" class="btn btn-primary mb-3">IP Filter</button></a>
      </div>
      <form action="{{ route('rdp.store')}}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="input-group mb-3">  
        <input type="file"  name="json_rdp" class="form-control" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" aria-label="Upload">
        <button type="submit" class="btn btn-secondary ">Upload</button>
      </div>
    </form>
    <a href="{{ route('getprintrdp') }}"><button type="button" class="btn btn-primary mb-3">print</button></a>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <div id="sankey_chart"></div>
    <script type="text/javascript">

        function convertRawDataStrToJSON(data) {
            return data.map(row => {
                row.rawDataStr = JSON.parse(row.rawDataStr);
                return row;
            });
        }

        function generateSankeyData(data) {
            let flows = {};

            data.forEach(row => {
                let sourceIP = row.rawDataStr.EventData.IpAddress;
                let targetUsername = row.rawDataStr.EventData.TargetUserName;
                let targetHostname = row.endpointHostName;

                // let key = `${sourceIP} -> ${targetUsername} -> ${targetHostname}`;
                let key = `${sourceIP} -> ${targetHostname} -> ${targetUsername}`;
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
                var chart = new google.visualization.Sankey(document.getElementById('sankey_chart'));
                chart.draw(data, options);
            });
        }

        fetch('/getLastDatardp')
            .then(response => response.json())
            .then(data => {
                data = convertRawDataStrToJSON(data);
                let sankeyData = generateSankeyData(data);
                drawChart(sankeyData);
            })
            .catch(error => {
                console.error('Error fetching the JSON data:', error);
            });

    </script>
    </script>
</div>
@endsection