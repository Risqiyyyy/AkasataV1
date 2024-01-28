<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Failed SSH</title>
</head>
<body >
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <div id="sankey_chart" onload="window.print()"></div>
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
          window.print();
      }

          fetch('/getLastData')
              .then(response => response.json())
              .then(data => {
                let sankeyData = drawSankeyChart(data);
                drawChart(sankeyData);
              })
              .catch(error => console.error('Error:', error));
            </script>
</html>