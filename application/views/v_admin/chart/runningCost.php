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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
<body>
<figure class="highcharts-figure">
    <div id="container">
    </div>
    <table id="datatable">
        <thead>
        <select id="tahun" class="form-control" onchange="rubah('tahun')">
           <option value="2022">2022</option>
           <option value="2023">2023</option>
        </select>
        <tr>
            <th>Bulan</th>
            <th>Jumlah</th>
               
            </tr>
            
        </thead>
        <tbody>

            <?php foreach($running_cost as $rc) {?>
            <tr>
                
                <td><?php echo $rc['Bulan']; ?></td>
                <td><?php echo $rc['count']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</figure>
</body>
<script>
    $('#tahun').val(<?=$tahun?>);
    Highcharts.chart('container', {
    data: {
        table: 'datatable'
    },
    chart: {
        type: 'column'
    },
    title: {
        text: 'Running Cost (Rp)'
    },
    subtitle: {
        text:
            'Source:    ',
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        allowDecimals: true,
        title: {
            text: 'Rupiah'
        }
    },
    // tooltip: {
    //     formatter: function () {
    //         return '<b>' + this.series.name + '</b><br/>' +
    //             this.point.y + ' ' + this.point.name.toLowerCase();
    //     }
    // }
});

function rubah(tahun = 'a'){
            
                var tahun = $('#tahun').val();
               
                window.location.href = window.location.protocol+'//'+window.location.hostname+'/digitalisasi-form-workshop/admin/response/chartRunningCost/'+tahun;
                
}



</script>
</html>