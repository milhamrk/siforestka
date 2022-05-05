<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>


    
 <!--
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
  
<link rel="stylesheet" href="https://netdna.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

<!--  <link href="< ?=base_url()?>assets/css/BootSideMenu.css" rel="stylesheet">
-->  
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/cluster/dist/MarkerCluster.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>asset/cluster/dist/MarkerCluster.Default.css" />
	
	
	<link href="<?php echo base_url(); ?>asset/leaflet/leaflet.css" rel="stylesheet">

  
   
<style type="text/css">
  .user{
    padding:5px;
    margin-bottom: 5px;
  }
  #mapid { 
	height: 550px;
	z-index:1;
  }
</style>
</head>
<body>

	<div class="ps-breadcrumb">
		<div class="ps-container">
			<ul class="breadcrumb">
				<li><a href="<?php echo base_url(); ?>">Home</a></li>
				<li>Peta</li>
			</ul>
		</div>
	</div>
<div class="ps-page--blog">
	<div class="container">

		<div id="mapid"></div>
	
		

	
	
	
 <!--
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
 -->
  <script src="<?php echo base_url(); ?>asset/leaflet/leaflet.js"></script> 
  <script src="<?php echo base_url(); ?>asset/js/leaflet.ajax.js"></script> 
  <script src="<?php echo base_url(); ?>asset/cluster/dist/leaflet.markercluster-src.js"></script>
     
  <script type="text/javascript"> 
 	
	var map = L.map('mapid').setView([-3.319461,114.5888483], 8);
	var base_url="<?=base_url()?>";
	
	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
	}).addTo(map);
	
	//L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
		//attribution: 'Tiles &copy; Esri &mdash; Source: Esri, i-cubed, USDA, USGS, AEX, GeoEye, Getmapping, Aerogrid, IGN, IGP, UPR-EGP, and the GIS User Community'
	//}).addTo(map);
	
	var myFeatureGroup = L.featureGroup().addTo(map).on("click", groupClick);
	var produkMarker;
	var markers = L.markerClusterGroup();
	
	$.getJSON("<?=base_url()?>peta/produk_json", function(data){
		$.each(data, function(i, field){
			
			var v_lat=parseFloat(data[i].produk_lat);
			var v_long=parseFloat(data[i].produk_long);
			var kode=data[i].id_produk;
			var kategori=data[i].id_kategori_produk;
			var nama=data[i].produk_nama;
			var idproduk=data[i].id_produk;
			
			
			
			if (kategori==15){
				var info_bidang="<div style='text-align:center'><b>INFO</b></div>";
				info_bidang+="<div style='text-align:center;color:red'>"+idproduk+"-"+nama+"</div>";
				info_bidang+="<a href='<?=base_url()?>peta/bidang_detail/"+kode+"'><img src='<?=base_url()?>asset/images/bajakah.jpg' width=230' height='180'/>";
				info_bidang+="<div style=width:100%;text-align:center;margin-top:10px;'><a href='<?=base_url()?>peta/bidang_detail/"+kode+"'> DETAIL </a></div>";
				var icon_produk = L.icon({
					iconUrl: base_url+'asset/images/tree.png',
					iconSize: [20,20]
				});
			}else if (kategori==16){
				var info_bidang="<div style='text-align:center'><b>INFO</b></div>";
				info_bidang+="<div style='text-align:center;color:red'>"+idproduk+"-"+nama+"</div>";
				info_bidang+="<a href='<?=base_url()?>peta/bidang_detail/"+kode+"'><img src='<?=base_url()?>asset/images/jasling.jpg' width=230' height='180'/>";
				info_bidang+="<div style=width:100%;text-align:center;margin-top:10px;'><a href='<?=base_url()?>peta/bidang_detail/"+kode+"'> DETAIL </a></div>";
				var icon_produk = L.icon({
					iconUrl: base_url+'asset/images/jasling.png',
					iconSize: [20,20]
				});
			}else if (kategori==17){
				var info_bidang="<div style='text-align:center'><b>INFO</b></div>";
				info_bidang+="<div style='text-align:center;color:red'>"+idproduk+"-"+nama+"</div>";
				info_bidang+="<a href='<?=base_url()?>peta/bidang_detail/"+kode+"'><img src='<?=base_url()?>asset/images/karbon.jpg' width=230' height='180'/>";
				info_bidang+="<div style=width:100%;text-align:center;margin-top:10px;'><a href='<?=base_url()?>peta/bidang_detail/"+kode+"'> DETAIL </a></div>";
				var icon_produk = L.icon({
					iconUrl: base_url+'asset/images/karbon.png',
					iconSize: [20,20]
				});
			}else {
				var info_bidang="<div style='text-align:center'><b>INFO</b></div>";
				info_bidang+="<div style='text-align:center;color:red'>"+idproduk+"-"+nama+"</div>";
				info_bidang+="<a href='<?=base_url()?>peta/bidang_detail/"+kode+"'><img src='<?=base_url()?>asset/images/kayu.jpg' width=230' height='180'/>";
				info_bidang+="<div style=width:100%;text-align:center;margin-top:10px;'><a href='<?=base_url()?>peta/bidang_detail/"+kode+"'> DETAIL </a></div>";
				var icon_produk = L.icon({
					iconUrl: base_url+'asset/images/kayu.png',
					iconSize: [20,20]
				});
			};
			
			produkMarker = L.marker([v_long,v_lat],{icon:icon_produk})
				//.addTo(myFeatureGroup)
				.bindPopup(info_bidang, {
					maxWidth : 230,
					closeButton: true,
					offset: L.point(0, -20)
				})
			produkMarker.id = data[i].id_produk	;
			markers.addLayer(produkMarker);
			map.addLayer(markers);
			map.fitBounds(markers.getBounds());
		});
	});
	
	function groupClick(event) {
		/* alert("Clicked on marker " + event.layer.id); */
	}
	
	/* var jsonTest = new L.GeoJSON.AJAX(["assets/geojson/bumi.geojson"],{onEachFeature:popUp}).addTo(map); */
	 
	/* $.getJSON(base_url+"assets/geojson/map.geojson", function(data){
		geoLayer = L.geoJson(data, {
			style: function(feature) {
					return {
								fillOpacity: 0.8,
								weight: 1,
								opacity: 1,
								color:"#008cff"
							};
				},
		
				onEachFeature: function(feature, layer) {
					var latt = parseFloat(feature.properties.latitude);
					var info_bidang="hallo";
					layer.bindPopup(info_bidang, {
						maxWidth : 260,
						closeButton: true,
						offset: L.point(0, -20)
					})
		
					layer.on('click',function() {
						layer.openPopup();
					});
				}
				
		}).addto(map); 
	});  */
		
	/* onEachFeature: function(feature, layer) {
		var latt = parseFloat(feature.properties.latitude);
		var info_bidang="hallo";
		layer.bindPopup(info_bidang, {
			maxWidth : 260,
			closeButton: true,
			offset: L.point(0, -20)
		});
		
		layer.on('click',function() {
			layer.openPopup();
		}
	} 
/* }  */


	
	
	
	
	
  </script>
  
</div></div>


</body>
</html>