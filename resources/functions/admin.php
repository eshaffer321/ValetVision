
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.9.3/css/bootstrap-select.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.9.3/js/bootstrap-select.min.js"></script>

    
    
    <script src="../js/main.js"></script>

    <title>Valet | Admin</title>
</head>
<body>
    <div class="container text-center">
        <h1 class="jumbrotron">Admin</h1>
    </div>
    
    <div class="container">
        <div class="row">
          <div class="col-xs-3">
            <div class="form-group">
              <label for="select">Select:</label>
                <select class="selectpicker show-tick show-menu-arrow" data-style="btn-primary" title="Select one..." id="tables">
                  <option data-icon="glyphicon glyphicon-shopping-cart">Customers</option>
                  <option data-icon="glyphicon glyphicon-user">Drivers</option>
                  <option data-icon="glyphicon glyphicon-th">Parking Spots</option>
                  <option data-icon="glyphicon glyphicon-tags">Tickets</option>
                </select>
            </div>
          </div>
          <div class="col-xs-3">
            <div class="form-group">
              <label for="filter">Filter By:</label>
                <select class="selectpicker show-tick show-menu-arrow" data-style="btn-primary" id="filter" title="..." disabled>
                </select>
            </div>
          </div>
          <div class="col-xs-3">
            <div class="form-group">
              <label for="sort">Sort By:</label>
                <select class="selectpicker show-tick show-menu-arrow" data-style="btn-primary" name ="sort" id="sort" title="..." disabled>
                </select>
            </div>
          </div>
          <div class="col-xs-3">
            <div class="form-group">
              <label for="order">Order By:</label>
                <select class="selectpicker show-tick show-menu-arrow" data-style="btn-primary" name ="order" id="order" title="..." disabled>
                  <option value="">Ascending</option>
                  <option value="">Descending</option>
                </select>
            </div>
          </div>
        </div>
    </div>
    
    <div class="container" id="output_table">
      
    </div>
    
</body>
</html>