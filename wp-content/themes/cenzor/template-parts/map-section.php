<?php
/**
 * Template part for displaying map section with cities
 *
 * @package cenzor
 */

if ( ! function_exists( 'belingoGeo_get_cities' ) ) {
	return;
}

$cities = belingoGeo_get_cities( array(
	'posts_per_page' => -1,
) );

if ( empty( $cities ) ) {
	return;
}

$map_points = array();
foreach ( $cities as $city ) {
	$city_name = $city->get_name();
	$city_meta = $city->get_meta();
	
	$address = isset( $city_meta['city_address'] ) ? $city_meta['city_address'][0] : '';
	$phone = isset( $city_meta['city_phone'] ) ? $city_meta['city_phone'][0] : '';
	
	if ( $city_name ) {
		$map_points[] = array(
			'name'    => $city_name,
			'address' => $address,
			'phone'   => $phone,
		);
	}
}

if ( empty( $map_points ) ) {
	return;
}
?>

<?php
$map_id = 'yandex-map-' . uniqid();
?>

<section class="map-section">
	<div class="container">
		<h2 class="map-section-title">Субъекты РФ в которых пользуются услугами нашей компании</h2>
		<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A16e5eca8e777abbc819c1b3f1a1e8beadfe44c5847095fc012dd784b0ddbd3c5&amp;width=500&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>	</div>
</section>

<style>
.map-section iframe{
	width: 100%;
}

</style>

<script>
	(function() {
		const mapPoints = <?php echo json_encode( $map_points ); ?>;
		const mapId = '<?php echo esc_js( $map_id ); ?>';
		
		if ( typeof ymaps === 'undefined' ) {
			const script = document.createElement('script');
			script.src = 'https://api-maps.yandex.ru/2.1/?apikey=2437cb1a-7149-473c-bf5b-d9d935c7de05&lang=ru_RU';
			script.onload = function() {
				ymaps.ready(initMap);
			};
			document.head.appendChild(script);
		} else {
			ymaps.ready(initMap);
		}
		
		function initMap() {
			if ( mapPoints.length === 0 ) {
				return;
			}
			
			const map = new ymaps.Map(mapId, {
				center: [55.751574, 37.573856],
				zoom: 5,
				controls: ['zoomControl', 'fullscreenControl']
			});
			
			const geocoder = ymaps.geocode;
			const promises = [];
			
			mapPoints.forEach(function(point, index) {
				const promise = geocoder(point.name).then(function(res) {
					const firstGeoObject = res.geoObjects.get(0);
					if ( firstGeoObject ) {
						const coordinates = firstGeoObject.geometry.getCoordinates();
						const placemark = new ymaps.Placemark(coordinates, {
							balloonContentHeader: point.name,
							balloonContentBody: '<p>' + (point.address || '') + '</p>' + (point.phone ? '<p>Телефон: ' + point.phone + '</p>' : ''),
							hintContent: point.name
						});
						return placemark;
					}
					return null;
				});
				promises.push(promise);
			});
			
			Promise.all(promises).then(function(placemarks) {
				const validPlacemarks = placemarks.filter(function(pm) {
					return pm !== null;
				});
				
				validPlacemarks.forEach(function(placemark) {
					map.geoObjects.add(placemark);
				});
				
				if ( validPlacemarks.length > 0 ) {
					const bounds = validPlacemarks.map(function(pm) {
						return pm.geometry.getCoordinates();
					});
					
					if ( bounds.length > 1 ) {
						map.setBounds(ymaps.util.bounds.fromPoints(bounds), {
							checkZoomRange: true
						});
					} else if ( bounds.length === 1 ) {
						map.setCenter(bounds[0], 10);
					}
				}
			});
		}
	})();
</script>

