<html>
    <head>
        <style>
            #container {
    height: 400px;
}

.highcharts-figure,
.highcharts-data-table table {
    min-width: 310px;
    max-width: 800px;
    margin: 1em auto;
}

#datatable {
    font-family: Verdana, sans-serif;
    border-collapse: collapse;
    border: 1px solid #ebebeb;
    margin: 10px auto;
    text-align: center;
    width: 100%;
    max-width: 500px;
}

#datatable caption {
    padding: 1em 0;
    font-size: 1.2em;
    color: #555;
}

#datatable th {
    font-weight: 600;
    padding: 0.5em;
}

#datatable td,
#datatable th,
#datatable caption {
    padding: 0.5em;
}

#datatable thead tr,
#datatable tr:nth-child(even) {
    background: #f8f8f8;
}

#datatable tr:hover {
    background: #f1f7ff;
}

        </style>
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/data.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    </head>
<body>
<figure class="highcharts-figure">
    <div id="container"></div>
    <table id="datatable">
        <thead>
            <tr>
            <th>Bulan</th>
                <th>Jumlah</th>
                
            </tr>
        </thead>
        <tbody>

            <?php foreach($running_hour as $rh) {?>
            <tr>
            <td><?php echo $rh['Bulan']; ?></td>
                <td><?php echo $rh['count']; ?></td>
                
            </tr>
            <?php } ?>
        </tbody>
    </table>
</figure>
</body>
<script>
    Highcharts.chart('container', {
    data: {
        table: 'datatable'
    },
    chart: {
        type: 'column'
    },
    title: {
        text: 'Running Hour Mesin'
    },
    subtitle: {
        text:
            'Source: <a href="#" target="_blank">PT Century Batteries Indonesia</a>'
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        allowDecimals: false,
        title: {
            text: 'Jam'
        }
    },
    // tooltip: {
    //     formatter: function () {
    //         return '<b>' + this.series.name + '</b><br/>' +
    //             this.point.y + ' ' + this.point.name.toLowerCase();
    //     }
    // }
});

</script>
</html>