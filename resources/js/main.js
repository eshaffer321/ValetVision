$( document ).ready(function() {
    $('#tables').on('change', function (e) {
        var valueSelected = this.value;
        $('#filter').prop('disabled', false);
        $('#sort').attr('disabled', 'disabled').html('<option>...</option>').selectpicker('refresh');
        $('#order').attr('disabled', 'disabled').html('<option>...</option>').selectpicker('refresh');
        $('#output_table').empty();

        if (valueSelected == 'Drivers') {
            $("#filter")
                .html('<option>Active</option><option>Inactive</option>')
                .selectpicker('refresh');
                getData('driver');
        }
        
        if (valueSelected == 'Parking Spots') {
            $("#filter")
                .html('<option>Available</option><option>Occupied</option>')
                .selectpicker('refresh');
                getData('parking_spot');
        }
        
        if (valueSelected == 'Customers') {
            $("#filter")
                .html('<option>Car in Lot</option><option>Car picked up</option><option>Paid</option><option>Unpaid</option>')
                .selectpicker('refresh');
                getData('customer');
        }
        
        if (valueSelected == 'Tickets') {
            $("#filter")
                .html('<option>Needs Pickup</option><option>Car Delivered</option>')
                .selectpicker('refresh');
                getData('ticket');
        }
    });
    
    $('#filter').on('change', function (e) {
        var filterName = this.value;
        var tableName = $('#tables').find(":selected").text();
        $('#sort').prop('disabled', false);
        switch(tableName) {
            case 'Parking Spots':
                tableName = 'parking_spot';
                $("#sort")
                .html('<option>Parking Spot ID</option>')
                .selectpicker('refresh');
                break;
            case 'Drivers':
                tableName = 'driver';
                $("#sort")
                .html('<option>Name</option><option>Driver ID</option>')
                .selectpicker('refresh');
                break;
            case 'Customers':
                tableName= 'customer';
                $("#sort")
                .html('<option>Name</option><option>Make</option><option>Model</option><option>Customer ID</option>')
                .selectpicker('refresh');
                break;
            case 'Tickets':
                tableName = 'ticket';
                $("#sort")
                .html('<option>Dropoff Time</option><option>Parking Spot ID</option>')
                .selectpicker('refresh');
                break;
        }
        $('#output_table').empty();
        $('#order').prop('disabled', false);
        $("#order")
                .html('<option>Ascending</option><option>Descending</option>')
                .selectpicker('refresh');
        getFilteredData(tableName, filterName);
    });
    
    function getData(table) {
        $.post('admin_data.php', {table: table}, function(data) {
            $(data).appendTo('#output_table');
        });
    }
    
    function getFilteredData(table, filter) {
       $.post('admin_data.php', {table: table, filter: filter}, function(data) {
            $(data).appendTo('#output_table');
        }); 
    }

});