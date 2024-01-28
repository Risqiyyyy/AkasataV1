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
      <form action="{{ route('chart.store')}}" method="post" enctype="multipart/form-data">
        @csrf
    <div class="input-group mb-3">  
        <input type="file"  name="json_file" class="form-control" id="inputGroupFile03" aria-describedby="inputGroupFileAddon03" aria-label="Upload">
        {{-- <select name="category" id="category" class="btn btn-outline-secondary dropdown-toggle">
            <option value="ssh">SSH</option>
            <option value="category2">Category 2</option>
        </select> --}}
        <button type="submit" class="btn btn-secondary ">Upload</button>
      </div>
    </form>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <div id="sankey_chart"></div>

      <script type="text/javascript">
      function drawSankeyChart(data) {
        let flows = {}; 

        if (data.json_file && Array.isArray(data.json_file)) {
          data.json_file.forEach(function(row) {
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
          } else {
              console.error("'json_file' property is missing or is not an array");
          }
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

              // Instantiate and draw the chart
              var chart = new google.visualization.Sankey(document.getElementById('sankey_chart'));
              chart.draw(data, options);
          });
      }

          fetch('/getLastData')
              .then(response => response.json())
              .then(data => {
                let sankeyData = drawSankeyChart(data);
                drawChart(sankeyData);
              })
              .catch(error => console.error('Error:', error));
            </script>
</div>
@endsection