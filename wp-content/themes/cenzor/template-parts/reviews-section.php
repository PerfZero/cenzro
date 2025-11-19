<?php
/**
 * Template part for displaying reviews section
 *
 * @package cenzor
 */
?>

<section class="reviews-section">
	<div class="container">
		<h2 class="reviews-title">Отзывы наших клиентов</h2>
		
      
<div style="display: flex; justify-content: center;margin-top: 20px;border-radius: 20px;">
    <iframe title="Виджет с отзывами «Карусель» от MyReviews" style="width: 100%; height: 100%; max-width: 1170px; border: none; outline: none; padding: 0; margin: 0" id="myReviews__block-widget">
    </iframe>
</div>


      
<script src="https://myreviews.dev/widget/dist/index.js" defer></script>
<script>
    (function (){
      var myReviewsInit = function () {
        new window.myReviews.BlockWidget({
        uuid: "bc917803-2892-4a2e-ad59-4779c2fb4788",
        name: "g9167214",
        additionalFrame:"none",
        lang:"ru",
        widgetId: "1"
        }).init();

      };
    if (document.readyState === "loading") {
      document.addEventListener('DOMContentLoaded', function () {
          myReviewsInit()
      })
    } else {
      myReviewsInit()
    }
    })()
</script>
  
    
	</div>
</section>

