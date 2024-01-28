<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Failed Logon</title>
</head>
<body>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <div id="sankey_chart" style="width: 900px; height: 300px;"></div>

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
                window.print();
            });
        }

        fetch('./rdp.json')
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
</body>
</html>