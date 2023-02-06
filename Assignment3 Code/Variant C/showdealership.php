<!DOCTYPE html>
<html>
<head>
  <title>Dealership Locator</title>
  <script src="http://www.openlayers.org/api/OpenLayers.js"></script>
  <script>

    var map=null;
    var markers=null;
		
    function createmarker (lon,lat) {
				var feature = new OpenLayers.LonLat( lon, lat ) // create features (locations) out of arrays in points
						.transform(  //transform the location to the coordinate system of our OpenLayers map
							new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
							map.getProjectionObject() // to Spherical Mercator Projection
						);
				markers.addMarker(new OpenLayers.Marker(feature)); // Add new features to markers layer
		}

    function init() {
      map = new OpenLayers.Map("basicMap"); //create a new map
      var mapnik = new OpenLayers.Layer.OSM(); //add an OpenStreetMap layer to have some data in the mapview
      map.addLayer(mapnik); //add the OSM layer to the map

	    markers = new OpenLayers.Layer.Markers( "Markers" ); //add a layer where markers can be put
	    map.addLayer(markers); //add the markers layer to the current map

	    var lonLat = new OpenLayers.LonLat( 13.0 ,47.8 ) //define a new location with these coordinates in WGS84
        .transform(  //transform the location to the coordinate system of our OpenLayers map
          new OpenLayers.Projection("EPSG:4326"), // transform from WGS 1984
          map.getProjectionObject() // to Spherical Mercator Projection
      );

			var poi = [ // create array with point of interests
      <?php
          	$log_db = new PDO('sqlite:./dealer.db');

            $brand=$_POST['brand'];

            $str = "SELECT * FROM dealership WHERE brand=:brand;";
          	$query = $log_db->prepare($str);
            $query->bindParam(':brand', $brand);
            $query->execute();
          	$rows = $query->fetchAll(PDO::FETCH_ASSOC);

            $i=0;
            foreach($rows as $row){
                if($i++>0) echo ",";
                echo "[".$row['latitude'].",".$row['longitude']."]";
            }      
      ?>
      ];

			for (var x of poi) { // for each array(object) in array 
				createmarker (x[0],x[1]) // create markers
			}

      map.setCenter(lonLat, 15); // Use maker to center the map above and set zoom level to 15
      var extent = map.zoomToExtent(markers.getDataExtent()); 
    }
  </script>

<style>

body{
    background:#444;
    color:#fff;
    font-family:verdana;
}

ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  color:#000;
  background-color: #689;
  background-color: #10CC8D;
}

li {
  float: left;
}

li a {
  display: block;
  color: #000;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: #222;
  color:#fff;
}

.active {
  background-color: #04AA6D;
  color:#fff;
}

.item3 {
    text-decoration: underline;
}

</style>  

</head>

<body onload="init();">

<ul>
  <li><img style="width:40px;margin-left:4px;margin-top:4px;" src="Icon.svg"></li>
  <li><a class="item2" href="#locator">News</a></li>
  <li><a class="item3" href="#options">Locator</a></li>
  <li class="item4" style="float:right">
      <a class="active" href="manage.php">Manage</a>
    </li>
</ul>

  <form method="POST" action="showdealership.php"><select name='brand' onchange="this.form.submit()"><option>Select a brand</option>
  <?php
    	$str="SELECT DISTINCT(brand) FROM dealership;";
    	$query = $log_db->prepare($str);
      $query->execute();
    	$rows = $query->fetchAll(PDO::FETCH_ASSOC);

      foreach($rows as $row){
          echo "<option>".$row['brand']."</option>";
      }
  ?>
  </select></form>

  <h1>Dealership Locator for <?php echo $_POST['brand']; ?></h1>
  <p>Do not forget to enable location services to see dealership near your location (currently not working)</p>

  <div style="width: 600px; height: 600px;" id="basicMap"></div>

  <p>To view the current list of dealerships on your mobile device scan the QR code below</p>
  <img src="https://quickchart.io/chart?cht=qr&chs=150x150&chl=http://wwwlab.webug.se" class="qr-code img-thumbnail img-responsive" />

</body>

</html>