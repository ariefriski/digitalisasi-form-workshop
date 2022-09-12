<div id="chartContainer" style="float: left; height: 400px; width: 100%;">
<script src="http://code.jquery.com/jquery-1.7.1.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqwidgets/14.0.0/jqwidgets/jqx-all.js" type="text/javascript"></script>       
<script type="text/javascript">
$(document).ready(function () {
// memanggil data array dengan JSON
var source =
     {
         datatype: "json",
         datafields: [
                { name: 'hasil' },
                { name: 'total' }
         ],
         url: '<?php echo base_url() ?>admin/response/pieChart'
     };
var dataAdapter = new $.jqx.dataAdapter(source, { async: false, autoBind: true, loadError: function (xhr, status, error) { alert('Error loading "' + source.url + '" : ' + error); } });
// pengaturan jqxChart
    var settings = {
        title: "JOB TYPE",
        description: "",
        enableAnimations: true,
        showLegend: true,
        showBorderLine: true,
        legendLayout: { left: 10, top: 160, width: 300, height: 200, flow: 'vertical' },
        padding: { left: 5, top: 5, right: 5, bottom: 5 },
        titlePadding: { left: 0, top: 0, right: 0, bottom: 10 },
        source: dataAdapter,
        colorScheme: 'scheme03',
        seriesGroups:
           [
            {
              type: 'pie',
              showLabels: true,
              series:
                [
                  { 
                     dataField: 'total',
                     displayText: 'hasil',
                     labelRadius: 170,
                     initialAngle: 15,
                     radius: 145,
                     centerOffset: 0,
                     formatFunction: function (value) {
                                        if (isNaN(value))
                                            return value;
                                            return parseFloat(value);
                                        },
                  }
                ]
             }
           ]
         };
       // Menampilkan Chart
      $('#chartContainer').jqxChart(settings);
   });
</script>    
</div> 